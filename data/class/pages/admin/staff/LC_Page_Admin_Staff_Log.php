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
 * ログ のページクラス.
 *
 * @package Page
 * @author Seasoft 塚田将久
 * @version $Id: LC_Page_Admin_Staff_Log.php 21867 2012-05-30 07:37:01Z nakanishi $
 */
class LC_Page_Admin_Staff_Log extends LC_Page_Admin_Ex {

    var $arrLogList = array();

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
	parent::init();
	$this->tpl_mainpage = 'staff/log.tpl';
	$this->tpl_subno = 'log';
	$this->tpl_mainno = 'staff';
	$this->tpl_maintitle = 'マイナンバー管理';
	$this->tpl_subtitle = 'ログ表示';
	$this->line_max = 50;
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

	$objFormParam = new SC_FormParam;

	// パラメーター情報初期化
	$this->lfInitParam($objFormParam);

	// POST値をセット
	$objFormParam->setParam($_REQUEST);
	$this->arrErr = $objFormParam->checkError();
	$this->arrForm = $objFormParam->getFormParamList();

	if (empty($this->arrErr)) {
	    $this->line_max = $objFormParam->getValue('line_max');
	    $this->tpl_ec_log = $this->getLog(DATA_REALDIR . "logs/mynumber.log");
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
     * パラメーターの初期化.
     *
     * @return void
     */
    function lfInitParam(&$objFormParam) {
	$objFormParam->addParam('行数', 'line_max', INT_LEN, '', array('NUM_CHECK', 'MAX_LENGTH_CHECK'), 50);
    }

    /**
     * EC-CUBE ログを取得する.
     *
     * @return array $arrLogs 取得したログ
     */
    function getLog($log_path_base) {

	$index = 0;
	$arrLogs = array();
	for ($gen = 0; $gen <= MAX_LOG_QUANTITY; $gen++) {
	    $path = $log_path_base;
	    if ($gen != 0) {
		$path .= ".$gen";
	    }

	    // ファイルが存在しない場合、前世代のログへ
	    if (!file_exists($path))
		continue;

	    $arrLogTmp = array_reverse(file($path));

	    $arrBodyReverse = array();
	    foreach ($arrLogTmp as $line) {
		// 上限に達した場合、処理を抜ける
		if (count($arrLogs) >= $this->line_max)
		    break 2;

		$line = chop($line);
		if (preg_match('/^\[([^\]]+)\] \[([^\]]+)\] \[([^\]]+)\] (.*?)$/', $line, $arrMatch)) {
		    $arrLogLine = array();
		    $arrLogLine['date'] = $arrMatch[1];
		    $arrLogLine['access'] = $arrMatch[2];
		    $arrLogLine['event'] = $arrMatch[3];
		    $arrLogLine['detail'] = $arrMatch[4];
		    $arrLogs[] = $arrLogLine;
		}
	    }
	}
	return $arrLogs;
    }

}
