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
 * Admin_Customer_SearchCustomer のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Customer_SearchCustomer.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Job_CorporateSelect extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions
    var $agency_id;

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/corporate_select.tpl';
        $this->tpl_subtitle = '会員検索';
        $this->httpCacheControl('nocache');
        if (isset($_GET['agency_id']))
            $this->agency_id = $_GET['agency_id'];
        else
            $this->agency_id = $_POST['agency_id'];
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
        // 入力パラメーターチェック
        $this->arrErr = $objFormParam->checkError();
        if (!SC_Utils_Ex::isBlank($this->arrErr)) {
            return;
        }

        // POSTのモードがsearchなら会員検索開始
        switch ($this->getMode()) {
            case 'search':
                list($this->tpl_linemax, $this->arrCorporate, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
                $this->tpl_strnavi = $this->objNavi->strnavi;
                break;
            default:
                break;
        }
        $this->setTemplate($this->tpl_mainpage);
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
        $objFormParam->addParam('企業ID', 'search_corporate_id', ID_MAX_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局名', 'search_pharmacy_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
    }

    function buildQuery($arrRet) {
        $where = "del_flg = 0 AND agency_id = ?";
        $arrval = array();
        $arrval[] = $this->agency_id;

        foreach ($arrRet as $key => $val) {
            if ($val == "") {
                continue;
            }

            switch ($key) {
                case 'search_corporate_id':
                    $where .= " AND corporate_id = ?";
                    $arrval[] = $val;
                    break;
                case 'search_pharmacy_name':
                    $where .= " AND pharmacy_name ILIKE ?";
                    $arrval[] = "%$val%";
                    break;
                default:
                    break;
            }
        }
        return array($where, $arrval);
    }

    /**
     * 会員一覧を検索する処理
     *
     * @param array $arrParam 検索パラメーター連想配列
     * @return array( integer 全体件数, mixed 会員データ一覧配列, mixed SC_PageNaviオブジェクト)
     */
    function lfDoSearch($arrRet) {
        list($where, $arrval) = $this->buildQuery($arrRet);
        $col = "*";
        $from = "mtb_corporate";
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
