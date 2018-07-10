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

/**
 * PDF 納品書を出力する
 *
 * TODO ページクラスとすべき要素を多々含んでいるように感じる。
 */
define('PDF_TEMPLATE_REALDIR', TEMPLATE_ADMIN_REALDIR . 'pdf/');

class SC_Fpdf_Job extends SC_Helper_FPDI {

    function __construct($arrVal) {
        $this->FPDF();
        $this->tpl_dispmode = 'real';
        foreach ($arrVal as $key => $value)
            $this->$key = $value;
        $this->AddSJISFont();
        $this->SetFont('Gothic');
        $this->AliasNbPages();

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
    }

    function setData($sjob_id) {
        $this->sjob_id = $sjob_id;
        $this->SetDisplayMode($this->tpl_dispmode);
        if (SC_Utils_Ex::sfIsInt($sjob_id))
            $this->disp_mode = true;

        $this->lfGetJobData($this->sjob_id);
        if (SC_Utils_Ex::sfIsInt($this->title))
            $this->setFrontPage();

        foreach ($this->type as $type) {
            if ($type == 1 || $type == 2) {
                $ph_contract_period_s = $this->arrDisp['ph_contract_period_s'];
                list($yy, $mm, $dd) = explode("-", $ph_contract_period_s);
                if ($this->arrDisp['ph_contract_period_s'] == '' || !checkdate($mm, $dd, $yy))
                    $ph_contract_period_s = '1900-01-01';
                $ph_contract_period_o = $this->arrDisp['ph_contract_period_o'];
                list($yy, $mm, $dd) = explode("-", $ph_contract_period_o);
                if ($this->arrDisp['ph_contract_period_o'] == '' || !checkdate($mm, $dd, $yy))
                    $ph_contract_period_o = '2100-12-31';
                $startDate = new DateTime($ph_contract_period_s);
                $overDate = new DateTime($ph_contract_period_o);
                $staff = array();
                $max = count($this->arrDisp['cid']);
                for ($i = 0; $i < $max; $i++) {
                    $working_day = new DateTime($this->arrDisp['working_day'][$i]);
                    if ($startDate <= $working_day && $working_day <= $overDate) {
                        if (!in_array($this->arrDisp['cid'][$i], $staff['staff_ids']))
                            $staff['staff_ids'][] = $this->arrDisp['cid'][$i];
                        list($yy, $mm, $dd) = explode("-", $this->arrDisp['working_day'][$i]);
                        $wday = $mm . '/' . $dd;
                        if (!in_array($wday, $staff['working_days']))
                            $staff['working_days'][] = $wday;
                        $time = $this->arrDisp['working_start'][$i] . '- ' . $this->arrDisp['working_over'][$i];
                        if (!in_array($time, $staff['working_times']))
                            $staff['working_times'][] = $time;
                        $timeDiff = $this->time_diff($this->arrDisp['breaktime_s'][$i], $this->arrDisp['breaktime_o'][$i]);
                        $staff['allBreakTime'] += $timeDiff;
                    }
                }
            }
            switch ($type) {
                case '1':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '14.pdf');
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setJobData($type, 0, $staff);
                    $this->setKiyakuData($type);
                    break;
                case '2':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '15.pdf');
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setJobData($type, 0, $staff);
                    $this->setKiyakuData($type);
                    break;
                case '3':
//                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '16.pdf');
                    break;
                case '4':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '21.pdf');
                    $max = count($this->arrDisp['customer_id']);
                    for ($i = 0; $i < $max; $i++) {
                        $tplidx = $this->ImportPage(1);
                        $this->AddPage();
                        $this->useTemplate($tplidx);
                        $this->setJobData($type, $i);
                        $this->setKiyakuData($type);
                    }
                    break;
                case '5':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '22.pdf');
                    $max = count($this->arrDisp['customer_id']);
                    for ($i = 0; $i < $max; $i++) {
                        $tplidx = $this->ImportPage(1);
                        $this->AddPage();
                        $this->useTemplate($tplidx);
                        $this->setJobData($type, $i);
                    }
                    break;
                case '6':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '23.pdf');
                    $max = count($this->arrDisp['customer_id']);
                    for ($i = 0; $i < $max; $i++) {
                        $tplidx = $this->ImportPage(1);
                        $this->AddPage();
                        $this->useTemplate($tplidx);
                        $this->setKiyakuData($type);
                    }
                    break;
                case '7':
//                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '24.pdf');
                    break;
                case '8':
//                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '25.pdf');
                    break;
                default:
                    break;
            }
        }
    }

    function setFrontPage() {
        $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '27.pdf');
        switch ($this->title) {
            case '1':
                $tplidx = $this->ImportPage(1);
                $this->AddPage();
                $this->useTemplate($tplidx);
                $this->lfText(30, 30, '〒 ' . $this->arrDisp['zip01'] . ' - ' . $this->arrDisp['zip02'], 12, '');
                $this->lfText(30, 38, $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'], 12, '');
                $this->lfText(30, 46, $this->arrDisp['agency_name'], 12, '');
                $this->setFrontData();
                break;
            case '2':
                $tplidx = $this->ImportPage(1);
                $this->AddPage();
                $this->useTemplate($tplidx);
                $this->lfText(30, 30, '〒 ' . $this->arrDisp['ph_zip_code1'] . ' - ' . $this->arrDisp['ph_zip_code2'], 12, '');
                $this->lfText(30, 38, $this->arrPref[$this->arrDisp['ph_pref']] . $this->arrDisp['ph_addr1'] . $this->arrDisp['ph_addr2'], 12, '');
                $this->lfText(30, 46, $this->arrDisp['ph_pharmacy_name'], 12, '');
                $this->setFrontData();
                break;
            case '3':
                $this->lfGetCustomerData();
                foreach ($this->arrDisp['cus_zip01'] as $customer_id => $zip01) {
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->lfText(30, 30, '〒 ' . $zip01 . ' - ' . $this->arrDisp['cus_zip02'][$customer_id], 12, '');
                    $this->lfText(30, 38, $this->arrPref[$this->arrDisp['cus_pref'][$customer_id]] . $this->arrDisp['cus_addr01'][$customer_id] . $this->arrDisp['cus_addr02'][$customer_id], 12, '');
                    $this->lfText(30, 46, $this->arrDisp['cus_name01'][$customer_id] . $this->arrDisp['cus_name02'][$customer_id], 12, '');
                    $this->setFrontData();
                }
                break;
            default:
                break;
        }
    }

    function setFrontData() {
        $this->lfText(147, 30, $this->year . '年' . $this->month . '月' . $this->day . '日', 12, '');
        $this->lfText(156, 105, $this->arrDisp['pp_tantousya'], 12, '');
        $this->SetFont('', '', 11);
        $this->Cell(0, 165, '', 0, 0, 'C');
        $this->Ln();
        $height = 6.5;
        if (!SC_Utils_Ex::isBlank($this->msg1)) {
            $this->Cell(0, $height, $this->msg1, 0, 0, 'C');
            $this->Ln();
        }
        if (!SC_Utils_Ex::isBlank($this->msg2)) {
            $this->Cell(0, $height, $this->msg2, 0, 0, 'C');
            $this->Ln();
        }
        if (!SC_Utils_Ex::isBlank($this->msg3)) {
            $this->Cell(0, $height, $this->msg3, 0, 0, 'C');
            $this->Ln();
        }
        if (!SC_Utils_Ex::isBlank($this->msg4)) {
            $this->Cell(0, $height, $this->msg4, 0, 0, 'C');
            $this->Ln();
        }
        if (!SC_Utils_Ex::isBlank($this->msg5)) {
            $this->Cell(0, $height, $this->msg5, 0, 0, 'C');
            $this->Ln();
        }
        if (!SC_Utils_Ex::isBlank($this->msg6)) {
            $this->Cell(0, $height, $this->msg6, 0, 0, 'C');
            $this->Ln();
        }
        $this->lfText(30, 230, '【備考】', 11, '');
        $this->Cell(0, 20, '', 0, 1, 'C', 0, '');
        $this->SetXY(29, 235);
        $this->MultiCell(230, $height, $this->note, 0, 'L', false);
    }

    function setJobData($type, $index = 0, $staff = array()) {
        $ph_contract_period_s = str_replace('-', '- ', $this->arrDisp['ph_contract_period_s']);
        $ph_contract_period_o = str_replace('-', '- ', $this->arrDisp['ph_contract_period_o']);
        $ph_conflict_date = str_replace('-', '- ', $this->arrDisp['ph_conflict_date']);
        switch ($type) {
            case '1':
                $this->lfText(66, 31, $this->arrDisp['agency_name'], 9, '');
                list($yy, $mm, $dd) = explode('-', $this->arrDisp['ph_contract_period_s']);
                $this->lfText(78, 38.4, $yy . '年' . $mm . '月' . $dd . '日', 9, '');
                $this->lfText(58, 49, $this->arrDisp['agency_name'], 8, '');
                $text = '〒 ' . $this->arrDisp['zip01'] . ' - ' . $this->arrDisp['zip02'];
                $text .= $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'];
                $this->lfText(58, 52.5, $text, 8, '');
                $this->lfText(58, 55.5, $this->arrDisp['ph_work_location'], 8, '');
                $text = '〒 ' . $this->arrDisp['ph_zip_code1'] . ' - ' . $this->arrDisp['ph_zip_code2'];
                $text .= $this->arrPref[$this->arrDisp['ph_pref']] . $this->arrDisp['ph_addr1'] . $this->arrDisp['ph_addr2'];
                $this->lfText(58, 58.8, $text, 8, '');
                $this->lfText(88, 61.8, $this->arrDisp['ph_command_person_firstname'] . ' ' . $this->arrDisp['ph_command_person_lastname'], 8, '');
                $text = $this->arrDisp['ph_per_tel1'] . ' - ' . $this->arrDisp['ph_per_tel2'] . ' - ' . $this->arrDisp['ph_per_tel3'];
                $this->lfText(135, 61.8, $text, 8, '');
                $this->lfText(88, 65, $this->arrDisp['ph_charge_firstname'] . ' ' . $this->arrDisp['ph_charge_lastname'], 8, '');
                $text = $this->arrDisp['ph_tel1'] . ' - ' . $this->arrDisp['ph_tel2'] . ' - ' . $this->arrDisp['ph_tel3'];
                $this->lfText(135, 65, $text, 8, '');
                $this->lfText(88, 68.2, $this->arrDisp['ph_claim_offer_firstname'] . ' ' . $this->arrDisp['ph_claim_offer_lastname'], 8, '');
                $text = $this->arrDisp['ph_offer_tel1'] . ' - ' . $this->arrDisp['ph_offer_tel2'] . ' - ' . $this->arrDisp['ph_offer_tel3'];
                $this->lfText(135, 68.2, $text, 8, '');
                $this->lfText(58, 83, $this->arrDisp['ph_job_description'], 8, '');
                $this->lfText(58, 87.8, $ph_contract_period_s . ' ～ ' . $ph_contract_period_o, 8, '');
                $this->lfText(152, 87.8, $ph_conflict_date, 8, '');
                $this->lfText(58, 91, count($staff['staff_ids']) . '人', 8, '');
                $this->lfText(58, 94, SC_Utils_Ex::sfGetCommaList($staff['working_days']), 8, '');
                $this->lfText(58, 97, SC_Utils_Ex::sfGetCommaList($staff['working_times']), 8, '');
                if ($staff['allBreakTime'] == 0)
                    $this->lfText(58, 100.5, 'なし', 8, '');
                else
                    $this->lfText(58, 100.5, $staff['allBreakTime'], 8, '');
                $this->lfText(58, 103.8, $this->arrDisp['ph_overtime_work'], 8, '');
                $this->lfText(58, 107.5, $this->arrDisp['payment_terms'], 8, '');
                $this->lfText(58, 236, $this->arrDisp['contract_notice'], 8, '');

                $text = '〒 ' . $this->arrDisp['zip01'] . ' - ' . $this->arrDisp['zip02'];
                $this->lfText(35, 260, $text, 9, '');
                $text = $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'];
                $this->lfText(35, 264, $text, 9, '');
                $this->lfText(35, 268, $this->arrDisp['agency_name'], 9, '');
                $this->lfText(35, 272, $this->arrDisp['agency_di_name01'] . ' ' . $this->arrDisp['agency_di_name02'], 9, '');
                $this->lfText(152, 252, $this->year . '年' . $this->month . '月' . $this->day . '日', 9, '');
                break;
            case '2':
                if ($this->title != 3)
                    $this->lfGetCustomerData();
                $this->lfText(30, 18, $this->arrDisp['agency_name'], 12, '');
                $text = '〒' . $this->arrDisp['ph_zip_code1'] . ' - ' . $this->arrDisp['ph_zip_code2'] . ' ';
                $text .= $this->arrPref[$this->arrDisp['ph_pref']] . $this->arrDisp['ph_addr1'] . $this->arrDisp['ph_addr2'];
                $this->lfText(45, 50, $text, 8, '');
                $this->lfText(45, 55, $this->arrDisp['ph_job_description'], 8, '');
                $this->lfText(53, 60, $ph_contract_period_s, 8, '');
                $this->lfText(90, 60, $ph_contract_period_o, 8, '');
                $this->lfText(45, 65, SC_Utils_Ex::sfGetCommaList($staff['working_times']), 8, '');
                $this->lfText(65, 69.5, $this->arrDisp['ph_charge_firstname'] . ' ' . $this->arrDisp['ph_charge_lastname'], 8, '');
                $this->lfText(65, 74.5, $this->arrDisp['ph_claim_offer_firstname'] . ' ' . $this->arrDisp['ph_claim_offer_lastname'], 8, '');
                $this->lfText(65, 79.5, $this->arrDisp['ph_command_person_firstname'] . ' ' . $this->arrDisp['ph_command_person_lastname'], 8, '');

                $height = 119;
                foreach ($staff['staff_ids'] as $i) {
                    $this->lfText(16, $height, $this->arrDisp['cus_name01'][$i] . ' ' . $this->arrDisp['cus_name02'][$i], 8, '');
                    $this->lfText(48, $height, $this->arrDisp['age'][$i], 8, '');
                    $this->lfText(57.5, $height, $this->arrDisp['sex'][$i], 8, '');
                    $this->lfText(77, $height, '加入', 8, '');
                    $this->lfText(106, $height, '加入', 8, '');
                    $this->lfText(136, $height, '加入', 8, '');
                    $height+=6.5;
                }
                break;
            case '3':
                break;
            case '4':
                $this->lfText(87, 40, $this->arrDisp['customer_id'][$index], 10, '');
                $this->lfText(135, 40, $this->arrDisp['name01'][$index] . ' ' . $this->arrDisp['name02'][$index], 10, '');
                $this->lfText(65, 46, $this->arrDisp['ph_job_description'], 10, '');
                $this->lfText(43.5, 52, $this->arrDisp['ph_pharmacy_name'], 10, '');
                $text = '〒 ' . $this->arrDisp['ph_zip_code1'] . ' - ' . $this->arrDisp['ph_zip_code2'];
                $text .= $this->arrPref[$this->arrDisp['ph_pref']] . $this->arrDisp['ph_addr1'] . $this->arrDisp['ph_addr2'];
                $this->lfText(43.5, 58, $text, 10, '');
                $this->lfText(66, 64, $this->arrDisp['ph_command_person_firstname'] . ' ' . $this->arrDisp['ph_command_person_lastname'], 10, '');
                $this->lfText(54, 70, $ph_contract_period_s, 10, '');
                $this->lfText(88, 70, $ph_contract_period_o, 10, '');
                $this->lfText(164, 70, $ph_conflict_date, 10, '');

                $staff = array();
                foreach ($this->arrDisp['cid'] as $i => $cid) {
                    if ($cid == $this->arrDisp['customer_id'][$index]) {
                        list($yy, $mm, $dd) = explode("-", $this->arrDisp['working_day'][$i]);
                        $wday = $mm . '/' . $dd;
                        if (!in_array($wday, $staff['working_days']))
                            $staff['working_days'][] = $wday;
                        $time = $this->arrDisp['working_start'][$i] . '- ' . $this->arrDisp['working_over'][$i];
                        if (!in_array($time, $staff['working_times']))
                            $staff['working_times'][] = $time;
                        $timeDiff = $this->time_diff($this->arrDisp['breaktime_s'][$i], $this->arrDisp['breaktime_o'][$i]);
                        $allBreakTime += $timeDiff;
                    }
                }
                $this->lfText(43.5, 76, SC_Utils_Ex::sfGetCommaList($staff['working_days']), 10, '');
                $this->lfText(43.5, 82, SC_Utils_Ex::sfGetCommaList($staff['working_times']), 10, '');
                if ($allBreakTime == 0)
                    $this->lfText(60, 88, 'なし', 8, '');
                else
                    $this->lfText(60, 88, $allBreakTime, 10, '');
                $this->lfText(79, 160, $this->arrDisp['ph_charge_firstname'] . ' ' . $this->arrDisp['ph_charge_lastname'], 10, '');
                $this->lfText(66.5, 232.5, $this->arrDisp['ph_charge_firstname'] . ' ' . $this->arrDisp['ph_charge_lastname'], 10, '');
                $this->lfText(43.5, 238.5, $this->arrDisp['ph_overtime_work'], 10, '');
                $this->lfText(43.5, 244.5, $this->arrDisp['ph_welfare'], 10, '');
                break;
            case '5':
                $this->lfGetCorporateData();
                $this->lfText(65, 51, $this->arrDisp['ph_pharmacy_name'], 16, '');
                $this->lfText(160, 50.5, $this->arrDisp['corporate_id'], 12, '');
                $addr = $this->arrPref[$this->arrDisp['ph_pref']] . $this->arrDisp['ph_addr1'] . $this->arrDisp['ph_addr2'];
                $this->lfText(37, 63, $addr, 11, '');
                $this->lfText(37, 71, $this->arrDisp['access'], 11, '');
                $text = $this->arrDisp['ph_tel1'] . ' - ' . $this->arrDisp['ph_tel2'] . ' - ' . $this->arrDisp['ph_tel3'];
                $this->lfText(37, 79, $text, 11, '');
                $text = $this->arrDisp['ph_fax1'] . ' - ' . $this->arrDisp['ph_fax2'] . ' - ' . $this->arrDisp['ph_fax3'];
                $this->lfText(125, 79, $text, 11, '');
                $this->lfText(73, 87, $this->arrDisp['main_authority'], 11, '');
                $this->lfText(37, 95, $this->arrDisp['kamoku'], 11, '');
                $this->lfText(170, 95, $this->arrDisp['prescriptions'], 11, '');
                $this->lfText(37, 103, $this->arrDisp['ph_job_description'], 11, '');
                $this->lfText(54, 111, $this->arrDisp['ph_charge_firstname'] . ' ' . $this->arrDisp['ph_charge_lastname'], 11, '');
                if ($this->arrDisp['medication_his'] == 1)
                    $this->lfText(118, 111, '√', 8, '');
                else
                    $this->lfText(131, 111, '√', 8, '');
                if ($this->arrDisp['b_room'] == 1)
                    $this->lfText(160, 111, '√', 8, '');
                else
                    $this->lfText(173, 111, '√', 8, '');
                $this->lfText(37, 119, $this->arrDisp['num_of_pharmacists'], 11, '');
                $this->lfText(73, 119, $this->arrDisp['o_staff'], 11, '');
                $this->lfText(120, 119, $this->arrDisp['work_hour_s'], 11, '');
                $this->lfText(151, 119, $this->arrDisp['work_hour_o'], 11, '');
                $this->SetXY(53, 124);
                $this->MultiCell(205, 5, $this->arrDisp['necessities'], 0, 'L', false);
                $this->lfText(54, 141, $this->arrDisp['environ'], 11, '');
                $this->SetXY(53, 145);
                $this->MultiCell(205, 5, $this->arrDisp['notices'], 0, 'L', false);
                $this->SetXY(53, 158);
                $this->MultiCell(205, 5, $this->arrDisp['ph_memo'], 0, 'L', false);
                if ($this->arrDisp['gmap_src'] != '')
                    $this->Image($this->arrDisp['gmap_src'], 50, 175, 135, 90, 'JPG');
                break;
            default:
                break;
        }
    }

    function setKiyakuData($type) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        $objQuery->setOrder('rank DESC');
        switch ($type) {
            case '1':
                $this->SetLeftMargin(58);
                $this->Cell(0, 57.6, '', 0, 2, '', 0, '');
                $kiyaku_type = 2;
                $h = 3.5;
                $width = 117;
                $this->SetFont('Gothic', '', 6.5);
                break;
            case '4':
                $this->SetLeftMargin(43.5);
                $this->Cell(0, 46, '', 0, 2, '', 0, '');
                $kiyaku_type = 5;
                $h = 6;
                $width = 140;
                $this->SetFont('Gothic', '', 10);
                break;
            case '6':
                $this->SetLeftMargin(15);
                $this->Cell(0, 20, '', 0, 2, '', 0, '');
                $kiyaku_type = 6;
                $h = 4.4;
                $width = 180;
                $this->SetFont('Gothic', '', 9);
                break;
            default:
                break;
        }

        $arrRet = $objQuery->select('*', 'dtb_kiyaku', 'kiyaku_type = ? AND del_flg = 0', array($kiyaku_type));
        $arrRet = SC_Utils_Ex::sfSwapArray($arrRet);

        $arrKiyaku = array();

        if ($type == 6) {
            $j = 0;
            for ($i = 0; $i < count($arrRet['kiyaku_id']); $i++) {
                $arrKiyaku[$j][0] = $arrRet['kiyaku_title'][$i];
                $arrKiyaku[$j][1] = '';
                $arrKiyaku[$j + 1][0] = $arrRet['kiyaku_text'][$i];
                $arrKiyaku[$j + 1][1] = '';
                $j+=2;
            }
            $this->FancyTableExtended($arrKiyaku, array($width, 0.1), 'L', true, true, $h);
        } else {
            if ($type == 4) {
                for ($i = 0; $i < count($arrRet['kiyaku_id']) - 1; $i++) {
                    $arrKiyaku[$i][0] = $arrRet['kiyaku_text'][$i];
                    $arrKiyaku[$i][1] = '';
                }
                $this->FancyTableExtended($arrKiyaku, array($width, 0.1), 'L', false, false, $h);

                $this->Cell(0, 0, '', 0, 2, '', 0, '');
                $arrKiyaku = array();
                $arrKiyaku[0][0] = $arrRet['kiyaku_text'][count($arrRet['kiyaku_id']) - 1];
                $arrKiyaku[0][1] = '';
                $this->FancyTableExtended($arrKiyaku, array($width, 0.1), 'L', false, false, 4.2);
            } else {
                for ($i = 0; $i < count($arrRet['kiyaku_id']); $i++) {
                    $arrKiyaku[$i][0] = $arrRet['kiyaku_text'][$i];
                    $arrKiyaku[$i][1] = '';
                }
                $this->FancyTableExtended($arrKiyaku, array($width, 0.1), 'L', false, false, $h);
            }
        }
    }

    function lfGetJobData($sjob_id) {
        if (SC_Utils_Ex::sfIsInt($sjob_id)) {
            // DBから受注情報を読み込む
            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $where = 'sjob_id = ?';
            $arrRet = $objQuery->select('*', 'dtb_job', $where, array($sjob_id));
            $this->arrDisp = $arrRet[0];

            $arrRet = $objQuery->select('zip01,zip02,pref,addr01,addr02,payment_terms,agency_di_name01,agency_di_name02,pp_tantousya', 'dtb_agency', 'agency_id = ?', array($this->arrDisp['agency_id']));
            $this->arrDisp = array_merge($this->arrDisp, $arrRet[0]);

            $arrRet = $objQuery->select('customer_id,name01,name02', 'dtb_job_detail', $where, array($sjob_id));
            $arrRet = SC_Utils_Ex::sfSwapArray($arrRet);
            $this->arrDisp = array_merge($this->arrDisp, $arrRet);

            $arrRet = $objQuery->select('customer_id as cid,working_day,working_start,working_over,breaktime_s,breaktime_o', 'dtb_job_date', $where . ' AND customer_id IN (' . SC_Utils_Ex::sfGetCommaList($this->arrDisp['customer_id']) . ')', array($sjob_id));
            $arrRet = SC_Utils_Ex::sfSwapArray($arrRet);
            $this->arrDisp = array_merge($this->arrDisp, $arrRet);
        }
    }

    function lfGetCustomerData() {
        $masterData = new SC_DB_MasterData_Ex();
        $arrSex = $masterData->getMasterData('mtb_sex');
        $today = new DateTime();
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrRet = $objQuery->select('customer_id,name01,name02,zip01,zip02,pref,addr01,addr02,sex,birth', 'dtb_customer', 'customer_id IN (' . SC_Utils_Ex::sfGetCommaList($this->arrDisp['customer_id']) . ')');
        foreach ($arrRet as $customer) {
            $this->arrDisp['cus_name01'][$customer['customer_id']] = $customer['name01'];
            $this->arrDisp['cus_name02'][$customer['customer_id']] = $customer['name02'];
            $this->arrDisp['cus_zip01'][$customer['customer_id']] = $customer['zip01'];
            $this->arrDisp['cus_zip02'][$customer['customer_id']] = $customer['zip02'];
            $this->arrDisp['cus_pref'][$customer['customer_id']] = $customer['pref'];
            $this->arrDisp['cus_addr01'][$customer['customer_id']] = $customer['addr01'];
            $this->arrDisp['cus_addr02'][$customer['customer_id']] = $customer['addr02'];
            $this->arrDisp['sex'][$customer['customer_id']] = $arrSex[$customer['sex']];
            $birthdate = new DateTime(substr($customer['birth'], 0, 10));
            $interval = $today->diff($birthdate);
            $this->arrDisp['age'][$customer['customer_id']] = $interval->format('%y');
        }
    }

    function lfGetCorporateData() {
        if (SC_Utils_Ex::sfIsInt($this->arrDisp['corporate_id'])) {
            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $arrRet = $objQuery->select('main_authority,kamoku,prescriptions,medication_his,num_of_pharmacists,o_staff,work_hour_s,work_hour_o,b_room,necessities,environ,notices,nearest,access,gmap_src', 'mtb_corporate', 'corporate_id = ?', array($this->arrDisp['corporate_id']));
            $this->arrDisp = array_merge($this->arrDisp, $arrRet[0]);
        }
    }

    function time_diff($start_time, $over_time) {
        list($current_hour, $current_min) = explode(':', $over_time);
        list($ref_hour, $ref_min) = explode(':', $start_time);

        if ($current_hour < $ref_hour || ($current_hour == $ref_hour && $current_min < $ref_min)) {
            $current_hour += 12;
            if ($current_hour <= $ref_hour)
                $current_hour += 12;
        }

        $hDf = $current_hour - $ref_hour;
        $mDf = $current_min - $ref_min;

        if ($hDf > 0) {
            if ($mDf < 0) {
                $mDf = 60 + $mDf;
                $hDf -= 1;
            }
            return $hDf * 60 + $mDf;
        } else {
            if ($mDf > 0) {
                return $mDf;
            }
        }
        return '0';
    }

    function createPdf() {
        // PDFをブラウザに送信
        ob_clean();
        if ($this->download == 1) {
            if ($this->PageNo() == 1) {
                $filename = 'Job-No' . $this->sjob_id . '.pdf';
            } else {
                $filename = 'Job.pdf';
            }
            $this->Output($this->lfConvSjis($filename), 'D');
        } else {
            $this->Output();
        }

        // 入力してPDFファイルを閉じる
        $this->Close();
    }

    // PDF_Japanese::Text へのパーサー
    function lfText($x, $y, $text, $size = 0, $style = '') {
        // 退避
        $bak_font_style = $this->FontStyle;
        $bak_font_size = $this->FontSizePt;

        $this->SetFont('', $style, $size);
        $this->Text($x, $y, $text);

        // 復元
        $this->SetFont('', $bak_font_style, $bak_font_size);
    }

}
