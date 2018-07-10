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
 * プラグイン の情報クラス.
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

class plugin_info{
    const PLUGIN_CODE         = "SortAssistant";
    static $PLUGIN_NAME       = "[管理者用]並び替えアシスト";
    static $PLUGIN_VERSION    = "0.8";
    static $PLUGIN_TABLE_VIEW = "plg_sortablerankrank_view";
    static $PLUGIN_TABLE_PROD = "plg_sortablerankrank_product";
    static $PLUGIN_TABLE_CCAT = "plg_sortablerankrank_classcategory";
    static $COMPLIANT_VERSION = "2.12.2";
    static $AUTHOR            = "株式会社サロンネットワークサービス";
    static $DESCRIPTION       = "並び替えをドラッグ操作で出来るようにサポートします。使い方はプラグイン設定にてご確認下さい。";
    static $PLUGIN_SITE_URL   = "http://www.salon.ne.jp/";
    static $AUTHOR_SITE_URL   = "http://www.salon.ne.jp/";
    static $CLASS_NAME        = "SortAssistant";
    static $LICENSE           = "LGPL";
}

?>
