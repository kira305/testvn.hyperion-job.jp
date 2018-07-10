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
	$this->arrRelation = $masterData->getMasterData('mtb_family_relation');
	$this->arrIsLiveTogether = array(0 => '別居', 1 => '同居');
	$objDate = new SC_Date_Ex(BIRTH_YEAR);
	$this->arrYear = $objDate->getYear();
	$this->arrMonth = $objDate->getMonth();
	$this->arrDay = $objDate->getDay();
	$this->page = 'input';

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
	$this->title = 'マイナンバー登録';
	if ($_SESSION['is_family_member'] == 1)
	    $this->title = '扶養家族のマイナンバー登録';
	$this->tpl_title = '入力ページ';

	$objFormParam = new SC_FormParam_Ex();
	$this->initParam($objFormParam);
	$objFormParam->setParam($_POST);
	if ($_SESSION['parent_staff_id'] > 0 && $_POST['parent_name01'] == '') {
	    $objQuery = & SC_Query_Ex::getSingletonInstance();
	    $arrResults = $objQuery->select('name01, name02, mynumber', 'dtb_staff', 'staff_id = ?', array($_SESSION['parent_staff_id']));
	    $objFormParam->setParam(array(
		'parent_staff_id' => $_SESSION['parent_staff_id'],
		'parent_name01' => $arrResults[0]['name01'],
		'parent_name02' => $arrResults[0]['name02'],
		'parent_mynumber01' => substr($arrResults[0]['mynumber'], 0, 4),
		'parent_mynumber02' => substr($arrResults[0]['mynumber'], 4, 4),
		'parent_mynumber03' => substr($arrResults[0]['mynumber'], 8, 4)
	    ));
	}
	$arrForm = $objFormParam->getHashArray();

	// mobile用（戻るボタンでの遷移かどうかを判定）
	if (!empty($arrForm['return'])) {
	    $_POST['mode'] = 'return';
	}

	// アップロードファイル情報の初期化
	$objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, HTML_REALDIR . "upload/mynumber_image/");
	$this->lfInitFile($objUpFile);
	$objUpFile->setHiddenFileList($_POST);

	// ダウンロード販売ファイル情報の初期化
	$objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, HTML_REALDIR . "download/mynumber_image/");
	$this->lfInitDownFile($objDownFile);
	$objDownFile->setHiddenFileList($_POST);

	switch ($this->getMode()) {
	    case 'upload_image':
	    case 'delete_image':
		// パラメーター初期化
		$this->lfInitFormParam_UploadImage($objFormParam);
		$objFormParam->setParam($_POST);
		$arrForm = $objFormParam->getHashArray();

		switch ($this->getMode()) {
		    case 'upload_image':
			// ファイルを一時ディレクトリにアップロード
			$this->arrErr[$arrForm['image_key']] = $objUpFile->makeTempFile($arrForm['image_key'], IMAGE_RENAME);
			if ($this->arrErr[$arrForm['image_key']] == '') {
			    // 縮小画像作成
			    $this->lfMakeScaleImage($objUpFile, $arrForm['image_key'], $arrForm['image_key']);
			}
			break;
		    case 'delete_image':
			// ファイル削除
			$this->lfDeleteTempFile($objUpFile, $arrForm['image_key']);
			break;
		    default:
			break;
		}

		// 入力画面表示設定
		$this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
		// ページonload時のJavaScript設定
		$this->tpl_onload = $this->getAnchorHash('_' . $arrForm['image_key']);
		break;
	    case 'confirm':
		//-- 確認
		$this->arrErr = $this->errorCheck($objFormParam);
		$arrForm = $objFormParam->getHashArray();
		// 入力エラーなし
		if (empty($this->arrErr)) {
		    $this->arrForm = $this->lfSetViewParam_ConfirmPage($objUpFile, $objDownFile, $arrForm);
		    $this->page = 'confirm';
		    $this->tpl_title = '確認ページ';
		} else
		    $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
		break;
	    case 'complete':
		$arrForm = $objFormParam->getHashArray();
		$this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
		list($this->isParent, $this->parent_staff_id) = $this->sfEditStaffData($objFormParam, $objUpFile, $objDownFile);
		$this->page = 'complete';
		$this->tpl_title = '完了ページ';
		break;
	    case 'return':
		$arrForm = $objFormParam->getHashArray();
		$this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
		break;
	    default:
		$this->arrForm = $arrForm;
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

    function initParam(&$objFormParam) {
	$objFormParam->addParam('お名前(姓)', 'name01', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('お名前(名)', 'name02', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('お名前(フリガナ・姓)', 'kana01', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
	$objFormParam->addParam('お名前(フリガナ・名)', 'kana02', STEXT_LEN, 'CKV', array('EXIST_CHECK', 'NO_SPTAB', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
	$objFormParam->addParam('マイナンバー1', 'mynumber01', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('マイナンバー2', 'mynumber02', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('マイナンバー3', 'mynumber03', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	$objFormParam->addParam('添付画像①', 'save_mynumber_image', '', '', array());
	$objFormParam->addParam('添付画像①', 'temp_mynumber_image', '', '', array());
	$objFormParam->addParam('添付画像②', 'save_mynumber_image_back', '', '', array());
	$objFormParam->addParam('添付画像②', 'temp_mynumber_image_back', '', '', array());
	if ($_SESSION['is_family_member'] == 1) {
	    $objFormParam->addParam('parent_staff_id', 'parent_staff_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), $_SESSION['parent_staff_id']);
	    $objFormParam->addParam('parent_name01', 'parent_name01');
	    $objFormParam->addParam('parent_name02', 'parent_name02');
	    $objFormParam->addParam('同居区分', 'is_live_together', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1);
	    $objFormParam->addParam('あなたとの続柄', 'relation_id', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	    $objFormParam->addParam('年', 'year', 4, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
	    $objFormParam->addParam('月', 'month', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
	    $objFormParam->addParam('日', 'day', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
	    $objFormParam->addParam('マイナンバー1', 'parent_mynumber01', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	    $objFormParam->addParam('マイナンバー2', 'parent_mynumber02', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	    $objFormParam->addParam('マイナンバー3', 'parent_mynumber03', TEL_ITEM_LEN, 'n', array('EXIST_CHECK', 'SPTAB_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
	}
    }

    function errorCheck(&$objFormParam) {
	$objFormParam->convParam();

	$arrRequest = $objFormParam->getHashArray();
	$objErr = new SC_CheckError_Ex($arrRequest);
	$objErr->arrErr = $objFormParam->checkError();

	$objErr->doFunc(array('マイナンバー1', 'mynumber01', 4), array('NUM_COUNT_CHECK'));
	$objErr->doFunc(array('マイナンバー2', 'mynumber02', 4), array('NUM_COUNT_CHECK'));
	$objErr->doFunc(array('マイナンバー3', 'mynumber03', 4), array('NUM_COUNT_CHECK'));
	if ($objErr->arrErr['mynumber01'] == '' && $objErr->arrErr['mynumber02'] == '' && $objErr->arrErr['mynumber03'] == '') {
	    $objQuery = & SC_Query_Ex::getSingletonInstance();
	    $arrResults = $objQuery->select('mynumber', 'dtb_staff', 'del_flg = 0 AND mynumber = ?', array($arrRequest['mynumber01'] . $arrRequest['mynumber02'] . $arrRequest['mynumber03']));
	    if (count($arrResults) > 0)
		$objErr->arrErr['mynumber01'] .= '※ 番号はすでに登録されています。<br />';
	}
	if (strlen($arrRequest['save_mynumber_image']) == 0 && strlen($arrRequest['temp_mynumber_image']) == 0)
	    $objErr->arrErr['mynumber_image'] = '※ 添付画像①が入力されていません。<br />';
	if (($_SESSION['mynumber_card'] != 0 || $_SESSION['is_family_member'] != 1) && strlen($arrRequest['save_mynumber_image_back']) == 0 && strlen($arrRequest['temp_mynumber_image_back']) == 0)
	    $objErr->arrErr['mynumber_image_back'] = '※ 添付画像②が入力されていません。<br />';

	if ($_SESSION['is_family_member'] == 1) {
	    $objErr->doFunc(array('生年月日', 'year', 'month', 'day'), array('CHECK_BIRTHDAY'));
	    $objErr->doFunc(array('マイナンバー1', 'parent_mynumber01', 4), array('NUM_COUNT_CHECK'));
	    $objErr->doFunc(array('マイナンバー2', 'parent_mynumber02', 4), array('NUM_COUNT_CHECK'));
	    $objErr->doFunc(array('マイナンバー3', 'parent_mynumber03', 4), array('NUM_COUNT_CHECK'));
	    if ($objErr->arrErr['parent_mynumber01'] == '' && $objErr->arrErr['parent_mynumber02'] == '' && $objErr->arrErr['parent_mynumber03'] == '') {
		$objQuery = & SC_Query_Ex::getSingletonInstance();
		$arrResults = $objQuery->select('staff_id, name01, name02', 'dtb_staff', 'parent_staff_id = 0 AND del_flg = 0 AND mynumber = ?', array($arrRequest['parent_mynumber01'] . $arrRequest['parent_mynumber02'] . $arrRequest['parent_mynumber03']));
		if (count($arrResults) != 1)
		    $objErr->arrErr['parent_mynumber01'] .= '※ 番号は登録されていません。<br />';
		else
		    $objFormParam->setParam(array('parent_staff_id' => $arrResults[0]['staff_id'], 'parent_name01' => $arrResults[0]['name01'], 'parent_name02' => $arrResults[0]['name02']));
	    }
	}

	return $objErr->arrErr;
    }

    function sfEditStaffData(&$objFormParam, &$objUpFile, &$objDownFile) {
	$objQuery = & SC_Query_Ex::getSingletonInstance();
	$objQuery->begin();

	$arrRet = $objFormParam->getHashArray();
	$array = $objFormParam->getDbArray();

	$array['mynumber'] = $array['mynumber01'] . $array['mynumber02'] . $array['mynumber03'];
	unset($array['mynumber01']);
	unset($array['mynumber02']);
	unset($array['mynumber03']);
	$array['update_date'] = 'CURRENT_TIMESTAMP';
	$arrFile = $objUpFile->getDBFileList();
	$array = array_merge($array, $arrFile);
	$objDownFile->deleteDBDownFile($arrRet);
	unset($array['save_mynumber_image']);
	unset($array['temp_mynumber_image']);
	unset($array['save_mynumber_image_back']);
	unset($array['temp_mynumber_image_back']);
	if ($_SESSION['is_family_member'] == 1) {
	    $array['parent_mynumber'] = $array['parent_mynumber01'] . $array['parent_mynumber02'] . $array['parent_mynumber03'];
	    unset($array['parent_mynumber01']);
	    unset($array['parent_mynumber02']);
	    unset($array['parent_mynumber03']);
	    $array['birth'] = $arrRet['year'] . '-' . $arrRet['month'] . '-' . $arrRet['day'];
	}

	$staff_id = $objQuery->max('staff_id', 'dtb_staff');
	if ($staff_id == 0 || $staff_id == '')
	    $staff_id = 1;
	$staff_id++;
	$array['staff_id'] = $staff_id;
	$array['is_haken'] = 1;
	$array['create_date'] = 'CURRENT_TIMESTAMP';
	$objQuery->insert('dtb_staff', $array);
	$objQuery->commit();
	$this->lfSaveUploadFiles($objUpFile, $objDownFile);
	if (isset($array['parent_staff_id']) && $array['parent_staff_id'] > 0)
	    return array(1, $array['parent_staff_id']);
	return array(0, $array['staff_id']);
    }

    /**
     * パラメーター情報の初期化
     * - 画像ファイルアップロードモード
     *
     * @param object $objFormParam SC_FormParamインスタンス
     * @return void
     */
    function lfInitFormParam_UploadImage(&$objFormParam) {
	$objFormParam->addParam('image_key', 'image_key', '', '', array());
    }

    /**
     * アップロードファイルパラメーター情報の初期化
     * - 画像ファイル用
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @return void
     */
    function lfInitFile(&$objUpFile) {
	$objUpFile->addFile('添付画像①', 'mynumber_image', array(), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
	$objUpFile->addFile('添付画像②', 'mynumber_image_back', array(), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
    }

    /**
     * アップロードファイルパラメーター情報の初期化
     * - ダウンロード商品ファイル用
     *
     * @param object $objDownFile SC_UploadFileインスタンス
     * @return void
     */
    function lfInitDownFile(&$objDownFile) {
	$objDownFile->addFile('ダウンロード販売用ファイル', 'down_file', explode(',', DOWNLOAD_EXTENSION), DOWN_SIZE, true, 0, 0);
    }

    /**
     * 表示用フォームパラメーター取得
     * - 入力画面
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @param object $objDownFile SC_UploadFileインスタンス
     * @param array $arrForm フォーム入力パラメーター配列
     * @return array 表示用フォームパラメーター配列
     */
    function lfSetViewParam_InputPage(&$objUpFile, &$objDownFile, &$arrForm) {
	// アップロードファイル情報取得(Hidden用)
	$arrHidden = $objUpFile->getHiddenFileList();
	$arrForm['arrHidden'] = array_merge((array) $arrHidden, (array) $objDownFile->getHiddenFileList());
	// 画像ファイル表示用データ取得
	$arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, ROOT_URLPATH . "upload/mynumber_image/");
	// ダウンロード商品実ファイル名取得
	$arrForm['down_realfilename'] = $objDownFile->getFormDownFile();
	return $arrForm;
    }

    /**
     * 表示用フォームパラメーター取得
     * - 確認画面
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @param object $objDownFile SC_UploadFileインスタンス
     * @param array $arrForm フォーム入力パラメーター配列
     * @return array 表示用フォームパラメーター配列
     */
    function lfSetViewParam_ConfirmPage(&$objUpFile, &$objDownFile, &$arrForm) {
	// 画像ファイル用データ取得
	$arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, ROOT_URLPATH . "upload/mynumber_image/");
	// ダウンロード商品実ファイル名取得
	$arrForm['down_realfilename'] = $objDownFile->getFormDownFile();

	return $arrForm;
    }

    /**
     * 縮小画像生成
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @param string $from_key 元画像ファイルキー
     * @param string $to_key 縮小画像ファイルキー
     * @param boolean $forced
     * @return void
     */
    function lfMakeScaleImage(&$objUpFile, $from_key, $to_key, $forced = false) {
	$arrImageKey = array_flip($objUpFile->keyname);
	$from_path = '';

	if ($objUpFile->temp_file[$arrImageKey[$from_key]]) {
	    $from_path = $objUpFile->temp_dir . $objUpFile->temp_file[$arrImageKey[$from_key]];
	} elseif ($objUpFile->save_file[$arrImageKey[$from_key]]) {
	    $from_path = $objUpFile->save_dir . $objUpFile->save_file[$arrImageKey[$from_key]];
	}

	if (file_exists($from_path)) {
	    // 生成先の画像サイズを取得
	    $to_w = $objUpFile->width[$arrImageKey[$to_key]];
	    $to_h = $objUpFile->height[$arrImageKey[$to_key]];

	    if ($forced) {
		$objUpFile->save_file[$arrImageKey[$to_key]] = '';
	    }

	    if (empty($objUpFile->temp_file[$arrImageKey[$to_key]]) && empty($objUpFile->save_file[$arrImageKey[$to_key]])
	    ) {
		// リネームする際は、自動生成される画像名に一意となるように、Suffixを付ける
		$dst_file = $objUpFile->lfGetTmpImageName(IMAGE_RENAME, '', $objUpFile->temp_file[$arrImageKey[$from_key]]);
		$path = $objUpFile->makeThumb($from_path, $to_w, $to_h, $dst_file);
		$objUpFile->temp_file[$arrImageKey[$to_key]] = basename($path);
	    }
	}
    }

    /**
     * アップロードファイルパラメーター情報から削除
     * 一時ディレクトリに保存されている実ファイルも削除する
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @param string $image_key 画像ファイルキー
     * @return void
     */
    function lfDeleteTempFile(&$objUpFile, $image_key) {
	// TODO: SC_UploadFile::deleteFileの画像削除条件見直し要
	$arrTempFile = $objUpFile->temp_file;
	$arrKeyName = $objUpFile->keyname;

	foreach ($arrKeyName as $key => $keyname) {
	    if ($keyname != $image_key)
		continue;

	    if (!empty($arrTempFile[$key])) {
		$temp_file = $arrTempFile[$key];
		$arrTempFile[$key] = '';

		if (!in_array($temp_file, $arrTempFile)) {
		    $objUpFile->deleteFile($image_key);
		} else {
		    $objUpFile->temp_file[$key] = '';
		    $objUpFile->save_file[$key] = '';
		}
	    } else {
		$objUpFile->temp_file[$key] = '';
		$objUpFile->save_file[$key] = '';
	    }
	}
    }

    /**
     * アップロードファイルを保存する
     *
     * @param object $objUpFile SC_UploadFileインスタンス
     * @param object $objDownFile SC_UploadFileインスタンス
     * @param integer $product_id 商品ID
     * @return void
     */
    function lfSaveUploadFiles(&$objUpFile, &$objDownFile) {
	// TODO: SC_UploadFile::moveTempFileの画像削除条件見直し要
	$objImage = new SC_Image_Ex($objUpFile->temp_dir);
	$arrTempFile = $objUpFile->temp_file;
	foreach ($arrTempFile as $temp_file) {
	    if ($temp_file)
		$objImage->moveTempImage($temp_file, $objUpFile->save_dir);
	}
	$objDownFile->moveTempDownFile();
    }

    /**
     * アンカーハッシュ文字列を取得する
     * アンカーキーをサニタイジングする
     *
     * @param string $anchor_key フォーム入力パラメーターで受け取ったアンカーキー
     * @return <type>
     */
    function getAnchorHash($anchor_key) {
	if ($anchor_key != '') {
	    return "location.hash='#" . htmlspecialchars($anchor_key) . "'";
	} else {
	    return '';
	}
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
