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
 * メルマガ管理 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Mail.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Mail extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'mail/index.tpl';
        $this->tpl_mainno = 'mail';
        $this->tpl_subno = 'index';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = 'メルマガ管理';
        $this->tpl_subtitle = '配信内容設定';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrJob = $masterData->getMasterData('mtb_job');
        $this->arrJob['不明'] = '不明';
        $this->arrSex = $masterData->getMasterData('mtb_sex');
        $this->arrPageRows = $masterData->getMasterData('mtb_page_max');
        $this->arrHtmlmail = array('' => '両方', 1 => 'HTML', 2 => 'TEXT');
        $this->arrMailType = $masterData->getMasterData('mtb_mail_type');

        // 日付プルダウン設定
        $objDate = new SC_Date_Ex(BIRTH_YEAR);
        $this->arrBirthYear = $objDate->getYear();
        $this->arrRegistYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();
        $this->objDate = $objDate;

        // カテゴリ一覧設定
        $objDb = new SC_Helper_DB_Ex();
        $this->arrCatList = $objDb->sfGetCategoryList();

        // テンプレート一覧設定
        $this->arrTemplate = $this->lfGetMailTemplateList(SC_Helper_Mail_Ex::sfGetMailmagaTemplate());

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
        $this->lfInitParamSearchCustomer($objFormParam);
        $objFormParam->setParam($_POST);

        // パラメーター読み込み
        $this->arrHidden = $objFormParam->getSearchArray();

        // 入力パラメーターチェック
        $this->arrErr = SC_Helper_Customer_Ex::sfCheckErrorSearchParam($objFormParam);
        $this->arrForm = $objFormParam->getFormParamList();
        if (!SC_Utils_Ex::isBlank($this->arrErr))
            return;

        // モードによる処理切り替え
        switch ($this->getMode()) {
            // 配信先検索
            case 'search':
            case 'back':
                list($this->tpl_linemax, $this->arrResults, $this->objNavi) = SC_Helper_Customer_Ex::sfGetSearchData($objFormParam->getHashArray());
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                break;
            case 'check_customer':
                list($this->tpl_linemax, $this->arrResults, $this->objNavi) = SC_Helper_Customer_Ex::sfGetSearchData($objFormParam->getHashArray());
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                $this->lfAddParamSelectTemplate($objFormParam);
                $objFormParam->setParam($_POST);
                $this->tpl_mainpage = 'mail/query_input.tpl';
                break;
            // input:検索結果画面「配信内容を設定する」押下後
            case 'input':
                if (isset($_POST['cid'])) {
                    foreach ($_POST['cid'] as $customer_id)
                        $ids .= $customer_id . '-';
                }
                $_POST['cid'] = substr($ids, 0, -1);
                $this->lfAddParamSelectTemplate($objFormParam);
                $objFormParam->setParam($_POST);
                $this->tpl_mainpage = 'mail/input.tpl';
                break;
            // template:テンプレート選択時
            case 'template':
            case 'regist_back':
                $this->tpl_mainpage = 'mail/input.tpl';
                $this->lfAddParamSelectTemplate($objFormParam);
                $this->lfGetTemplateData($objFormParam, $_POST['template_id']);
                if ($this->getMode() == 'regist_back') {
                    $objFormParam->setParam($_POST);
                }
                break;
            case 'regist_confirm':
                $this->tpl_mainpage = 'mail/input.tpl';
                $this->lfAddParamSelectTemplate($objFormParam);
                $objFormParam->setParam($_POST);
                $this->arrErr = $objFormParam->checkError();
                if (SC_Utils_Ex::isBlank($this->arrErr))
                    $this->tpl_mainpage = 'mail/input_confirm.tpl';
                break;
            case 'regist_complete':
                $this->tpl_mainpage = 'mail/input.tpl';
                $this->lfAddParamSelectTemplate($objFormParam);
                $objFormParam->setParam($_POST);
                $this->arrErr = $objFormParam->checkError();
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    $this->tpl_mainpage = 'mail/index.tpl';
                    if (SC_Utils_Ex::sfIsInt($_POST['send_id']) && $this->lfCheckSendMail($_POST['send_id']))
                        SC_Helper_Mail_Ex::sfSendMailmagazine($this->lfUpdateData($objFormParam));
                    else
                        SC_Helper_Mail_Ex::sfSendMailmagazine($this->lfRegisterData($objFormParam));
                    SC_Response_Ex::sendRedirect('./history.php');
                }
                break;
            // query:配信履歴から「確認」
            case 'query':
                if (SC_Utils_Ex::sfIsInt($_GET['send_id'])) {
                    $this->arrSearchData = $this->lfGetMailQuery($_GET['send_id']);
                }
                $this->setTemplate('mail/query.tpl');
                break;
            case 'customer':
                if (SC_Utils_Ex::sfIsInt($_GET['send_id'])) {
                    $objQuery = & SC_Query_Ex::getSingletonInstance();
                    $arrCustomer = $objQuery->select('concat(name01,name02) as name', 'dtb_customer', 'customer_id IN (SELECT customer_id FROM dtb_send_customer WHERE send_id = ?)', array($_GET['send_id']));
                    foreach ($arrCustomer as $value)
                        $this->cus_names .= $value['name'] . ', ';
                }
                $this->setTemplate('mail/customer.tpl');
                break;
            case 'retry':
                $this->tpl_mainpage = 'mail/input.tpl';
                if (SC_Utils_Ex::sfIsInt($_GET['send_id'])) {
                    $arrSearchData = $this->lfGetMailQuery($_GET['send_id']);
                    $objFormParam->setParam($arrSearchData);
                    $this->arrHidden = $objFormParam->getSearchArray();

                    $this->lfAddParamSelectTemplate($objFormParam);
                    $this->lfGetMailHistory($objFormParam, $_GET['send_id']);
                }
                break;
            case 'save':
                $this->tpl_mainpage = 'mail/input.tpl';
                $this->lfAddParamSelectTemplate($objFormParam);
                $objFormParam->setParam($_POST);
                $this->arrErr = $objFormParam->checkError();
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    $this->tpl_mainpage = 'mail/index.tpl';
                    $this->lfRegisterData($objFormParam);
                    SC_Response_Ex::sendRedirect('./history.php');
                }
                break;
            case 'check':
                list($this->tpl_linemax, $this->arrResults, $this->objNavi) = SC_Helper_Customer_Ex::sfGetSearchData($objFormParam->getHashArray());
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                $this->lfAddParamSelectTemplate($objFormParam);
                if (isset($_POST['cid']) && $_POST['cid'] != NULL)
                    $this->cids = explode('-', $_POST['cid']);
                $objFormParam->setParam($_POST);
                $this->tpl_mainpage = 'mail/query_input.tpl';
                break;
            case 'mail':
                $this->tpl_mainpage = 'mail/input.tpl';
                $this->lfAddParamSelectTemplate($objFormParam);

                $_POST['mail_method'] = 2;
                $_POST['body'] = '薬剤師のお仕事紹介をしております。
ファーマプレミアムでございます。

本日は、新しく入ったばかりの求人をご紹介したいと思います。
ぜひ、チェックしてみて下さい！';

                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $objQuery->setOrder('product_id ASC');
                $objProduct = new SC_Product_Ex();
                $arrProducts = $objProduct->getDetailByProductIds($objQuery, $_POST['dm']);

                foreach ($arrProducts as $product) {
                    $_POST['body'] .= '

*************************************************************************
' . $product["main_comment"] . '
*************************************************************************
【勤務地】' . $product["sub_comment1"] . '
【交通アクセス】' . $product["sub_comment2"] . '
【給与】' . $product["price02_min"] . '円
【就業日】' . $product["sub_comment3"] . '
【就業時間】' . $product["sub_comment4"] . '
【待遇】' . $product["sub_comment5"] . '
【処方科目】' . $product["sub_comment6"] . '
【処方箋枚数／日】' . $product["sub_comment7"] . '
' . $product["sub_comment8"] . '
↓　↓　↓
求人コード： ' . $product["product_code_min"];
                }

                $CONF = SC_Helper_DB_Ex::sfGetBasisData();
                $masterData = new SC_DB_MasterData_Ex();
                $arrPref = $masterData->getMasterData('mtb_pref');

                $_POST['body'] .= '


★ご応募の際は、
このメールに求人コード・希望日程を記載してこのまま返信願います。

他の求人をお探しの方はこちらへ！
↓　↓　↓
☆地域別でお仕事検索☆
https://www.pharmapremium.jp

' . $CONF["shop_name"] . '
〒' . $CONF["zip01"] . '-' . $CONF["zip02"] . '
' . $arrPref[$CONF["pref"]] . $CONF["addr01"] . $CONF["addr02"] . '
TEL フリーコール番号　' . $CONF["tel01"] . '-' . $CONF["tel02"] . '-' . $CONF["tel03"] . '(通話料無料)
FAX　' . $CONF["fax01"] . '-' . $CONF["fax02"] . '-' . $CONF["fax03"] . '

配信停止はこちらへURL：(' . ROOT_URLPATH . 'mypage/change.php)';

                $objFormParam->setParam($_POST);
                break;
            default:
                break;
        }
        $this->arrForm = $objFormParam->getFormParamList();
        if ($this->arrForm['cid']['value'] != '') {
            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $cid = str_replace('-', ',', $this->arrForm['cid']['value']);
            $arrCustomer = $objQuery->select('name01, name02', 'dtb_customer', 'customer_id IN (' . $cid . ')');
            foreach ($arrCustomer as $customer)
                $this->cus_names .= $customer['name01'] . $customer['name02'] . '、 ';
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
     * パラメーター情報の初期化（初期会員検索時）
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitParamSearchCustomer(&$objFormParam) {
        SC_Helper_Customer_Ex::sfSetSearchParam($objFormParam);
        $objFormParam->addParam('配信形式', 'search_htmlmail', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('配信メールアドレス種別', 'search_mail_type', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * パラメーター情報の追加（テンプレート選択）
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfAddParamSelectTemplate(&$objFormParam) {
        $objFormParam->addParam('メール形式', 'mail_method', INT_LEN, 'n', array('EXIST_CHECK', 'ALNUM_CHECK'));
        $objFormParam->addParam('管理タイトル', 'kanrititle', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('Subject', 'subject', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('本文', 'body', LLTEXT_LEN, 'KVCa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('テンプレートID', 'template_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('send_ID', 'send_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('cid', 'cid', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * メルマガテンプレート一覧情報の取得
     *
     * @param array $arrTemplate SC_Helper_Mail_Ex::sfGetMailmagaTemplate()の戻り値
     * @return array key:template_id value:サブジェクト【配信形式】
     */
    function lfGetMailTemplateList($arrTemplate) {
        if (is_array($arrTemplate)) {
            foreach ($arrTemplate as $line) {
                $return[$line['template_id']] = '【' . $this->arrHtmlmail[$line['mail_method']] . '】' . $line['subject'];
            }
        }
        return $return;
    }

    /**
     * テンプレートIDから情報の取得して$objFormParamにset_paramする
     *
     * @param array $objFormParam フォームパラメータークラス
     * @param array $template_id テンプレートID
     * @return void
     */
    function lfGetTemplateData(&$objFormParam, $template_id) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->setOrder('template_id DESC');
        $where = 'template_id = ?';
        $arrResults = $objQuery->getRow('*', 'dtb_mailmaga_template', $where, array($template_id));
        $objFormParam->setParam($arrResults);
    }

    /**
     * 配信内容と配信リストを書き込む
     *
     * @return integer 登録した行の dtb_send_history.send_id の値
     */
    function lfRegisterData(&$objFormParam) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        /* if($objFormParam->getValue('send_id') > 0){
          $arrSearchData = $this->lfGetMailQuery($objFormParam->getValue('send_id'));
          $objFormParam->setParam($arrSearchData);
          } */

        $arrVal = $objFormParam->getHashArray();
        if ($arrVal['cid'] != '') {
            $cid = str_replace('-', ',', $arrVal['cid']);
            $arrSendCustomer = $objQuery->select('*', 'dtb_customer', 'customer_id IN (' . $cid . ')');
        }
        else
            list($linemax, $arrSendCustomer, $objNavi) = SC_Helper_Customer_Ex::sfGetSearchData($arrVal, 'All');
        $send_customer_cnt = count($arrSendCustomer);

        $send_id = $objQuery->nextVal('dtb_send_history_send_id');
        $dtb_send_history = array();
        $dtb_send_history['mail_method'] = $objFormParam->getValue('mail_method');
        $dtb_send_history['template_id'] = $objFormParam->getValue('template_id');
        $dtb_send_history['kanrititle'] = $objFormParam->getValue('kanrititle');
        $dtb_send_history['subject'] = $objFormParam->getValue('subject');
        $dtb_send_history['body'] = $objFormParam->getValue('body');
        $dtb_send_history['start_date'] = 'CURRENT_TIMESTAMP';
        $dtb_send_history['creator_id'] = $_SESSION['member_id'];
        $dtb_send_history['send_count'] = $send_customer_cnt;
        $dtb_send_history['search_data'] = serialize($objFormParam->getSearchArray());
        $dtb_send_history['update_date'] = 'CURRENT_TIMESTAMP';
        $dtb_send_history['create_date'] = 'CURRENT_TIMESTAMP';
        $dtb_send_history['send_id'] = $send_id;
        $objQuery->insert('dtb_send_history', $dtb_send_history);
        // 「配信メールアドレス種別」に携帯メールアドレスが指定されている場合は、携帯メールアドレスに配信
        $emailtype = 'email';
        $searchmailtype = $objFormParam->getValue('search_mail_type');
        if ($searchmailtype == 2 || $searchmailtype == 4) {
            $emailtype = 'email_mobile';
        }
        if (is_array($arrSendCustomer)) {
            foreach ($arrSendCustomer as $line) {
                $dtb_send_customer = array();
                $dtb_send_customer['customer_id'] = $line['customer_id'];
                $dtb_send_customer['send_id'] = $send_id;
                $dtb_send_customer['email'] = $line[$emailtype];
                $dtb_send_customer['name'] = $line['name01'] . ' ' . $line['name02'];
                $objQuery->insert('dtb_send_customer', $dtb_send_customer);
            }
        }
        return $send_id;
    }

    function lfUpdateData(&$objFormParam) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        $arrVal = $objFormParam->getHashArray();
        if ($arrVal['cid'] != '') {
            $cid = str_replace('-', ',', $arrVal['cid']);
            $arrSendCustomer = $objQuery->select('*', 'dtb_customer', 'customer_id IN (' . $cid . ')');
        }
        else
            list($linemax, $arrSendCustomer, $objNavi) = SC_Helper_Customer_Ex::sfGetSearchData($arrVal, 'All');
        $send_customer_cnt = count($arrSendCustomer);

        $send_id = $objFormParam->getValue('send_id');
        $dtb_send_history = array();
        $dtb_send_history['mail_method'] = $objFormParam->getValue('mail_method');
        $dtb_send_history['template_id'] = $objFormParam->getValue('template_id');
        $dtb_send_history['kanrititle'] = $objFormParam->getValue('kanrititle');
        $dtb_send_history['subject'] = $objFormParam->getValue('subject');
        $dtb_send_history['body'] = $objFormParam->getValue('body');
        $dtb_send_history['send_count'] = $send_customer_cnt;
        $dtb_send_history['search_data'] = serialize($objFormParam->getSearchArray());
        $dtb_send_history['update_date'] = 'CURRENT_TIMESTAMP';
        $objQuery->update('dtb_send_history', $dtb_send_history, 'send_id = ?', array($send_id));

        $objQuery->delete('dtb_send_customer', 'send_id = ?', array($send_id));
        $emailtype = 'email';
        $searchmailtype = $objFormParam->getValue('search_mail_type');
        if ($searchmailtype == 2 || $searchmailtype == 4) {
            $emailtype = 'email_mobile';
        }
        if (is_array($arrSendCustomer)) {
            foreach ($arrSendCustomer as $line) {
                $dtb_send_customer = array();
                $dtb_send_customer['customer_id'] = $line['customer_id'];
                $dtb_send_customer['send_id'] = $send_id;
                $dtb_send_customer['email'] = $line[$emailtype];
                $dtb_send_customer['name'] = $line['name01'] . ' ' . $line['name02'];
                $objQuery->insert('dtb_send_customer', $dtb_send_customer);
            }
        }
        return $send_id;
    }

    function lfGetMailHistory(&$objFormParam, $send_id) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $where = 'send_id = ?';
        $arrResults = $objQuery->getRow('*', 'dtb_send_history', $where, array($send_id));
        $objFormParam->setParam($arrResults);
    }

    function lfCheckSendMail($send_id) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $sql = 'SELECT complete_count FROM dtb_send_history WHERE send_id = ?';
        $searchData = $objQuery->getOne($sql, array($send_id));
        if ($searchData == 0)
            return true;
        return false;
    }

    /**
     * 配信履歴から条件を取得する
     *
     * @param integer $send_id　配信履歴番号
     * @return array
     */
    function lfGetMailQuery($send_id) {

        $objQuery = & SC_Query_Ex::getSingletonInstance();

        // 送信履歴より、送信条件確認画面
        $sql = 'SELECT search_data FROM dtb_send_history WHERE send_id = ?';
        $searchData = $objQuery->getOne($sql, array($send_id));
        return unserialize($searchData);
    }

}
