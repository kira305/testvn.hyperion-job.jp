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
        $this->arrReminder = $masterData->getMasterData('mtb_reminder');
        $objDate = new SC_Date_Ex(BIRTH_YEAR, date('Y', strtotime('now')));
        $this->arrYear = $objDate->getYear('', START_BIRTH_YEAR, '');
        $this->arrMonth = $objDate->getMonth(true);
        $this->arrDay = $objDate->getDay(true);
        $this->arrCampaign = array(1 => '必ずもらえる2,000円', 2 => '10人に1人当たる10,000円');
        $this->httpCacheControl('nocache');
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
        $objFormParam = new SC_FormParam_Ex();

        SC_Helper_Customer_Ex::sfCustomerEntryParam($objFormParam);
        $objFormParam->addParam('お仕事に関するご希望', 'note', LTEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お祝い金キャンペーン申し込み', 'campaign', INT_LEN, 'n', array('NUM_CHECK'));
        $objFormParam->addParam('redirect', 'redirect', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->setParam($_POST);
        $arrForm = $objFormParam->getHashArray();

        // PC時は規約ページからの遷移でなければエラー画面へ遷移する
        if ($this->lfCheckReferer($arrForm, $_SERVER['HTTP_REFERER']) === false) {
            SC_Utils_Ex::sfDispSiteError(PAGE_ERROR, '', true);
        }

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($arrForm['return'])) {
            $_POST['mode'] = 'return';
        }

        switch ($this->getMode()) {
            case 'confirm':
                //-- 確認
                $this->arrErr = SC_Helper_Customer_Ex::sfCustomerEntryErrorCheck($objFormParam);
                $this->clearNullCheck($this->arrErr);
                $this->arrForm = $objFormParam->getHashArray();
                // 入力エラーなし
                if (empty($this->arrErr)) {
                    //パスワード表示
                    $this->passlen = SC_Utils_Ex::sfPassLen(strlen($this->arrForm['password']));

                    $arrKiyaku = $this->lfGetKiyakuData();
                    $this->max = count($arrKiyaku);
                    // mobile時はGETでページ指定
                    if (SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE) {
                        $this->offset = $this->lfSetOffset($_GET['offset']);
                    }
                    $this->tpl_kiyaku_text = $this->lfMakeKiyakuText($arrKiyaku, $this->max, $this->offset);
                    $this->tpl_mainpage = 'user_data/useful_confirm.tpl';
                }
                break;
            case 'complete':
                $this->arrForm = $objFormParam->getHashArray();
                $uniqid = $this->lfRegistCustomerData($this->lfMakeSqlVal($objFormParam));
                if (CUSTOMER_CONFIRM_MAIL == false) {
                    // ログイン状態にする
                    $objCustomer = new SC_Customer_Ex();
                    $objCustomer->setLogin($this->arrForm['email']);
                }
                $this->lfSendMail($uniqid, $this->arrForm);
                $this->lfSendMailToShop($uniqid, $this->arrForm);
                // 完了ページに移動させる。
                SC_Response_Ex::sendRedirect($this->arrForm['redirect']);
                break;
            case 'return':
                $this->arrForm = $objFormParam->getHashArray();
                break;
            default:
                $this->arrForm['mailmaga_flg'] = 1;
                if (isset($_GET['from']))
                    $this->arrForm['redirect'] = CART_URLPATH;
                else
                    $this->arrForm['redirect'] = 'explanation.php?a=complete';
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

    function clearNullCheck(&$arrErr) {
        if ($_POST['zip01'] == '')
            unset($arrErr['zip01']);
        if ($_POST['zip02'] == '')
            unset($arrErr['zip02']);
        if ($_POST['pref'] == '')
            unset($arrErr['pref']);
        if ($_POST['addr01'] == '')
            unset($arrErr['addr01']);
        if ($_POST['addr02'] == '')
            unset($arrErr['addr02']);
        if ($_POST['year'] == '')
            unset($arrErr['year']);
        if ($_POST['month'] == '')
            unset($arrErr['month']);
        if ($_POST['day'] == '')
            unset($arrErr['day']);
    }

    function lfMakeKiyakuText($arrKiyaku, $max, $offset) {
        $tpl_kiyaku_text = '';
        for ($i = 0; $i < $max; $i++) {
            if ($offset !== null && ($offset - 1) <> $i)
                continue;
            $tpl_kiyaku_text.=$arrKiyaku[$i]['kiyaku_title'] . "\n\n";
            $tpl_kiyaku_text.=$arrKiyaku[$i]['kiyaku_text'] . "\n\n";
        }
        return $tpl_kiyaku_text;
    }

    function lfGetKiyakuData() {

        $objQuery = SC_Query_Ex::getSingletonInstance();

        $objQuery->setOrder('rank DESC');
        $arrKiyaku = $objQuery->select('kiyaku_title, kiyaku_text', 'dtb_kiyaku', 'del_flg <> 1 AND kiyaku_type = 1');

        return $arrKiyaku;
    }

    function lfSetOffset($offset) {
        return is_numeric($offset) === true ? intval($offset) : 1;
    }

    function lfRegistCustomerData($sqlval) {
        unset($sqlval['redirect']);
        SC_Helper_Customer_Ex::sfEditCustomerData($sqlval);
        return $sqlval['secret_key'];
    }

    /**
     * 会員登録に必要なSQLパラメーターの配列を生成する.
     *
     * フォームに入力された情報を元に, SQLパラメーターの配列を生成する.
     * モバイル端末の場合は, email を email_mobile にコピーし,
     * mobile_phone_id に携帯端末IDを格納する.
     *
     * @param mixed $objFormParam
     * @access private
     * @return $arrResults
     */
    function lfMakeSqlVal(&$objFormParam) {
        $arrForm = $objFormParam->getHashArray();
        $arrResults = $objFormParam->getDbArray();

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

    /**
     * 会員登録完了メール送信する
     *
     * @access private
     * @return void
     */
    function lfSendMail($uniqid, $arrForm) {
        $CONF = SC_Helper_DB_Ex::sfGetBasisData();

        $objMailText = new SC_SiteView_Ex();
        $objMailText->setPage($this);
        $objMailText->assign('arrForm', $arrForm);
        $objMailText->assign('pref', $this->arrPref[$arrForm['pref']]);
        $objMailText->assign('reminder', $this->arrReminder[$arrForm['reminder']]);
        $objMailText->assign('campaign', $this->arrCampaign[$arrForm['campaign']]);
        $objMailText->assignobj($this);

        $objHelperMail = new SC_Helper_Mail_Ex();
        $objHelperMail->setPage($this);

        $subject = $objHelperMail->sfMakeSubject('会員登録が完了しました');
        $toCustomerMail = $objMailText->fetch('mail_templates/customer_regist_mail_to_customer.tpl');

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
                , $CONF['email01']      // bcc
        );
        // 宛先の設定
        $objMail->setTo($arrForm['email'], $arrForm['name01'] . $arrForm['name02'] . ' 様');

        $objMail->sendMail();
    }
    
    function lfSendMailToShop($uniqid, $arrForm) {
        $CONF = SC_Helper_DB_Ex::sfGetBasisData();

        $objMailText = new SC_SiteView_Ex();
        $objMailText->setPage($this);
        $objMailText->assign('CONF', $CONF);
        $objMailText->assign('name01', $arrForm['name01']);
        $objMailText->assign('name02', $arrForm['name02']);
        $objMailText->assign('uniqid', $uniqid);
        $objMailText->assignobj($this);

        $objHelperMail = new SC_Helper_Mail_Ex();
        $objHelperMail->setPage($this);

        // 仮会員が有効の場合
        if (CUSTOMER_CONFIRM_MAIL == true) {
            $subject = $objHelperMail->sfMakeSubject('会員登録のご確認');
            $toCustomerMail = $objMailText->fetch('mail_templates/customer_mail.tpl');
        } else {
            $subject = $objHelperMail->sfMakeSubject('会員登録のご完了');
            $toCustomerMail = $objMailText->fetch('mail_templates/customer_regist_mail.tpl');
        }

        $objMail = new SC_SendMail_Ex();
        $objMail->setItem(
                ''                    // 宛先
                , $subject              // サブジェクト
                , $toCustomerMail       // 本文
                , $arrForm['email']      // 配送元アドレス
                , $arrForm['name01'] . $arrForm['name02'] . ' 様'    // 配送元 名前
        );
        // 宛先の設定
        $objMail->setTo($CONF['email01'], $CONF['shop_name']);

        $objMail->sendMail();
    }

    /**
     * kiyaku.php からの遷移の妥当性をチェックする
     *
     * 以下の内容をチェックし, 妥当であれば true を返す.
     * 1. 規約ページからの遷移かどうか
     * 2. PC及びスマートフォンかどうか
     * 3. $post に何も含まれていないかどうか
     *
     * @access protected
     * @param array $post $_POST のデータ
     * @param string $referer $_SERVER['HTTP_REFERER'] のデータ
     * @return boolean kiyaku.php からの妥当な遷移であれば true
     */
    function lfCheckReferer(&$post, $referer) {

        if (SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE && empty($post) && (preg_match('/kiyaku.php/', basename($referer)) === 0)) {
            return false;
        }
        return true;
    }

    /**
     * 入力エラーのチェック.
     *
     * @param array $arrRequest リクエスト値($_GET)
     * @return array $arrErr エラーメッセージ配列
     */
    function lfCheckError($arrRequest) {
        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();
        // パラメーター情報の初期化
        $objFormParam->addParam('郵便番号1', 'zip01', ZIP01_LEN, 'n', array('EXIST_CHECK', 'NUM_COUNT_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip02', ZIP02_LEN, 'n', array('EXIST_CHECK', 'NUM_COUNT_CHECK', 'NUM_CHECK'));
        // // リクエスト値をセット
        $arrData['zip01'] = $arrRequest['zip01'];
        $arrData['zip02'] = $arrRequest['zip02'];
        $objFormParam->setParam($arrData);
        // エラーチェック
        $arrErr = $objFormParam->checkError();
        // 親ウィンドウの戻り値を格納するinputタグのnameのエラーチェック
        if (!$this->lfInputNameCheck($addData['zip01'])) {
            $arrErr['zip01'] = '※ 入力形式が不正です。<br />';
        }
        if (!$this->lfInputNameCheck($arrdata['zip02'])) {
            $arrErr['zip02'] = '※ 入力形式が不正です。<br />';
        }

        return $arrErr;
    }

    /**
     * エラーチェック.
     *
     * @param string $value
     * @return エラーなし：true エラー：false
     */
    function lfInputNameCheck($value) {
        // 半角英数字と_（アンダーバー）, []以外の文字を使用していたらエラー
        if (strlen($value) > 0 && !preg_match("/^[a-zA-Z0-9_\[\]]+$/", $value)) {
            return false;
        }

        return true;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
