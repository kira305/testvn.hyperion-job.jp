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
 * 新着情報管理 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

include_once(PLUGIN_UPLOAD_REALDIR. 'SortAssistant/helper/PLG_Helper_Base.php');

final class PLG_Helper_Basis_Contents_Index extends PLG_Helper_Base {


    public function __construct() {}


    /**
     * コンテンツ管理 # 新着情報管理
     * HookPoint:LC_Page_Admin_Basis_Delivery_action_after
     **/
    public function main($objPage){
        // 処理モード取得
        $objPage->mode = Salon_Plugin_Base002::getMode();
        switch($objPage->mode){
            // 並び替え実行
            case 'sort_excu':
                $table = "dtb_news";
                $where = "news_id = ?";
                $res = parent::update($table, $where);
                if(!$res){
                    $objPage->tpl_onload = parent::alertfail();
                    break;
                }
                $objPage->tpl_onload = parent::alertsuccess();

                // 並び替えを反映した新着情報を取得する
                $objPage->arrNews = $objPage->getNews();
                break;
        }
        $objPage->sortCount = count($objPage->arrNews);
    }


    /**
     * コンテンツ管理 # 新着情報管理
     * HookPoint:LC_Page_Admin_Basis_Delivery_action_after
     **/
    public function main2_13($objPage){
        $objNews = new SC_Helper_News_Ex();

        // 処理モード取得
        $objPage->mode = Salon_Plugin_Base002::getMode();
        switch($objPage->mode){
            // 並び替え実行
            case 'sort_excu':
                $table = "dtb_news";
                $where = "news_id = ?";
                $res = parent::update($table, $where);
                if(!$res){
                    $objPage->tpl_onload = parent::alertfail();
                    break;
                }
                $objPage->tpl_onload = parent::alertsuccess();

                // 並び替えを反映した新着情報を取得する
                $objPage->arrNews = $objNews->getList();
                break;
        }
        $objPage->sortCount = count($objPage->arrNews);
    }

}

?>
