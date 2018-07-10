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
class LC_Page_Admin_Customer_ClientCorporate extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/clientcorporate.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'clientcorporate';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '薬局登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');
        $this->holiday = array(1 => 'あり', 2 => '無');
        $this->yakureki = array(1 => '紙', 2 => '電子');
        $this->contractType = array(1 => '基本', 2 => 'NDA');
        $this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
        unset($this->arrEMPSTATUS[4]);
        $this->arrEMPSTATUS[5] = 'その他';

        $objDate = new SC_Date_Ex(RELEASE_YEAR);
        $objDate->setEndYear(date('Y', strtotime('+7 year')));
        $this->arrYear = $objDate->getYear('2013', true, '');
        $this->arrMonth = $objDate->getMonth(true);
        $this->arrDay = $objDate->getDay(true);

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $agencyList = $objQuery->select('agency_id, agency_name', 'dtb_agency', 'del_flg = 0');
        foreach ($agencyList as $agenc)
            $this->agencyList[$agenc['agency_id']] = $agenc['agency_name'];
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
            case 'become_client':
                $newId = $this->lfDoBecomeClient($_POST['edit_corporate_id']);
                $this->page = 'input';
                $ret = $objQuery->select('*', 'mtb_corporate', 'corporate_id=?', array($newId));
                $this->lfInitParam($objFormParam);
                $ret[0]['recruitment_detail'] = str_split($ret[0]['recruitment_detail']);
                $objFormParam->setParam($ret[0]);
                $this->arrForm = $objFormParam->getFormParamList();

                $this->lfInitSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                break;
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
                $ret = $objQuery->select('*', 'mtb_corporate', 'corporate_id=?', array($objFormSearchParam->getValue('edit_corporate_id')));
                $ret[0]['recruitment_detail'] = str_split($ret[0]['recruitment_detail']);
                $ret[0]['contract_type'] = str_split($ret[0]['contract_type']);
                list($ret[0]['conflict_year'], $ret[0]['conflict_month'], $ret[0]['conflict_day']) = explode('-', $ret[0]['conflict_date']);
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
                $this->tpl_mainpage = 'customer/clientcorporate_confirm.tpl';
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
                $this->tpl_mainpage = 'customer/clientcorporate_complete.tpl';
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
                if ($_SESSION['authority'] == 3) {
                    $this->page = 'input';
                    $ret = $objQuery->select('*', 'mtb_corporate', 'corporate_id=?', array($_SESSION['corporate_id']));
                    $ret[0]['recruitment_detail'] = str_split($ret[0]['recruitment_detail']);
                    $ret[0]['contract_type'] = str_split($ret[0]['contract_type']);
                    list($ret[0]['conflict_year'], $ret[0]['conflict_month'], $ret[0]['conflict_day']) = explode('-', $ret[0]['conflict_date']);
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

    function lfDoBecomeClient($corporate_id) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $corporates = $objQuery->select('*', 'dtb_corporate', 'corporate_id = ? ', array($corporate_id));
        $arrVal = $corporates[0];
        $arrVal['create_date'] = 'Now()';
        $arrVal['pharmacy_name'] = $arrVal['person_unit'];
        unset($arrVal['corporate_id']);
        unset($arrVal['person_unit']);
        $objQuery->insert('mtb_corporate', $arrVal);
        $objQuery->delete('dtb_corporate', 'corporate_id = ? ', array($corporate_id));
        return $objQuery->max('corporate_id', 'mtb_corporate');
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
        $objFormParam->addParam('会社名', 'agency_id', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('薬局ID', 'corporate_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('薬局名', 'pharmacy_name', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業部署', 'work_location', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('契約書', 'contract_type', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('契約期間', 'contract_period_s', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('契約期間', 'contract_period_o', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('抵触日', 'conflict_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('抵触日', 'conflict_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('抵触日', 'conflict_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局担当者名1', 'charge_firstname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局担当者名2', 'charge_lastname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局担当者名（カナ）1', 'charge_firstname_kana', STEXT_LEN, 'KVCa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('薬局担当者名（カナ）2', 'charge_lastname_kana', STEXT_LEN, 'KVCa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('指揮命令者1', 'command_person_firstname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('指揮命令者2', 'command_person_lastname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先1', 'per_tel1', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先2', 'per_tel2', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先3', 'per_tel3', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('苦情申出先1', 'claim_offer_firstname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('苦情申出先2', 'claim_offer_lastname', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先1', 'offer_tel1', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先2', 'offer_tel2', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先3', 'offer_tel3', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('郵便番号1', 'zip_code1', ZIP01_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip_code2', ZIP02_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('住所', 'pref', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('住所1', 'addr1', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所2', 'addr2', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号1', 'tel1', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号2', 'tel2', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号3', 'tel3', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX番号1', 'fax1', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('FAX番号2', 'fax2', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('FAX番号3', 'fax3', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('メールアドレス', 'email_add', null, 'KVa', array('SPTAB_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('メールアドレス(確認)', 'email_add_repeat', null, 'KVa', array('SPTAB_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('業務内容', 'job_description', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('店舗数', 'num_of_stores', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('薬歴', 'medication_his', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('薬剤師数', 'num_of_pharmacists', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('事務スタッフ', 'o_staff', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('メイン処方箋発行機関', 'main_authority', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('科目', 'kamoku', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('処方箋枚数', 'prescriptions', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('勤務時間1', 'work_hour_s', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('勤務時間2', 'work_hour_o', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('時間外業務', 'overtime_work', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('支払条件等', 'payment_terms', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩室', 'b_room', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('休憩時間1', 'b_time_s', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間2', 'b_time_o', INT_LEN, 'n', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('最寄駅', 'nearest', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('交通アクセス', 'access', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('必需品', 'necessities', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('周辺環境', 'environ', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('福利厚生', 'welfare', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('特記事項、社内ルール', 'notices', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('募集内容', 'recruitment_detail', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メモ', 'memo', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('その他、ご質問など', 'other_q', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('店舗マップ', 'gmap_src', LLTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));

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
        $objFormParam->addParam('会社ID', 'search_agency_id', ID_MAX_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('会社名', 'search_agency_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局名', 'search_pharmacy_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局担当者名', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('薬局担当者名（カナ）', 'search_kana', STEXT_LEN, 'CKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANABLANK_CHECK'));
        $objFormParam->addParam('郵便番号', 'search_zip', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_pref', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_addr', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号', 'search_tel', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX番号', 'search_fax', TEL_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールアドレス', 'search_email', MTEXT_LEN, 'a', array('SPTAB_CHECK', 'EMAIL_CHAR_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 10, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('edit_corporate_id', 'edit_corporate_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 検索パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckErrorSearchParam(&$objFormParam) {
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
        $objErr->doFunc(array('メールアドレス', 'メールアドレス(確認)', 'email_add', 'email_add_repeat'), array('EQUAL_CHECK'));
        $objErr->doFunc(array('抵触日', 'conflict_year', 'conflict_month', 'conflict_day'), array('CHECK_DATE'));
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
        if (count($arrData['recruitment_detail']) > 0) {
            $newarr = '';
            foreach ($arrData['recruitment_detail'] as $status)
                $newarr .= $status;
            $arrData['recruitment_detail'] = $newarr;
        }
        if (count($arrData['contract_type']) > 0) {
            $newarr = '';
            foreach ($arrData['contract_type'] as $status)
                $newarr .= $status;
            $arrData['contract_type'] = $newarr;
        }
        if ($arrData['conflict_year'] > 0)
            $arrData['conflict_date'] = $arrData['conflict_year'] . '-' . $arrData['conflict_month'] . '-' . $arrData['conflict_day'];
        unset($arrData['conflict_year']);
        unset($arrData['conflict_month']);
        unset($arrData['conflict_day']);

        if (is_numeric($arrData['corporate_id'])) {
            $arrData['update_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->update('mtb_corporate', $arrData, 'corporate_id = ? ', array($arrData['corporate_id']));
        } else {
            $arrData['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert('mtb_corporate', $arrData);
        }

        $objQuery->commit();
    }

}
