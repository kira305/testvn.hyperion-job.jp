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
class LC_Page_Admin_Customer_Search extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/search.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'search';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '法人マスター';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');

        $objDate = new SC_Date_Ex();
        $objDate->setStartYear(RELEASE_YEAR);
        $objDate->setEndYear(DATE('Y'));
        $this->arrBirthYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();

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

        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'delete':
                $this->is_delete = $this->lfDoDeleteCorporate($objFormParam->getValue('edit_corporate_id'));
                list($this->tpl_linemax, $this->arrData, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                break;
            case 'search':
                list($this->tpl_linemax, $this->arrData, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
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
        $objFormParam->addParam('法人ID', 'search_corporate_id', ID_MAX_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('企業名', 'search_corporate_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者部署名', 'search_person_unit', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者名', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者名（カナ）', 'search_kana', STEXT_LEN, 'CKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANABLANK_CHECK'));
        $objFormParam->addParam('郵便番号', 'search_zip', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_pref', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_addr', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号', 'search_tel', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX番号', 'search_fax', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールアドレス', 'search_email', MTEXT_LEN, 'a', array('SPTAB_CHECK', 'EMAIL_CHAR_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('edit_corporate_id', 'edit_corporate_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    function lfCheckError(&$objFormParam) {
        $arrErr = $objFormParam->checkError();
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->doFunc(array('誕生日(開始日)', 'search_b_start_year', 'search_b_start_month', 'search_b_start_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('誕生日(終了日)', 'search_b_end_year', 'search_b_end_month', 'search_b_end_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('誕生日(開始日)', '誕生日(終了日)', 'search_b_start_year', 'search_b_start_month', 'search_b_start_day', 'search_b_end_year', 'search_b_end_month', 'search_b_end_day'), array('CHECK_SET_TERM'));
        if (!SC_Utils_Ex::isBlank($objErr->arrErr)) {
            $arrErr = array_merge($arrErr, $objErr->arrErr);
        }
        return $arrErr;
    }

    function lfDoDeleteCorporate($corporate_id) {
        $arrVal['del_flg'] = 1;
        $arrVal['update_date'] = 'Now()';
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->update('dtb_corporate', $arrVal, 'corporate_id = ? ', array($corporate_id));
        return true;
    }

    function lfDoSearch($arrRet) {
        $where = "del_flg = 0";
        $arrval = array();

        foreach ($arrRet as $key => $val) {
            if ($val == "") {
                continue;
            }

            switch ($key) {
                case 'search_corporate_id':
                    $where .= " AND corporate_id = ?";
                    $arrval[] = $val;
                    break;
                case 'search_b_start_year':
                    $date = SC_Utils_Ex::sfGetTimestamp($_POST['search_b_start_year'], $_POST['search_b_start_month'], $_POST['search_b_start_day']);
                    $where.= " AND create_date >= ?";
                    $arrval[] = $date;
                    break;
                case 'search_b_end_year':
                    $date = SC_Utils_Ex::sfGetTimestamp($_POST['search_b_end_year'], $_POST['search_b_end_month'], $_POST['search_b_end_day'], true);
                    $where.= " AND create_date <= ?";
                    $arrval[] = $date;
                    break;
                case 'search_corporate_name':
                    $where .= " AND corporate_name ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                case 'search_person_unit':
                    $where .= " AND person_unit ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                case 'search_name':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (charge_firstname||charge_lastname ILIKE ? OR charge_firstname ILIKE ? OR charge_lastname ILIKE ?)";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND (concat(charge_firstname,charge_lastname) ILIKE ? OR charge_firstname ILIKE ? OR charge_lastname ILIKE ?)";
                    }
                    $nonsp_val = mb_ereg_replace("[ 　]+", "", $val);
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    break;
                case 'search_kana':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (charge_firstname_kana||charge_lastname_kana ILIKE ? OR charge_firstname_kana ILIKE ? OR charge_lastname_kana ILIKE ?)";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND (concat(charge_firstname_kana,charge_lastname_kana) ILIKE ? OR charge_firstname_kana ILIKE ? OR charge_lastname_kana ILIKE ?)";
                    }
                    $nonsp_val = mb_ereg_replace("[ 　]+", "", $val);
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    break;
                case 'search_zip':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (zip_code1 || zip_code2) LIKE ?";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND concat(zip_code1,zip_code2) LIKE ?";
                    }
                    $nonmark_val = ereg_replace("[()-]+", "", $val);
                    $arrval[] = "%$nonmark_val%";
                    break;
                case 'search_pref':
                    $where .= " AND pref = ?";
                    $arrval[] = $val;
                    break;
                case 'search_addr':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (addr1||addr2 ILIKE ? OR addr1 ILIKE ? OR addr2 ILIKE ?)";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND (concat(addr1,addr2) ILIKE ? OR addr1 ILIKE ? OR addr2 ILIKE ?)";
                    }
                    $nonsp_val = mb_ereg_replace("[ 　]+", "", $val);
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    break;
                case 'search_tel':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (tel1 || tel2 || tel3) LIKE ?";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND concat(tel1,tel2,tel3) LIKE ?";
                    }
                    $nonmark_val = ereg_replace("[()-]+", "", $val);
                    $arrval[] = "%$nonmark_val%";
                    break;
                case 'search_fax':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (fax1 || fax2 || fax3) LIKE ?";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND concat(fax1,fax2,fax3) LIKE ?";
                    }
                    $nonmark_val = ereg_replace("[()-]+", "", $val);
                    $arrval[] = "%$nonmark_val%";
                    break;
                case 'search_email':
                    $where .= " AND email_add ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                default:
                    break;
            }
        }

        $col = "*";
        $from = "dtb_corporate";
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $linemax = $objQuery->count($from, $where, $arrval);
        if (is_numeric($arrRet['search_page_max']))
            $page_max = $arrRet['search_page_max'];
        else
            $page_max = SEARCH_PMAX;
        $objNavi = new SC_PageNavi($arrRet['search_pageno'], $linemax, $page_max, "fnNaviSearchPage", NAVI_PMAX);
        $startno = $objNavi->start_row;
        $this->arrPagenavi = $objNavi->arrPagenavi;
        $objQuery->setlimitoffset($page_max, $startno);
        $arrResults = $objQuery->select($col, $from, $where, $arrval);
        return array($linemax, $arrResults, $objNavi);
    }

}