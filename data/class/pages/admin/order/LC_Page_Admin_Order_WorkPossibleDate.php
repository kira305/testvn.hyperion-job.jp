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
 * 会員管理 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Customer.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Order_WorkPossibleDate extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'order/work_possible_date.tpl';
        $this->tpl_mainno = 'order';
        $this->tpl_subno = 'work_possible_date';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '受注管理';
        $this->tpl_subtitle = '就業可能日管理';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');
        $this->arrStatus = $masterData->getMasterData('mtb_possible_date_status');

        $objDate = new SC_Date_Ex();
        $objDate->setStartYear(RELEASE_YEAR);
        $objDate->setEndYear(DATE('Y'));
        $this->arrRegistYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();

        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');

        $this->httpCacheControl('nocache');
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
        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();
        // パラメーター設定
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();
        // パラメーター読み込み
        $this->arrForm = $objFormParam->getFormParamList();
        // 検索ワードの引き継ぎ
        $this->arrHidden = $objFormParam->getSearchArray();

        // 入力パラメーターチェック
        $this->arrErr = $this->lfCheckError($objFormParam);
        if (!SC_Utils_Ex::isBlank($this->arrErr)) {
            return;
        }
        $arrParam = $objFormParam->getHashArray();
        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'edit':
                $upd = array('status' => $_POST['status'][$arrParam['edit_id']]);
                $this->lfDoUpdate($arrParam['edit_id'], $upd);
            case 'search':
                $where = 'customer_id > 0';
                $arrWhereVal = array();
                foreach ($arrParam as $key => $val) {
                    if ($val == '') {
                        continue;
                    }
                    $this->buildQuery($key, $where, $arrWhereVal, $objFormParam);
                }
                $order = 'status ASC';

                $this->tpl_linemax = $this->getNumberOfLines($where, $arrWhereVal);
                $page_max = SC_Utils_Ex::sfGetSearchPageMax($objFormParam->getValue('search_page_max'));
                $objNavi = new SC_PageNavi_Ex($this->arrHidden['search_pageno'], $this->tpl_linemax, $page_max, 'fnNaviSearchPage', NAVI_PMAX);
                $this->arrPagenavi = $objNavi->arrPagenavi;
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $objQuery->setLimitOffset($page_max, $objNavi->start_row);
                $objQuery->setOrder($order);
                $this->arrData = $objQuery->select('*', 'dtb_work_possible_date', $where, $arrWhereVal);

                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $this->customerRowById = array();
                $customerIds = array();
                foreach ($this->arrData as $data)
                    $customerIds[] = $data['customer_id'];
                if (count($customerIds) > 0) {

                    $arrCustomer = $objQuery->select('customer_id, staff_id, name01, name02, kana01, kana02', 'dtb_customer', 'customer_id IN (' . SC_Utils_Ex::sfGetCommaList($customerIds) . ')');
                    foreach ($arrCustomer as $customer)
                        $this->customerRowById[$customer['customer_id']] = $customer;
                }
                break;
            case 'csv':
                $where = 'customer_id > 0';
                $arrWhereVal = array();
                foreach ($arrParam as $key => $val) {
                    if ($val == '') {
                        continue;
                    }
                    $this->buildQuery($key, $where, $arrWhereVal, $objFormParam);
                }
                $order = 'status ASC';
                $objCSV = new SC_Helper_CSV_Ex();
                $objCSV->sfDownloadCsv(9, ' where ' . $where, $arrWhereVal, $order, true);
                SC_Response_Ex::actionExit();
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
     * エラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckError(&$objFormParam) {
        // パラメーターの基本チェック
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
     * 会員を削除する処理
     *
     * @param integer $customer_id 会員ID
     * @return boolean true:成功 false:失敗
     */
    function lfDoUpdate($id, $arrVal) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrVal['update_date'] = Date('Y-m-d H:i:s');
        $objQuery->update('dtb_work_possible_date', $arrVal, 'id = ?', array($id));
    }

    function buildQuery($key, &$where, &$arrValues, &$objFormParam) {
        $dbFactory = SC_DB_DBFactory_Ex::getInstance();
        switch ($key) {
            case 'search_name':
                $where .= ' AND customer_id IN (SELECT customer_id FROM dtb_customer WHERE ' . $dbFactory->concatColumn(array('name01', 'name02')) . ' LIKE ?)';
                $arrValues[] = sprintf('%%%s%%', $objFormParam->getValue($key));
                break;
            case 'search_staff_id':
                $where .= ' AND customer_id IN (SELECT customer_id FROM dtb_customer WHERE staff_id = ?)';
                $arrValues[] = $objFormParam->getValue($key);
                break;
            case 'search_start_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_start_year'), $objFormParam->getValue('search_start_month'), $objFormParam->getValue('search_start_day'));
                $where.= ' AND working_date >= ?';
                $arrValues[] = $date;
                break;
            case 'search_end_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_end_year'), $objFormParam->getValue('search_end_month'), $objFormParam->getValue('search_end_day'), true);
                $where.= ' AND working_date <= ?';
                $arrValues[] = $date;
                break;
            default:
                break;
        }
    }

    function getNumberOfLines($where, $arrValues) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        return $objQuery->count('dtb_work_possible_date', $where, $arrValues);
    }

}
