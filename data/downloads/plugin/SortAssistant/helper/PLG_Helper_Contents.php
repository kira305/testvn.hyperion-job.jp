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
 * コンテンツ管理 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Base.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/contents/PLG_Helper_Basis_Contents_Index.php');

final class PLG_Helper_Contents extends PLG_Helper_Base {

    public function __construct() {}


    public function install($arrPlugin){}


    public function uninstall($arrPlugin) {}



    /** 新着情報管理 */
    public function ContentsIndexRank($objPage){
        $objSort = new PLG_Helper_Basis_Contents_Index();
        $this->run($objSort, $objPage);
    }



    /** おすすめ商品管理 */
    public function ContentsRecommendRank($objPage){}



}

?>
