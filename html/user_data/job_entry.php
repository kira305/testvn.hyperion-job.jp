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
        if ($_GET['p'] != '') {
            switch ($_GET['p']) {
                case 1:
                    $_SESSION['recruit_job_name'] = '人材営業／人材コーディネーター';
                    break;
                case 2:
                    $_SESSION['recruit_job_name'] = 'フィールドマネージャー／フィールドスタッフ';
                    break;
                default:
                    SC_Response_Ex::sendRedirect('/user_data/job.php');
                    SC_Response_Ex::actionExit();
                    break;
            }
        }
        $this->kiyaku_text = $this->lfGetKiyakuData();

        $objFormParam = $this->lfInitParam($_REQUEST);
        $objFormParam->setParam($_POST);
        $this->arrForm = $objFormParam->getHashArray();
        $this->mode = $this->getMode();
        switch ($this->mode) {
            case 'confirm':
                $this->arrErr = $this->checkError($this->arrForm, $objFormParam);
                if (count($this->arrErr) == 0)
                    $this->tpl_mainpage = 'user_data/job_entry_confirm.tpl';
                else
                    $this->mergeError($this->arrForm, &$this->arrErr);
                break;
            case 'complete':
                $this->sendMail($this->arrForm);
                $this->tpl_mainpage = 'user_data/job_entry_done.tpl';
                break;
            default:
                $this->arrForm = $_SESSION['customer'];
                list($this->arrForm['birth_date'], $this->arrForm['birth_time']) = explode(' ', $this->arrForm['birth']);
                list($this->arrForm['year'], $this->arrForm['month'], $this->arrForm['day']) = explode('-', $this->arrForm['birth_date']);
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
        $objFormParam->addParam('上記利用規約に同意する', 'accept');
        return $objFormParam;
    }

    function sendMail($arrForm) {
        $arrInfo = SC_Helper_DB_Ex::sfGetBasisData();

        $sex = ($arrForm['sex'] == 1) ? '男性' : '女性';
        $body = $arrForm['name01'] . ' ' . $arrForm['name02'] . ' 様

求人情報・お仕事紹介サイト「ハイペリオンあっとジョブ!」でございます。

この度はご利用をいただきまして、まことにありがとうございます。

以下の内容でお仕事へのご応募を受け付けました。
ウェブ応募の場合、応募先の担当者からご連絡を差し上げますので、少々お待ちください。

※ご応募した内容に訂正や誤りがございましたら、お手数ですがご連絡ください。

************************************************
　求人詳細
************************************************

求人名：' . $_SESSION['recruit_job_name'] . '  
氏名 (漢字)：' . $arrForm['name01'] . ' ' . $arrForm['name02'] . '  
氏名 (カナ)：' . $arrForm['kana01'] . ' ' . $arrForm['kana02'] . '
性別：' . $sex . '
生年月日：' . $arrForm['year'] . '-' . $arrForm['month'] . '-' . $arrForm['day'] . '
電話番号：' . $arrForm['tel01'] . '-' . $arrForm['tel02'] . '-' . $arrForm['tel03'] . '
メールアドレス：' . $arrForm['email'] . '

============================================


その他、ご不明な点などございましたらお気軽にご連絡ください。
----------------------------------------------------------------------
　ハイペリオンあっとジョブ!
　http://www.hyperion-job.jp/
　メール: ofcstaff@hyperion.co.jp
　電話: 048-451-3877
----------------------------------------------------------------------
※本メールは自動配信メールです。
※本メールは、求人情報サイト「ハイペリオンあっとジョブ!」をご利用して
　いただいた方にお送りしております。
　もしお心当たりが無い場合は、大変お手数ですがその旨を
　以下の連絡先までご一報くださいますようお願いいたします。

　メール: ofcstaff@hyperion.co.jp
　電話: 048-451-3877';

        $objSendMail = new SC_SendMail_Ex();
        $from = $arrForm['email'];
        $tosubject = '【社員採用】応募情報が届きました。';
        $objSendMail->setItem('', $tosubject, $body, $from, $arrForm['name01'] . ' ' . $arrForm['name02']);
        $objSendMail->setTo($arrInfo['email01'], $arrInfo['shop_name']);
        $objSendMail->sendMail();

        $objSendMail1 = new SC_SendMail_Ex();
        $from = $arrInfo['email03'];
        $error = $arrInfo['email04'];
        $tosubject = '【正社員採用】ご応募ありがとうございました。';
        $objSendMail1->setItem('', $tosubject, $body, $from, $arrInfo['shop_name'], $from, $error, $error);
        $objSendMail1->setTo($arrForm['email'], $arrForm['name01'] . ' ' . $arrForm['name02'] . ' 様');
        $objSendMail1->sendMail();
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
