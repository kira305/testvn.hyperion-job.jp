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

require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * 会員情報修正 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id$
 */
class LC_Page_Admin_Customer_Edit extends LC_Page_Admin_Ex {

    /**
     * Page を初期化する.
     *
     * @return void
     */
    public function init() {
        parent::init();
        $this->tpl_mainpage = 'customer/edit.tpl';
        $this->tpl_mainno = 'customer';
        $this->tpl_subno = 'index';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '会員管理';
        $this->tpl_subtitle = '会員登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrCountry = $masterData->getMasterData('mtb_country');
        $this->arrJob = $masterData->getMasterData('mtb_job');
        $this->arrSex = $masterData->getMasterData('mtb_sex');
        $this->arrReminder = $masterData->getMasterData('mtb_reminder');
        $this->arrStatus = $masterData->getMasterData('mtb_customer_status');
        $this->arrMailMagazineType = $masterData->getMasterData('mtb_mail_magazine_type');
        $this->arrMaritalStatus = $masterData->getMasterData('mtb_marital_status');
        $this->arrTarget = $masterData->getMasterData('mtb_object');
        $this->arrEducation = $masterData->getMasterData('mtb_education');
        $this->arrPosition = $masterData->getMasterData('mtb_position');
        $this->arrRegion = $masterData->getMasterData('mtb_region');
        $this->arrJLPT = $masterData->getMasterData('mtb_jlpt');
        $this->arrWorkExperience = array(1 => '経験あり', 0 => '未経験');
        
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrPref = $objQuery->select('*', 'mtb_pref');
        $this->arrPrefByTarget = array();
        foreach ($arrPref as $pref)
            $this->arrPrefByTarget[$pref['object_id']][$pref['id']] = $pref['name'];
        
        $this->arrCategory = $masterData->getMasterData('mtb_category');
        $arrCategory = $objQuery->select('*', 'mtb_category');
        $this->arrCategoryByTarget = array();
        foreach ($arrCategory as $category)
            $this->arrCategoryByTarget[$category['object_id']][$category['id']] = $category['name'];

        // 日付プルダウン設定
        $objDate = new SC_Date_Ex(BIRTH_YEAR);
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();
        
        $objDate = new SC_Date_Ex(RELEASE_YEAR, DATE('Y'));
        $this->arrReleaseYear = $objDate->getYear();

        // 支払い方法種別
        $this->arrPayment = SC_Helper_Payment_Ex::getIDValueList();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    public function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    public function action() {
        // パラメーター管理クラス
        $objFormParam = new SC_FormParam_Ex();
        // 検索引き継ぎ用パラメーター管理クラス
        $objFormSearchParam = new SC_FormParam_Ex();
        
        // アップロードファイル情報の初期化
        $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
        $objUpFile->addFile('写真', 'image', array('jpg', 'gif', 'png'), IMAGE_SIZE, false, LARGE_IMAGE_WIDTH, LARGE_IMAGE_HEIGHT);
        $objUpFile->setHiddenFileList($_POST);

        // モードによる処理切り替え
        switch ($this->getMode()) {
            case 'edit_search':
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($_REQUEST);
                $this->arrErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr)) {
                    return;
                }
                // 指定会員の情報をセット
                $this->arrForm = SC_Helper_Customer_Ex::sfGetCustomerData($objFormSearchParam->getValue('edit_customer_id'), true);
                $this->setUploadFile($objUpFile, $this->arrForm);
                // 購入履歴情報の取得
                list($this->tpl_linemax, $this->arrPurchaseHistory, $this->objNavi) = $this->lfPurchaseHistory($objFormSearchParam->getValue('edit_customer_id'));
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                $this->arrPagenavi['mode'] = 'return';
                $this->tpl_pageno = '0';
                break;
            case 'confirm':
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam, $objUpFile);
                $this->arrForm = $objFormParam->getHashArray();
                $this->setUploadFile($objUpFile, $this->arrForm);
                
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or ! SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                // 確認画面テンプレートに切り替え
                $this->tpl_mainpage = 'customer/edit_confirm.tpl';
                break;
            case 'return':
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam, $objUpFile);
                $this->arrForm = $objFormParam->getHashArray();
                $this->setUploadFile($objUpFile, $this->arrForm);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or ! SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                // 購入履歴情報の取得
                list($this->tpl_linemax, $this->arrPurchaseHistory, $this->objNavi) = $this->lfPurchaseHistory($objFormParam->getValue('customer_id'), $objFormParam->getValue('search_pageno'));
                $this->arrPagenavi = $this->objNavi->arrPagenavi;
                $this->arrPagenavi['mode'] = 'return';
                $this->tpl_pageno = $objFormParam->getValue('search_pageno');

                break;
            case 'complete':
                // 登録・保存処理
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                // 入力パラメーターチェック
                $this->arrErr = $this->lfCheckError($objFormParam, $objUpFile);
                $this->arrForm = $objFormParam->getHashArray();
                $this->setUploadFile($objUpFile, $this->arrForm);
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();
                if (!SC_Utils_Ex::isBlank($this->arrErr) or ! SC_Utils_Ex::isBlank($this->arrSearchErr)) {
                    return;
                }
                $this->lfRegistData($objFormParam, $objUpFile);
                $this->tpl_mainpage = 'customer/edit_complete.tpl';
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
            // 画像のアップロード
            case 'upload_image':
            case 'delete_image':
                // パラメーター処理
                $this->lfInitParam($objFormParam);
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrForm = $objFormParam->getHashArray();
                // 検索引き継ぎ用パラメーター処理
                $this->lfInitSearchParam($objFormSearchParam);
                $objFormSearchParam->setParam($objFormParam->getValue('search_data'));
                $this->arrSearchErr = $this->lfCheckErrorSearchParam($objFormSearchParam);
                $this->arrSearchData = $objFormSearchParam->getSearchArray();

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
                $this->setUploadFile($objUpFile, $this->arrForm);
                break;
            default:
                $this->lfInitParam($objFormParam);
                $this->arrForm = $objFormParam->getHashArray();
                $this->setUploadFile($objUpFile, $this->arrForm);
                break;
        }
    }
    
    public function setUploadFile(&$objUpFile, &$arrForm) {
        $objUpFile->setDBFileList($arrForm);
        $arrForm['arrHidden'] = $objUpFile->getHiddenFileList();
        $arrForm['arrFile'] = $objUpFile->getFormFileList(IMAGE_TEMP_URLPATH, IMAGE_SAVE_URLPATH);
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

    /**
     * パラメーター情報の初期化
     *
     * @param  array $objFormParam フォームパラメータークラス
     * @return void
     */
    public function lfInitParam(&$objFormParam) {
        // 会員項目のパラメーター取得
        SC_Helper_Customer_Ex::sfCustomerEntryParam($objFormParam, true);
        // 検索結果一覧画面への戻り用パラメーター
        $objFormParam->addParam('検索用データ', 'search_data', '', '', array(), '', false);
        // 会員購入履歴ページング用
        $objFormParam->addParam('', 'search_pageno', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
    }

    /**
     * 検索パラメーター引き継ぎ用情報の初期化
     *
     * @param  SC_FormParam_Ex $objFormParam フォームパラメータークラス
     * @return void
     */
    public function lfInitSearchParam(&$objFormParam) {
        SC_Helper_Customer_Ex::sfSetSearchParam($objFormParam);
        // 初回受け入れ時用
        $objFormParam->addParam('編集対象会員ID', 'edit_customer_id', INT_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     * 検索パラメーターエラーチェック
     *
     * @param  SC_FormParam_Ex $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    public function lfCheckErrorSearchParam(&$objFormParam) {
        return SC_Helper_Customer_Ex::sfCheckErrorSearchParam($objFormParam);
    }

    /**
     * フォーム入力パラメーターエラーチェック
     *
     * @param  array $objFormParam フォームパラメータークラス
     * @return array エラー配列
     */
    public function lfCheckError(&$objFormParam, $objUpFile) {
        $arrErr = SC_Helper_Customer_Ex::sfCustomerMypageErrorCheck($objFormParam, true);
        $arrErr = array_merge((array) $arrErr, (array) $objUpFile->checkExists());

        // メアド重複チェック(共通ルーチンは使えない)
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $col = 'email, email_mobile, customer_id';
        $table = 'dtb_customer';
        $where = 'del_flg <> 1 AND (email Like ? OR email_mobile Like ?)';
        $arrVal = array($objFormParam->getValue('email'), $objFormParam->getValue('email_mobile'));
        if ($objFormParam->getValue('customer_id')) {
            $where .= ' AND customer_id <> ?';
            $arrVal[] = $objFormParam->getValue('customer_id');
        }
        $arrData = $objQuery->getRow($col, $table, $where, $arrVal);
        if (!SC_Utils_Ex::isBlank($arrData['email'])) {
            if ($arrData['email'] == $objFormParam->getValue('email')) {
                $arrErr['email'] = '※ すでに他の会員(ID:' . $arrData['customer_id'] . ')が使用しているアドレスです。';
            } elseif ($arrData['email'] == $objFormParam->getValue('email_mobile')) {
                $arrErr['email_mobile'] = '※ すでに他の会員(ID:' . $arrData['customer_id'] . ')が使用しているアドレスです。';
            }
        }
        if (!SC_Utils_Ex::isBlank($arrData['email_mobile'])) {
            if ($arrData['email_mobile'] == $objFormParam->getValue('email_mobile')) {
                $arrErr['email_mobile'] = '※ すでに他の会員(ID:' . $arrData['customer_id'] . ')が使用している携帯アドレスです。';
            } elseif ($arrData['email_mobile'] == $objFormParam->getValue('email')) {
                if ($arrErr['email'] == '') {
                    $arrErr['email'] = '※ すでに他の会員(ID:' . $arrData['customer_id'] . ')が使用している携帯アドレスです。';
                }
            }
        }

        return $arrErr;
    }

    /**
     * 登録処理
     *
     * @param  array $objFormParam フォームパラメータークラス
     * @return integer エラー配列
     */
    public function lfRegistData(&$objFormParam, $objUpFile) {
        // 登録用データ取得
        $arrData = $objFormParam->getDbArray();
        // 足りないものを作る
        if (!SC_Utils_Ex::isBlank($objFormParam->getValue('year'))) {
            $arrData['birth'] = $objFormParam->getValue('year') . '/'
                    . $objFormParam->getValue('month') . '/'
                    . $objFormParam->getValue('day')
                    . ' 00:00:00';
        }
        $arrData['desired_work'] = implode(" ", $arrData['desired_work']);
        $arrData['desired_position'] = implode(" ", $arrData['desired_position']);
        $arrData['desired_region'] = implode(" ", $arrData['desired_region']);

        if (!is_numeric($arrData['customer_id'])) {
            $arrData['secret_key'] = SC_Utils_Ex::sfGetUniqRandomId('r');
        } else {
            $arrOldCustomerData = SC_Helper_Customer_Ex::sfGetCustomerData($arrData['customer_id']);
            if ($arrOldCustomerData['status'] != $arrData['status']) {
                $arrData['secret_key'] = SC_Utils_Ex::sfGetUniqRandomId('r');
            }
        }
        $arrRet = $objUpFile->getDBFileList();
        $arrData = array_merge($arrData, $arrRet);
        
        $this->lfSaveUploadFiles($objUpFile);

        return SC_Helper_Customer_Ex::sfEditCustomerData($arrData, $arrData['customer_id']);
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

    /**
     * 購入履歴情報の取得
     *
     * @return array( integer 全体件数, mixed 会員データ一覧配列, mixed SC_PageNaviオブジェクト)
     */
    public function lfPurchaseHistory($customer_id, $pageno = 0) {
        if (SC_Utils_Ex::isBlank($customer_id)) {
            return array('0', array(), NULL);
        }
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $page_max = SEARCH_PMAX;
        $table = 'dtb_order';
        $where = 'customer_id = ? AND del_flg <> 1';
        $arrVal = array($customer_id);
        // 購入履歴の件数取得
        $linemax = $objQuery->count($table, $where, $arrVal);
        // ページ送りの取得
        $objNavi = new SC_PageNavi_Ex($pageno, $linemax, $page_max, 'eccube.moveSecondSearchPage', NAVI_PMAX);
        // 取得範囲の指定(開始行番号、行数のセット)
        $objQuery->setLimitOffset($page_max, $objNavi->start_row);
        // 表示順序
        $order = 'order_id DESC';
        $objQuery->setOrder($order);
        // 購入履歴情報の取得
        $arrPurchaseHistory = $objQuery->select('*', $table, $where, $arrVal);

        return array($linemax, $arrPurchaseHistory, $objNavi);
    }

}
