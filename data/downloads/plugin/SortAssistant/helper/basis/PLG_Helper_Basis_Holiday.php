<?php
/*
 * SortAssistant
 * 
 * Copyright (c) 2014 doishun
 * http://www.salon.ne.jp
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 */

/**
 * 休日管理 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

include_once(PLUGIN_UPLOAD_REALDIR. 'SortAssistant/helper/PLG_Helper_Base.php');

final class PLG_Helper_Basis_Holiday extends PLG_Helper_Base {


    public function __construct() {}


    /**
     * 基本情報管理 # 定休日管理
     * HookPoint:LC_Page_Admin_Design_MainEdit_action_after
     **/
    public function main($objPage){
        // 処理モード取得
        $objPage->mode = Salon_Plugin_Base002::getMode();
        switch($objPage->mode){
            // 並び替え実行
            case 'sort_excu':
                $table = "dtb_holiday";
                $where = "holiday_id = ?";
                $res = parent::update($table, $where);
                if(!$res){
                    $objPage->tpl_onload = parent::alertfail();
                    break;
                }
                $objPage->tpl_onload = parent::alertsuccess();
                break;
        }

        // ランク情報を合わせて取得
        $objPage->arrHoliday = $this->lfGetHolidayList();
        $objPage->sortCount  = count($objPage->arrHoliday);
    }


    /**
     * 定休日一覧の取得.
     * 
     * @see LC_Page_Admin_Basis_Holiday#lfGetHolidayList
     * @return array
     */
    private function lfGetHolidayList() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $where = 'del_flg <> 1';
        $objQuery->setOrder('rank DESC');
        return $objQuery->select('holiday_id, title, month, day, rank', 'dtb_holiday', $where);
    }

}

?>
