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

    var $arrPref = array();
    var $arrEMPSTATUS = array();

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();

        $this->httpCacheControl('nocache');

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
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
        $objDb = new SC_Helper_DB_Ex();
        $objFormParam = new SC_FormParam_Ex();

        $this->page = 'input';

        switch ($this->getMode()) {
            case 'confirm':
                // エラーチェック
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $objFormParam->toLower('email_add');
                $objFormParam->toLower('email_add_person');
                $this->arrErr = $this->lfCheckError($objFormParam);
                // 入力値の取得
                $this->arrForm = $objFormParam->getFormParamList();
                //$this->arrForm['recruitment_detail'] = str_split($this->arrForm['recruitment_detail']);
                if (SC_Utils_Ex::isBlank($this->arrErr))
                    $this->page = 'confirm';
                break;
            case 'return':
                $this->lfInitParam($objFormParam);
                $_POST['email_add_repeat'] = $_POST['email_add'];
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrForm = $objFormParam->getFormParamList();
                break;
            case 'complete':
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrForm = $objFormParam->getFormParamList();
                $this->registCorporate($this->arrForm);
                $this->lfSendMailToRecipient($this);
                $this->lfSendMailToSender($this);
                $this->arrForm = array();
                $this->page = 'complete';
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

    // }}}
    // {{{ protected functions

    /**
     * お問い合わせ入力時のパラメーター情報の初期化を行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {

        $objFormParam->addParam('企業名', 'corporate_name', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご担当者部署名', 'person_unit', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご担当者名1', 'charge_firstname', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご担当者名2', 'charge_lastname', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('カナ1', 'charge_firstname_kana', STEXT_LEN, 'KVCa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('カナ2', 'charge_lastname_kana', STEXT_LEN, 'KVCa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('郵便番号1', 'zip_code1', ZIP01_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip_code2', ZIP02_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('都道府県', 'pref', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('住所1', 'addr1', MTEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所2', 'addr2', MTEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご連絡先電話番号1', 'tel1', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご連絡先電話番号2', 'tel2', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご連絡先電話番号3', 'tel3', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ご連絡先FAX番号1', 'fax1', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('ご連絡先FAX番号2', 'fax2', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('ご連絡先FAX番号3', 'fax3', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('メールアドレス', 'email_add', null, 'KVa', array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('メールアドレス(確認)', 'email_add_repeat', null, 'KVa', array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('募集内容', 'recruitment_detail', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('その他、ご質問など', 'other_q', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('人数、スキルなど求人の要件', 'skill', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 入力内容のチェックを行なう.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return array 入力チェック結果の配列
     */
    function lfCheckError(&$objFormParam) {
        // 入力データを渡す。
        $arrForm = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrForm);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('メールアドレス', 'メールアドレス(確認)', 'email_add', 'email_add_repeat'), array('EQUAL_CHECK'));
        return $objErr->arrErr;
    }

    function registCorporate($arrForm) {
        $sqlval = array();
        foreach ($arrForm as $key => $array)
            $sqlval[$key] = $array['value'];
        if (count($sqlval['recruitment_detail']) > 0) {
            $newarr = '';
            foreach ($sqlval['recruitment_detail'] as $status)
                $newarr .= $status;
            $sqlval['recruitment_detail'] = $newarr;
        }
        $sqlval['create_date'] = 'Now()';
        $sqlval['del_flg'] = 0;
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();
        $objQuery->insert('dtb_corporate', $sqlval);
        $objQuery->commit();
    }

    /**
     * メールの送信を行う。
     *
     * @return void
     */
    function lfSendMailToRecipient(&$objPage) {
        $message = '
		  <style>table{width: 450px; border-collapse: collapse; border: 1px solid #E0E0E0;} table tr td, table tr th{border: 1px solid #E0E0E0; text-align: left; padding: 5px;} table tr th{background-color: #F0F0F0;}</style>
		  <table>
		    <tr>
		      <th width="150">企業名</th><td>' . $objPage->arrForm['corporate_name']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>ご担当者部署名</th><td>' . $objPage->arrForm['person_unit']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>ご担当者名</th><td>' . $objPage->arrForm['charge_firstname']['value'] . $objPage->arrForm['charge_lastname']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>カナ</th><td>' . $objPage->arrForm['charge_firstname_kana']['value'] . $objPage->arrForm['charge_lastname_kana']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>郵便番号</th><td>〒&nbsp;' . $objPage->arrForm['zip_code1']['value'] . '&nbsp;-&nbsp;' . $objPage->arrForm['zip_code2']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>ご住所</th><td>' . $this->arrPref[$objPage->arrForm['pref']['value']] . '<br>' . $objPage->arrForm['addr1']['value'] . '<br>' . $objPage->arrForm['addr2']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>ご連絡先電話番号</th><td>' . $objPage->arrForm['tel1']['value'] . '&nbsp;-&nbsp;' . $objPage->arrForm['tel2']['value'] . '&nbsp;-&nbsp;' . $objPage->arrForm['tel3']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>ご連絡先FAX番号</th><td>' . $objPage->arrForm['fax1']['value'] . '&nbsp;-&nbsp;' . $objPage->arrForm['fax2']['value'] . '&nbsp;-&nbsp;' . $objPage->arrForm['fax3']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>メールアドレス</th><td>' . $objPage->arrForm['email_add']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>募集内容</th><td>';
        foreach ($objPage->arrForm['recruitment_detail']['value'] as $value)
            $message .= $this->arrEMPSTATUS[$value] . ',  ';
        $message .= '</td>
		    </tr>
		    <tr>
		      <th>人数、スキルなど求人の要件</th><td>' . $objPage->arrForm['skill']['value'] . '</td>
		    </tr>
		    <tr>
		      <th>その他、ご質問など</th><td>' . $objPage->arrForm['other_q']['value'] . '</td>
		    </tr>
		  </table>
		';

        $CONF = SC_Helper_DB_Ex::sfGetBasisData();

        $to = $CONF['email02'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . '=?UTF-8?B?' . base64_encode($objPage->arrForm['charge_firstname']['value']) . '?=' . '<' . $objPage->arrForm['email_add']['value'] . '>' . "\r\n";
        $headers .= 'To: ' . '=?UTF-8?B?' . base64_encode($CONF['shop_name']) . '?=' . '<' . $to . '>' . "\r\n";

        $subject = 'houjin';
        mail('', '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
    }

    function lfSendMailToSender(&$objPage) {
        $masterData = new SC_DB_MasterData_Ex();
        $arrPref = $masterData->getMasterData("mtb_pref");
        $CONF = SC_Helper_DB_Ex::sfGetBasisData();

        $message = $objPage->arrForm['corporate_name']['value'] . '様<br><br>
'.$CONF["company_name"].'へのご登録有難うございます。早急に担当者から折り返し連絡させていただきます。<br>
＊このメールは当サイトへご登録していただいた方に自動返信しています。<br>
心当たりのない方は、お手数ですが破棄してください。<br><br><br>
署名欄<br><br>
<style>table{width: 450px; border: none;} table tr td, table tr th{text-align: left; padding: 3px;}</style>
<table>
	<tr>
		<th width="150">会社名</th><td>' . $CONF["company_name"] . '</td>
	</tr>
	<tr>
		<th>住所</th><td>' . $arrPref[$CONF["pref"]] . ' ' . $CONF["addr01"] . ' ' . $CONF["addr02"] . '</td>
	</tr>
	<tr>
		<th>電話番号</th><td>' . $CONF["tel01"] . '-' . $CONF["tel02"] . '-' . $CONF["tel03"] . '</td>
	</tr>
	<tr>
		<th>E-Mail</th><td>' . $CONF["email02"] . '</td>
	</tr>
</table>';


        $to = $objPage->arrForm['email_add']['value'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'From: ' . '=?UTF-8?B?' . base64_encode($CONF['shop_name']) . '?=' . '<' . $CONF['email02'] . '>' . "\r\n";
        $headers .= 'To: ' . '=?UTF-8?B?' . base64_encode($objPage->arrForm['charge_firstname']['value']) . '?=' . '<' . $to . '>' . "\r\n";

        $subject = 'お問い合わせ有難うございます。';
        mail('', '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
