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
 * 社員管理 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Staff.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Staff extends LC_Page_Admin_Ex {

    // }}}
    // {{{ functions

    var $arrAffiliation;
    var $arrRelation;
    var $arrIsLiveTogether;
    var $arrIsFamilyMember;
    var $arrHakenStaffType;

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
	parent::init();
	$searchIsHaken = $_REQUEST['search_is_haken'];
	if ($_SESSION['authority'] == 5)
	    $searchIsHaken = 1;

	$this->tpl_mainpage = 'staff/index.tpl';
	$this->tpl_mainno = 'staff';
	$this->tpl_maintitle = 'マイナンバー管理';
	if ($searchIsHaken == 0) {
	    $this->tpl_subno = 'index';
	    $this->tpl_subtitle = 'HYP従業員マスタ';
	} else {
	    $this->tpl_subno = 'haken';
	    $this->tpl_subtitle = '派遣スタッフマスタ';
	}
	$this->tpl_pager = 'pager.tpl';

	$masterData = new SC_DB_MasterData_Ex();
	$this->arrPageMax = $masterData->getMasterData('mtb_page_max');
	$this->arrAffiliation = $masterData->getMasterData('mtb_affiliation');
	$this->arrRelation = $masterData->getMasterData('mtb_family_relation');
	$this->arrIsLiveTogether = array(0 => '別居', 1 => '同居');
	$this->arrIsFamilyMember = array(0 => '従業員', 1 => '扶養家族');
	if ($searchIsHaken != 0)
	    $this->arrIsFamilyMember[0] = 'スタッフ';
	$this->arrHakenStaffType = array(1 => '朝霞', 2 => '名古屋');

	$objDate = new SC_Date_Ex(RELEASE_YEAR);
	$objDate->setEndYear(DATE('Y'));
	$this->arrYear = $objDate->getYear('', true, '');
	$this->arrMonth = $objDate->getMonth();
	$this->arrDay = $objDate->getDay();

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
	// パラメーター設定
	$this->lfInitParam($objFormParam);
	if (count($_POST) == 0) {
	    if ($_SESSION['authority'] == 5)
		$_GET['search_is_haken'] = 1;
	    $objFormParam->setParam($_GET);
	} else
	    $objFormParam->setParam($_POST);
	$objFormParam->convParam();
	// パラメーター読み込み
	$this->arrForm = $objFormParam->getFormParamList();
	// 検索ワードの引き継ぎ
	$this->arrHidden = $objFormParam->getSearchArray();

	// 入力パラメーターチェック
	$this->arrErr = $this->lfCheckError($objFormParam);
	if (!SC_Utils_Ex::isBlank($this->arrErr)) {
	    return;
	}

	if ($_POST['mode'] == 'save_note') {
	    $objQuery = & SC_Query_Ex::getSingletonInstance();
	    $arrStaffId = array();
	    foreach ($_POST['list_memo'] as $staff_id => $note) {
		$sqlval['note'] = $note;
		$objQuery->update('dtb_staff', $sqlval, 'staff_id = ?', array($staff_id));
		$arrStaffId[] = $staff_id;
	    }
	    $this->log('save', $arrStaffId);
	}

	// モードによる処理切り替え
	switch ($this->getMode()) {
	    case 'deleteAll':
		$this->is_delete = $this->lfDoDeleteStaff('staff_id IN (' . SC_Utils_Ex::sfGetCommaList($_POST['delete_staff_id']) . ')', array());
		list($this->tpl_linemax, $this->arrData, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
		$this->arrPagenavi = $this->objNavi->arrPagenavi;
		$this->log('delete', $_POST['delete_staff_id']);
		break;
	    case 'delete':
		$this->is_delete = $this->lfDoDeleteStaff('staff_id = ?', array($objFormParam->getValue('edit_staff_id')));
		list($this->tpl_linemax, $this->arrData, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
		$this->arrPagenavi = $this->objNavi->arrPagenavi;
		$this->log('delete', array($objFormParam->getValue('edit_staff_id')));
		break;
	    case 'save_note':
	    case 'search':
		list($this->tpl_linemax, $this->arrData, $this->objNavi) = $this->lfDoSearch($objFormParam->getHashArray());
		$this->arrPagenavi = $this->objNavi->arrPagenavi;
		if ($this->getMode() == 'search')
		    $this->log('search', $objFormParam->getHashArray());
		break;
	    case 'view':
		$this->tpl_mainpage = 'staff/view.tpl';
		$objQuery = & SC_Query_Ex::getSingletonInstance();
		$arrStaff = $objQuery->select('*', 'dtb_staff', 'staff_id = ?', array($this->arrForm['edit_staff_id']['value']));
		$this->arrStaff = $this->lfSetViewParam_InputPage($arrStaff[0]);
		$this->log('view', $arrStaff[0]);
		break;
	    case 'csv':
		$this->log('csv', $objFormParam->getHashArray());
		$this->lfDoCSV($objFormParam->getHashArray());
		SC_Response_Ex::actionExit();
		break;
	    default:
		break;
	}
    }

    function log($event, $arr) {
	switch ($event) {
	    case 'search':
	    case 'csv':
		foreach ($arr as $key => $value) {
		    if ($value == '' || $key == 'search_pageno' || $key == 'search_page_max')
			unset($arr[$key]);
		}
		break;
	    case 'save':
	    case 'delete':
		$objQuery = & SC_Query_Ex::getSingletonInstance();
		$arr = $objQuery->select('*', 'dtb_staff', 'staff_id IN (' . SC_Utils_Ex::sfGetCommaList($arr) . ')');
	    default:
		break;
	}
	foreach ($arr as $key => $value) {
	    if (is_array($value))
		$arr[$key] = $this->setValueById($value);
	    else {
		$arr = $this->setValueById($arr);
		break;
	    }
	}
	GC_Utils_Ex::gfMynumberLog($event, preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($arr)));
    }

    function setValueById($arr) {
	foreach ($arr as $key => $value) {
	    if (strpos($key, 'affiliation') !== FALSE)
		$arr[$key] = $this->setValuesByArr($value, $this->arrAffiliation);
	    else if (strpos($key, 'relation_id') !== FALSE)
		$arr[$key] = $this->setValuesByArr($value, $this->arrRelation);
	    else if (strpos($key, 'is_live_together') !== FALSE)
		$arr[$key] = $this->setValuesByArr($value, $this->arrIsLiveTogether);
	    else if (strpos($key, 'is_family_member') !== FALSE) {
		if (isset($arr['is_haken']) && $arr['is_haken'] != 0 || isset($arr['search_is_haken']) && $arr['search_is_haken'] != 0)
		    $this->arrIsFamilyMember[0] = 'スタッフ';
		$arr[$key] = $this->setValuesByArr($value, $this->arrIsFamilyMember);
	    }
	    else if (strpos($key, 'is_haken') !== FALSE)
		$arr[$key] = ($value == 0) ? 'HYP従業員' : '派遣スタッフ';
	    else if (strpos($key, 'haken_type') !== FALSE)
		$arr[$key] = $this->setValuesByArr($value, $this->arrHakenStaffType);
	}
	return $arr;
    }

    function setValuesByArr($ids, $arrValueById) {
	$tempText = '';
	if (is_array($ids)) {
	    foreach ($ids as $id)
		$tempText .= $arrValueById[$id] . ',';
	    $tempText = substr($tempText, 0, -1);
	} else
	    $tempText = $arrValueById[$ids];
	return $tempText;
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
     * パラメーター情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
	$objFormParam->addParam('部門/所属', 'search_affiliation', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('続柄', 'search_is_family_member', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('扶養主名前', 'search_parent_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('お名前', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('お名前(フリガナ)', 'search_kana', STEXT_LEN, 'CKV', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANABLANK_CHECK'));
	$objFormParam->addParam('編集対象社員ID', 'edit_staff_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('isHaken', 'search_is_haken');
	$objFormParam->addParam('hakenType', 'search_haken_type', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('開始年', 'search_screateyear', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('開始月', 'search_screatemonth', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('開始日', 'search_screateday', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('終了年', 'search_ecreateyear', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('終了月', 'search_ecreatemonth', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('終了日', 'search_ecreateday', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
	$objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
	$objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
    }

    function lfCheckError(&$objFormParam) {
	$objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
	$objErr->arrErr = $objFormParam->checkError();

	$objErr->doFunc(array('開始', 'search_screateyear', 'search_screatemonth', 'search_screateday'), array('CHECK_DATE'));
	$objErr->doFunc(array('終了', 'search_ecreateyear', 'search_ecreatemonth', 'search_ecreateday'), array('CHECK_DATE'));
	$objErr->doFunc(array('開始', '終了', 'search_screateyear', 'search_screatemonth', 'search_screateday', 'search_ecreateyear', 'search_ecreatemonth', 'search_ecreateday'), array('CHECK_SET_TERM'));

	return $objErr->arrErr;
    }

    /**
     * 社員を削除する処理
     *
     * @param integer $staff_id 社員ID
     * @return boolean true:成功 false:失敗
     */
    function lfDoDeleteStaff($where, $arrParam = array()) {
	$objQuery = & SC_Query_Ex::getSingletonInstance();
	$sqlval['del_flg'] = 1;
	$objQuery->update('dtb_staff', $sqlval, $where, $arrParam);
	return true;
    }

    /**
     * 社員一覧を検索する処理
     *
     * @param array $arrParam 検索パラメーター連想配列
     * @return array( integer 全体件数, mixed 社員データ一覧配列, mixed SC_PageNaviオブジェクト)
     */
    function lfDoSearch($arrParam) {
	$objQuery = & SC_Query_Ex::getSingletonInstance();
	$objSelect = new SC_StaffList_Ex($arrParam, 'edit');
	$page_max = SC_Utils_Ex::sfGetSearchPageMax($arrParam['search_page_max']);
	$disp_pageno = $arrParam['search_pageno'];
	if ($disp_pageno == 0) {
	    $disp_pageno = 1;
	}
	$offset = intval($page_max) * (intval($disp_pageno) - 1);
	$objQuery->setLimitOffset($page_max, $offset);
	$arrData = $objQuery->getAll($objSelect->getList(), $objSelect->arrVal);

	// 該当全体件数の取得
	$objQuery = & SC_Query_Ex::getSingletonInstance();
	$linemax = $objQuery->getOne($objSelect->getListCount(), $objSelect->arrVal);

	// ページ送りの取得
	$objNavi = new SC_PageNavi_Ex($arrParam['search_pageno'], $linemax, $page_max, 'fnNaviSearchOnlyPage', NAVI_PMAX);
	return array($linemax, $arrData, $objNavi);
    }

    /**
     * 社員一覧CSVを検索してダウンロードする処理
     *
     * @param array $arrParam 検索パラメーター連想配列
     * @return boolean true:成功 false:失敗
     */
    function lfDoCSV($arrParam) {
	$objSelect = new SC_StaffList_Ex($arrParam, 'edit');
	$order = 'update_date DESC, staff_id DESC';

	$objCSV = new SC_Helper_CSV_Ex();
	list($where, $arrVal) = $objSelect->getWhere();
	return $objCSV->sfDownloadCsv('8', $where, $arrVal, $order, true);
    }

    function lfSetViewParam_InputPage(&$arrForm) {
	$objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, HTML_REALDIR . "upload/mynumber_image/");
	$objUpFile->addFile('マイナンバー登録（画像 1）', 'mynumber_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
	$objUpFile->addFile('マイナンバー登録（画像 2）', 'mynumber_image_back', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
	$objUpFile->setHiddenFileList($arrForm);
	$objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, HTML_REALDIR . "download/mynumber_image/");
	$objDownFile->addFile('ダウンロード販売用ファイル', 'down_file', explode(',', DOWNLOAD_EXTENSION), DOWN_SIZE, true, 0, 0);
	$objDownFile->setHiddenFileList($arrForm);
	$objUpFile->setDBFileList($arrForm);
	$objDownFile->setDBDownFile($arrForm);
	$arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, ROOT_URLPATH . "upload/mynumber_image/");
	return $arrForm;
    }

}
