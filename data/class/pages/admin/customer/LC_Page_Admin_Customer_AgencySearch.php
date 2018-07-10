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
class LC_Page_Admin_Customer_AgencySearch extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/agency_search.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'agencysearch';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '本社マスター';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref', array("pref_id", "pref_name", "rank"));
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');

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
        $this->arrErr = $objFormParam->checkError();
        if (!SC_Utils_Ex::isBlank($this->arrErr)) {
            return;
        }

        // モードによる処理切り替え
        /* --------------------------
         * 処理実行
         * -------------------------- */
        switch ($this->getMode()) {
            case 'delete':
                $this->is_delete = $this->lfDoDeleteAgency($objFormParam->getValue('edit_agency_id'));
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
        $objFormParam->addParam('取引先ID', 'search_agency_id', ID_MAX_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('取引先名', 'search_agency_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('取引先コード', 'search_agency_code', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('代表者名', 'search_agency_di_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者', 'search_pp_tantousya', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('TEL', 'search_tel', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('edit_agency_id', 'edit_agency_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    function lfDoDeleteAgency($agency_id) {
        $arrVal['del_flg'] = 1;
        $arrVal['update_date'] = 'Now()';
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->update('dtb_agency', $arrVal, 'agency_id = ? ', array($agency_id));
        return true;
    }
    
    function buildQuery($arrRet) {
        $where = "del_flg = 0";
        $arrval = array();

        foreach ($arrRet as $key => $val) {
            if ($val == "") {
                continue;
            }

            switch ($key) {
                case 'search_agency_id':
                    $where .= " AND agency_id = ?";
                    $arrval[] = $val;
                    break;
                case 'search_agency_name':
                    $where .= " AND agency_name ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                case 'search_agency_code':
                    $where .= " AND agency_code ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                case 'search_agency_di_name':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (agency_di_name01||agency_di_name02 ILIKE ? OR agency_di_name01 ILIKE ? OR agency_di_name02 ILIKE ?)";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND (concat(agency_di_name01,agency_di_name02) ILIKE ? OR agency_di_name01 ILIKE ? OR agency_di_name02 ILIKE ?)";
                    }
                    $nonsp_val = mb_ereg_replace("[ 　]+", "", $val);
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    $arrval[] = "%$val%";
                    break;
                case 'search_pp_tantousya':
                    $where .= " AND pp_tantousya ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                case 'search_tel':
                    if (DB_TYPE == "pgsql") {
                        $where .= " AND (tel01 || tel02 || tel03) LIKE ?";
                    } elseif (DB_TYPE == "mysql") {
                        $where .= " AND concat(tel01,tel02,tel03) LIKE ?";
                    }
                    $nonmark_val = ereg_replace("[()-]+", "", $val);
                    $arrval[] = "%$nonmark_val%";
                    break;
                default:
                    break;
            }
        }
        return array($where, $arrval);
    }

    function lfDoSearch($arrRet) {
        list($where, $arrval) = $this->buildQuery($arrRet);
        $col = "*";
        $from = "dtb_agency";
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