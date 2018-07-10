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
require_once CLASS_EX_REALDIR . 'page_extends/mypage/LC_Page_AbstractMypage_Ex.php';

/**
 * 登録内容変更 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Mypage_Change.php 21883 2012-06-02 14:43:27Z Yammy $
 */
class LC_Page_Mypage_WorkReport extends LC_Page_AbstractMypage_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_subtitle = '随時振込申請';
        $this->tpl_mypageno = 'work_report';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrApplyStatus = $masterData->getMasterData('mtb_apply_status');

        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');
        $objDate = new SC_Date_Ex(RELEASE_YEAR, date('Y', strtotime('now')));
        $this->arrYear = $objDate->getYear('', RELEASE_YEAR, '');
        $this->arrMonth = $objDate->getMonth(true);
        $this->arrDay = $objDate->getDay(true);
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
    }

    /**
     * Page のプロセス
     * @return void
     */
    function action() {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_POST['mode'] = 'return';
        }

        $this->page = 'list';
        $this->year = date('Y');
        $this->month = date('n');

        switch ($this->getMode()) {
            case 'save':
                if (count($_POST['id']) > 0) {
                    $arrUpd = array('apply_flg' => 1);
                    if (strtotime(Date('H:i:s')) >= strtotime('20:00:00'))
                        $arrUpd['transfer_date'] = date('Y-m-d', strtotime(Date('Y-m-d') . ' +2 Weekday'));
                    else
                        $arrUpd['transfer_date'] = date('Y-m-d', strtotime(Date('Y-m-d') . ' +1 Weekday'));

                    $arrRet = $objQuery->select('month, day', 'dtb_holiday', 'del_flg <> 1');
                    foreach ($arrRet AS $val) {
                        $tempDate = Date('Y') . '-';
                        if (strlen($val['month']) == 1)
                            $tempDate .= '0';
                        $tempDate .= $val['month'] . '-';
                        if (strlen($val['day']) == 1)
                            $tempDate .= '0';
                        $tempDate .= $val['day'];
                        $arrHoliday[] = $tempDate;
                    }
                    $arrUpd['transfer_date'] = $this->getPossibleDay($arrHoliday, $arrUpd['transfer_date']);
                    $arrUpd['apply_date'] = date('Y-m-d H:i:s');
                    $objQuery->update('dtb_prepayment_apply', $arrUpd, 'id IN (' . SC_Utils_Ex::sfGetCommaList($_POST['id']) . ')');
                    $this->page = 'complete';
                    list($this->_year, $this->_month, $this->_day) = explode('-', $arrUpd['transfer_date']);
                }
                else {
                    $pair = explode('-', $_POST['yearmonth']);
                    $this->year = $pair[0];
                    $this->month = $pair[1];
                }
                break;
            case 'changeMonth':
                $pair = explode('-', $_POST['yearmonth']);
                $this->year = $pair[0];
                $this->month = $pair[1];
                break;
            default:
                break;
        }

        $objQuery->setorder('working_date DESC');
        $arrForm = $objQuery->select('id,company_name,working_date,apply_flg,apply_date', 'dtb_prepayment_apply', 'del_flg = 0 AND customer_id = ? AND working_date >= ? AND working_date <= ?', array($customer_id, date("Y-m-01", strtotime("-5 months")), date('Y-m-31')));
        $this->noresult = TRUE;
        $this->arrForm = array();
        foreach ($arrForm as $key => $arr) {
            list($arrForm[$key]['year'], $arrForm[$key]['month'], $arrForm[$key]['day']) = explode('-', $arr['working_date']);
            $this->arrYearMonth[$arrForm[$key]['year'] . '-' . $arrForm[$key]['month']] = $arrForm[$key]['year'] . '年' . $arrForm[$key]['month'] . '月';
            if ($arrForm[$key]['year'] == $this->year && $arrForm[$key]['month'] == $this->month)
                $this->arrForm[] = $arrForm[$key];
            if ($arr['apply_flg'] == 0)
                $this->noresult = FALSE;
        }
        $this->selectedYearMonth = $this->year . '-';
        if (strlen($this->month) == 1)
            $this->selectedYearMonth .= '0';
        $this->selectedYearMonth .= $this->month;
    }

    function getPossibleDay($arrHoliday, $transfer_date) {
        if (in_array($transfer_date, $arrHoliday)) {
            $new_transfer_date = date('Y-m-d', strtotime($transfer_date . ' +1 Weekday'));
            return $this->getPossibleDay($arrHoliday, $new_transfer_date);
        }
        else
            return $transfer_date;
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

}
