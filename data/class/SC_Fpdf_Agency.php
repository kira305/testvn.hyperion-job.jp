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

class SC_Fpdf_Agency extends SC_Helper_FPDI {

    function __construct($download, $type) {
        $this->FPDF();
        $this->pdf_download = $download;
        $this->tpl_dispmode = 'real';
        $this->type = $type;
        $this->AddSJISFont();
        $this->SetFont('Gothic');
        $this->AliasNbPages();

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPref = $masterData->getMasterData('mtb_pref');
    }

    function setData($arrData) {
        $this->arrData = $arrData;
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $arrRet = $objQuery->select('*', 'dtb_agency', 'agency_id = ?', array($this->arrData['agency_id']));
        $this->arrDisp = $arrRet[0];

        $this->SetDisplayMode($this->tpl_dispmode);
        if (SC_Utils_Ex::sfIsInt($arrData['agency_id']))
            $this->disp_mode = true;

        foreach ($this->type as $type) {
            switch ($type) {
                case '1':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '11.pdf');
                    $this->SetMargins(18, 18);
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setKiyakuData(1);

                    $this->SetMargins(18, 0, 18);
                    $tplidx = $this->ImportPage(2);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setKiyakuData(2);
                    break;
                case '2':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '12.pdf');
                    $this->SetMargins(20, 20);
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setKiyakuData(3);

                    $this->SetMargins(20, 5, 20);
                    $tplidx = $this->ImportPage(2);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setKiyakuData(4);
                    break;
                case '3':
                    $this->pageno = $this->setSourceFile(PDF_TEMPLATE_REALDIR . '13.pdf');
                    $tplidx = $this->ImportPage(1);
                    $this->AddPage();
                    $this->useTemplate($tplidx);
                    $this->setAgencyData();
                    break;
                default:
                    break;
            }
        }
    }

    function setKiyakuData($flag) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        if ($flag == 1) {
            if (count($this->arrDisp) > 0)
                $this->lfText(20, 30, $this->arrDisp['agency_name'], 8, '');
            $objQuery->setOrder('rank DESC');
            $objQuery->setLimitOffset(13, 0);
            $kiyaku_type = 3;
            $this->Cell(0, 12, '', 0, 2, '', 0, '');
            $this->SetFont('Gothic', '', 8);
        } elseif ($flag == 2) {
            if (count($this->arrDisp) > 0) {
                $text = '〒 ' . $this->arrDisp['zip01'] . ' - ' . $this->arrDisp['zip02'];
                $text .= $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'];
                $this->lfText(46, 262.5, $text, 8, '');
                $this->lfText(46, 269.8, $this->arrDisp['agency_name'], 8, '');
                $text = $this->arrDisp['agency_di_name01'] . '　' . $this->arrDisp['agency_di_name02'] . '　様';
                $this->lfText(46, 276.9, $text, 8, '');
            }
            $objQuery->setOrder('rank DESC');
            $objQuery->setLimitOffset(10, 13);
            $kiyaku_type = 3;
            $this->SetFont('Gothic', '', 8);
        } elseif ($flag == 3) {
            if (count($this->arrDisp) > 0) {
                $text = '〒 ' . $this->arrDisp['zip01'] . ' - ' . $this->arrDisp['zip02'];
                $this->lfText(46, 74, $text, 9, '');
                $text = $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'];
                $this->lfText(46, 77.6, $text, 9, '');
                $this->lfText(46, 87.5, $this->arrDisp['agency_name'], 9, '');
                $this->lfText(46, 98, $this->arrDisp['official_position'], 9, '');
                $text = $this->arrDisp['agency_di_name01'] . '　' . $this->arrDisp['agency_di_name02'] . '　様';
                $this->lfText(46, 116, $text, 9, '');
            }
            $objQuery->setOrder('rank DESC');
            $objQuery->setLimitOffset(3, 0);
            $kiyaku_type = 4;
            $this->Cell(0, 60, '', 0, 2, '', 0, '');
            $this->SetFont('Gothic', '', 9);
        } else {
            $objQuery->setOrder('rank DESC');
            $objQuery->setLimitOffset(3, 3);
            $kiyaku_type = 4;
            $this->SetFont('Gothic', '', 9);
        }

        $arrRet = $objQuery->select('*', 'dtb_kiyaku', 'kiyaku_type = ? AND del_flg = 0', array($kiyaku_type));
        $arrRet = SC_Utils_Ex::sfSwapArray($arrRet);

        $this->arrDisp = array_merge($this->arrDisp, $arrRet);

        $arrKiyaku = array();
        $j = 0;
        for ($i = 0; $i < count($this->arrDisp['kiyaku_id']); $i++) {
            $arrKiyaku[$j][0] = $this->arrDisp['kiyaku_title'][$i];
            $arrKiyaku[$j][1] = '';
            $arrKiyaku[$j + 1][0] = $this->arrDisp['kiyaku_text'][$i];
            $arrKiyaku[$j + 1][1] = '';
            $j+=2;
        }
        if ($flag == 1 || $flag == 2)
            $this->FancyTableExtended($arrKiyaku, array(175, 0.1), 'L', false);
        else
            $this->FancyTableExtended($arrKiyaku, array(170, 0.1), 'L', true, true, 4.5);
    }

    function setAgencyData() {
        if (count($this->arrDisp) > 0) {
            $this->lfText(168, 52.6, $this->arrDisp['agency_id'], 10, '');
            $this->lfText(58, 82, $this->arrDisp['agency_name_kana'], 10, '');
            $this->lfText(48, 95, $this->arrDisp['agency_name'], 11, '');
            $text = $this->arrDisp['zip01'] . '      ' . $this->arrDisp['zip02'];
            $this->lfText(46, 114, $text, 10, '');
            $text = $this->arrPref[$this->arrDisp['pref']] . $this->arrDisp['addr01'] . $this->arrDisp['addr02'];
            $this->lfText(42, 123, $text, 10, '');
        }
    }

    function createPdf() {
        // PDFをブラウザに送信
        ob_clean();
        if ($this->pdf_download == 1) {
            if ($this->PageNo() == 1) {
                $filename = '11_13-No' . $this->arrData['agency_id'] . '.pdf';
            } else {
                $filename = '11_13.pdf';
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
