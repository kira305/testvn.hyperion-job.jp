<?php

require_once '../require.php';
require_once CLASS_EX_REALDIR . 'page_extends/LC_Page_Ex.php';

/**
 * ユーザーカスタマイズ用のページクラス
 *
 * 管理画面から自動生成される
 *
 * @package Page
 */
class LC_Page_User extends LC_Page_Ex {

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->arrOffice = array(1 => '川越オフィス', 2 => '朝霞オフィス', 3 => '池袋オフィス');
        $this->arrOfficeAddr = array(
            1 => '川越市脇田本町15-19　ニューパレスビル新館 6F',
            2 => '朝霞市東弁財3-15-3　イーストミューズ 1F',
            3 => '東京都豊島区雑司が谷3-11-2　コバヤシビル 3F'
        );
        $this->arrOfficeUrl = array(
            1 => 'http://maps.googleapis.com/maps/api/staticmap?center=%E5%B7%9D%E8%B6%8A%E5%B8%82%E8%84%87%E7%94%B0%E6%9C%AC%E7%94%BA15-19%20%E3%83%8B%E3%83%A5%E3%83%BC%E3%83%91%E3%83%AC%E3%82%B9%E3%83%93%E3%83%AB%E6%96%B0%E9%A4%A8&zoom=18&scale=2&size=600x400&maptype=roadmap&markers=label:A|%E5%B7%9D%E8%B6%8A%E5%B8%82%E8%84%87%E7%94%B0%E6%9C%AC%E7%94%BA15-19%20%E3%83%8B%E3%83%A5%E3%83%BC%E3%83%91%E3%83%AC%E3%82%B9%E3%83%93%E3%83%AB%E6%96%B0%E9%A4%A8&sensor=false&format=jpg',
            2 => 'http://maps.googleapis.com/maps/api/staticmap?center=%E6%9C%9D%E9%9C%9E%E5%B8%82%E6%9D%B1%E5%BC%81%E8%B2%A13-15-3%20%E3%82%A4%E3%83%BC%E3%82%B9%E3%83%88%E3%83%9F%E3%83%A5%E3%83%BC%E3%82%BA%201F&zoom=18&scale=2&size=600x400&maptype=roadmap&markers=label:A|%E6%9C%9D%E9%9C%9E%E5%B8%82%E6%9D%B1%E5%BC%81%E8%B2%A13-15-3%20%E3%82%A4%E3%83%BC%E3%82%B9%E3%83%88%E3%83%9F%E3%83%A5%E3%83%BC%E3%82%BA&sensor=false&format=jpg',
            3 => 'http://maps.googleapis.com/maps/api/staticmap?center=%E6%9D%B1%E4%BA%AC%E9%83%BD%E8%B1%8A%E5%B3%B6%E5%8C%BA%E9%9B%91%E5%8F%B8%E3%81%8C%E8%B0%B73-11-2%20%E3%82%B3%E3%83%90%E3%83%A4%E3%82%B7%E3%83%93%E3%83%AB&zoom=18&scale=2&size=600x400&maptype=roadmap&markers=label:A|%E6%9D%B1%E4%BA%AC%E9%83%BD%E8%B1%8A%E5%B3%B6%E5%8C%BA%E9%9B%91%E5%8F%B8%E3%81%8C%E8%B0%B73-11-2%20%E3%82%B3%E3%83%90%E3%83%A4%E3%82%B7%E3%83%93%E3%83%AB&sensor=false&format=jpg'
        );
        $this->msg = 0;
        if (isset($_GET['a'])) {
            $this->msg = 1;
        }
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        $this->arrData = isset($_SESSION['customer']) ? $_SESSION['customer'] : '';

        $objFormParam = new SC_FormParam_Ex();
        $objFormParam->addParam('希望会場', 'office', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('希望日時', 'note', LTEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前(姓)', 'name01', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前(名)', 'name02', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前(フリガナ・姓)', 'kana01', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お名前(フリガナ・名)', 'kana02', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お電話番号1', 'tel01', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お電話番号2', 'tel02', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お電話番号3', 'tel03', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールアドレス', 'email', null, 'a', array('EXIST_CHECK', 'NO_SPTAB', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->setParam($_POST);
        $arrForm = $objFormParam->getHashArray();

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($arrForm['return'])) {
            $_POST['mode'] = 'return';
        }

        switch ($this->getMode()) {
            case 'confirm':
                $this->arrErr = $objFormParam->checkError();
                if (empty($this->arrErr))
                    $this->tpl_mainpage = 'user_data/explanation_confirm.tpl';
                break;
            case 'complete':
                $this->arrErr = $objFormParam->checkError();
                if (empty($this->arrErr)) {
                    $this->lfSendMail($objFormParam->getHashArray());
                    $this->tpl_mainpage = 'user_data/explanation_complete.tpl';
                }
                break;
            case 'return':
                break;
            default:
                break;
        }
        $this->arrForm = $objFormParam->getHashArray();
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
     * 会員登録完了メール送信する
     *
     * @access private
     * @return void
     */
    function lfSendMail($arrForm) {
        $CONF = SC_Helper_DB_Ex::sfGetBasisData();

        $objMailText = new SC_SiteView_Ex();
        $objMailText->setPage($this);
        $objMailText->assign('arrForm', $arrForm);
        $objMailText->assign('officeAddr', $this->arrOfficeAddr[$arrForm['office']]);
        $objMailText->assign('officeUrl', $this->arrOfficeUrl[$arrForm['office']]);
        $objMailText->assignobj($this);

        $objHelperMail = new SC_Helper_Mail_Ex();
        $objHelperMail->setPage($this);

        $subject = $objHelperMail->sfMakeSubject('登録説明会へのお申込を受け付けました');
        $toCustomerMail = $objMailText->fetch('mail_templates/explanation.tpl');

        $objMail = new SC_SendMail_Ex();
        $objMail->setItem(
                ''                    // 宛先
                , $subject              // サブジェクト
                , $toCustomerMail       // 本文
                , $CONF['email03']      // 配送元アドレス
                , $CONF['shop_name']    // 配送元 名前
                , $CONF['email03']      // reply_to
                , $CONF['email04']      // return_path
                , $CONF['email04']      // Errors_to
        );
        $objMail->setTo($arrForm['email'], $arrForm['name01'] . $arrForm['name02'] . ' 様');
        $objMail->sendMail(true);

        $objMail = new SC_SendMail_Ex();
        $objMail->setItem(
                ''                    // 宛先
                , $subject              // サブジェクト
                , $toCustomerMail       // 本文
                , $CONF['email02']      // 配送元アドレス
                , $CONF['shop_name']    // 配送元 名前
        );
        $objMail->setTo($CONF['email01'], $CONF['shop_name']);
        $objMail->sendMail(true);
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
