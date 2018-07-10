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

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
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
        $this->registeredFully = false;
        $this->mode = $this->getMode();
        if (!isset($this->mode) || $this->mode == '') {
            $objCartSess = new SC_CartSession_Ex();
            $this->cartKeys = $objCartSess->getKeys();
            $this->cartItems = $objCartSess->getAllCartList();
        }

        $this->customerData = $_SESSION['tempUserData'];
        list($this->customerData['birth_date'], $this->customerData['birth_time']) = explode(' ', $this->customerData['birth']);
        list($this->customerData['year'], $this->customerData['month'], $this->customerData['day']) = explode('-', $this->customerData['birth_date']);
        $objCookie = new SC_Cookie_Ex(COOKIE_EXPIRE);
        $mail_kibou = $objCookie->getCookie('login_email');
        if ($mail_kibou != '')
            $this->customerData['mail_kibou'] = 1;
        $this->kiyaku_text = $this->lfGetKiyakuData();

        $objFormParam = $this->lfInitParam($_REQUEST);
        $objFormParam->setParam($_POST);
        $this->arrForm = $objFormParam->getHashArray();

        switch ($this->mode) {
            case 'confirm':
                $this->arrErr = $this->checkError($this->arrForm, $objFormParam);
                if (count($this->arrErr) == 0)
                    $this->tpl_mainpage = 'user_data/entry_form_member_confirm.tpl';
                else
                    $this->mergeError($this->arrForm, &$this->arrErr);
                break;
            case 'complete':
                $objCustomer = new SC_Customer_Ex();
                $objPurchase = new SC_Helper_Purchase_Ex();
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                
                $sqlval = $objFormParam->getDbArray();
                unset($sqlval['accept']);
                $customerData = array_merge($_SESSION['tempUserData'], $sqlval);
                $customer_id = SC_Helper_Customer_Ex::sfEditCustomerData($customerData);
                $registeredCustomerData = $objQuery->select('password', 'dtb_customer', 'customer_id = ?', array($customer_id));
                $objCustomer->setLoginByEmailPass($_SESSION['tempUserData']['email'], $registeredCustomerData[0]['password']);
                $userData = array();
                $objPurchase->copyFromCustomer($userData, $objCustomer);
                $objQuery->update('dtb_order', $userData, 'order_id = ?', array($_SESSION['order_id']));

                SC_Response_Ex::sendRedirect('entry_form_member_done.php');
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
    
    function lfRegistCustomerData($sqlval) {
        SC_Helper_Customer_Ex::sfEditCustomerData($sqlval);
        return $sqlval['secret_key'];
    }

    function lfInitParam() {
        $objFormParam = new SC_FormParam_Ex();
        $objFormParam->addParam('パスワード', 'password', STEXT_LEN, 'a', array('EXIST_CHECK', 'SPTAB_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('パスワード(確認)', 'password02', STEXT_LEN, 'a', array('EXIST_CHECK', 'SPTAB_CHECK', 'ALNUM_CHECK'), '', false);
        $objFormParam->addParam('郵便番号1', 'zip01', ZIP01_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip02', ZIP02_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('都道府県', 'pref', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('市区町村', 'addr01', MTEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('番地・建物名', 'addr02', MTEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('上記利用規約に同意する', 'accept');
        return $objFormParam;
    }

    function checkError($arrParams, $objFormParam) {
        $objErr = new SC_CheckError_Ex($arrParams);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('郵便番号', 'zip01', 'zip02'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('パスワード', 'password', PASSWORD_MIN_LEN, PASSWORD_MAX_LEN), array('SPTAB_CHECK', 'NUM_RANGE_CHECK'));
        $objErr->doFunc(array('パスワード', 'パスワード(確認)', 'password', 'password02'), array('EQUAL_CHECK'));
        return $objErr->arrErr;
    }

    function mergeError($arrForm, $arrErr) {
        if ($arrForm['zip01'] == '' && $arrForm['zip01'] == '') {
            $arrErr['zip'] = '※郵便番号を入力してください';
            unset($arrErr['zip01']);
            unset($arrErr['zip02']);
        }
    }

    function lfGetKiyakuData() {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $objQuery->setOrder('rank DESC');
        $arrKiyaku = $objQuery->select('kiyaku_title, kiyaku_text', 'dtb_kiyaku', 'del_flg <> 1 AND kiyaku_type = 1');
        return $arrKiyaku;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
