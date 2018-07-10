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

/*  [名称] SC_StaffList
 *  [概要] 会員検索用クラス
 */

class SC_StaffList extends SC_SelectSql_Ex {

    var $arrColumnCSV;

    function __construct($array, $mode = '') {
	parent::__construct($array);

	$dbFactory = SC_DB_DBFactory_Ex::getInstance();

	if ($mode == '') {
	    // 会員本登録会員で削除していない会員
	    $this->setWhere('del_flg = 0 ');
	    // 登録日を示すカラム
	    $regdate_col = 'dtb_staff.update_date';
	}

	if ($mode == 'edit') {
	    $this->setWhere(' del_flg = 0 ');
	    // 登録日を示すカラム
	    $regdate_col = 'dtb_staff.update_date';
	}

	// 名前
	if (!isset($this->arrSql['search_name']))
	    $this->arrSql['search_name'] = '';
	if (strlen($this->arrSql['search_name']) > 0) {
	    $this->setWhere('(' . $dbFactory->concatColumn(array('name01', 'name02')) . ' LIKE ?)');
	    $searchName = $this->addSearchStr($this->arrSql['search_name']);
	    $this->arrVal[] = mb_ereg_replace('[ 　]+', '', $searchName);
	}

	// 名前(フリガナ)
	if (!isset($this->arrSql['search_kana']))
	    $this->arrSql['search_kana'] = '';
	if (strlen($this->arrSql['search_kana']) > 0) {
	    $this->setWhere('(' . $dbFactory->concatColumn(array('kana01', 'kana02')) . ' LIKE ?)');
	    $searchKana = $this->addSearchStr($this->arrSql['search_kana']);
	    $this->arrVal[] = mb_ereg_replace('[ 　]+', '', $searchKana);
	}

	// 部門/所属
	if (!isset($this->arrSql['search_affiliation']))
	    $this->arrSql['search_affiliation'] = '';
	if (is_array($this->arrSql['search_affiliation'])) {
	    $arrAffiliationVal = $this->setItemTerm($this->arrSql['search_affiliation'], 'affiliation');
	    foreach ($arrAffiliationVal as $data) {
		$this->arrVal[] = $data;
	    }
	}

	// is family member
	if (!isset($this->arrSql['search_is_family_member']))
	    $this->arrSql['search_is_family_member'] = '';
	if (is_array($this->arrSql['search_is_family_member'])) {
	    if (count($this->arrSql['search_is_family_member']) == 1) {
		if ($this->arrSql['search_is_family_member'][0] == 0)
		    $this->setWhere('parent_staff_id = ?');
		else
		    $this->setWhere('parent_staff_id > ?');
		$this->arrVal[] = 0;
	    }
	}

	// 名前
	if (!isset($this->arrSql['search_parent_name']))
	    $this->arrSql['search_parent_name'] = '';
	if (strlen($this->arrSql['search_parent_name']) > 0) {
	    $this->setWhere('(' . $dbFactory->concatColumn(array('parent_name01', 'parent_name02')) . ' LIKE ?)');
	    $searchName = $this->addSearchStr($this->arrSql['search_parent_name']);
	    $this->arrVal[] = mb_ereg_replace('[ 　]+', '', $searchName);
	}

	if (!isset($this->arrSql['search_is_haken']))
	    $this->arrSql['search_is_haken'] = '';
	if (strlen($this->arrSql['search_is_haken']) > 0) {
	    if ($this->arrSql['search_is_haken'] == 0)
		$this->setWhere('is_haken = 0');
	    else
		$this->setWhere('is_haken <> 0');
	}

	if (!isset($this->arrSql['search_haken_type']))
	    $this->arrSql['search_haken_type'] = '';
	if (is_array($this->arrSql['search_haken_type'])) {
	    $arrVal = $this->setItemTerm($this->arrSql['search_haken_type'], 'is_haken');
	    foreach ($arrVal as $data) {
		$this->arrVal[] = $data;
	    }
	}

	if (!isset($this->arrSql['search_screateyear']))
	    $this->arrSql['search_screateyear'] = '';
	if (!isset($this->arrSql['search_screatemonth']))
	    $this->arrSql['search_screatemonth'] = '';
	if (!isset($this->arrSql['search_screateday']))
	    $this->arrSql['search_screateday'] = '';
	if (!isset($this->arrSql['search_ecreateyear']))
	    $this->arrSql['search_ecreateyear'] = '';
	if (!isset($this->arrSql['search_ecreatemonth']))
	    $this->arrSql['search_ecreatemonth'] = '';
	if (!isset($this->arrSql['search_ecreateday']))
	    $this->arrSql['search_ecreateday'] = '';
	if ((strlen($this->arrSql['search_screateyear']) > 0 && strlen($this->arrSql['search_screatemonth']) > 0 && strlen($this->arrSql['search_screateday']) > 0) ||
		(strlen($this->arrSql['search_ecreateyear']) > 0 && strlen($this->arrSql['search_ecreatemonth']) > 0 && strlen($this->arrSql['search_ecreateday']) > 0)) {

	    $arrRegistTime = $this->selectTermRange($this->arrSql['search_screateyear'], $this->arrSql['search_screatemonth'], $this->arrSql['search_screateday']
		    , $this->arrSql['search_ecreateyear'], $this->arrSql['search_ecreatemonth'], $this->arrSql['search_ecreateday'], 'create_date');
	    foreach ($arrRegistTime as $data) {
		$this->arrVal[] = $data;
	    }
	}

	$this->setOrder('staff_id DESC');
    }

    // 検索用SQL
    function getList() {
	$this->select = 'SELECT * FROM dtb_staff ';
	return $this->getSql(0);
    }

    // 検索総数カウント用SQL
    function getListCount() {
	$this->select = 'SELECT COUNT(staff_id) FROM dtb_staff ';
	return $this->getSql(1);
    }

    // CSVダウンロード用SQL
    function getListCSV($arrColumnCSV) {
	$this->arrColumnCSV = $arrColumnCSV;
	$i = 0;
	foreach ($this->arrColumnCSV as $val) {
	    if ($i != 0)
		$state .= ', ';
	    $state .= $val['sql'];
	    $i++;
	}

	$this->select = 'SELECT ' . $state . ' FROM dtb_staff ';
	return $this->getSql(2);
    }

    function getWhere() {
	return array($this->where, $this->arrVal);
    }

}
