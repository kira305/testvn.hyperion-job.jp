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
 * Admin_Customer_SearchCustomer のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Customer_CV.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Customer_CV extends LC_Page_Admin_Ex {

	var $filePath = '';

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/cv.tpl';
        $this->tpl_subtitle = '会員検索';
        $this->httpCacheControl('nocache');

		$masterData         = new SC_DB_MasterData_Ex();
        $this->arrPref      = $masterData->getMasterData('mtb_pref');
        $this->arrSex       = $masterData->getMasterData('mtb_sex');

        $objDate            = new SC_Date_Ex(BIRTH_YEAR, date('Y',strtotime('now')));
        $this->arrYear      = $objDate->getYear('', START_BIRTH_YEAR, '');
        $this->arrMonth     = $objDate->getMonth(true);
        $this->arrDay       = $objDate->getDay(true);
		$this->todayYear 	= date("Y");
		$this->todayMonth	= date("m");
		$this->todayDay		= date("d");
		$objDateC 			= new SC_Date_Ex(RELEASE_YEAR);
        $this->arrYearC 	= $objDateC->getYear('', date('Y'), '');
        $this->arrMonthC 	= $objDateC->getMonth(true);
        $this->arrDayC 		= $objDateC->getDay(true);

		$this->arrAge = array();
		for($i = 20; $i <= 60; $i++) $this->arrAge[$i] = $i;
		$this->arrFLAG = array(1=>'あり', 0=>'無し');
		$this->arrHOUR = array(1=>1,2=>2,3=>3);
		$this->arrMINUTE = array();
		for($i = 0; $i < 60; $i+=5){
			if($i < 10)
				$this->arrMINUTE[$i] = '0'.$i;
			else
				$this->arrMINUTE[$i] = $i;
		}
		$this->arrPEOPLECOUNT = array();
		for($i = 1; $i < 10; $i++) $this->arrPEOPLECOUNT[$i] = $i;

		$this->filePath = HTML_REALDIR . "upload/cv_file/";
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
		if(isset($_POST['customer_id']))
			$customer_id = $_POST['customer_id'];
		else
			$customer_id = $_GET['customer_id'];
		$objQuery =& SC_Query_Ex::getSingletonInstance();
		$cv_id = $objQuery->get('cv_id', 'dtb_cv', 'customer_id = ?', array($customer_id));

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_POST['mode'] = 'return';
        }

        $objFormParam = new SC_FormParam_Ex();
        $this->sfCustomerMypageParam($objFormParam);
        $objFormParam->setParam($_POST);    // POST値の取得

        switch ($this->getMode()) {
            case 'confirm':
                $this->arrErr = $this->sfCustomerMypageErrorCheck($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();

				if($_FILES["photo"]["error"] == UPLOAD_ERR_OK){
					$allowedExts = array("jpg", "jpeg", "gif", "png");
					$extension = end(explode(".", $_FILES["photo"]["name"]));
					if ((($_FILES["photo"]["type"] == "image/gif")
						|| ($_FILES["photo"]["type"] == "image/jpeg")
						|| ($_FILES["photo"]["type"] == "image/png")
						|| ($_FILES["photo"]["type"] == "image/pjpeg"))
						&& ($_FILES["photo"]["size"] < 20000)
						&& in_array($extension, $allowedExts))
				  	{
						$this->arrForm['photo'] = $_FILES["photo"]["name"];
						move_uploaded_file($_FILES["photo"]["tmp_name"], $this->filePath . $_FILES["photo"]["name"]);
					}
				}

                if (empty($this->arrErr)) {
                    $this->tpl_mainpage = 'customer/cv_confirm.tpl';
                }
                break;
			case 'delete_photo':
				if (is_numeric($cv_id))
                	$this->deleteFile($cv_id);
				$this->arrForm = $objFormParam->getHashArray();
				$this->arrForm['photo'] = '';
                break;
            case 'complete':
                $this->arrErr = $this->sfCustomerMypageErrorCheck($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
                if (empty($this->arrErr)) {
                    $this->lfRegistCustomerData($objFormParam, $cv_id);
                    //print ("<script>window.close();</script>");
					$this->tpl_onload = "window.close();";
                }
                break;
            case 'return':
                $this->arrForm = $objFormParam->getHashArray();
				$this->arrForm['photo'] = $_POST['photo'];
                break;
            default:
				if (is_numeric($cv_id))
					$this->arrForm = $this->sfGetCvData($cv_id);
				else
                	$this->arrForm = SC_Helper_Customer_Ex::sfGetCustomerData($customer_id);
                break;
        }

        $this->setTemplate($this->tpl_mainpage);

    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

	function deleteFile($cv_id) {
        $objQuery = $objQuery =& SC_Query_Ex::getSingletonInstance();
		$arrval = array('photo'=>'');
		$objQuery->update('dtb_cv', $arrval, 'cv_id = ?', array($cv_id));
    }

    function sfCustomerMypageParam(&$objFormParam) {
		$objFormParam->addParam('会員ID', 'customer_id', INT_LEN, 'n', array('NUM_CHECK'));
		$objFormParam->addParam('平成（年）', 'c_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('平成（月）', 'c_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('平成（日）', 'c_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('お名前(フリガナ・姓)', 'kana01', STEXT_LEN, 'CKV', array('NO_SPTAB', 'SPTAB_CHECK' ,'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お名前(フリガナ・名)', 'kana02', STEXT_LEN, 'CKV', array('NO_SPTAB', 'SPTAB_CHECK' ,'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お名前(姓)', 'name01', STEXT_LEN, 'aKV', array('NO_SPTAB', 'SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前(名)', 'name02', STEXT_LEN, 'aKV', array('NO_SPTAB', 'SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('年', 'year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('月', 'month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('日', 'day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
		$objFormParam->addParam('歳', 'age', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('性別', 'sex', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('写真', 'photo', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ふりがな', 'kana_addr01', STEXT_LEN, 'CKV', array('NO_SPTAB', 'SPTAB_CHECK' ,'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('郵便番号1', 'zip01', ZIP01_LEN, 'n', array('SPTAB_CHECK' ,'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'zip02', ZIP02_LEN, 'n', array('SPTAB_CHECK' ,'NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('都道府県', 'pref', INT_LEN, 'n', array('NUM_CHECK'));
        $objFormParam->addParam('住所1', 'addr01', MTEXT_LEN, 'aKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所2', 'addr02', MTEXT_LEN, 'aKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メールアドレス', 'email', null, 'a', array('NO_SPTAB', 'EMAIL_CHECK', 'SPTAB_CHECK' ,'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('自宅電話1', 'tel11', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('自宅電話2', 'tel12', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('自宅電話3', 'tel13', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('携帯電話1', 'tel01', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('携帯電話2', 'tel02', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('携帯電話3', 'tel03', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ふりがな', 'kana_addr02', STEXT_LEN, 'CKV', array('NO_SPTAB', 'SPTAB_CHECK' ,'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('連 絡 先', 'addr03', STEXT_LEN, 'aKV', array('SPTAB_CHECK' ,'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先電話1', 'tel21', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先電話2', 'tel22', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('連絡先電話3', 'tel23', TEL_ITEM_LEN, 'n', array('SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
		for($i = 1; $i <= 17; $i++){
			$objFormParam->addParam('学歴・職歴（年）'.$i, 'ec_y'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('学歴・職歴（月）'.$i, 'ec_m'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('学歴・職歴（所属）'.$i, 'ec'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
		}
		for($i = 1; $i <= 7; $i++){
			$objFormParam->addParam('免許・資格（年）'.$i, 'license_y'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('免許・資格（月）'.$i, 'license_m'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('免許・資格'.$i, 'license'.$i, STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
		}
        $objFormParam->addParam('志望動機・特技・好きな学科', 'mo_sk_fa', LLTEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('自己PR', 'prself', LLTEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('本人希望記入欄', 'p_hope', LLTEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('通勤時間（時間）', 'commuting_hour', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('通勤時間（分）', 'commuting_minute', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('扶養家族（配偶者を除く）', 'dependent', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('配偶者', 'spouse', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('配偶者の扶養義務', 'support_spouse', STEXT_LEN, 'aKV', array('SPTAB_CHECK' , 'MAX_LENGTH_CHECK'));
    }

	function sfGetCvData($cv_id) {
        $objQuery       =& SC_Query_Ex::getSingletonInstance();
        $ret        = $objQuery->select('*','dtb_cv','cv_id=?', array($cv_id));
        $arrForm    = $ret[0];
		if (isset($arrForm['c_date']))
            list($arrForm['c_year'], $arrForm['c_month'], $arrForm['c_day']) = explode('-',$arrForm['c_date']);
		if (isset($arrForm['birth']))
            list($arrForm['year'], $arrForm['month'], $arrForm['day']) = explode('-',$arrForm['birth']);
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
    function lfRegistCustomerData(&$objFormParam, $cv_id) {
		$arrRet             = $objFormParam->getHashArray();
        $sqlval             = $objFormParam->getDbArray();
		$sqlval['c_date']   = $arrRet['c_year'].'-'.$arrRet['c_month'].'-'.$arrRet['c_day'];
        $sqlval['birth']    = $arrRet['year'].'-'.$arrRet['month'].'-'.$arrRet['day'];

        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->begin();

		if (is_numeric($cv_id)) {
            $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->update('dtb_cv', $sqlval, 'cv_id = ? ', array($cv_id));
        } else {
            $sqlval['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert('dtb_cv', $sqlval);
        }

        $objQuery->commit();
        return $cv_id;
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
		$objErr->doFunc(array('生年月日', 'year', 'month', 'day'), array('CHECK_BIRTHDAY'));
		$objErr->doFunc(array('平�', 'c_year', 'c_month', 'c_day'), array('CHECK_DATE'));
        return $objErr->arrErr;
    }
}
