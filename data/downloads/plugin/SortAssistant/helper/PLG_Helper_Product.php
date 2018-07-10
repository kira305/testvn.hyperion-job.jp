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
 * 商品管理 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Base.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/products/PLG_Helper_Products_Class.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/products/PLG_Helper_Products_ClassCategory.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/products/PLG_Helper_Products_Category.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/products/PLG_Helper_Products_Maker.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/products/PLG_Helper_Products_Rank.php');

final class PLG_Helper_Product extends PLG_Helper_Base {

    public function __construct() {}


    public function install($arrPlugin){}


    public function uninstall($arrPlugin) {}



    /** 規格管理 */
    public function ProductClassRank($objPage){
        $objSort = new PLG_Helper_Products_Class();
        $this->run($objSort, $objPage);
    }


    /** 規格分類 */
    public function ProductClassCategoryRank($objPage){
        $objSort = new PLG_Helper_Products_ClassCategory();
        $this->run($objSort, $objPage);
    }


    /** カテゴリ */
    public function ProductCategoryRank($objPage){
        $objSort = new PLG_Helper_Products_Category();
        $this->run($objSort, $objPage);
    }


    /** メーカー管理 */
    public function ProductMakerRank($objPage){
        $objSort = new PLG_Helper_Products_Maker();
        $this->run($objSort, $objPage);
    }


    /** 商品並び替え */
    public function ProductRank($objPage){
        $objSort = new PLG_Helper_Products_Rank();
        $this->run($objSort, $objPage);
    }

}

?>
