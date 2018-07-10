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
 * プラグイン のアップデート用クラス.
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Basis.php');

class plugin_update{
	/**
	 *アップデート
	 *updateはアップデート時に実行されます。
	 *引数にはdtb_pluginのプラグイン情報が渡されます。
	 *
	 *@param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
	 *@return void
	 */
	 function update($arrPlugin){
        $tmp = rtrim(realpath(dirname(__FILE__)), "/")."/";


        // プラグインロゴ、jsとcssとコピー
        // /html/plugin/ProductListFlilckChangerSP/
        $a = SC_Utils_Ex::sfCopyDir($tmp. "media/"
                             , PLUGIN_HTML_REALDIR  . "SortAssistant/"
                             , ''
                             , true);

        // 更新プログラムのコピー
        SC_Utils_Ex::sfCopyDir($tmp. "helper/products/"
                             , PLUGIN_UPLOAD_REALDIR  . "SortAssistant/helper/products/"
                             , ''
                             , true);


        // 更新テンプレートのコピー
        SC_Utils_Ex::sfCopyDir($tmp. "templates/products/rank/"
                             , PLUGIN_UPLOAD_REALDIR  . "SortAssistant/templates/products/rank/"
                             , ''
                             , true);
	 }
}
?>