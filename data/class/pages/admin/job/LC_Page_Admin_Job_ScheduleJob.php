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
 * 帳票出力 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Job_ScheduleJob.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Job_ScheduleJob extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/schedule_job.tpl';
        $this->tpl_mainno = 'job';
        $this->tpl_subno = 'pdf';

        $this->arrTYPE[0] = 'ファーマプレミアムに依頼';
        $this->arrTYPE[1] = '自社';
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
        $objDate = new SC_Date_Ex(2003);
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

        $this->completed = 0;
        // どんな状態の時に isset($arrRet) == trueになるんだ? これ以前に$arrRet無いが、、、、
        if (!isset($arrRet))
            $arrRet = array();
        switch ($this->getMode()) {
            case 'confirm':
                $this->arrErr = $this->lfCheckError($this->objFormParam);
                if (count($this->arrErr) == 0) {
                    $this->registJob($objQuery, $this->objFormParam);
                    $this->completed = 1;
                }
                else
                    $this->arrForm = $_POST;
                break;
            default:
                $this->arrForm = $this->createFromValues($objQuery);
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

    /**
     *  パラメーター情報の初期化
     *  @param SC_FormParam
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('依頼番号', 'sjob_id', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('依頼番号', 'type', INT_LEN, 'n', array('MAX_LENGTH_CHECK', 'NUM_CHECK'), 0);
        $objFormParam->addParam('就業日', 'year', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業日', 'month', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業日', 'day', INT_LEN, 'n', array('EXIST_CHECK', 'MAX_LENGTH_CHECK', 'NUM_CHECK'));
        $objFormParam->addParam('就業時間1', 'working_start_all', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('就業時間2', 'working_over_all', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間1', 'breaktime_s_all', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('休憩時間2', 'breaktime_o_all', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('依頼人数', 'staff_count', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('メモ', 'memo', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
        $objFormParam->addParam('corporate', 'corporate_id');
        $objFormParam->addParam('agency', 'agency_id');
    }

    function lfCorporateParam(&$objFormParam) {
        $objFormParam->addParam('薬局名', 'ph_pharmacy_name');
        $objFormParam->addParam('就業部署', 'ph_work_location');
        $objFormParam->addParam('担当者名(姓)', 'ph_charge_firstname');
        $objFormParam->addParam('担当者名(名)', 'ph_charge_lastname');
        $objFormParam->addParam('担当者名(フリガナ・姓)', 'ph_charge_firstname_kana');
        $objFormParam->addParam('担当者名(フリガナ・名)', 'ph_charge_lastname_kana');
        $objFormParam->addParam('メールアドレス', 'ph_email_add');
        $objFormParam->addParam('郵便番号1', 'ph_zip_code1');
        $objFormParam->addParam('郵便番号2', 'ph_zip_code2');
        $objFormParam->addParam('都道府県', 'ph_pref');
        $objFormParam->addParam('住所1', 'ph_addr1');
        $objFormParam->addParam('住所2', 'ph_addr2');
        $objFormParam->addParam('電話番号1', 'ph_tel1');
        $objFormParam->addParam('電話番号2', 'ph_tel2');
        $objFormParam->addParam('電話番号3', 'ph_tel3');
        $objFormParam->addParam('FAX番号1', 'ph_fax1');
        $objFormParam->addParam('FAX番号2', 'ph_fax2');
        $objFormParam->addParam('FAX番号3', 'ph_fax3');
        $objFormParam->addParam('契約期間', 'ph_contract_period_s');
        $objFormParam->addParam('契約期間', 'ph_contract_period_o');
        $objFormParam->addParam('仕事内容', 'ph_job_description');
        $objFormParam->addParam('備考', 'ph_memo');
        $objFormParam->addParam('指揮命令者', 'ph_command_person_firstname');
        $objFormParam->addParam('指揮命令者', 'ph_command_person_lastname');
        $objFormParam->addParam('連絡先1', 'ph_per_tel1');
        $objFormParam->addParam('連絡先2', 'ph_per_tel2');
        $objFormParam->addParam('連絡先3', 'ph_per_tel3');
        $objFormParam->addParam('指揮命令者', 'ph_claim_offer_firstname');
        $objFormParam->addParam('指揮命令者', 'ph_claim_offer_lastname');
        $objFormParam->addParam('連絡先1', 'ph_offer_tel1');
        $objFormParam->addParam('連絡先2', 'ph_offer_tel2');
        $objFormParam->addParam('連絡先3', 'ph_offer_tel3');
        $objFormParam->addParam('指揮命令者', 'ph_conflict_date');
        $objFormParam->addParam('指揮命令者', 'ph_overtime_work');
        $objFormParam->addParam('福利厚生', 'ph_welfare');
    }

    function createFromValues($objQuery) {
        $arrForm = array();
        if (isset($_GET['sjob_id'])) {
            $arrJob = $objQuery->select('type, working_day_all, working_start_all, working_over_all, breaktime_s_all, breaktime_o_all, staff_count, memo', 'dtb_job', 'sjob_id = ?', array($_GET['sjob_id']));
            $arrForm['type'] = $arrJob[0]['type'];
            $arrForm['sjob_id'] = $_GET['sjob_id'];
            $arrForm['year'] = substr($arrJob[0]['working_day_all'], 0, 4);
            $arrForm['month'] = substr($arrJob[0]['working_day_all'], 5, 2);
            $arrForm['day'] = substr($arrJob[0]['working_day_all'], 8, 2);
            $arrForm['working_start_all'] = $arrJob[0]['working_start_all'];
            $arrForm['working_over_all'] = $arrJob[0]['working_over_all'];
            $arrForm['breaktime_s_all'] = $arrJob[0]['breaktime_s_all'];
            $arrForm['breaktime_o_all'] = $arrJob[0]['breaktime_o_all'];
            $arrForm['staff_count'] = $arrJob[0]['staff_count'];
            $arrForm['memo'] = $arrJob[0]['memo'];
        } else {
            $arrForm['type'] = 0;
            $arrForm['agency_id'] = $_SESSION['agency_id'];
            if (isset($_GET['corporate_id']))
                $arrForm['corporate_id'] = $_GET['corporate_id'];
            else
                $arrForm['corporate_id'] = $_SESSION['corporate_id'];
            $arrForm['year'] = date('Y', strtotime(substr($_GET['start'], 4, 11)));
            $arrForm['month'] = date('m', strtotime(substr($_GET['start'], 4, 11)));
            $arrForm['day'] = date('d', strtotime(substr($_GET['start'], 4, 11)));
            $arrForm['working_start_all'] = date('H:i', strtotime(substr($_GET['start'], 16, 8)));
            if ($arrForm['working_start_all'] == '00:00')
                $arrForm['working_start_all'] = '';
            $arrForm['working_over_all'] = date('H:i', strtotime(substr($_GET['end'], 16, 8)));
            if ($arrForm['working_over_all'] == '00:00')
                $arrForm['working_over_all'] = '';
            $arrForm['breaktime_s_all'] = date('H:i', strtotime(substr($_GET['start'], 16, 8)));
            if ($arrForm['breaktime_s_all'] == '00:00')
                $arrForm['breaktime_s_all'] = '';
            $arrForm['breaktime_o_all'] = date('H:i', strtotime(substr($_GET['end'], 16, 8)));
            if ($arrForm['breaktime_o_all'] == '00:00')
                $arrForm['breaktime_o_all'] = '';
        }
        return $arrForm;
    }

    /**
     *  入力内容のチェック
     *  @var SC_FormParam
     */
    function lfCheckError(&$objFormParam) {
        $arrErr = $objFormParam->checkError();

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

    function registJob($objQuery, $objFormParam) {
        if ($_POST['sjob_id'] == '') {
            $this->lfCorporateParam($objFormParam);
            $this->setcorporateTo($_POST['corporate_id'], &$objFormParam);
        }
        $arrRet = $objFormParam->getHashArray();

        if ($arrRet['month'] < 10)
            $arrRet['month'] = '0' . $arrRet['month'];
        if ($arrRet['day'] < 10)
            $arrRet['day'] = '0' . $arrRet['day'];
        $arrRet['working_day_all'] = $arrRet['year'] . '-' . $arrRet['month'] . '-' . $arrRet['day'];
        unset($arrRet['year']);
        unset($arrRet['month']);
        unset($arrRet['day']);
        $arrRet['update_date'] = 'CURRENT_TIMESTAMP';

        $sendMail = false;
        if ($arrRet['sjob_id'] > 0) {
            $oldJob = $objQuery->select('ph_pharmacy_name, ph_charge_firstname, ph_charge_lastname, ph_email_add, type', 'dtb_job', 'sjob_id = ?', array($arrRet['sjob_id']));
            unset($arrRet['agency_id']);
            unset($arrRet['corporate_id']);
            $objQuery->update('dtb_job', $arrRet, 'sjob_id = ?', array($arrRet['sjob_id']));

            if ($oldJob[0]['type'] == 1 && $arrRet['type'] == 0) {
                $sendMail = true;
                $arrRet['ph_pharmacy_name'] = $oldJob[0]['ph_pharmacy_name'];
                $arrRet['ph_charge_firstname'] = $oldJob[0]['ph_charge_firstname'];
                $arrRet['ph_charge_lastname'] = $oldJob[0]['ph_charge_lastname'];
                $arrRet['ph_email_add'] = $oldJob[0]['ph_email_add'];
            }
        } else {
            $sendMail = true;
            $agencyList = $objQuery->select('agency_name', 'dtb_agency', 'del_flg = 0 AND agency_id = ?', array($arrRet['agency_id']));
            $arrRet['agency_name'] = $agencyList[0]['agency_name'];
            $arrRet['status'] = 1;
            $arrRet['creator_id'] = $_SESSION['member_id'];
            $arrRet['yoyaku_date'] = 'CURRENT_TIMESTAMP';
            $arrRet['create_date'] = 'CURRENT_TIMESTAMP';
            $objQuery->insert('dtb_job', $arrRet);
            $arrRet['sjob_id'] = $objQuery->conn->lastInsertID('dtb_job', 'sjob_id');
        }
        if ($sendMail)
            $this->sendMail($arrRet);
    }

    function setcorporateTo($corporate_id, &$objFormParam) {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $arrCustomer = $objQuery->select('*', 'mtb_corporate', 'corporate_id = ?', array($corporate_id));
        foreach ($arrCustomer[0] as $key => $val)
            $objFormParam->setValue('ph_' . $key, $val);
    }

    function sendMail($arrValues) {
        $arrInfo = SC_Helper_DB_Ex::sfGetBasisData();

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= "From: " .
                "" . mb_encode_mimeheader(mb_convert_encoding($arrInfo['shop_name'], "ISO-2022-JP", "AUTO")) . "" .
                "<" . $arrInfo['email02'] . "> \r\n";

        $subject = 'ご依頼ありがとうございます。';
        $message = '
ご依頼ありがとうございます。<br /><br />
' . $arrValues["ph_pharmacy_name"] . '<br>
' . $arrValues["ph_charge_firstname"] . $arrValues["ph_charge_lastname"] . ' 様<br /><br />
いつもお世話になっております。<br />
下記の内容でご依頼を承りました。<br /><br />
就業日： ' . $arrValues['working_day_all'] . '<br />
就業時間： ' . $arrValues['working_start_all'] . ' ～ ' . $arrValues['working_over_all'] . '<br />
休憩時間： ' . $arrValues['breaktime_s_all'] . ' ～ ' . $arrValues['breaktime_o_all'] . '<br />
依頼人数： ' . $arrValues['staff_count'] . '<br />
備考： ' . $arrValues['memo'] . '<br /><br />
宜しくお願い致します。<br />';

        if ($arrValues['ph_email_add'] != '')
            mail($arrValues['ph_email_add'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);

//        $link = "http://test.pharmapremium.jp/admin/job/edit.php?sjob_id=" . $arrValues['sjob_id'];
        $link = "http://test.pharmapremium.jp/admin/job/edit.php?" . TRANSACTION_ID_NAME . "=" . $this->transactionid;
        $message .= '<br /><a href="' . $link . '">eccubeへ</a>';
        mail($arrInfo['email02'], '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers);
    }

}
