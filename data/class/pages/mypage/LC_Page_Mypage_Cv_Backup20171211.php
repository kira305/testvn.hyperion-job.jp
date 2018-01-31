<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) 2000-2014 LOCKON CO.,LTD. All Rights Reserved.
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

require_once CLASS_EX_REALDIR . 'page_extends/mypage/LC_Page_AbstractMypage_Ex.php';

/**
 * 登録内容変更 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Mypage_Cv extends LC_Page_AbstractMypage_Ex {

    /**
     * Page を初期化する.
     *
     * @return void
     */
    public function init() {
        parent::init();
        $this->tpl_subtitle = '履歴書内容編集(入力ページ)';
        $this->tpl_mypageno = 'cv';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrSex = $masterData->getMasterData('mtb_sex');
        $this->arrMaritalStatus = $masterData->getMasterData('mtb_marital_status');
        $this->arrTarget = $masterData->getMasterData('mtb_object');
        $this->arrEducation = $masterData->getMasterData('mtb_education');
        $this->arrPosition = $masterData->getMasterData('mtb_position');
        $this->arrRegion = $masterData->getMasterData('mtb_region');
        $this->arrJLPT = $masterData->getMasterData('mtb_jlpt');
        $this->arrWorkExperience = array(1 => '経験あり', 0 => '未経験');

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $arrPref = $objQuery->select('*', 'mtb_pref');
        $this->arrPrefByTarget = array();
        foreach ($arrPref as $pref)
            $this->arrPrefByTarget[$pref['object_id']][$pref['id']] = $pref['name_vn'];

        $this->arrCategory = $masterData->getMasterData('mtb_category');
        $arrCategory = $objQuery->select('*', 'mtb_category');
        $this->arrCategoryByTarget = array();
        foreach ($arrCategory as $category){
            if($category['object_id'] != '' && $category['object_id'] > 0)
                $this->arrCategoryByTarget[$category['object_id']][$category['id']] = $category['name_vn'];
            else{
                $this->arrCategoryByTarget[1][$category['id']] = $category['name_vn'];
                $this->arrCategoryByTarget[2][$category['id']] = $category['name_vn'];
            }
        }

        // 日付プルダウン設定
        $objDate = new SC_Date_Ex(BIRTH_YEAR);
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();

        $objDate = new SC_Date_Ex(RELEASE_YEAR, DATE('Y'));
        $this->arrReleaseYear = $objDate->getYear();

        $this->httpCacheControl('nocache');
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    public function process() {
        parent::process();
    }

    /**
     * Page のプロセス
     * @return void
     */
    public function action() {
        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');
        $this->customer_data = SC_Helper_Customer_Ex::sfGetCustomerData($customer_id);

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_REQUEST['mode'] = 'return';
        }

        // パラメーター管理クラス,パラメーター情報の初期化
        $objFormParam = new SC_FormParam_Ex();
        SC_Helper_Customer_Ex::sfCustomerMypageParam($objFormParam);
        SC_Helper_Customer_Ex::sfCustomerCvParam($objFormParam);
        $objFormParam->setParam($_POST);    // POST値の取得
        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $objUpFile->addFile('写真', 'image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
        $objUpFile->setHiddenFileList($_POST);

        // ダウンロード販売ファイル情報の初期化
        $objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, DOWN_SAVE_REALDIR);
        $objDownFile->addFile('履歴書ファイル', 'down_file', explode(',', DOWNLOAD_EXTENSION), DOWN_SIZE, true, 0, 0);
        $objDownFile->setHiddenFileList($_POST);

        switch ($this->getMode()) {
            case 'cv_confirm':
                $this->arrErr = $objDownFile->checkExists();

                // 入力エラーなし
                if (empty($this->arrErr)) {
                    $this->tpl_mainpage = 'mypage/cv_confirm.tpl';
                    $this->content = 'file';
                    $this->tpl_subtitle = '履歴書ファイルアップロード(確認ページ)';
                }
                break;
            // 確認
            case 'confirm':
                $this->arrErr = SC_Helper_Customer_Ex::sfCustomerMypageErrorCheck($objFormParam);
                $this->arrErr = array_merge((array) $this->arrErr, (array) $objUpFile->checkExists());
                unset($this->arrErr['password']);

                // 入力エラーなし
                if (empty($this->arrErr)) {
                    $this->tpl_mainpage = 'mypage/cv_confirm.tpl';
                    $this->content = 'info';
                    $this->tpl_subtitle = '履歴書内容編集(確認ページ)';
                }
                break;
            // 会員登録と完了画面
            case 'complete':
                $this->arrErr = SC_Helper_Customer_Ex::sfCustomerMypageErrorCheck($objFormParam);
                $this->arrErr = array_merge((array) $this->arrErr, (array) $objUpFile->checkExists());
                unset($this->arrErr['password']);

                // 入力エラーなし
                if (empty($this->arrErr)) {
                    // 会員情報の登録
                    $this->lfRegistCustomerData($objFormParam, $customer_id, $objUpFile);

                    //セッション情報を最新の状態に更新する
                    $objCustomer->updateSession();

                    // 完了ページに移動させる。
                    SC_Response_Ex::sendRedirect('cv_complete.php');
                }
                break;
            // 会員登録と完了画面
            case 'cv_complete':
                $this->arrErr = $objDownFile->checkExists();

                // 入力エラーなし
                if (empty($this->arrErr)) {
                    // 会員情報の登録
                    $val = $objFormParam->getDbArray();
                    $sqlval['cv'] = $val['cv'];
                    $sqlval['cv_name'] = $val['cv_name'];
                    SC_Helper_Customer_Ex::sfEditCustomerData($sqlval, $customer_id);
                    $objDownFile->moveTempDownFile();

                    //セッション情報を最新の状態に更新する
                    $objCustomer->updateSession();

                    // 完了ページに移動させる。
                    SC_Response_Ex::sendRedirect('cv_complete.php');
                }
                break;
            // 確認ページからの戻り
            case 'return':
                // quiet.
                break;
            // 画像のアップロード
            case 'upload_image':
            case 'delete_image':
                switch ($this->getMode()) {
                    case 'upload_image':
                        $this->arrErr['image'] = $objUpFile->makeTempFile('image', IMAGE_RENAME);
                        break;
                    case 'delete_image':
                        $this->lfDeleteTempFile($objUpFile, 'image');
                        break;
                    default:
                        break;
                }
                break;
            case 'upload_down':
            case 'delete_down':
                switch ($this->getMode()) {
                    case 'upload_down':
                        // ファイルを一時ディレクトリにアップロード
                        $this->arrErr['down_file'] = $objDownFile->makeTempDownFile();
                        $objFormParam->setParam(array('cv_name' => $_FILES['down_file']['name']));
                        break;
                    case 'delete_down':
                        // ファイル削除
                        $objDownFile->deleteFile('down_file');
                        $objFormParam->setParam(array('cv' => ''));
                        break;
                    default:
                        break;
                }
                break;
            case 'edit':
                $objFormParam->setParam($this->customer_data);
                break;
            case 'pdf':
                require_once CLASS_EX_REALDIR . 'SC_Fpdf_CV_Ex.php';
                $objFpdf = new SC_Fpdf_CV_Ex();
                $objFpdf->setData();
                $objFpdf->createPdf();
                break;
            default:
                if ($this->customer_data['cv'] != '' || $this->customer_data['current_address'] != '') {
                    $this->tpl_subtitle = '履歴書';
                }
                $this->arrForm = $this->customer_data;
                break;
        }
        if ($this->getMode() != '')
            $this->arrForm = $objFormParam->getHashArray();

        $this->setUploadFile($objUpFile, $objDownFile, $this->arrForm);
    }

    /**
     *  会員情報を登録する
     *
     * @param SC_FormParam $objFormParam
     * @param mixed $customer_id
     * @access private
     * @return void
     */
    public function lfRegistCustomerData(&$objFormParam, $customer_id, $objUpFile) {
        $sqlval = $objFormParam->getDbArray();
        unset($sqlval['cv']);
        unset($sqlval['cv_name']);

        $sqlval['desired_work'] = implode(" ", $sqlval['desired_work']);
        $sqlval['desired_position'] = implode(" ", $sqlval['desired_position']);
        $sqlval['desired_region'] = implode(" ", $sqlval['desired_region']);

        $arrRet = $objUpFile->getDBFileList();
        $sqlval = array_merge($sqlval, $arrRet);
        $this->lfSaveUploadFiles($objUpFile);

        SC_Helper_Customer_Ex::sfEditCustomerData($sqlval, $customer_id);
    }

    public function lfSaveUploadFiles(&$objUpFile) {
        // TODO: SC_UploadFile::moveTempFileの画像削除条件見直し要
        $objImage = new SC_Image_Ex($objUpFile->temp_dir);
        $arrTempFile = $objUpFile->temp_file;
        foreach ($arrTempFile as $temp_file) {
            if ($temp_file) {
                $objImage->moveTempImage($temp_file, $objUpFile->save_dir);
            }
        }
    }

    public function setUploadFile(&$objUpFile, &$objDownFile, &$arrForm) {
        $objUpFile->setDBFileList($arrForm);
        $objDownFile->setDBDownFile($arrForm);
        $arrHidden = $objUpFile->getHiddenFileList();
        $arrForm['arrHidden'] = array_merge((array) $arrHidden, (array) $objDownFile->getHiddenFileList());
        $arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, IMAGE_SAVE_URLPATH);
        $arrForm['cv'] = $objDownFile->getFormDownFile();
    }

    public function lfDeleteTempFile(&$objUpFile, $image_key) {
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

}
