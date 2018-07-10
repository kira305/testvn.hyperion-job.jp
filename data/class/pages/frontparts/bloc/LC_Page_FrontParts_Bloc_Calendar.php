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
define('CALENDAR_ROOT', DATA_REALDIR . 'module/Calendar' . DIRECTORY_SEPARATOR);
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * Calendar のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $ $
 */
class LC_Page_FrontParts_Bloc_Calendar extends LC_Page_FrontParts_Bloc_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
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

        // 休日取得取得
        $this->arrHoliday = $this->lfGetHoliday();
        // 定休日取得取得
        $this->arrRegularHoliday = $this->lfGetRegularHoliday();
        // カレンダーデータ取得
        $this->arrCalendar = $this->lfGetCalendar(1);

        $startDate = date('Y-n-j', strtotime('+5 days'));
        $arr = explode('-', $startDate);
        $this->year = $arr[0];
        $this->month = $arr[1];
        $this->day = $arr[2];

        $date_from = date('Y') . '-' . date('n') . '-1';
        $year = date('Y');
        $month = date('n') + 1;
        if ($month > 12) {
            $month = 1;
            $year = $year + 1;
        }
        $date_to = $year . '-' . month . '-31';

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->setGroupBy('workday');
        $dates = $objQuery->select('count(calendar_id) as count, workday', 'dtb_calendar', 'del_flg = 0 AND workday >= ? AND workday <= ? AND product_id IN (select product_id from dtb_products where del_flg = 0 and status = 1)', array($date_from, $date_to));
        foreach ($dates as $date)
            $this->dates[$date['workday']] = $date['count'];
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    /**
     * カレンダー情報取得.
     *
     * @param integer $disp_month 表示する月数
     * @return array $arrCalendar カレンダー情報の配列を返す
     */
    function lfGetCalendar($disp_month = 1) {

        $today = date('Y/m/d');
        for ($j = 0; $j <= $disp_month - 1; ++$j) {
            $year = date('Y');
            $month = date('n') + $j;
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
