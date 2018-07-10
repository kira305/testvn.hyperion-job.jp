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
class LC_Page_Admin_Customer_Corporate extends LC_Page_Admin_Ex {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/corporate.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'corporate';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '法人登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
		$this->arrPageMax = $masterData->getMasterData('mtb_page_max');
		$this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
		unset($this->arrEMPSTATUS[4]);
		$this->arrEMPSTATUS[5] = 'その他';
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
		$objQuery       =& SC_Query_Ex::getSingletonInstance();

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
		        $ret = $objQuery->select('*','dtb_corporate','corporate_id=?', array($objFormSearchParam->getValue('edit_corporate_id')));
				$this->lfInitParam($objFormParam);
				$ret[0]['recruitment_detail'] = str_split($ret[0]['recruitment_detail']);
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
				$this->tpl_mainpage = 'customer/corporate_confirm.tpl';
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
                $this->tpl_mainpage = 'customer/corporate_complete.tpl';
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
                $this->lfInitParam($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
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
		$objFormParam->addParam('法人ID', 'corporate_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('企業名', 'corporate_name', STEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者部署名', 'person_unit', STEXT_LEN, 'KVa', array('SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者名1', 'charge_firstname', STEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者名2', 'charge_lastname', STEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK'));
		$objFormParam->addParam('担当者名（カナ）1', 'charge_firstname_kana', STEXT_LEN, 'KVCa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK','KANA_CHECK'));
        $objFormParam->addParam('担当者名（カナ）2', 'charge_lastname_kana', STEXT_LEN, 'KVCa', array('EXIST_CHECK','SPTAB_CHECK','MAX_LENGTH_CHECK','KANA_CHECK'));
        $objFormParam->addParam('郵便番号1', 'zip_code1', ZIP01_LEN, 'n',array('EXIST_CHECK','SPTAB_CHECK' ,'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip_code2', ZIP02_LEN, 'n',array('EXIST_CHECK','SPTAB_CHECK' ,'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('住所', 'pref', INT_LEN, 'n', array('EXIST_CHECK','MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('住所1', 'addr1', MTEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所2', 'addr2', MTEXT_LEN, 'KVa', array('EXIST_CHECK','SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号1', 'tel1', TEL_ITEM_LEN, 'n', array('EXIST_CHECK','NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号2', 'tel2', TEL_ITEM_LEN, 'n', array('EXIST_CHECK','NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号3', 'tel3', TEL_ITEM_LEN, 'n', array('EXIST_CHECK','NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('FAX番号1', 'fax1', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK' ,'NUM_CHECK'));
        $objFormParam->addParam('FAX番号2', 'fax2', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK' ,'NUM_CHECK'));
        $objFormParam->addParam('FAX番号3', 'fax3', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK' ,'NUM_CHECK'));
		$objFormParam->addParam('メールアドレス', 'email_add', null, 'KVa',array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('メールアドレス(確認)', 'email_add_repeat', null, 'KVa',array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('募集内容', 'recruitment_detail', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('その他、ご質問など', 'other_q', MTEXT_LEN, 'KVa', array('SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));

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
        $objFormParam->addParam('法人ID', 'search_corporate_id', ID_MAX_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
		$objFormParam->addParam('登録日', 'search_b_start_year', 4, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_month', 2, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_start_day', 2, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_year', 4, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_month', 2, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('登録日', 'search_b_end_day', 2, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
		$objFormParam->addParam('企業名', 'search_corporate_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
		$objFormParam->addParam('担当者部署名', 'search_person_unit', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
		$objFormParam->addParam('担当者名', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('担当者名（カナ）', 'search_kana', STEXT_LEN, 'CKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANABLANK_CHECK'));
		$objFormParam->addParam('郵便番号', 'search_zip', TEL_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_pref', INT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所', 'search_addr', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号', 'search_tel', TEL_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
		$objFormParam->addParam('FAX番号', 'search_fax', TEL_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
		$objFormParam->addParam('メールアドレス', 'search_email', MTEXT_LEN, 'a', array('SPTAB_CHECK', 'EMAIL_CHAR_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('edit_corporate_id', 'edit_corporate_id', INT_LEN, 'n', array('NUM_CHECK','MAX_LENGTH_CHECK'));
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
		$objErr->doFunc(array('誕生日(開始日)','誕生日(終了日)', 'search_b_start_year', 'search_b_start_month', 'search_b_start_day', 'search_b_end_year', 'search_b_end_month', 'search_b_end_day'), array('CHECK_SET_TERM'));
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
        $arrForm =  $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrForm);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('メールアドレス', 'メールアドレス(確認)', 'email_add', 'email_add_repeat') ,array('EQUAL_CHECK'));
        return $objErr->arrErr;
    }

    /**
     * 登録処理
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfRegistData(&$objFormParam) {
        $objQuery   =& SC_Query_Ex::getSingletonInstance();
        $arrData = $objFormParam->getDbArray();
		if(count($arrData['recruitment_detail']) > 0){
			$newarr = '';
			foreach($arrData['recruitment_detail'] as $status)
				$newarr .= $status;
			$arrData['recruitment_detail'] = $newarr;
		}

        if (is_numeric($arrData['corporate_id'])) {
			$arrData['update_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->update('dtb_corporate', $arrData, 'corporate_id = ? ', array($arrData['corporate_id']));
        } else {
            $arrData['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert('dtb_corporate', $arrData);
        }

        $objQuery->commit();
    }
}
