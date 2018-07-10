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
class LC_Page_Admin_Prepayment_WorkReport extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'prepayment/work_report.tpl';
        $this->tpl_mainno = 'prepayment';
        $this->tpl_subno = 'work_report';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '勤怠管理';
        $this->tpl_subtitle = '随時振込申請管理';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');
        $this->arrStatus = $masterData->getMasterData('mtb_prepayment_status');
        $this->arrApplyStatus = $masterData->getMasterData('mtb_apply_status');
        unset($this->arrApplyStatus[0]);

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
        
        // fetch cron job argument
        if (!empty($_SERVER['argv'][1])) {
            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $arrTransfer = $objQuery->select('id', 'dtb_prepayment_apply', 'transfer_date=?', array(Date('Y-m-d')));
            if (count($arrTransfer) > 0) {
                $message = '
		  本日振込予定の申請が'.count($arrTransfer).'件があります。<br />
                  EC-CUBE管理画面から確認ください。<br />
                  <a href="http://test.hyperion-job.jp/admin/prepayment/work_report.php" target="_blank">http://test.hyperion-job.jp/admin/prepayment/work_report.php</a>
		';
                $CONF = SC_Helper_DB_Ex::sfGetBasisData();
                $to = $CONF['email02'];
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                $headers .= 'To: ' . '=?UTF-8?B?' . base64_encode($CONF['shop_name']) . '?=' . '<' . $to . '>' . "\r\n";
                $subject = '【随時振込】'.Date('Y').'年'.Date('m').'月'.Date('d').'日';
                mail('', '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
            }
        }

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
            case 'delete':
                if ($this->getMode() == 'edit')
                    $upd = array('apply_flg' => $_POST['status'][$arrParam['edit_id']]);
                elseif ($this->getMode() == 'delete')
                    $upd = array('apply_flg' => '0', 'apply_date' => '');
                $upd['apply_update_id'] = $_SESSION['member_id'];
                $this->lfDoUpdate($arrParam['edit_id'], $upd);
            case 'search':
                $where = 'del_flg = 0 AND apply_flg <> 0';
                $arrWhereVal = array();
                foreach ($arrParam as $key => $val) {
                    if ($val == '') {
                        continue;
                    }
                    $this->buildQuery($key, $where, $arrWhereVal, $objFormParam);
                }
                $order = 'apply_flg ASC';

                $this->tpl_linemax = $this->getNumberOfLines($where, $arrWhereVal);
                $page_max = SC_Utils_Ex::sfGetSearchPageMax($objFormParam->getValue('search_page_max'));
                $objNavi = new SC_PageNavi_Ex($this->arrHidden['search_pageno'], $this->tpl_linemax, $page_max, 'fnNaviSearchPage', NAVI_PMAX);
                $this->arrPagenavi = $objNavi->arrPagenavi;
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $objQuery->setLimitOffset($page_max, $objNavi->start_row);
                $objQuery->setOrder($order);
                $this->arrData = $objQuery->select('*', 'dtb_prepayment_apply', $where, $arrWhereVal);

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

                $this->memberNameById = array();
                $memberIds = array();
                foreach ($this->arrData as $data) {
                    if ($data['apply_update_id'] > 0)
                        $memberIds[] = $data['apply_update_id'];
                }
                if (count($memberIds) > 0) {
                    $arrMember = $objQuery->select('member_id, name', 'dtb_member', 'member_id IN (' . SC_Utils_Ex::sfGetCommaList($memberIds) . ')');
                    foreach ($arrMember as $member)
                        $this->memberNameById[$member['member_id']] = $member['name'];
                }

                break;
            case 'csv':
                $where = 'del_flg = 0 AND apply_flg <> 0';
                $arrWhereVal = array();
                foreach ($arrParam as $key => $val) {
                    if ($val == '') {
                        continue;
                    }
                    $this->buildQuery($key, $where, $arrWhereVal, $objFormParam);
                }
                $order = 'apply_flg ASC';
                $objCSV = new SC_Helper_CSV_Ex();
                $objCSV->sfDownloadCsv(7, ' where ' . $where, $arrWhereVal, $order, true);
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
        $objFormParam->addParam('お名前', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('スタッフID', 'search_staff_id', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始年)', 'search_working_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始月)', 'search_working_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始日)', 'search_working_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了年)', 'search_working_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了月)', 'search_working_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了日)', 'search_working_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('振込予定日(年)', 'search_transfer_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('振込予定日(月)', 'search_transfer_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('振込予定日(日)', 'search_transfer_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(開始年)', 'search_apply_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(開始月)', 'search_apply_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(開始日)', 'search_apply_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(開始時)', 'search_apply_start_hour', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(開始分)', 'search_apply_start_minute', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(終了年)', 'search_apply_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(終了月)', 'search_apply_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(終了日)', 'search_apply_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(終了時)', 'search_apply_end_hour', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請(終了分)', 'search_apply_end_minute', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('振込状況', 'search_apply_flg', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('編集対象登録No', 'edit_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
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
        $objErr->doFunc(array('就業日(開始日)', 'search_working_start_year', 'search_working_start_month', 'search_working_start_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業日(終了日)', 'search_working_end_year', 'search_working_end_month', 'search_working_end_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業日(開始日)', '就業日(終了日)', 'search_working_start_year', 'search_working_start_month', 'search_working_start_day', 'search_working_end_year', 'search_working_end_month', 'search_working_end_day'), array('CHECK_SET_TERM'));

        $objErr->doFunc(array('振込予定日', 'search_transfer_year', 'search_transfer_month', 'search_transfer_day',), array('CHECK_DATE'));
        
        $objErr->doFunc(array('随時振込申請(開始日)', 'search_apply_start_year', 'search_apply_start_month', 'search_apply_start_day', 'search_apply_start_hour', 'search_apply_start_minute'), array('CHECK_DATE2'));
        $objErr->doFunc(array('随時振込申請(終了日)', 'search_apply_end_year', 'search_apply_end_month', 'search_apply_end_day', 'search_apply_end_hour', 'search_apply_end_minute'), array('CHECK_DATE2'));
        $objErr->doFunc(array('随時振込申請(開始日)', '随時振込申請(終了日)', 'search_apply_start_year', 'search_apply_start_month', 'search_apply_start_day', 'search_apply_start_hour', 'search_apply_start_minute', '00', 'search_apply_end_year', 'search_apply_end_month', 'search_apply_end_day', 'search_apply_end_hour', 'search_apply_end_minute', '59'), array('CHECK_SET_TERM2'));

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
        $objQuery->update('dtb_prepayment_apply', $arrVal, 'id = ?', array($id));
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
            case 'search_working_start_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_working_start_year'), $objFormParam->getValue('search_working_start_month'), $objFormParam->getValue('search_working_start_day'));
                $where.= ' AND working_date >= ?';
                $arrValues[] = $date;
                break;
            case 'search_working_end_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_working_end_year'), $objFormParam->getValue('search_working_end_month'), $objFormParam->getValue('search_working_end_day'), true);
                $where.= ' AND working_date <= ?';
                $arrValues[] = $date;
                break;
            case 'search_transfer_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_transfer_year'), $objFormParam->getValue('search_transfer_month'), $objFormParam->getValue('search_transfer_day'));
                $where.= ' AND transfer_date = ?';
                $arrValues[] = $date;
                break;
            case 'search_apply_start_year':
                $date = $objFormParam->getValue('search_apply_start_year') . '-' . $objFormParam->getValue('search_apply_start_month') . '-' . $objFormParam->getValue('search_apply_start_day') . ' ' . $objFormParam->getValue('search_apply_start_hour') . ':' . $objFormParam->getValue('search_apply_start_minute') . ':00';
                $where.= ' AND apply_date >= ?';
                $arrValues[] = $date;
                break;
            case 'search_apply_end_year':
                $date = $objFormParam->getValue('search_apply_end_year') . '-' . $objFormParam->getValue('search_apply_end_month') . '-' . $objFormParam->getValue('search_apply_end_day') . ' ' . $objFormParam->getValue('search_apply_end_hour') . ':' . $objFormParam->getValue('search_apply_end_minute') . ':59';
                $where.= ' AND apply_date <= ?';
                $arrValues[] = $date;
                break;
            case 'search_apply_flg':
                $tmp_where = '';
                foreach ($objFormParam->getValue($key) as $element) {
                    if ($element != '') {
                        if (SC_Utils_Ex::isBlank($tmp_where)) {
                            $tmp_where .= ' AND (apply_flg ILIKE ?';
                        } else {
                            $tmp_where .= ' OR apply_flg ILIKE ?';
                        }
                        $arrValues[] = sprintf('%%%s%%', $element);
                    }
                }
                if (!SC_Utils_Ex::isBlank($tmp_where)) {
                    $tmp_where .= ')';
                    $where .= " $tmp_where ";
                }
                break;
            default:
                break;
        }
    }

    function getNumberOfLines($where, $arrValues) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        return $objQuery->count('dtb_prepayment_apply', $where, $arrValues);
    }

}
