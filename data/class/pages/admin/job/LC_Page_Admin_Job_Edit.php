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
 * 受注修正 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Order_Edit.php 21935 2012-06-21 06:02:41Z pineray $
 */
class LC_Page_Admin_Job_Edit extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/edit.tpl';
        $this->tpl_mainno = 'job';
        $this->tpl_maintitle = '依頼管理';
        $this->tpl_subtitle = '依頼登録';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrCALENDARFLAG = array(0 => '未', 1 => '入');

        $objDate = new SC_Date_Ex(RELEASE_YEAR);
        $this->arrYear = $objDate->getYear('', true, '');
        $this->arrMonth = $objDate->getMonth(true);
        $this->arrDay = $objDate->getDay(true);
        $this->arrHOUR = array('' => '', '00' => '00', '01' => '01', '02' => '02', '03' => '03', '04' => '04', '05' => '05', '06' => '06', '07' => '07', '08' => '08', '09' => '09', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16', '17' => '17', '18' => '18', '19' => '19', '20' => '20', '21' => '21', '22' => '22', '23' => '23');
        $this->arrMINUTE = array('' => '', '00' => '00', '05' => '05', '10' => '10', '15' => '15', '20' => '20', '25' => '25', '30' => '30', '35' => '35', '40' => '40', '45' => '45', '50' => '50', '55' => '55');

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
        $objFormParam = new SC_FormParam_Ex();

        // パラメーター情報の初期化
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_REQUEST);
        $objFormParam->convParam();
        $job_id = $objFormParam->getValue('sjob_id');

        // DBから受注情報を読み込む
        if (!SC_Utils_Ex::isBlank($job_id)) {
            $this->setJobToFormParam($objFormParam, $job_id);
            $this->tpl_subno = 'index';
        } else {
            $this->tpl_subno = 'add';
        }

        $this->arrSearchHidden = $objFormParam->getSearchArray();

        switch ($this->getMode()) {
            case 'pre_edit':
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $arrOrderDate = $objQuery->select('*', 'dtb_job_date', 'sjob_id = ?', array($job_id));
                foreach ($arrOrderDate as $arrDate)
                    $_SESSION['working_calendar'][$arrDate['customer_id']][$arrDate['working_day']] = $arrDate;
                break;
            case 'job_id':
                break;
            case 'confirm':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                if (SC_Utils_Ex::isBlank($this->arrErr)) {
                    $this->tpl_mainpage = 'job/edit_confirm.tpl';
                }
                break;
            case 'confirm_return':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                break;
            case 'complete':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                if ($job_id >= 0)
                    $this->message = '依頼を編集しました。';
                else
                    $this->message = '依頼を登録しました。';
                $this->doRegister($job_id, $objFormParam);
                unset($_SESSION['working_calendar']);
                $this->tpl_mainpage = 'job/edit_complete.tpl';
                break;
            case 'recalculate':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                break;
            case 'working_calculate':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->lfWorkingCalculate($objFormParam);
                break;
            case 'delete_customer':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $delete_no = $objFormParam->getValue('delete_no');
                $this->doDeleteCustomer($delete_no, $objFormParam);
                $this->arrErr = $this->lfCheckError($objFormParam);
                break;
            case 'select_customer':
                $objFormParam->setParam($_POST);
                $objFormParam->convParam();
                $this->doRegisterCustomer($objFormParam);
                $this->arrErr = $this->lfCheckError($objFormParam);
                break;
            default:
                break;
        }
        $this->arrForm = $objFormParam->getFormParamList();
        $this->tpl_onload .= $this->getAnchorKey($objFormParam);
        $this->arrInfo = SC_Helper_DB_Ex::sfGetBasisData();
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    function lfInitParamSearch(&$objFormParam) {
        $objFormParam->addParam('受注ＩＤ', 'search_job_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('案件名', 'search_job_name', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));

        $objFormParam->addParam('派遣日(開始年)', 'search_sjob_date_year', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣日(開始月)', 'search_sjob_date_month', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣日(開始日)', 'search_sjob_date_day', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣日(終了年)', 'search_ejob_date_year', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣日(終了月)', 'search_ejob_date_month', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣日(終了日)', 'search_ejob_date_day', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));

        $objFormParam->addParam('派遣期間(開始年)', 'search_sjob_sche_date_year', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣期間(開始月)', 'search_sjob_sche_date_month', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣期間(開始日)', 'search_sjob_sche_date_day', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣期間(終了年)', 'search_ejob_sche_date_year', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣期間(終了月)', 'search_ejob_sche_date_month', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣期間(終了日)', 'search_ejob_sche_date_day', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));

        $objFormParam->addParam('表示件数', 'search_page_max', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('ページ送り番号', 'search_pageno', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('予約番号', 'sjob_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
    }

    /**
     * パラメーター情報の初期化を行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        // 検索条件のパラメーターを初期化
        $this->lfInitParamSearch($objFormParam);

        $objFormParam->addParam('予約番号', 'sjob_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('受注ＩＤ', 'job_id', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('案件名', 'job_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('受注コード', 'job_code', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('業務・概要', 'job_description', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('業務・詳細', 'job_detail', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('営業所', 'job_office', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('現場担当者', 'office_charge', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('現場担当者電話1', 'o_charge_tel1', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('現場担当者電話2', 'o_charge_tel2', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('現場担当者電話3', 'o_charge_tel3', TEL_ITEM_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('備考', 'remarks', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('派遣日(年)', 'job_date_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣日(月)', 'job_date_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣日(日)', 'job_date_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(開始年)', 'job_sche_date_from_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(開始月)', 'job_sche_date_from_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(開始日)', 'job_sche_date_from_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(終了年)', 'job_sche_date_to_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(終了月)', 'job_sche_date_to_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('派遣期間(終了日)', 'job_sche_date_to_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);

        $objFormParam->addParam('申込日(年)', 'apply_date_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('申込日(月)', 'apply_date_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('申込日(日)', 'apply_date_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('キャンセル日付(年)', 'cancel_date_year', 4, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('キャンセル日付(月)', 'cancel_date_month', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('キャンセル日付(日)', 'cancel_date_day', 2, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('現場名', 'office_name', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('エリア代', 'area_cost', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('郵便番号1', 'post_zip1', ZIP01_LEN, 'n', array('NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('郵便番号2', 'post_zip2', ZIP02_LEN, 'n', array('NUM_CHECK', 'NUM_COUNT_CHECK'));
        $objFormParam->addParam('都道府県', 'office_pref', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('住所1', 'office_addr1', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('住所2', 'office_addr2', MTEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('必要人数', 'request_num', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('派遣最大人数', 'request_num_max', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業予定開始時間(時)', 'job_start_time1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業予定開始時間(分)', 'job_start_time2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業予定終了時間(時)', 'job_finish_time1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('就業予定終了時間(分)', 'job_finish_time2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('拘束時間(時)', 'binding_hour1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('拘束時間(分)', 'binding_hour2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('実働時間(時)', 'working_total1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('実働時間(分)', 'working_total2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('休憩時間(時)', 'break_time1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('休憩時間(分)', 'break_time2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('残業の有無', 'over_time', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));

        $objFormParam->addParam('最寄駅', 'nearest_station', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('最寄駅から移動方法', 'root_from_station', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('最寄駅から移動時間（分）', 'time_from_station', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('最寄駅から移動詳細', 'root_detail', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('持ち物', 'belongings', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('派遣先からの注意事項', 'dispatch_notes', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('当社から注意事項', 'hyperion_notes', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('集合場所', 'meeting_place', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('集合時間(時)', 'meeting_time1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('集合時間(分)', 'meeting_time2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('点呼場所', 'roll_call_place', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('点呼時間(時)', 'roll_call_time1', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('点呼時間(分)', 'roll_call_time2', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'), '', false);
        $objFormParam->addParam('解散予定場所', 'dissolution_place', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));

        // 受注詳細情報
        $objFormParam->addParam('スタッフID', 'customer_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'), '0');
        $objFormParam->addParam('スタッフ名1', 'name01');
        $objFormParam->addParam('スタッフ名2', 'name02');
        $objFormParam->addParam('カレンダー', 'calendar_flag', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業時間', 'working_hour', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('残業時間', 'overtime', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('email', 'email');
        $objFormParam->addParam('小計', 'subtotal');
        $objFormParam->addParam('支払い合計', 'total');

        $objFormParam->addParam('メモ', 'memo', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('備考（個別契約書用）', 'contract_notice', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));

        $objFormParam->addParam('就業日', 'working_day_all');
        $objFormParam->addParam('就業時間1', 'working_start_all');
        $objFormParam->addParam('就業時間2', 'working_over_all');
        $objFormParam->addParam('休憩時間1', 'breaktime_s_all');
        $objFormParam->addParam('休憩時間2', 'breaktime_o_all');
        $objFormParam->addParam('依頼人数', 'staff_count');

        $objFormParam->addParam('商品項番', 'no', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('追加商品規格ID', 'add_customer_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('修正商品規格ID', 'edit_customer_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('アンカーキー', 'anchor_key', STEXT_LEN, 'KVa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('削除用項番', 'delete_no', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
    }

    /**
     * 受注データを取得して, SC_FormParam へ設定する.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @param integer $job_id 取得元の受注ID
     * @return void
     */
    function setJobToFormParam(&$objFormParam, $job_id) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrOrderDetail = $objQuery->select('*', 'dtb_job_detail', 'sjob_id = ?', array($job_id));
        $objFormParam->setParam(SC_Utils_Ex::sfSwapArray($arrOrderDetail));
        $arrOrder = $objQuery->select('*', 'dtb_job', 'sjob_id = ?', array($job_id));
        list($arrOrder[0]['job_date_year'], $arrOrder[0]['job_date_month'], $arrOrder[0]['job_date_day']) = explode('-', $arrOrder[0]['job_date']);
        list($arrOrder[0]['job_sche_date_from_year'], $arrOrder[0]['job_sche_date_from_month'], $arrOrder[0]['job_sche_date_from_day']) = explode('-', $arrOrder[0]['job_sche_date_from']);
        list($arrOrder[0]['job_sche_date_to_year'], $arrOrder[0]['job_sche_date_to_month'], $arrOrder[0]['job_sche_date_to_day']) = explode('-', $arrOrder[0]['job_sche_date_to']);
        list($arrOrder[0]['apply_date_year'], $arrOrder[0]['apply_date_month'], $arrOrder[0]['apply_date_day']) = explode('-', $arrOrder[0]['apply_date']);
        list($arrOrder[0]['cancel_date_year'], $arrOrder[0]['cancel_date_month'], $arrOrder[0]['cancel_date_day']) = explode('-', $arrOrder[0]['cancel_date']);
        list($arrOrder[0]['job_start_time1'], $arrOrder[0]['job_start_time2']) = explode(':', $arrOrder[0]['job_start_time']);
        list($arrOrder[0]['job_finish_time1'], $arrOrder[0]['job_finish_time2']) = explode(':', $arrOrder[0]['job_finish_time']);
        list($arrOrder[0]['binding_hour1'], $arrOrder[0]['binding_hour2']) = explode(':', $arrOrder[0]['binding_hour']);
        list($arrOrder[0]['working_total1'], $arrOrder[0]['working_total2']) = explode(':', $arrOrder[0]['working_total']);
        list($arrOrder[0]['break_time1'], $arrOrder[0]['break_time2']) = explode(':', $arrOrder[0]['break_time']);
        list($arrOrder[0]['meeting_time1'], $arrOrder[0]['meeting_time2']) = explode(':', $arrOrder[0]['meeting_time']);
        list($arrOrder[0]['roll_call_time1'], $arrOrder[0]['roll_call_time2']) = explode(':', $arrOrder[0]['roll_call_time']);
        $objFormParam->setParam($arrOrder[0]);
    }

    function lfWorkingCalculate(&$objFormParam) {
        $arrCustomer = array();
        foreach ($_SESSION['working_calendar'] as $customer_id => $val) {
            $arrCustomer[$customer_id]['working_hour']['hour'] = 0;
            $arrCustomer[$customer_id]['working_hour']['min'] = 0;
            $arrCustomer[$customer_id]['overtime']['hour'] = 0;
            $arrCustomer[$customer_id]['overtime']['min'] = 0;
            $arrCustomer[$customer_id]['subtotal'] = 0;
            foreach ($val as $date => $values) {
                $arrCustomer[$customer_id]['working_hour']['hour'] += substr($values['working_hour'], 0, 2);
                $arrCustomer[$customer_id]['working_hour']['min'] += substr($values['working_hour'], 3, 2);
                $arrCustomer[$customer_id]['overtime']['hour'] += substr($values['overtime'], 0, 2);
                $arrCustomer[$customer_id]['overtime']['min'] += substr($values['overtime'], 3, 2);
                $arrCustomer[$customer_id]['subtotal'] += $values['subtotal'];
            }
            $arrCustomer[$customer_id]['working_hour']['hour'] += intval($arrCustomer[$customer_id]['working_hour']['min'] / 60);
            $arrCustomer[$customer_id]['working_hour']['min'] = $arrCustomer[$customer_id]['working_hour']['min'] % 60;
            $arrCustomer[$customer_id]['overtime']['hour'] += intval($arrCustomer[$customer_id]['overtime']['min'] / 60);
            $arrCustomer[$customer_id]['overtime']['min'] = $arrCustomer[$customer_id]['overtime']['min'] % 60;
            $arrCustomer[$customer_id]['working_hour'] = $this->twoDigitValue($arrCustomer[$customer_id]['working_hour']['hour']) . ':' . $this->twoDigitValue($arrCustomer[$customer_id]['working_hour']['min']);
            $arrCustomer[$customer_id]['overtime'] = $this->twoDigitValue($arrCustomer[$customer_id]['overtime']['hour']) . ':' . $this->twoDigitValue($arrCustomer[$customer_id]['overtime']['min']);
        }
        $arrValues = $objFormParam->getHashArray();
        $max = count($arrValues['customer_id']);
        $arrValues['total'] = 0;
        for ($i = 0; $i < $max; $i++) {
            $arrValues['calendar_flag'][$i] = 0;
            if (count($_SESSION['working_calendar'][$arrValues['customer_id'][$i]]) > 0)
                $arrValues['calendar_flag'][$i] = 1;
            $arrValues['working_hour'][$i] = $arrCustomer[$arrValues['customer_id'][$i]]['working_hour'];
            $arrValues['overtime'][$i] = $arrCustomer[$arrValues['customer_id'][$i]]['overtime'];
            $arrValues['subtotal'][$i] = $arrCustomer[$arrValues['customer_id'][$i]]['subtotal'];
            $arrValues['total'] += $arrValues['subtotal'][$i];
        }
        $objFormParam->setParam($arrValues);
    }

    function twoDigitValue($value) {
        if ($value >= 10)
            return $value;
        else
            return '0' . $value;
    }

    /**
     * 入力内容のチェックを行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return array エラーメッセージの配列
     */
    function lfCheckError(&$objFormParam) {
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->arrErr = $objFormParam->checkError();
        if (!SC_Utils_Ex::isBlank($objErr->arrErr)) {
            return $objErr->arrErr;
        }
        $objErr->doFunc(array('派遣日', 'job_date_year', 'job_date_month', 'job_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('派遣期間(開始日)', 'job_sche_date_from_year', 'job_sche_date_from_month', 'job_sche_date_from_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('派遣期間(終了年)', 'job_sche_date_to_year', 'job_sche_date_to_month', 'job_sche_date_to_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('申込日', 'apply_date_year', 'apply_date_month', 'apply_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('キャンセル日付', 'cancel_date_year', 'cancel_date_month', 'cancel_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('派遣期間(開始日)', '派遣期間(終了年)', 'job_sche_date_from_year', 'job_sche_date_from_month', 'job_sche_date_from_day', 'job_sche_date_to_year', 'job_sche_date_to_month', 'job_sche_date_to_day'), array('CHECK_SET_TERM'));
        
        $objErr->doFunc(array('就業予定開始時間', 'job_start_time1', 'job_start_time2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('就業予定終了時間', 'job_finish_time1', 'job_finish_time2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('拘束時間', 'binding_hour1', 'binding_hour2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('実働時間', 'working_total1', 'working_total2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('休憩時間', 'break_time1', 'break_time2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('集合時間', 'meeting_time1', 'meeting_time2'), array('ALL_EXIST_CHECK'));
        $objErr->doFunc(array('点呼時間', 'roll_call_time1', 'roll_call_time2'), array('ALL_EXIST_CHECK'));
        
        return $objErr->arrErr;
    }

    /**
     * DB更新処理
     *
     * @param integer $job_id 受注ID
     * @param SC_Helper_Purchase $objPurchase SC_Helper_Purchase インスタンス
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @param string $message 通知メッセージ
     * @return integer $job_id 受注ID
     *
     * エラー発生時は負数を返す。
     */
    function doRegister($job_id, &$objFormParam) {

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrValues = $objFormParam->getDbArray();
        $arrHash = $objFormParam->getHashArray();
        $objQuery->begin();
        $job_id = $this->registerJob($job_id, $arrValues, $arrHash);

        $arrDetail = $objFormParam->getSwapArray(array(
            'customer_id',
            'name01',
            'name02',
            'calendar_flag',
            'working_hour',
            'email',
            'overtime',
            'subtotal'
        ));

        $objQuery->delete('dtb_job_detail', 'sjob_id = ?', array($job_id));
        $objQuery->delete('dtb_job_date', 'sjob_id = ?', array($job_id));
        if (count($arrDetail) > 0) {
            foreach ($arrDetail as $arrParams) {
                $arrValues = $objQuery->extractOnlyColsOf('dtb_job_detail', $arrParams);
                $arrValues['sjob_id'] = $job_id;
                if (isset($_SESSION['working_calendar'][$arrValues['customer_id']])) {
                    foreach ($_SESSION['working_calendar'][$arrValues['customer_id']] as $working_day => $values) {
                        $arrDate = $values;
                        $arrDate['sjob_id'] = $job_id;
                        $objQuery->insert('dtb_job_date', $arrDate);
                    }
                    $arrValues['calendar_flag'] = 1;
                }
                else
                    $arrValues['calendar_flag'] = 0;
                $objQuery->insert('dtb_job_detail', $arrValues);
            }
        }

        $objQuery->commit();
        return $job_id;
    }

    function registerJob($job_id, $arrHash, $arrParams) {
        $table = 'dtb_job';
        $where = 'sjob_id = ?';
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $arrValues = $objQuery->extractOnlyColsOf($table, $arrHash);

        if (isset($arrParams['job_date_year']))
            $arrValues['job_date'] = $arrParams['job_date_year'] . '-' . $arrParams['job_date_month'] . '-' . $arrParams['job_date_day'];
        if (isset($arrParams['job_sche_date_from_year']))
            $arrValues['job_sche_date_from'] = $arrParams['job_sche_date_from_year'] . '-' . $arrParams['job_sche_date_from_month'] . '-' . $arrParams['job_sche_date_from_day'];
        if (isset($arrParams['job_sche_date_to_year']))
            $arrValues['job_sche_date_to'] = $arrParams['job_sche_date_to_year'] . '-' . $arrParams['job_sche_date_to_month'] . '-' . $arrParams['job_sche_date_to_day'];
        if (isset($arrParams['apply_date_year']))
            $arrValues['apply_date'] = $arrParams['apply_date_year'] . '-' . $arrParams['apply_date_month'] . '-' . $arrParams['apply_date_day'];
        if (isset($arrParams['cancel_date_year']))
            $arrValues['cancel_date'] = $arrParams['cancel_date_year'] . '-' . $arrParams['cancel_date_month'] . '-' . $arrParams['cancel_date_day'];
        if (isset($arrParams['job_start_time1']))
            $arrValues['job_start_time'] = $arrParams['job_start_time1'] . ':' . $arrParams['job_start_time2'];
        if (isset($arrParams['job_finish_time1']))
            $arrValues['job_finish_time'] = $arrParams['job_finish_time1'] . ':' . $arrParams['job_finish_time2'];
        if (isset($arrParams['binding_hour1']))
            $arrValues['binding_hour'] = $arrParams['binding_hour1'] . ':' . $arrParams['binding_hour2'];
        if (isset($arrParams['working_total1']))
            $arrValues['working_total'] = $arrParams['working_total1'] . ':' . $arrParams['working_total2'];
        if (isset($arrParams['break_time1']))
            $arrValues['break_time'] = $arrParams['break_time1'] . ':' . $arrParams['break_time2'];
        if (isset($arrParams['meeting_time1']))
            $arrValues['meeting_time'] = $arrParams['meeting_time1'] . ':' . $arrParams['meeting_time2'];
        if (isset($arrParams['roll_call_time1']))
            $arrValues['roll_call_time'] = $arrParams['roll_call_time1'] . ':' . $arrParams['roll_call_time2'];
        $arrValues['update_date'] = 'CURRENT_TIMESTAMP';

        $exists = $objQuery->exists($table, $where, array($job_id));
        if ($exists) {

            $objQuery->update($table, $arrValues, $where, array($job_id));
        } else {
            $arrValues['creator_id'] = $_SESSION['member_id'];
            $arrValues['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert($table, $arrValues);
            $job_id = $objQuery->conn->lastInsertID('dtb_job', 'sjob_id');
        }
        return $job_id;
    }

    /**
     * 受注商品の追加/更新を行う.
     *
     * 小画面で選択した受注商品をフォームに反映させる.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function doRegisterCustomer(&$objFormParam) {
        $customer_id = $objFormParam->getValue('add_customer_id');
        if (SC_Utils_Ex::isBlank($customer_id)) {
            $customer_id = $objFormParam->getValue('edit_customer_id');
            $changed_no = $objFormParam->getValue('no');
        }
        // FXIME バリデーションを通さず $objFormParam の値で DB 問い合わせしている。(管理機能ため、さほど問題は無いと思うものの…)
        // 商品規格IDが指定されていない場合、例外エラーを発生
        if (strlen($customer_id) === 0) {
            trigger_error('スタッフ規格指定なし', E_USER_ERROR);
        }

        // 選択済みの商品であれば数量を1増やす
        $exists = false;
        $arrExistsCustomerIds = $objFormParam->getValue('customer_id');
        foreach ($arrExistsCustomerIds as $key => $value) {
            $exists_customer_id = $arrExistsCustomerIds[$key];
            if ($exists_customer_id == $customer_id) {
                $exists = true;
                $exists_no = $key;
            }
        }

        // 新しく商品を追加した場合はフォームに登録
        // 商品を変更した場合は、該当行を変更
        if (!$exists) {
            $objQuery = SC_Query_Ex::getSingletonInstance();
            $arrCustomers = $objQuery->select('customer_id, name01, name02, email', 'dtb_customer', 'customer_id = ?', array($customer_id));
            $arrCustomer = $arrCustomers[0];
            $arrCustomer['calendar_flag'] = 0;

            // 一致する商品規格がない場合、例外エラーを発生
            if (empty($arrCustomer)) {
                trigger_error('スタッフ規格一致なし', E_USER_ERROR);
            }

            $arrUpdateKeys = array('customer_id', 'name01', 'name02', 'email', 'calendar_flag');
            foreach ($arrUpdateKeys as $key) {
                $arrValues = $objFormParam->getValue($key);
                // FIXME getValueで文字列が返る場合があるので配列であるかをチェック
                if (!is_array($arrValues)) {
                    $arrValues = array();
                }

                if (isset($changed_no)) {
                    $arrValues[$changed_no] = $arrCustomer[$key];
                } else {
                    $added_no = 0;
                    if (is_array($arrExistsCustomerIds)) {
                        $added_no = count($arrExistsCustomerIds);
                    }
                    $arrValues[$added_no] = $arrCustomer[$key];
                }
                $objFormParam->setValue($key, $arrValues);
            }
        } elseif (isset($changed_no) && $exists_no != $changed_no) {
            // 変更したが、選択済みの商品だった場合は、変更対象行を削除。
            $this->doDeleteCustomer($changed_no, $objFormParam);
        }
    }

    /**
     * 受注商品を削除する.
     *
     * @param integer $delete_no 削除する受注商品の項番
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function doDeleteCustomer($delete_no, &$objFormParam) {
        $arrDeleteKeys = array('customer_id', 'name01', 'name02', 'email', 'calendar_flag', 'working_hour', 'overtime', 'subtotal');
        foreach ($arrDeleteKeys as $key) {
            $arrNewValues = array();
            $arrValues = $objFormParam->getValue($key);
            foreach ($arrValues as $index => $val) {
                if ($index != $delete_no) {
                    $arrNewValues[] = $val;
                } else {
                    if ($key == 'customer_id')
                        unset($_SESSION['working_calendar'][$val]);
                }
            }
            $objFormParam->setValue($key, $arrNewValues);
        }
    }

    /**
     * アンカーキーを取得する.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return アンカーキーの文字列
     */
    function getAnchorKey(&$objFormParam) {
        $ancor_key = $objFormParam->getValue('anchor_key');
        if (!SC_Utils_Ex::isBlank($ancor_key)) {
            return "location.hash='#" . htmlentities(urlencode($ancor_key), ENT_QUOTES) . "'";
        }
        return '';
    }

}
