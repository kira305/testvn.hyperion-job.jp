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
 * @version $Id: LC_Page_Admin_Job_Schedule.php 21935 2012-06-21 06:02:41Z pineray $
 */
class LC_Page_Admin_Job_Schedule extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/schedule.tpl';
        $this->tpl_mainno = 'job';
        $this->tpl_maintitle = '依頼管理';
        $this->tpl_subtitle = 'スケジュール管理';

        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $agencyList = $objQuery->select('agency_name', 'dtb_agency', 'agency_id = ?', array($_SESSION['agency_id']));
        $this->agencyName = $agencyList[0]['agency_name'];
        if ($_SESSION['authority'] == 3) {
            $corpList = $objQuery->select('pharmacy_name', 'mtb_corporate', 'corporate_id = ?', array($_SESSION['corporate_id']));
            $this->corpName = $corpList[0]['pharmacy_name'];
        } else {
            $corpList = $objQuery->select('corporate_id, pharmacy_name', 'mtb_corporate', 'del_flg = 0 AND agency_id = ?', array($_SESSION['agency_id']));
            foreach ($corpList as $corp)
                $this->arrCORPORATE[$corp['corporate_id']] = $corp['pharmacy_name'];
        }

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
        if (isset($_POST['mode'])) {
            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $job = $objQuery->select('working_day_all, working_start_all, working_over_all', 'dtb_job', 'sjob_id = ?', array($_POST['sjob_id']));
            $arrVal = array();
            if ($_POST['mode'] == 'move') {
                if ($_POST['dayDiff'] != 0)
                    $arrVal['working_day_all'] = date('Y-m-d', strtotime($job[0]['working_day_all'] . $_POST['dayDiff'] . " day"));
                if ($_POST['minuteDiff'] != 0) {
                    $arrVal['working_start_all'] = date('H:i', strtotime($job[0]['working_start_all'] . $_POST['minuteDiff'] . " minute"));
                    $arrVal['working_over_all'] = date('H:i', strtotime($job[0]['working_over_all'] . $_POST['minuteDiff'] . " minute"));
                }
            } else if ($_POST['mode'] == 'resize') {
                $arrVal['working_over_all'] = date('H:i', strtotime($job[0]['working_over_all'] . $_POST['minuteDiff'] . " minute"));
            }
            $objQuery->update('dtb_job', $arrVal, 'sjob_id = ?', array($_POST['sjob_id']));

            $message = '依頼を登録しました。';
            $this->tpl_onload = "window.alert('" . $message . "');";
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

}
