<?php
/*
 * AddProductColumns
 * Copyright(c) 2012 DELIGHT Inc. All Rights Reserved.
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


// {{{ requires
require_once '../../../../require.php';
require_once(PLUGIN_UPLOAD_REALDIR . 'AddProductColumns/plg_AddProductColumns_ClassAutoloader.php');
spl_autoload_register(array('plg_AddProductColumns_ClassAutoloader', 'autoload'));

// }}}
// {{{ generate page

$objPage = new plg_AddProductColumns_LC_Page_Admin_Products_Columns_Ex();
$objPage->init();
$objPage->process();
