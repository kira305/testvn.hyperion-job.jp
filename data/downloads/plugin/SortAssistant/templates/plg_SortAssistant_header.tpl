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

$arrPageLayout = $this->get_template_vars('arrPageLayout');

    switch($arrPageLayout['device_type_id']){
        case 1:
            break;
        case 2:
            break;
        case 10:
        default:
            switch($_SERVER['PHP_SELF']){
                // 基本情報管理
                case ROOT_URLPATH . ADMIN_DIR . 'basis/delivery.php':
                case ROOT_URLPATH . ADMIN_DIR . 'basis/payment.php':
                case ROOT_URLPATH . ADMIN_DIR . 'basis/kiyaku.php':
                case ROOT_URLPATH . ADMIN_DIR . 'basis/holiday.php':

                // 商品管理
                case ROOT_URLPATH . ADMIN_DIR . 'products/class.php':
                case ROOT_URLPATH . ADMIN_DIR . 'products/classcategory.php':
                case ROOT_URLPATH . ADMIN_DIR . 'products/category.php':
                case ROOT_URLPATH . ADMIN_DIR . 'products/maker.php':
                case ROOT_URLPATH . ADMIN_DIR . 'products/product_rank.php':

                // コンテンツ管理
                case ROOT_URLPATH . ADMIN_DIR . 'contents/index.php':
                case ROOT_URLPATH . ADMIN_DIR . 'contents/recommend.php':

                    echo('<link rel="stylesheet" href="'. PLUGIN_HTML_URLPATH .  'SortAssistant/sortable_view.css" type="text/css" media="screen" />');
                    echo('<script type="text/javascript" src="'. ROOT_URLPATH .'js/ui.core.js"></script>');
                    echo('<script type="text/javascript" src="'. ROOT_URLPATH .'js/ui.sortable.js"></script>');
                    echo('<script type="text/javascript" src="'. PLUGIN_HTML_URLPATH .  'SortAssistant/sortable_view.js"></script>');
                    break;

                default: break;
            }
    }
?>
