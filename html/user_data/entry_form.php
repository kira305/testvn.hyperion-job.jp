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

    var $mode;

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $objDate = new SC_Date_Ex(BIRTH_YEAR, date('Y', strtotime('now')));
        $this->arrYear = $objDate->getYear('', FALSE, '');
        $this->arrMonth = $objDate->getMonth(FALSE);
        $this->arrDay = $objDate->getDay(FALSE);
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
        $objCartSess = new SC_CartSession_Ex();
        $this->cartKeys = $objCartSess->getKeys();
        $this->cartItems = $objCartSess->getAllCartList();
        $this->kiyaku_text = $this->lfGetKiyakuData();
        $this->isLogged = false;

        $objFormParam = $this->lfInitParam($_REQUEST);
        $objFormParam->setParam($_POST);
        $this->arrForm = $objFormParam->getHashArray();
        $this->mode = $this->getMode();
        switch ($this->mode) {
            case 'confirm':
                $this->arrErr = $this->checkError($this->arrForm, $objFormParam);
                if (count($this->arrErr) == 0) {
                    $objCookie = new SC_Cookie_Ex(COOKIE_EXPIRE);
                    if ($this->arrForm['mail_kibou'] == '1') {
                        $objCookie->setCookie('login_email', $this->arrForm['email']);
                    } else {
                        $objCookie->setCookie('login_email', '');
                    }

                    $this->tpl_mainpage = 'user_data/entry_form_confirm.tpl';
                }
                else
                    $this->mergeError($this->arrForm, &$this->arrErr);
                break;
            case 'complete':
                $_SESSION['tempUserData'] = $this->lfMakeSqlVal($objFormParam);

                $objSiteSess = new SC_SiteSession_Ex();
                $objPurchase = new SC_Helper_Purchase_Ex();
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $objHelperMail = new SC_Helper_Mail_Ex();
                $objHelperMail->setPage($this);

                $this->tpl_uniqid = $objSiteSess->getUniqId();
                $objPurchase->verifyChangeCart($this->tpl_uniqid, $objCartSess);
                $this->cartKey = $objCartSess->getKey();
                $arrForm = $objCartSess->calculate($this->cartKey);
                $arrForm['update_date'] = 'CURRENT_TIMESTAMP';
                $arrForm['order_id'] = $objQuery->nextval('dtb_order_order_id');
                $_SESSION['order_id'] = $arrForm['order_id'];
                $arrForm['order_temp_id'] = $this->tpl_uniqid;

                $keys = array('name01','name02','kana01','kana02','sex','birth','tel01','tel02','tel03','email');
                foreach ($keys as $key)
                    $arrForm['order_' . $key] = $_SESSION['tempUserData'][$key];

                $objPurchase->saveOrderTemp($this->tpl_uniqid, $arrForm);
                $objSiteSess->setRegistFlag();
                $objPurchase->completeOrder(ORDER_NEW);
                $template_id = SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE ? 2 : 1;
                $objHelperMail->sfSendOrderMail($arrForm['order_id'], $template_id);

                SC_Response_Ex::sendRedirect('entry_form_done.php');
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

    function checkError($arrParams, $objFormParam) {
        $objErr = new SC_CheckError_Ex($arrParams);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('電話番号', 'tel01', 'tel02', 'tel03'), array('TEL_CHECK'));
        $objErr->doFunc(array('生年月日', 'year', 'month', 'day'), array('CHECK_BIRTHDAY'));
//        $objErr->doFunc(array('メールアドレス', 'email'), array('CHECK_REGIST_CUSTOMER_EMAIL'));
        $objErr->doFunc(array('メールアドレス', '確認', 'email', 'email02'), array('EQUAL_CHECK'));
        return $objErr->arrErr;
    }

    function mergeError($arrForm, $arrErr) {
        if ($arrForm['name01'] == '' && $arrForm['name02'] == '') {
            $arrErr['name'] = '※氏名を入力してください';
            unset($arrErr['name01']);
            unset($arrErr['name02']);
        }
        if ($arrForm['kana01'] == '' && $arrForm['kana02'] == '') {
            $arrErr['kana'] = '※カナを入力してください';
            unset($arrErr['kana01']);
            unset($arrErr['kana02']);
        }
        if ($arrForm['year'] == '' && $arrForm['month'] == '' && $arrForm['day'] == '') {
            $arrErr['birth'] = '※生年月日を選択してください';
            unset($arrErr['year']);
            unset($arrErr['month']);
            unset($arrErr['day']);
        }
        if ($arrForm['tel01'] == '' && $arrForm['tel02'] == '' && $arrForm['tel03'] == '') {
            $arrErr['tel'] = '※電話番号を入力してください';
            unset($arrErr['tel01']);
            unset($arrErr['tel02']);
            unset($arrErr['tel03']);
        }
    }

    function lfInitParam() {
        $objFormParam = new SC_FormParam_Ex();
        $objFormParam->addParam('氏名(姓)', 'name01', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('氏名(名)', 'name02', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('カナ(姓)', 'kana01', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('カナ(名)', 'kana02', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('性別', 'sex', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('年', 'year', 4, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('月', 'month', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('日', 'day', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('電話番号1', 'tel01', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号2', 'tel02', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('電話番号3', 'tel03', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールアドレス', 'email', null, 'a', array('NO_SPTAB', 'EXIST_CHECK', 'EMAIL_CHECK', 'SPTAB_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('メールアドレス(確認)', 'email02', null, 'a', array('NO_SPTAB', 'EXIST_CHECK', 'EMAIL_CHECK', 'SPTAB_CHECK', 'EMAIL_CHAR_CHECK'), '', false);
        $objFormParam->addParam('メールマガジン', 'mailmaga_flg', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールを希望する', 'mail_kibou');
        $objFormParam->addParam('上記利用規約に同意する', 'accept');
        return $objFormParam;
    }

    function lfMakeSqlVal(&$objFormParam) {
        $arrForm = $objFormParam->getHashArray();
        $arrResults = $objFormParam->getDbArray();
        unset($arrResults['mail_kibou']);
        unset($arrResults['accept']);
        // 生年月日の作成
        $arrResults['birth'] = SC_Utils_Ex::sfGetTimestamp($arrForm['year'], $arrForm['month'], $arrForm['day']);
        // 仮会員 1 本会員 2
        $arrResults['status'] = (CUSTOMER_CONFIRM_MAIL == true) ? '1' : '2';
        /*
         * secret_keyは、テーブルで重複許可されていない場合があるので、
         * 本会員登録では利用されないがセットしておく。
         */
        $arrResults['secret_key'] = SC_Helper_Customer_Ex::sfGetUniqSecretKey();
        // 入会時ポイント
        $CONF = SC_Helper_DB_Ex::sfGetBasisData();
        $arrResults['point'] = $CONF['welcome_point'];
        if (SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE) {
            // 携帯メールアドレス
            $arrResults['email_mobile'] = $arrResults['email'];
            // PHONE_IDを取り出す
            $arrResults['mobile_phone_id'] = SC_MobileUserAgent_Ex::getId();
        }
        return $arrResults;
    }

    function lfGetKiyakuData() {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $objQuery->setOrder('rank DESC');
        $arrKiyaku = $objQuery->select('kiyaku_title, kiyaku_text', 'dtb_kiyaku', 'del_flg <> 1 AND kiyaku_type = 2');
        return $arrKiyaku;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
