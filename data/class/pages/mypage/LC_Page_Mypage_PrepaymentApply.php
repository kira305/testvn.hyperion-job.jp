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
require_once CLASS_EX_REALDIR . 'page_extends/mypage/LC_Page_AbstractMypage_Ex.php';

/**
 * 登録内容変更 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Mypage_Change.php 21883 2012-06-02 14:43:27Z Yammy $
 */
class LC_Page_Mypage_PrepaymentApply extends LC_Page_AbstractMypage_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_subtitle = '就業実績報告';
        $this->tpl_mypageno = 'prepayment_apply';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrStatus = $masterData->getMasterData('mtb_prepayment_status');

        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');
        $this->arrBREAKTIME = array('' => '', '00' => '00', '01' => '01', '02' => '02');
        $objDate = new SC_Date_Ex(RELEASE_YEAR, date('Y', strtotime('now')));
        $this->arrYear = $objDate->getYear('', RELEASE_YEAR, '');
        $this->arrMonth = $objDate->getMonth(true);
        $this->arrDay = $objDate->getDay(true);
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
    }

    /**
     * Page のプロセス
     * @return void
     */
    function action() {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');

        // mobile用（戻るボタンでの遷移かどうかを判定）
        if (!empty($_POST['return'])) {
            $_POST['mode'] = 'return';
        }

        $this->page = $_POST['page'];
        $this->year = date('Y');
        $this->month = date('n');

        // パラメーター管理クラス,パラメーター情報の初期化
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);    // POST値の取得
        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $this->lfInitFile($objUpFile);
        $objUpFile->setHiddenFileList($_POST);

        // ダウンロード販売ファイル情報の初期化
        $objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, DOWN_SAVE_REALDIR);
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
                break;
            case 'new':
                $this->page = 'input';
                $this->tpl_subtitle = '勤怠入力';
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                break;
            // 確認
            case 'confirm':
                $arrForm = $objFormParam->getHashArray();
                $this->arrErr = $this->lfCheckError($objFormParam);
                if (empty($this->arrErr)) {
                    $this->arrForm = $this->lfSetViewParam_ConfirmPage($objUpFile, $objDownFile, $arrForm);
                    $this->page = 'confirm';
                    $this->tpl_subtitle = '入力確認';
                }
                else
                    $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                break;
            // 会員登録と完了画面
            case 'complete':
                $this->lfRegistData($objQuery, $objFormParam, $customer_id, $objUpFile, $objDownFile);
                $this->page = 'complete';
                $this->tpl_subtitle = '';
                break;
            // 確認ページからの戻り
            case 'return':
                $this->page = 'input';
                $this->tpl_subtitle = '勤怠入力';
                $arrForm = $objFormParam->getHashArray();
                $this->arrForm = $this->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                break;
            case 'changeMonth':
                $pair = explode('-', $_POST['yearmonth']);
                $this->year = $pair[0];
                $this->month = $pair[1];
            default:
                $this->page = 'list';
                $objQuery->setorder('working_date DESC');
                $arrForm = $objQuery->select('*', 'dtb_prepayment_apply', 'del_flg = 0 AND customer_id = ? AND working_date >= ?', array($customer_id, date("Y-m-01", strtotime("-5 months"))));
                $this->arrForm = array();
                foreach ($arrForm as $key => $arr) {
                    list($arrForm[$key]['year'], $arrForm[$key]['month'], $arrForm[$key]['day']) = explode('-', $arr['working_date']);
                    $this->arrYearMonth[$arrForm[$key]['year'] . '-' . $arrForm[$key]['month']] = $arrForm[$key]['year'] . '年' . $arrForm[$key]['month'] . '月';
                    if ($arrForm[$key]['year'] == $this->year && $arrForm[$key]['month'] == $this->month)
                        $this->arrForm[] = $arrForm[$key];
                }

                $this->selectedYearMonth = $this->year . '-';
                if (strlen($this->month) == 1)
                    $this->selectedYearMonth .= '0';
                $this->selectedYearMonth .= $this->month;
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
     *  会員情報を登録する
     *
     * @param mixed $objFormParam
     * @param mixed $customer_id
     * @access private
     * @return void
     */
    function lfRegistData($objQuery, &$objFormParam, $customer_id, &$objUpFile, &$objDownFile) {
        $arrRet = $objFormParam->getHashArray();
        $sqlval = $objFormParam->getDbArray();
        $sqlval['customer_id'] = $customer_id;
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
        $objQuery->insert('dtb_prepayment_apply', $sqlval);
        $this->lfSaveUploadFiles($objUpFile, $objDownFile);
    }

    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('就業先名', 'company_name', STEXT_LEN, 'aKV', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業日(年)', 'year', 4, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), Date('Y'), false);
        $objFormParam->addParam('就業日(月)', 'month', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), Date('m'), false);
        $objFormParam->addParam('就業日(日)', 'day', 2, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'), Date('d'), false);
        $objFormParam->addParam('就業時間(開始時)', 'working_start_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(開始分)', 'working_start_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(終了時)', 'working_over_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間(終了分)', 'working_over_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間(時間)', 'breaktime_hour', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間(分)', 'breaktime_minute', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('save_work_report_image', 'save_work_report_image', '', '', array());
        $objFormParam->addParam('temp_work_report_image', 'temp_work_report_image', '', '', array());
        $objFormParam->addParam('備考', 'memo', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 入力エラーのチェック.
     *
     * @param array $arrRequest リクエスト値($_GET)
     * @return array $arrErr エラーメッセージ配列
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
