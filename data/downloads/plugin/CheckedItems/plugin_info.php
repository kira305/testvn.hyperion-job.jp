<?php
/*
 * CheckedItems
 * Copyright(c) 2012-2014 DELIGHT Inc. All Rights Reserved.
 *
 * http://www.delight-web.com/
 * 
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * プラグイン の情報クラス.
 *
 * @package CheckedItems
 * @author DELIGHT Inc.
 * @version $Id: $
 */
class plugin_info{
    static $PLUGIN_CODE       = "CheckedItems";
    static $PLUGIN_NAME       = "最近チェックした商品";
    static $CLASS_NAME        = "CheckedItems";
    static $PLUGIN_VERSION     = "1.1";
    static $COMPLIANT_VERSION  = "2.12.0-2.13.3";
    static $AUTHOR            = "DELIGHT inc.";
    static $DESCRIPTION       = "最近チェックした商品を表示するブロックです。";
    static $PLUGIN_SITE_URL    = "http://www.ec-cube.net/owners/index.php";
    static $AUTHOR_SITE_URL    = "http://www.delight-web.com/ec-cube/products/about.php";
    static $LICENSE          = "LGPL";
    static $HOOK_POINTS       = array(array('LC_Page_Products_Detail_action_after', 'LC_Page_Products_Detail_action_after'));
}
