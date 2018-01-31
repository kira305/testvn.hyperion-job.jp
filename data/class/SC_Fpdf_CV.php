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

/**
 * PDF 納品書を出力する
 *
 * TODO ページクラスとすべき要素を多々含んでいるように感じる。
 */
define('PDF_TEMPLATE_REALDIR', TEMPLATE_ADMIN_REALDIR . 'pdf/');

class SC_Fpdf_CV extends SC_Helper_FPDI {

    var $customer_data;

    public function __construct() {
        $this->FPDF();
        // デフォルトの設定
        $this->tpl_pdf = PDF_TEMPLATE_REALDIR . 'cv.pdf';  // テンプレートファイル

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrSex = $masterData->getMasterData('mtb_sex');
        $this->arrMaritalStatus = $masterData->getMasterData('mtb_marital_status');
        $this->arrTarget = $masterData->getMasterData('mtb_object');
        $this->arrEducation = $masterData->getMasterData('mtb_education');
        $this->arrPosition = $masterData->getMasterData('mtb_position');
        $this->arrRegion = $masterData->getMasterData('mtb_region');
        $this->arrJLPT = $masterData->getMasterData('mtb_jlpt');
        $this->arrWorkExperience = array(1 => '経験あり', 0 => '未経験');
        $this->arrPref = $masterData->getMasterData('mtb_pref');
        $this->arrCategory = $masterData->getMasterData('mtb_category');

        // SJISフォント
        $this->AddSJISFont();
        $this->SetFont('SJIS');

        //ページ総数取得
        $this->AliasNbPages();

        // マージン設定
        $this->SetMargins(15, 20);

        // PDFを読み込んでページ数を取得
        $this->pageno = $this->setSourceFile($this->tpl_pdf);
    }

    public function setData() {
        // ページ番号よりIDを取得
        $tplidx = $this->ImportPage(1);
        // ページを追加（新規）
        $this->AddPage();
        //表示倍率(100%)
        $this->SetDisplayMode('real');
        // テンプレート内容の位置、幅を調整 ※useTemplateに引数を与えなければ100%表示がデフォルト
        $this->useTemplate($tplidx);

        $objCustomer = new SC_Customer_Ex();
        $customer_id = $objCustomer->getValue('customer_id');
        $this->customer_data = SC_Helper_Customer_Ex::sfGetCustomerData($customer_id);

        $fontSize = 7.5;
        $this->SetFont('Gothic', '', $fontSize);

        $x = 95;
        $y = 19;
        $lineHeight = 4.5;
        $this->Image(IMAGE_SAVE_REALDIR . $this->customer_data['image'], 15, 15, 40);
        $this->lfText($x, $y, $this->customer_data['name01'] . ' ' . $this->customer_data['name02'], $fontSize, '');
        $this->lfText($x, $y + $lineHeight, $this->arrSex[$this->customer_data['sex']], $fontSize, '');
        $this->lfText($x, $y + 2 * $lineHeight, $this->customer_data['year'] . '年' . $this->customer_data['month'] . '月' . $this->customer_data['day'] . '日', $fontSize, '');
        $this->lfText($x, $y + 3 * $lineHeight, $this->customer_data['email'], $fontSize, '');

        $x = 70;
        $y = 46;
        $lineHeight = 5.5;
        $this->lfText($x, $y, $this->arrMaritalStatus[$this->customer_data['marital_status']], $fontSize, '');
        $this->lfText($x, $y + $lineHeight, $this->arrTarget[$this->customer_data['current_address']], $fontSize, '');
        $this->lfText($x, $y + 2 * $lineHeight, '〒 ' . $this->customer_data['zip01'] . ' - ' . $this->customer_data['zip02'], $fontSize, '');
        $this->lfText($x, $y + 3 * $lineHeight, $this->arrPref[$this->customer_data['pref']], $fontSize, '');
        $this->lfText($x, $y + 4 * $lineHeight, $this->customer_data['addr01'], $fontSize, '');
        $this->lfText($x, $y + 5 * $lineHeight, $this->customer_data['addr02'], $fontSize, '');
        $this->lfText($x, $y + 6 * $lineHeight, $this->arrEducation[$this->customer_data['education']], $fontSize, '');
        $this->lfText($x, $y + 7 * $lineHeight, $this->customer_data['school_name'], $fontSize, '');
        $this->lfText($x, $y + 8 * $lineHeight, $this->customer_data['major'], $fontSize, '');
        $this->lfText($x, $y + 9 * $lineHeight, $this->arrWorkExperience[$this->customer_data['work_experience']], $fontSize, '');

        if ($this->customer_data['work_experience'] == 1) {
            $x = 13;
            $y = 113;
            for ($i = 0; $i < 6; $i++) {
                $workingDate = '';
                if ($this->customer_data['start_year'][$i] > 0 || $this->customer_data['end_year'][$i] > 0) {
                    if ($this->customer_data['start_year'][$i] > 0)
                        $workingDate .= $this->customer_data['start_year'][$i] . '年' . $this->customer_data['start_month'][$i] . '月';
                    else
                        $workingDate .= '未登録';
                    $workingDate .= ' ~ ';
                    if ($this->customer_data['end_year'][$i] > 0)
                        $workingDate .= $this->customer_data['end_year'][$i] . '年' . $this->customer_data['end_month'][$i] . '月';
                    else
                        $workingDate .= '未登録';
                }
                $this->SetXY($x, $y);
                $this->MultiCell(42, $lineHeight, $workingDate, 0, 'L', false);
                $this->SetXY($x + 42, $y);
                $this->MultiCell(14, $lineHeight, $this->customer_data['working_year'][$i], 0, 'C', false);
                $this->SetXY($x + 56, $y);
                $this->MultiCell(42, $lineHeight, $this->customer_data['working_company_name'][$i], 0, 'L', false);
                $this->SetXY($x + 98, $y);
                $this->MultiCell(42, $lineHeight, $this->customer_data['company_addr'][$i], 0, 'L', false);
                $this->SetXY($x + 140, $y);
                $this->MultiCell(42, $lineHeight, $this->customer_data['job_description'][$i], 0, 'L', false);
                $y += 2 * $lineHeight;
            }
        }

        $x = 70;
        $y = 187;
        $this->SetXY($x - 1, 172.3);
        $this->MultiCell(126, $lineHeight, $this->arrIdToStrValue($this->arrCategory, $this->customer_data['desired_work']), 0, 'L', false);
        $this->lfText($x, $y, $this->arrIdToStrValue($this->arrPosition, $this->customer_data['desired_position']), $fontSize, '');
        if ($this->customer_data['current_salary'] != '' && $this->customer_data['current_salary'] > 1)
            $this->lfText($x, $y + $lineHeight, $this->customer_data['current_salary'], $fontSize, '');
        if ($this->customer_data['desired_salary'] != '' && $this->customer_data['desired_salary'] > 1)
            $this->lfText($x, $y + 2 * $lineHeight, $this->customer_data['desired_salary'], $fontSize, '');
        $this->lfText($x, $y + 3 * $lineHeight, $this->arrIdToStrValue($this->arrRegion, $this->customer_data['desired_region']), $fontSize, '');

        $y = 213;
        $this->lfText($x, $y, 'JLPT：' . $this->arrJLPT[$this->customer_data['jp_level']] . '　　その他：' . $this->customer_data['jp_other'], $fontSize, '');
        $this->lfText($x, $y + $lineHeight, 'TOEIC：' . $this->customer_data['toeic'] . '　　IELTS：' . $this->customer_data['ielts'] . '　　その他：' . $this->customer_data['eng_other'], $fontSize, '');
        $this->SetXY($x - 1, 220.5);
        $this->MultiCell(126, $lineHeight, $this->customer_data['other_language'], 0, 'L', false);

        $this->SetXY($x - 1, 236);
        $this->MultiCell(126, $lineHeight, $this->customer_data['qualification'], 0, 'L', false);
        $this->SetXY($x - 1, 251.6);
        $this->MultiCell(126, $lineHeight, $this->customer_data['skill'], 0, 'L', false);
        $this->SetXY($x - 1, 267.4);
        $this->MultiCell(126, $lineHeight, $this->customer_data['self_pr'], 0, 'L', false);
    }

    public function createPdf() {
        ob_clean();
        $filename = 'CV-' . $this->customer_data['customer_id'] . '.pdf';
        $this->Output($this->lfConvSjis($filename), 'D');

        // 入力してPDFファイルを閉じる
        $this->Close();
    }

    public function arrIdToStrValue($arrVal, $arrId) {
        $strValue = '';
        if (count($arrId) > 0) {
            foreach ($arrId as $i => $id) {
                if ($i == 0)
                    $strValue .= $arrVal[$id];
                else
                    $strValue .= '、' . $arrVal[$id];
            }
        }
        return $strValue;
    }

    // PDF_Japanese::Text へのパーサー

    /**
     * @param integer $x
     * @param integer $y
     */
    private function lfText($x, $y, $text, $size = 0, $style = '') {
        // 退避
        $bak_font_style = $this->FontStyle;
        $bak_font_size = $this->FontSizePt;

        $this->SetFont('', $style, $size);
        $this->Text($x, $y, $text);

        // 復元
        $this->SetFont('', $bak_font_style, $bak_font_size);
    }

}
