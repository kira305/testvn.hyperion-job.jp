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
 * @version $Id: LC_Page_Admin_Products_Calendar.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Products_Calendar extends LC_Page_Admin_Ex {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'products/calendar.tpl';
        $this->tpl_mainno = 'products';
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
		$objQuery =& SC_Query_Ex::getSingletonInstance();
        $this->product_id = $_GET['product_id'];
		if($this->getMode() != '')
			$this->product_id = $_POST['product_id'];

        switch ($this->getMode()) {
            case 'save':
				$this->year = $_POST['year'];
	            $this->month = $_POST['month'];

				$this->next_year = $this->year;
				$this->next_month = $this->month + 1;
				if ($this->next_month > 12) {
	                $this->next_month = 1;
	                $this->next_year = $this->next_year + 1;
	            }
				$dates = $objQuery->select('*', 'dtb_calendar', 'product_id = ? AND (workday LIKE ? OR workday LIKE ?)', array($this->product_id, sprintf('%%%s%%', $this->year.'-'.$this->month), sprintf('%%%s%%', $this->next_year.'-'.$this->next_month)));
				foreach($dates as $date){
					if(in_array($date['workday'], $_POST['cal'])){
						if($date['del_flg'] == 1){
							$arrVal = array('del_flg'=>0);
							$arrVal['update_date'] = 'CURRENT_TIMESTAMP';
							$objQuery->update('dtb_calendar', $arrVal, 'calendar_id = ?', array($date['calendar_id']));
						}
						foreach($_POST['cal'] as $key=>$cal){
							if($cal == $date['workday'])
								unset($_POST['cal'][$key]);
						}
					}
					else{
						$arrVal = array('del_flg'=>1);
						$arrVal['update_date'] = 'CURRENT_TIMESTAMP';
						$objQuery->update('dtb_calendar', $arrVal, 'calendar_id = ?', array($date['calendar_id']));
					}
				}
				
				if(count($_POST['cal']) > 0){
					$arrVal = array();
					$arrVal['product_id'] = $this->product_id;
					$arrVal['creator_id'] = $_SESSION['member_id'];
					foreach($_POST['cal'] as $date){
						$arrVal['workday'] = $date;
						$objQuery->insert('dtb_calendar', $arrVal);
					}
				}
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

		$dates = $objQuery->select('workday', 'dtb_calendar', 'product_id = ? AND del_flg = 0', array($this->product_id));
		foreach($dates as $date)
			$this->dates[] = $date['workday'];

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

	/**
     * カレンダー情報取得.
     *
     * @param integer $disp_month 表示する月数
     * @return array $arrCalendar カレンダー情報の配列を返す
     */
    function lfGetCalendar($year, $month, $disp_month = 1) {

        $today = date('Y/m/d');
        for ($j = 0; $j <= $disp_month-1; ++$j) {
            $month = $month + $j;
            if ($month > 12) {
                $month = $month%12;
                $year = $year + $month%12;
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
        foreach ($arrRet AS $key=>$val) {
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
            $day = date('w', mktime(0,0,0 ,$month, $day, $year));
            if (in_array($day, $this->arrRegularHoliday)) {
                return true;
            }
        }
        return false;
    }
}
