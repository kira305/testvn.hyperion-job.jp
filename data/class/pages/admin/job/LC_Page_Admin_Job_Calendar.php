<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2012 LOCKON CO.,LTD. All Rights Reserved.
 *
 * http://www.lockon.co.jp/
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * 商品選択 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Job_Calendar.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Job_Calendar extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/calendar.tpl';
        $this->tpl_mainno = 'job';
        $this->arrTIMEFLAG = array(1 => '日勤', 2 => '夜勤');
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_REQUEST);

        $this->customer_id = $_GET['customer_id'];
        if ($this->getMode() != '') {
            $this->customer_id = $_POST['customer_id'];

            if ($this->getMode() == 'ok' || $this->getMode() == 'save' || $this->getMode() == 'delete') {
                $this->year = $_POST['year'];
                $this->month = $_POST['month'];

                $this->next_year = $this->year;
                $this->next_month = $this->month + 1;
                if ($this->next_month > 12) {
                    $this->next_month = 1;
                    $this->next_year = $this->next_year + 1;
                }
            }
        }

        switch ($this->getMode()) {
            case 'ok':
                $this->arrErr = $objFormParam->checkError();
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    $arrVal = array();
                    $arrVal['customer_id'] = $this->customer_id;
                    $arrVal['time_flag'] = $_POST['time_flag'];
                    $arrVal['working_start'] = $_POST['working_start'];
                    $arrVal['working_over'] = $_POST['working_over'];
                    $arrVal['breaktime_s'] = $_POST['breaktime_s'];
                    $arrVal['breaktime_o'] = $_POST['breaktime_o'];
                    $arrVal['price'] = $_POST['price'];

                    foreach ($_POST['cal'] as $date) {
                        $arrVal['working_day'] = $date;
                        list($arrVal['working_hour'], $arrVal['overtime'], $arrVal['subtotal']) = $this->calculate($arrVal);
                        $_SESSION['working_calendar'][$arrVal['customer_id']][$arrVal['working_day']] = $arrVal;
                    }
                } else{
                    $this->arrForm = $objFormParam->getFormParamList();
                }
                break;
            case 'save':
                foreach ($_POST['working'] as $working_day => $values) {
                    $values['customer_id'] = $this->customer_id;
                    $_SESSION['working_calendar'][$this->customer_id][$working_day] = $values;
                    list($_SESSION['working_calendar'][$this->customer_id][$working_day]['working_hour'], $_SESSION['working_calendar'][$this->customer_id][$working_day]['overtime'], $_SESSION['working_calendar'][$this->customer_id][$working_day]['subtotal']) = $this->calculate($values);
                }
                break;
            case 'delete':
                unset($_SESSION['working_calendar'][$this->customer_id][$_POST['date']]);
                break;
            case 'previous':
                $this->year = $_POST['year'];
                $this->month = $_POST['month'] - 1;
                if ($this->month < 1) {
                    $this->month = 12;
                    $this->year = $this->year - 1;
                }
                break;
            case 'next':
                $this->year = $_POST['year'];
                $this->month = $_POST['month'] + 1;
                if ($this->month > 12) {
                    $this->month = 1;
                    $this->year = $this->year + 1;
                }
                break;
            default:
                $this->year = date('Y');
                $this->month = date('n');
                break;
        }

        $this->arrDate = $_SESSION['working_calendar'][$this->customer_id];
        foreach ($this->arrDate as $date => $value)
            $this->dates[] = $date;

        $this->arrHoliday = $this->lfGetHoliday();
        $this->arrRegularHoliday = $this->lfGetRegularHoliday();
        $this->arrCalendar = $this->lfGetCalendar($this->year, $this->month, 2);
        $this->setTemplate($this->tpl_mainpage);
    }

    /**
     * デストラクタ.
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('日勤/夜勤', 'time_flag', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業時刻1', 'working_start', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時刻2', 'working_over', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時刻1', 'breaktime_s', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時刻2', 'breaktime_o', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('派遣料金', 'price', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
    }

    function calculate($arrValues) {
        $dt = new DateTime($arrValues['working_day']);
        $arrValues['working_w_day'] = $dt->format('N');

        if ($arrValues['working_w_day'] == 7) {
            if ($arrValues['time_flag'] == 1) {
                $workingtime = 1.35;
                $overtime = 1.35;
            } else {
                $workingtime = 1.6;
                $overtime = 1.6;
            }
        } else {
            if ($arrValues['time_flag'] == 1) {
                $workingtime = 1;
                $overtime = 1.25;
            } else {
                $workingtime = 1.25;
                $overtime = 1.5;
            }
        }
        $workingtime = $arrValues['price'] * $workingtime;
        $overtime = $arrValues['price'] * $overtime;

        $breaktime = '00:00';
        if ($arrValues['breaktime_s'] != '' && $arrValues['breaktime_o'] != '')
            $breaktime = $this->time_diff($arrValues['breaktime_s'], $arrValues['breaktime_o'], true);
        $working_hour = $this->time_diff($arrValues['working_start'], $arrValues['working_over'], true);

        $arrValues['working_hour'] = $this->time_diff($breaktime, $working_hour, false);
        $arrValues['overtime'] = '00:00';
        if (substr($arrValues['working_hour'], 0, 2) > 8) {
            $arrValues['overtime'] = $this->time_diff('08:00', $arrValues['working_hour'], false);
            $arrValues['working_hour'] = '08:00';
        }

        $arrValues['subtotal'] = round(($this->hourToMinute($arrValues['working_hour']) * $workingtime + $this->hourToMinute($arrValues['overtime']) * $overtime) / 60);
        return array($arrValues['working_hour'], $arrValues['overtime'], $arrValues['subtotal']);
    }

    function time_diff($start_time, $over_time, $diff) {
        $current_hour = substr($over_time, 0, 2);
        $current_min = substr($over_time, 3, 2);
        $ref_hour = substr($start_time, 0, 2);
        $ref_min = substr($start_time, 3, 2);

        if ($diff) {
            if ($current_hour < $ref_hour || ($current_hour == $ref_hour && $current_min < $ref_min)) {
                $current_hour += 12;
                if ($current_hour <= $ref_hour)
                    $current_hour += 12;
            }
        }

        $hDf = $current_hour - $ref_hour;
        $mDf = $current_min - $ref_min;

        if ($hDf > 0) {
            if ($mDf < 0) {
                $mDf = 60 + $mDf;
                $hDf -= 1;
                return $this->twoDigitValue($hDf) . ':' . $this->twoDigitValue($mDf);
            } else {
                return $this->twoDigitValue($hDf) . ':' . $this->twoDigitValue($mDf);
            }
        } else {
            if ($mDf > 0) {
                return '00:' . $this->twoDigitValue($mDf);
            }
        }
        return '00:00';
    }

    function hourToMinute($time) {
        $hour = substr($time, 0, 2);
        $min = substr($time, 3, 2);
        return 60 * $hour + $min;
    }

    function twoDigitValue($value) {
        if ($value >= 10)
            return $value;
        else
            return '0' . $value;
    }

    /**
     * カレンダー情報取得.
     *
     * @param integer $disp_month 表示する月数
     * @return array $arrCalendar カレンダー情報の配列を返す
     */
    function lfGetCalendar($year, $month, $disp_month = 1) {

        $today = date('Y/m/d');
        for ($j = 0; $j <= $disp_month - 1; ++$j) {
            $month = $month + $j;
            if ($month > 12) {
                $month = $month % 12;
                $year = $year + $month % 12;
            }

            $objMonth = new Calendar_Month_Weekdays($year, $month, 0);
            $objMonth->build();
            $i = 0;
            while ($objDay = $objMonth->fetch()) {
                if ($month == $objDay->month) {
                    $arrCalendar[$j][$i]['in_month'] = true;
                } else {
                    $arrCalendar[$j][$i]['in_month'] = false;
                }
                $arrCalendar[$j][$i]['first'] = $objDay->first;
                $arrCalendar[$j][$i]['last'] = $objDay->last;
                $arrCalendar[$j][$i]['empty'] = $objDay->empty;
                $arrCalendar[$j][$i]['year'] = $year;
                $arrCalendar[$j][$i]['month'] = $month;
                $arrCalendar[$j][$i]['day'] = $objDay->day;
                if ($this->lfCheckHoliday($year, $month, $objDay->day)) {
                    $arrCalendar[$j][$i]['holiday'] = true;
                } else {
                    $arrCalendar[$j][$i]['holiday'] = false;
                }

                if ($today === sprintf('%04d/%02d/%02d', $year, $month, $objDay->day)) {
                    $arrCalendar[$j][$i]['today'] = true;
                }
                ++$i;
            }
        }

        return $arrCalendar;
    }

    /**
     * 休日取得.
     *
     * @return array $arrHoliday 休日情報の配列を返す
     */
    function lfGetHoliday() {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $objQuery->setOrder('rank DESC');

        $where = 'del_flg <> 1';
        $arrRet = $objQuery->select('month, day', 'dtb_holiday', $where);
        foreach ($arrRet AS $key => $val) {
            $arrHoliday[$val['month']][] = $val['day'];
        }
        return $arrHoliday;
    }

    /**
     * 定休日取得.
     *
     * @return array $arrRegularHoliday 定休日情報の配列を返す
     */
    function lfGetRegularHoliday() {
        $arrInfo = SC_Helper_DB_Ex::sfGetBasisData();
        $arrRegularHoliday = explode('|', $arrInfo['regular_holiday_ids']);
        return $arrRegularHoliday;
    }

    /**
     * 休日チェック取得.
     *
     * @param integer $year 年
     * @param integer $month 月
     * @param integer $day 日
     * @return boolean 休日の場合trueを返す
     */
    function lfCheckHoliday($year, $month, $day) {
        if (!empty($this->arrHoliday[$month])) {
            if (in_array($day, $this->arrHoliday[$month])) {
                return true;
            }
        }
        if (!empty($this->arrRegularHoliday)) {
            $day = date('w', mktime(0, 0, 0, $month, $day, $year));
            if (in_array($day, $this->arrRegularHoliday)) {
                return true;
            }
        }
        return false;
    }

}
