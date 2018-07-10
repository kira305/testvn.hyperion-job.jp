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
        $this->kiyaku_text = $this->lfGetKiyakuData();

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
                    $this->tpl_mainpage = 'user_data/member_entry_confirm.tpl';
                }
                else
                    $this->mergeError($this->arrForm, $this->arrErr);
                break;
            case 'complete':
                $this->lfRegistCustomerData($this->lfMakeSqlVal($objFormParam));
                $objCustomer = new SC_Customer_Ex();
                $objCustomer->setLogin($this->arrForm['email']);

                SC_Response_Ex::sendRedirect('member_entry_done.php');
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
        $objErr->doFunc(array('郵便番号', 'zip01', 'zip02'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('パスワード', 'password', PASSWORD_MIN_LEN, PASSWORD_MAX_LEN), array('SPTAB_CHECK', 'NUM_RANGE_CHECK'));
        $objErr->doFunc(array('パスワード', 'パスワード(確認)', 'password', 'password02'), array('EQUAL_CHECK'));
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
        if ($arrForm['zip01'] == '' && $arrForm['zip01'] == '') {
            $arrErr['zip'] = '※郵便番号を入力してください';
            unset($arrErr['zip01']);
            unset($arrErr['zip02']);
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
        $objFormParam->addParam('パスワード', 'password', STEXT_LEN, 'a', array('EXIST_CHECK', 'SPTAB_CHECK', 'ALNUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('パスワード(確認)', 'password02', STEXT_LEN, 'a', array('EXIST_CHECK', 'SPTAB_CHECK', 'ALNUM_CHECK'), '', false);
        $objFormParam->addParam('郵便番号1', 'zip01', ZIP01_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip02', ZIP02_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('都道府県', 'pref', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('市区町村', 'addr01', MTEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('番地・建物名', 'addr02', MTEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールマガジン', 'mailmaga_flg', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールを希望する', 'mail_kibou');
        $objFormParam->addParam('上記利用規約に同意する', 'accept');
        return $objFormParam;
    }

    function lfRegistCustomerData($sqlval) {
        SC_Helper_Customer_Ex::sfEditCustomerData($sqlval);
        return $sqlval['secret_key'];
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
        $arrKiyaku = $objQuery->select('kiyaku_title, kiyaku_text', 'dtb_kiyaku', 'del_flg <> 1 AND kiyaku_type = 1');
        return $arrKiyaku;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
