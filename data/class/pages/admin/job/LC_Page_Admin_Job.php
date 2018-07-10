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
 * 受注管理 のページクラス
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_Admin_Job.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Job extends LC_Page_Admin_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage = 'job/index.tpl';
        $this->tpl_mainno = 'job';
        $this->tpl_subno = 'index';
        $this->tpl_pager = 'pager.tpl';
        $this->tpl_maintitle = '手配管理';
        $this->tpl_subtitle = '手配管理';

        $masterData = new SC_DB_MasterData_Ex();
        $this->arrPageMax = $masterData->getMasterData('mtb_page_max');

        $objDate = new SC_Date_Ex(RELEASE_YEAR);
        $this->arrYear = $objDate->getYear('', true, '');
        $this->arrMonth = $objDate->getMonth();
        $this->arrDay = $objDate->getDay();

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
        unset($_SESSION['working_calendar']);
        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $this->arrHidden = $objFormParam->getSearchArray();
        $this->arrForm = $objFormParam->getFormParamList();

        switch ($this->getMode()) {
            // 削除
            case 'delete':
                $this->doDelete('sjob_id = ?', array($objFormParam->getValue('sjob_id')));
            // 削除後に検索結果を表示するため breakしない
            // 検索パラメーター生成後に処理実行するため breakしない
            case 'csv':
            case 'delete_all':

            // 検索パラメーターの生成
            case 'search':
                $objFormParam->convParam();
                $objFormParam->trimParam();
                $this->arrErr = $this->lfCheckError($objFormParam);
                $arrParam = $objFormParam->getHashArray();

                if (count($this->arrErr) == 0) {
                    $where = 'del_flg = 0';
                    $arrWhereVal = array();
                    foreach ($arrParam as $key => $val) {
                        if ($val == '') {
                            continue;
                        }
                        $this->buildQuery($key, $where, $arrWhereVal, $objFormParam);
                    }

                    $order = 'update_date DESC';

                    /* -----------------------------------------------
                     * 処理を実行
                     * ----------------------------------------------- */
                    switch ($this->getMode()) {
                        // CSVを送信する。
                        case 'csv':
                            $this->doOutputCSV($where, $arrWhereVal, $order);

                            SC_Response_Ex::actionExit();
                            break;

                        // 全件削除(ADMIN_MODE)
                        case 'delete_all':
                            $this->doDelete($where, $arrWhereVal);
                            break;

                        // 検索実行
                        default:
                            // 行数の取得
                            $this->tpl_linemax = $this->getNumberOfLines($where, $arrWhereVal);
                            // ページ送りの処理
                            $page_max = SC_Utils_Ex::sfGetSearchPageMax($objFormParam->getValue('search_page_max'));
                            // ページ送りの取得
                            $objNavi = new SC_PageNavi_Ex($this->arrHidden['search_pageno'], $this->tpl_linemax, $page_max, 'fnNaviSearchPage', NAVI_PMAX);
                            $this->arrPagenavi = $objNavi->arrPagenavi;

                            // 検索結果の取得
                            list($this->arrResults, $this->arrNamesByJobId) = $this->findJobs($where, $arrWhereVal, $page_max, $objNavi->start_row, $order);
                            break;
                    }
                }
                break;
            default:
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
     * パラメーター情報の初期化を行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('受注ＩＤ', 'search_job_id', STEXT_LEN, 'KVa', array('MAX_LENGTH_CHECK'));
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
     * 入力内容のチェックを行う.
     *
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function lfCheckError(&$objFormParam) {
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->arrErr = $objFormParam->checkError();

        $objErr->doFunc(array('開始', 'search_sjob_date_year', 'search_sjob_date_month', 'search_sjob_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('終了', 'search_ejob_date_year', 'search_ejob_date_month', 'search_ejob_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('開始', '終了', 'search_sjob_date_year', 'search_sjob_date_month', 'search_sjob_date_day', 'search_ejob_date_year', 'search_ejob_date_month', 'search_ejob_date_day'), array('CHECK_SET_TERM'));

        $objErr->doFunc(array('開始', 'search_sjob_sche_date_year', 'search_sjob_sche_date_month', 'search_sjob_sche_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('終了', 'search_ejob_sche_date_year', 'search_ejob_sche_date_month', 'search_ejob_sche_date_day'), array('CHECK_DATE'));
        $objErr->doFunc(array('開始', '終了', 'search_sjob_sche_date_year', 'search_sjob_sche_date_month', 'search_sjob_sche_date_day', 'search_ejob_sche_date_year', 'search_ejob_sche_date_month', 'search_ejob_sche_date_day'), array('CHECK_SET_TERM'));

        return $objErr->arrErr;
    }

    /**
     * クエリを構築する.
     *
     * 検索条件のキーに応じた WHERE 句と, クエリパラメーターを構築する.
     * クエリパラメーターは, SC_FormParam の入力値から取得する.
     *
     * 構築内容は, 引数の $where 及び $arrValues にそれぞれ追加される.
     *
     * @param string $key 検索条件のキー
     * @param string $where 構築する WHERE 句
     * @param array $arrValues 構築するクエリパラメーター
     * @param SC_FormParam $objFormParam SC_FormParam インスタンス
     * @return void
     */
    function buildQuery($key, &$where, &$arrValues, &$objFormParam) {
        switch ($key) {
            case 'search_job_id':
                $where .= ' AND job_id LIKE ?';
                $arrValues[] = sprintf('%%%s%%', $objFormParam->getValue($key));
                break;
            case 'search_job_name':
                $where .= ' AND job_name LIKE ?';
                $arrValues[] = sprintf('%%%s%%', $objFormParam->getValue($key));
                break;
            case 'search_sjob_date_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_sjob_date_year'), $objFormParam->getValue('search_sjob_date_month'), $objFormParam->getValue('search_sjob_date_day'));
                $where.= ' AND job_date >= ?';
                $arrValues[] = $date;
                break;
            case 'search_ejob_date_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_ejob_date_year'), $objFormParam->getValue('search_ejob_date_month'), $objFormParam->getValue('search_ejob_date_day'), true);
                $where.= ' AND job_date <= ?';
                $arrValues[] = $date;
                break;
            case 'search_sjob_sche_date_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_sjob_sche_date_year'), $objFormParam->getValue('search_sjob_sche_date_month'), $objFormParam->getValue('search_sjob_sche_date_day'));
                $where.= ' AND job_sche_date_from >= ?';
                $arrValues[] = $date;
                break;
            case 'search_ejob_sche_date_year':
                $date = SC_Utils_Ex::sfGetTimestamp($objFormParam->getValue('search_ejob_sche_date_year'), $objFormParam->getValue('search_ejob_sche_date_month'), $objFormParam->getValue('search_ejob_sche_date_day'), true);
                $where.= ' AND job_sche_date_to <= ?';
                $arrValues[] = $date;
                break;
            default:
                break;
        }
    }

    /**
     * 受注を削除する.
     *
     * @param string $where 削除対象の WHERE 句
     * @param array $arrParam 削除対象の値
     * @return void
     */
    function doDelete($where, $arrParam = array()) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $sqlval['del_flg'] = 1;
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $objQuery->update('dtb_job', $sqlval, $where, $arrParam);
    }

    /**
     * CSV データを構築して取得する.
     *
     * 構築に成功した場合は, ファイル名と出力内容を配列で返す.
     * 構築に失敗した場合は, false を返す.
     *
     * @param string $where 検索条件の WHERE 句
     * @param array $arrVal 検索条件のパラメーター
     * @param string $order 検索結果の並び順
     * @return void
     */
    function doOutputCSV($where, $arrVal, $order) {
        if ($where != '') {
            $where = " WHERE $where ";
        }

        $objCSV = new SC_Helper_CSV_Ex();
        $objCSV->sfDownloadCsv('3', $where, $arrVal, $order, true);
    }

    /**
     * 検索結果の行数を取得する.
     *
     * @param string $where 検索条件の WHERE 句
     * @param array $arrValues 検索条件のパラメーター
     * @return integer 検索結果の行数
     */
    function getNumberOfLines($where, $arrValues) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        return $objQuery->count('dtb_job', $where, $arrValues);
    }

    /**
     * 受注を検索する.
     *
     * @param string $where 検索条件の WHERE 句
     * @param array $arrValues 検索条件のパラメーター
     * @param integer $limit 表示件数
     * @param integer $offset 開始件数
     * @param string $order 検索結果の並び順
     * @return array 受注の検索結果
     */
    function findJobs($where, $arrValues, $limit, $offset, $order) {
        $objQuery = & SC_Query_Ex::getSingletonInstance();
        $objQuery->setLimitOffset($limit, $offset);
        $objQuery->setOrder($order);
        //return $objQuery->select('*', 'dtb_job', $where, $arrValues);
        $arrJob = $objQuery->select('*', 'dtb_job', $where, $arrValues);

        $arrJobId = array();
        foreach ($arrJob as $job)
            $arrJobId[] = $job['sjob_id'];

        $arrStaffNames = array();
        if (count($arrJobId) > 0) {
            $arrJobDetail = $objQuery->select('sjob_id, name01, name02', 'dtb_job_detail', 'sjob_id IN (' . SC_Utils_Ex::sfGetCommaList($arrJobId) . ')');
            foreach ($arrJobDetail as $detail) {
                if (isset($arrStaffNames[$detail['sjob_id']]))
                    $arrStaffNames[$detail['sjob_id']] .= ', ' . $detail['name01'] . $detail['name02'];
                else
                    $arrStaffNames[$detail['sjob_id']] = $detail['name01'] . $detail['name02'];
            }
        }
        return array($arrJob, $arrStaffNames);
    }

}
