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
 * 会員情報修正 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Customer_Edit.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Prepayment_Edit extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'prepayment/edit.tpl';
        $this->tpl_mainno = 'prepayment';
        $this->tpl_subno = 'edit';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '勤怠管理';
        $this->tpl_subtitle = '勤怠登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrStatus = $masterData->getMasterData('mtb_prepayment_status');

        $objDate = new SC_Date_Ex();
        $objDate->setStartYear(RELEASE_YEAR);
        $objDate->setEndYear(DATE('Y'));
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();
        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');
        $this->arrBREAKTIME = array('' => '', '00' => '00', '01' => '01', '02' => '02');
        
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrCustomer = $objQuery->select('customer_id,staff_id,name01,name02,kana01,kana02', 'dtb_customer', 'del_flg = 0');
        foreach ($arrCustomer as $customer) {
            $this->arrCustomerNameById[$customer['customer_id']] = $customer['name01'] . $customer['name02'];
            $this->arrCustomerInfoById[$customer['customer_id']] = $customer;
        }
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
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();
        // 検索引き継ぎ用パラメーター管理クラス
        $objFormSearchParam = new SC_FormParam_Ex();

        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $this->lfInitFile($objUpFile);
        $objUpFile->setHiddenFileList($_POST);

        // ダウンロード販売ファイル情報の初期化
        $objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, DOWN_SAVE_REALDIR);
        $this->lfInitDownFile($objDownFile);
        $objDownFile->setHiddenFileList($_POST);

        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'upload_image':
            case 'delete_image':
                $this->lfInitFormParam_UploadImage($objFormParam);
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $arrForm = $objFormParam->getHashArray();

                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();

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
                break;
            case 'edit_search':
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($_REQUEST);
                $this->arrErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr)) {
                    return;
                }
                $arrForm = $objQuery->select('*', 'dtb_prepayment_apply', 'id = ?', array($objFormSearchParam->getValue('edit_id')));
                $arrForm = $arrForm[0];
                list($arrForm['year'], $arrForm['month'], $arrForm['day']) = explode('-', $arrForm['working_date']);
                list($arrForm['working_start_hour'], $arrForm['working_start_minute']) = explode(':', $arrForm['working_start']);
                list($arrForm['working_over_hour'], $arrForm['working_over_minute']) = explode(':', $arrForm['working_over']);
                list($arrForm['breaktime_hour'], $arrForm['breaktime_minute']) = explode(':', $arrForm['breaktime']);
                $objUpFile->setDBFileList($arrForm);
                $objDownFile->setDBDownFile($arrForm);
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                break;
            case 'confirm':
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam);
                $arrForm = $objFormParam->getHashArray();
                if (empty($this->arrErr))
                    $this->arrForm = $this->lfSetViewParam_ConfirmPage($objUpFile, $objDownFile, $arrForm);
                else
                    $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                // 確認画面テンプレートに切り替え
                $this->tpl_mainpage = 'prepayment/edit_confirm.tpl';
                break;
            case 'return':
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam);
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                break;
            case 'complete':
                // 登録・保存処理
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam);
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or !SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->lfRegistData($objFormParam, $objUpFile, $objDownFile);
                $this->tpl_mainpage = 'prepayment/edit_complete.tpl';
                break;
            case 'complete_return':
                // 入力パラメーターチェック
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                break;
            case 'customer':
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                break;
            default:
                $this->lfInitParam($objFormParam);
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
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

    /**
     * パラメーター情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('id', 'id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ステータス', 'status', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業先名', 'company_name', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(年)', 'year', 4, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業日(月)', 'month', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業日(日)', 'day', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業時間(開始時)', 'working_start_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(開始分)', 'working_start_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(終了時)', 'working_over_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(終了分)', 'working_over_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間(時間)', 'breaktime_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間(分)', 'breaktime_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('save_work_report_image', 'save_work_report_image', '', '', array());
        $objFormParam->addParam('temp_work_report_image', 'temp_work_report_image', '', '', array());
        $objFormParam->addParam('備考', 'memo', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メモ（ショップ専用）', 'shop_memo', MLTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('検索用データ', 'search_data', '', '', array(), '', false);
        $objFormParam->addParam('スタッフ名', 'customer_id', INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 検索パラメーター引き継ぎ用情報の初期化
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return void
     */
    function lfInitSearchParam(&$objFormParam) {
        $objFormParam->addParam('お名前', 'search_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('スタッフID', 'search_staff_id', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始年)', 'search_working_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始月)', 'search_working_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(開始日)', 'search_working_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了年)', 'search_working_end_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了月)', 'search_working_end_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(終了日)', 'search_working_end_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('申請日(開始年)', 'search_start_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('申請日(開始月)', 'search_start_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('申請日(開始日)', 'search_start_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('ステータス', 'search_status', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('随時振込申請ステータス', 'search_apply_flg', INT_LEN, 'n', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('編集対象登録No', 'edit_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
        $objFormParam->addParam('ページ番号', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 1, false);
    }

    /**
     * 検索パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckErrorSearchParam(&$objFormParam) {
        $arrErr = $objFormParam->checkError();
        // 拡張エラーチェック初期化
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        // 拡張エラーチェック
        $objErr->doFunc(array('就業日(開始日)', 'search_working_start_year', 'search_working_start_month', 'search_working_start_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業日(終了日)', 'search_working_end_year', 'search_working_end_month', 'search_working_end_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('就業日(開始日)', '就業日(終了日)', 'search_working_start_year', 'search_working_start_month', 'search_working_start_day', 'search_working_end_year', 'search_working_end_month', 'search_working_end_day'), array('CHECK_SET_TERM'));
        $objErr->doFunc(array('申請日(開始日)', 'search_start_year', 'search_start_month', 'search_start_day',), array('CHECK_DATE'));
        $objErr->doFunc(array('申請日(終了日)', 'search_end_year', 'search_end_month', 'search_end_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('申請日(開始日)', '申請日(終了日)', 'search_start_year', 'search_start_month', 'search_start_day', 'search_end_year', 'search_end_month', 'search_end_day'), array('CHECK_SET_TERM'));
        if (!SC_Utils_Ex::isBlank($objErr->arrErr)) {
            $arrErr = array_merge($arrErr, $objErr->arrErr);
        }
        return $arrErr;
    }

    /**
     * フォーム入力パラメーターエラーチェック
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfCheckError(&$objFormParam) {
        $arrParams = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrParams);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('就業日', 'year', 'month', 'day'), array('CHECK_DATE'));
        if (strlen($arrParams['save_work_report_image']) == 0 && strlen($arrParams['temp_work_report_image']) == 0)
            $objErr->arrErr['work_report_image'] = '※ 作業日報が入力されていません。<br />';
        return $objErr->arrErr;
    }

    /**
     * 登録処理
     *
     * @param array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    function lfRegistData(&$objFormParam, $objUpFile, $objDownFile) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrRet = $objFormParam->getHashArray();
        $sqlval = $objFormParam->getDbArray();
        $sqlval['working_date'] = $arrRet['year'] . '-' . $arrRet['month'] . '-' . $arrRet['day'];
        $sqlval['working_start'] = $sqlval['working_start_hour'] . ':' . $sqlval['working_start_minute'];
        $sqlval['working_over'] = $sqlval['working_over_hour'] . ':' . $sqlval['working_over_minute'];
        $sqlval['breaktime'] = $sqlval['breaktime_hour'] . ':' . $sqlval['breaktime_minute'];
        $arrFile = $objUpFile->getDBFileList();
        $sqlval = array_merge($sqlval, $arrFile);
        $objDownFile->deleteDBDownFile($arrRet);
        unset($sqlval['save_work_report_image']);
        unset($sqlval['temp_work_report_image']);
        unset($sqlval['working_start_hour']);
        unset($sqlval['working_start_minute']);
        unset($sqlval['working_over_hour']);
        unset($sqlval['working_over_minute']);
        unset($sqlval['breaktime_hour']);
        unset($sqlval['breaktime_minute']);
        $sqlval['update_id'] = $_SESSION['member_id'];
        if (!is_numeric($sqlval['id']))
            $objQuery->insert('dtb_prepayment_apply', $sqlval);
        else {
            $sqlval['update_date'] = Date('Y-m-d H:i:s');
            $objQuery->update('dtb_prepayment_apply', $sqlval, 'id = ?', array($sqlval['id']));
        }
        $this->lfSaveUploadFiles($objUpFile, $objDownFile);
    }

    function lfInitFormParam_UploadImage(&$objFormParam) {
        $objFormParam->addParam('image_key', 'image_key', '', '', array());
    }

    function lfInitFile(&$objUpFile) {
        $objUpFile->addFile('作業日報', 'work_report_image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH*2, LARGE_IMAGE_HEIGHT*2);
    }

    function lfInitDownFile(&$objDownFile) {
        $objDownFile->addFile('ダウンロード販売用ファイル', 'down_file', explode(',', DOWNLOAD_EXTENSION), DOWN_SIZE, true, 0, 0);
    }

    function lfSetViewParam_InputPage(&$objUpFile, &$objDownFile, &$arrForm) {
        // アップロードファイル情報取得(Hidden用)
        $arrHidden = $objUpFile->getHiddenFileList();
        $arrForm['arrHidden'] = array_merge((array) $arrHidden, (array) $objDownFile->getHiddenFileList());
        // 画像ファイル表示用データ取得
        $arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, IMAGE_SAVE_URLPATH);
        // ダウンロード商品実ファイル名取得
        $arrForm['down_realfilename'] = $objDownFile->getFormDownFile();
        return $arrForm;
    }

    function lfSetViewParam_ConfirmPage(&$objUpFile, &$objDownFile, &$arrForm) {
        // 画像ファイル用データ取得
        $arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, IMAGE_SAVE_URLPATH);
        // ダウンロード商品実ファイル名取得
        $arrForm['down_realfilename'] = $objDownFile->getFormDownFile();

        return $arrForm;
    }

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

}
