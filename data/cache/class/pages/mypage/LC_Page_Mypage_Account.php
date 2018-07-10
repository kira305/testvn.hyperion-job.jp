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
class LC_Page_Mypage_Account extends LC_Page_AbstractMypage_Ex {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_subtitle = '口座情報追加・変更';
        $this->tpl_mypageno = 'account';
		$this->tpl_mainpage = 'mypage/account.tpl';
		$this->arrFLAG = array(1=>'普通', 2=>'当座');

        $this->httpCacheControl('nocache');
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

        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_POST['mode'] = 'return';
        }

        // パラメーター管理クラス,パラメーター情報の初期化
        $objFormParam = new SC_FormParam_Ex();
        $this->sfCustomerMypageParam($objFormParam);
        $objFormParam->setParam($_POST);    // POST値の取得

        switch ($this->getMode()) {
            case 'confirm':
                $this->arrErr = $this->sfCustomerMypageErrorCheck($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
                if (empty($this->arrErr)) {
                    $this->tpl_mainpage = 'mypage/account_confirm.tpl';
                    $this->tpl_subtitle = '口座登録内容（確認ページ）';
                }
                break;
            // 会員登録と完了画面
            case 'complete':
                $this->arrErr = $this->sfCustomerMypageErrorCheck($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
                if (empty($this->arrErr)) {
                    $this->lfRegistCustomerData($objFormParam, $customer_id);
                    $objCustomer->updateSession();
                    $this->tpl_mainpage = 'mypage/account_complete.tpl';
                    $this->tpl_subtitle = '口座登録（完了ペーじ）';
                }
                break;
            // 確認ページからの戻り
            case 'return':
                $this->arrForm = $objFormParam->getHashArray();
                break;
            default:
                $this->arrForm = $this->sfGetCustomerData($customer_id);
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

	function sfCustomerMypageParam(&$objFormParam) {
        $objFormParam->addParam('銀行名', 'bank', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('銀行支店名', 'bank_branch', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('金融機関コード', 'bank_code', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('支店番号', 'branch_code', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('口座名義1', 'account_holder1', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('口座名義2', 'account_holder2', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('預金種目', 'event_deposit', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('口座番号', 'account_number', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

	function sfGetCustomerData($customer_id) {
        $objQuery       =& SC_Query_Ex::getSingletonInstance();
        $ret        = $objQuery->select('*','dtb_customer','customer_id=?', array($customer_id));
        $arrForm    = $ret[0];
        return $arrForm;
    }

    /**
     *  会員情報を登録する
     *
     * @param mixed $objFormParam
     * @param mixed $customer_id
     * @access private
     * @return void
     */
    function lfRegistCustomerData(&$objFormParam, $customer_id) {
        $sqlval             = $objFormParam->getDbArray();
        SC_Helper_Customer_Ex::sfEditCustomerData($sqlval, $customer_id);
    }

    /**
     * 入力エラーのチェック.
     *
     * @param array $arrRequest リクエスト値($_GET)
     * @return array $arrErr エラーメッセージ配列
     */
    function sfCustomerMypageErrorCheck(&$objFormParam) {
        $objFormParam->convParam();
        $arrParams = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrParams);
        $objErr->arrErr = $objFormParam->checkError();
        return $objErr->arrErr;
    }
}
