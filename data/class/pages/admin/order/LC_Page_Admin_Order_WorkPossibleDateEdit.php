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
 * 会員情報修正 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Customer_Edit.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Order_WorkPossibleDateEdit extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'order/work_possible_date_edit.tpl';
        $this->tpl_mainno = 'order';
        $this->tpl_subno = 'work_possible_date_edit';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '受注管理';
        $this->tpl_subtitle = '勤務可能日登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrStatus = $masterData->getMasterData('mtb_possible_date_status');

        $objDate = new SC_Date_Ex();
        $objDate->setStartYear(RELEASE_YEAR);
        $objDate->setEndYear(DATE('Y'));
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();
        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrCustomer = $objQuery->select('customer_id,staff_id,name01,name02,kana01,kana02', 'dtb_customer', 'del_flg = 0');
        foreach ($arrCustomer as $customer) {
            $this->arrCustomerNameById[$customer['customer_id']] = $customer['name01'] . $customer['name02'];
            $this->arrCustomerInfoById[$customer['customer_id']] = $customer;
        }
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
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objFormParam = new SC_FormParam_Ex();
        $objFormSearchParam = new SC_FormParam_Ex();

        if (count($_POST) > 0) {
            $this->lfInitSearchParam($objFormSearchParam);
            if ($_POST['mode'] != 'edit_search') {
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
            }
            else
                $objFormSearchParam->setParam($_REQUEST);
            $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
            $this->arrSearchData = $objFormSearchParam->getSearchArray();
        }

        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'edit_search':
                if (!SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $arrForm = $objQuery->select('*', 'dtb_work_possible_date', 'id = ?', array($objFormSearchParam->getValue('edit_id')));
                $arrForm = $arrForm[0];
                list($arrForm['year'], $arrForm['month'], $arrForm['day']) = explode('-', $arrForm['working_date']);
                list($arrForm['working_start_hour'], $arrForm['working_start_minute']) = explode(':', $arrForm['working_start']);
                list($arrForm['working_over_hour'], $arrForm['working_over_minute']) = explode(':', $arrForm['working_over']);
                $this->arrForm = $arrForm;
                break;
            case 'return':
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                break;
            case 'confirm':
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->tpl_mainpage = 'order/work_possible_date_edit_confirm.tpl';
                break;
            case 'complete':
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->lfRegistData($objFormParam);
                $this->tpl_mainpage = 'order/work_possible_date_edit_complete.tpl';
                break;
            case 'complete_return':
                if (!SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                break;
            case 'customer':
                $this->arrErr = array();
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

    /**
     * パラメーター情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('id', 'id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('スタッフ名', 'customer_id', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('対応ステータス', 'status', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(年)', 'year', 4, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業可能日(月)', 'month', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業可能日(日)', 'day', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('時間帯(開始時)', 'working_start_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('時間帯(開始分)', 'working_start_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('時間帯(終了時)', 'working_over_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('時間帯(終了分)', 'working_over_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('残業可', 'overtime_allowed', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('検索用データ', 'search_data', '', '', array(), '', false);
    }

    /**
     * 検索パラメーター引き継ぎ用情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitSearchParam(&$objFormParam) {
        $objFormParam->addParam('スタッフ名', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('スタッフID', 'search_staff_id', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(開始年)', 'search_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(開始月)', 'search_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(開始日)', 'search_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(終了年)', 'search_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(終了月)', 'search_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業可能日(終了日)', 'search_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('編集対象登録No', 'edit_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 10, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
    }

    /**
     * 検索パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckErrorSearchParam(&$objFormParam) {
        $arrErr = $objFormParam->checkError();
        // 拡張エラーチェック初期化
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        // 拡張エラーチェック
        $objErr->doFunc(array('就業可能日(開始日)', 'search_start_year', 'search_start_month', 'search_start_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業可能日(終了日)', 'search_end_year', 'search_end_month', 'search_end_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業可能日(開始日)', '就業可能日(終了日)', 'search_start_year', 'search_start_month', 'search_start_day', 'search_end_year', 'search_end_month', 'search_end_day'), array('CHECK_SET_TERM'));
        if (!SC_Utils_Ex::isBlank($objErr->arrErr)) {
            $arrErr = array_merge($arrErr, $objErr->arrErr);
        }
        return $arrErr;
    }

    /**
     * フォーム入力パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckError(&$objFormParam) {
        $arrParams = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrParams);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('就業可能日', 'year', 'month', 'day'), array('CHECK_DATE'));
        return $objErr->arrErr;
    }

    /**
     * 登録処理
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfRegistData(&$objFormParam) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrRet = $objFormParam->getHashArray();
        $sqlval = $objFormParam->getDbArray();
        $sqlval['working_date'] = $arrRet['year'] . '-' . $arrRet['month'] . '-' . $arrRet['day'];
        $sqlval['working_start'] = $sqlval['working_start_hour'] . ':' . $sqlval['working_start_minute'];
        $sqlval['working_over'] = $sqlval['working_over_hour'] . ':' . $sqlval['working_over_minute'];
        unset($sqlval['working_start_hour']);
        unset($sqlval['working_start_minute']);
        unset($sqlval['working_over_hour']);
        unset($sqlval['working_over_minute']);
        if (!is_numeric($sqlval['id']))
            $objQuery->insert('dtb_work_possible_date', $sqlval);
        else {
            $sqlval['update_date'] = Date('Y-m-d H:i:s');
            $objQuery->update('dtb_work_possible_date', $sqlval, 'id = ?', array($sqlval['id']));
        }
    }

}
