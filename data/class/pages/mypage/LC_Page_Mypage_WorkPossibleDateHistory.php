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
class LC_Page_Mypage_WorkPossibleDateHistory extends LC_Page_AbstractMypage_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_subtitle = '申請状況の確認';
        $this->tpl_mypageno = 'work_possible_date_history';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrStatus = $masterData->getMasterData('mtb_possible_date_status');
        $this->jpWeek = array(1 => '月', 2 => '火', 3 => '水', 4 => '木', 5 => '金', 6 => '土', 7 => '日');
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

        $this->year = date('Y');
        $this->month = date('n');
        if ($_POST['mode'] == 'changeMonth') {
            $pair = explode('-', $_POST['yearmonth']);
            $this->year = $pair[0];
            $this->month = $pair[1];
        }

        $objQuery->setorder('working_date DESC');
        $arrForm = $objQuery->select('*', 'dtb_work_possible_date', 'customer_id = ? AND working_date >= ?', array($customer_id, date("Y-m-01", strtotime("-5 months"))));
        $this->arrForm = array();
        foreach ($arrForm as $key => $arr) {
            list($arrForm[$key]['year'], $arrForm[$key]['month'], $arrForm[$key]['day']) = explode('-', $arr['working_date']);
            $this->arrYearMonth[$arrForm[$key]['year'] . '-' . $arrForm[$key]['month']] = $arrForm[$key]['year'] . '年' . $arrForm[$key]['month'] . '月';
            if ($arrForm[$key]['year'] == $this->year && $arrForm[$key]['month'] == $this->month)
                $this->arrForm[] = $arrForm[$key];
        }
        $this->selectedYearMonth = $this->year . '-';
        if (strlen($this->month) == 1)
            $this->selectedYearMonth .= '0';
        $this->selectedYearMonth .= $this->month;
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
