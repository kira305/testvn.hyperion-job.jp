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
class LC_Page_Admin_Customer_Agency extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/agency.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'agency';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '本社登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');
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
        // 検索引き継ぎ用パラメーター管理クラス
        $objFormSearchParam = new SC_FormParam_Ex();
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'edit_search':
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($_REQUEST);
                $this->arrErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr)) {
                    return;
                }
                $this->page = 'input';
                $ret = $objQuery->select('*', 'dtb_agency', 'agency_id=?', array($objFormSearchParam->getValue('edit_agency_id')));
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($ret[0]);
                $this->arrForm = $objFormParam->getFormParamList();
                break;
            case 'confirm':
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                $this->arrForm = $objFormParam->getFormParamList();

                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->tpl_mainpage = 'customer/agency_confirm.tpl';
                break;
            case 'return':
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                $this->arrForm = $objFormParam->getFormParamList();

                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                break;
            case 'complete':
                // 登録・保存処理
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();

                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->lfRegistData($objFormParam);
                $this->tpl_mainpage = 'customer/agency_complete.tpl';
                break;
            case 'complete_return':
                // 入力パラメーターチェック
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
            default:
                if ($_SESSION['authority'] == 2) {
                    $this->page = 'input';
                    $ret = $objQuery->select('*', 'dtb_agency', 'agency_id=?', array($_SESSION['agency_id']));
                    $this->lfInitParam($objFormParam);
                    $objFormParam->setParam($ret[0]);
                    $this->arrForm = $objFormParam->getFormParamList();
                } else {
                    $this->lfInitParam($objFormParam);
                    $this->arrForm = $objFormParam->getHashArray();
                }
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
        $objFormParam->addParam('取引先ID', 'agency_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('取引先名', 'agency_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('取引先名（カナ）', 'agency_name_kana', STEXT_LEN, 'KVCa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('取引先コード', 'agency_code', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('代表者名1', 'agency_di_name01', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('代表者名2', 'agency_di_name02', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('役職', 'official_position', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ファーマプレミアムの担当者', 'pp_tantousya', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('郵便番号1', 'zip01', ZIP01_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip02', ZIP02_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('本社住所', 'pref', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('本社住所1', 'addr01', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('本社住所2', 'addr02', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('TEL1', 'tel01', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('TEL2', 'tel02', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('TEL3', 'tel03', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX1', 'fax01', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX2', 'fax02', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX3', 'fax03', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('支払条件等', 'payment_terms', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メモ', 'memo', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('検索用データ', 'search_data', '', '', array(), '', false);
        $objFormParam->addParam('', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
    }

    /**
     * 検索パラメーター引き継ぎ用情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitSearchParam(&$objFormParam) {
        $objFormParam->addParam('取引先ID', 'search_agency_id', ID_MAX_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('取引先名', 'search_agency_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('取引先コード', 'search_agency_code', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('代表者名', 'search_agency_di_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者', 'search_pp_tantousya', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('TEL', 'search_tel', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 10, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('edit_agency_id', 'edit_agency_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 検索パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckErrorSearchParam(&$objFormParam) {
        $arrErr = $objFormParam->checkError();
        return $arrErr;
    }

    /**
     * フォーム入力パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckError(&$objFormParam) {
        $arrForm = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrForm);
        $objErr->arrErr = $objFormParam->checkError();
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
        $arrData = $objFormParam->getDbArray();

        if (is_numeric($arrData['agency_id'])) {
            $arrData['update_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->update('dtb_agency', $arrData, 'agency_id = ? ', array($arrData['agency_id']));
        } else {
            $arrData['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert('dtb_agency', $arrData);
        }

        $objQuery->commit();
    }

}
