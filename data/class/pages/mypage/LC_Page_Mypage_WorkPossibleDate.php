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
class LC_Page_Mypage_WorkPossibleDate extends LC_Page_AbstractMypage_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_subtitle = '勤務可能日登録';
        $this->tpl_mypageno = 'work_possible_date';

        $arrHOUR = array('00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        foreach ($arrHOUR as $hour) {
            $this->arrTime[$hour . ':00'] = $hour . ':00';
            $this->arrTime[$hour . ':30'] = $hour . ':30';
        }
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
        $this->page = 'list';
        $this->arrErr = array();
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_POST['mode'] = 'return';
        }

        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        if (count($_POST) == 0) {
            $startDate = date('Y-m-d');
            $objQuery->setorder('working_date DESC');
            $arrPossibleDate = $objQuery->select('working_date', 'dtb_work_possible_date', 'customer_id = ?', array($customer_id));
            if (count($arrPossibleDate) > 0 && $arrPossibleDate[0]['working_date'] > Date('Y-m-d'))
                $startDate = $arrPossibleDate[0]['working_date'];
            $arrResult = array();
            for ($i = 0; $i < 13; $i++) {
                $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
                $arrResult[$i]['working_date'] = $startDate;
            }
            $objFormParam->setParam(SC_Utils_Ex::sfSwapArray($arrResult));
        }
        else
            $objFormParam->setParam($_REQUEST);
        $objFormParam->convParam();

        $this->arrErr = array();
        $arrVal = $objFormParam->getHashArray();
        foreach ($arrVal['working_date'] as $key => $value) {
            if (strlen($arrVal['working_start'][$key]) > 0 && strlen($arrVal['working_over'][$key]) == 0 ||
                    strlen($arrVal['working_start'][$key]) == 0 && strlen($arrVal['working_over'][$key]) > 0) {
                $this->arrErr[$key] = '※ 時間帯はすべての項目を入力して下さい。<br />';
            }
        }
        $this->arrForm = $objFormParam->getFormParamList();

        switch ($this->getMode()) {
            case 'confirm':
                if (SC_Utils_Ex::isBlank($this->arrErr))
                    $this->page = 'confirm';
                break;
            case 'return':
                break;
            case 'complete':
                $this->lfRegistData($objQuery, $objFormParam, $customer_id);
                $this->page = 'complete';
                break;
            default:
                break;
        }
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('日付', 'working_date');
        $objFormParam->addParam('時間帯1', 'working_start');
        $objFormParam->addParam('時間帯2', 'working_over');
        $objFormParam->addParam('残業可', 'overtime_allowed');
    }

    function lfRegistData($objQuery, &$objFormParam, $customer_id) {
        $arrRet = $objFormParam->getHashArray();
        $sqlval['customer_id'] = $customer_id;
        foreach ($arrRet['working_start'] as $key => $start) {
            if ($start != '') {
                $sqlval['working_date'] = $arrRet['working_date'][$key];
                $sqlval['working_start'] = $arrRet['working_start'][$key];
                $sqlval['working_over'] = $arrRet['working_over'][$key];
                $sqlval['overtime_allowed'] = $arrRet['overtime_allowed'][$key];
                $objQuery->insert('dtb_work_possible_date', $sqlval);
            }
        }
    }

}
