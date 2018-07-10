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
require_once CLASS_EX_REALDIR . 'SC_Fpdf_Job_Ex.php';

/**
 * 帳票出力 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Job_Pdf.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Job_Pdf extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/pdf.tpl';
        $this->tpl_mainno = 'job';
        $this->tpl_subno = 'pdf';
        $this->tpl_maintitle = '手配管理';
        $this->tpl_subtitle = '帳票出力';

        $this->arrType[1] = '労働者派遣個別契約書';
        $this->arrType[2] = '派遣先通知書　兼　派遣先管理台帳';
        $this->arrType[3] = '1-6';
        $this->arrType[4] = '就業条件明示書';
        $this->arrType[5] = '薬局情報シート';
        $this->arrType[6] = 'ファーマプレミアムスタッフの皆様へ';
        $this->arrType[7] = '2-4';
        $this->arrType[8] = '2-5';

        $this->arrTitle[1] = '本社';
        $this->arrTitle[2] = '薬局';
        $this->arrTitle[3] = 'スタッフ';

        $this->arrDownload[0] = 'ブラウザに開く';
        $this->arrDownload[1] = 'ファイルに保存';

        $this->arrFill[0] = '印字';
        $this->arrFill[1] = '白紙';

        $this->arrNote[1] = 'ファーマプレミアムでございます。いつもお世話になっております。\nこの度は弊社へご依頼頂きまして誠にありがとうございます。\n契約書類一式をお送り致しますので内容のご確認をお願い申し上げます。\n尚、個別契約書は1部弊社保管となりますので付属の返信封筒にてご返信下さいませ。\nお手数お掛け致しますが、今後とも宜しくお願い致します。';
        $this->arrNote[2] = $this->arrNote[1];
        $this->arrNote[3] = 'ファーマプレミアムでございます。\nこの度はご就業して頂きまして誠にありがとうございます。\n契約書類一式を送らせて頂きますので内容のご確認をお願い申し上げます。\nまた何かご不明な点がございましたら、お気軽に弊社までお問い合わせ下さいませ。\n今後とも宜しくお願い致します。';
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

        $objDb = new SC_Helper_DB_Ex();
        $objDate = new SC_Date_Ex(1901);
        $objDate->setStartYear(RELEASE_YEAR);
        $this->arrYear = $objDate->getYear();
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();

        // パラメーター管理クラス
        $this->objFormParam = new SC_FormParam_Ex();
        // パラメーター情報の初期化
        $this->lfInitParam($this->objFormParam);
        $this->objFormParam->setParam($_POST);
        // 入力値の変換
        $this->objFormParam->convParam();

        // どんな状態の時に isset($arrRet) == trueになるんだ? これ以前に$arrRet無いが、、、、
        if (!isset($arrRet))
            $arrRet = array();
        switch ($this->getMode()) {
            case 'confirm':

                $status = $this->createPdf($this->objFormParam);
                if ($status === true) {
                    SC_Response_Ex::actionExit();
                } else {
                    $this->arrErr = $status;
                }
                break;
            default:
                $this->arrForm = $this->createFromValues($_GET['job_id'], $_POST['pdf_job_id']);
                break;
        }
        $this->setTemplate($this->tpl_mainpage);
    }

    /**
     *
     * PDF作成フォームのデフォルト値の生成
     */
    function createFromValues($sjob_id, $pdf_sjob_id) {
        // ここが$arrFormの初登場ということを明示するため宣言する。
        $arrForm = array();

        // 今日の日付をセット
        $arrForm['year'] = date('Y');
        $arrForm['month'] = date('m');
        $arrForm['day'] = date('d');

        // 注文番号があったら、セットする
        if (SC_Utils_Ex::sfIsInt($sjob_id)) {
            $arrForm['sjob_id'][0] = $sjob_id;
        } elseif (is_array($pdf_sjob_id)) {
            sort($pdf_sjob_id);
            foreach ($pdf_sjob_id AS $val) {
                $arrForm['sjob_id'][] = $val;
            }
        }

        return $arrForm;
    }

    /**
     *
     * PDFの作成
     * @param SC_FormParam $objFormParam
     */
    function createPdf(&$objFormParam) {

        $arrErr = $this->lfCheckError($objFormParam);
        $arrRet = $objFormParam->getHashArray();

        $arrVal = $arrRet;
        unset($arrVal['sjob_id']);
        unset($arrVal['pdf_sjob_id']);

        $this->arrForm = $arrRet;
        // エラー入力なし
        if (count($arrErr) == 0) {
            $objFpdf = new SC_Fpdf_Job_Ex($arrVal);
            foreach ($arrRet['sjob_id'] AS $val)
                $objFpdf->setData($val);
            $objFpdf->createPdf();
            return true;
        } else {
            return $arrErr;
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
     *  パラメーター情報の初期化
     *  @param SC_FormParam
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('注文番号', 'sjob_id', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('注文番号', 'pdf_sjob_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('発行日', 'year', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('発行日', 'month', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('発行日', 'day', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('帳票の状態', 'fill', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('帳票の種類', 'type', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('書類送付のご案内', 'title', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('ダウンロード方法', 'download', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('記1行目', 'msg1', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('記2行目', 'msg2', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('記3行目', 'msg3', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('記4行目', 'msg4', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('記5行目', 'msg5', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('記6行目', 'msg6', STEXT_LEN * 3 / 5, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('備考', 'note', STEXT_LEN * 6, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
    }

    /**
     *  入力内容のチェック
     *  @var SC_FormParam
     */
    function lfCheckError(&$objFormParam) {
        // 入力データを渡す。
        $arrErr = $objFormParam->checkError();
        if (SC_Utils_Ex::sfIsInt($objFormParam->getValue('title')))
            unset($arrErr['type']);

        $year = $objFormParam->getValue('year');
        if (!is_numeric($year)) {
            $arrErr['year'] = '発行年は数値で入力してください。';
        }

        $month = $objFormParam->getValue('month');
        if (!is_numeric($month)) {
            $arrErr['month'] = '発行月は数値で入力してください。';
        } else if (0 >= $month && 12 < $month) {

            $arrErr['month'] = '発行月は1〜12の間で入力してください。';
        }

        $day = $objFormParam->getValue('day');
        if (!is_numeric($day)) {
            $arrErr['day'] = '発行日は数値で入力してください。';
        } else if (0 >= $day && 31 < $day) {

            $arrErr['day'] = '発行日は1〜31の間で入力してください。';
        }

        return $arrErr;
    }

}
