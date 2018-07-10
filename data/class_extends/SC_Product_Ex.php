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

require_once CLASS_REALDIR . 'SC_Product.php';

class SC_Product_Ex extends SC_Product {
    function lists(&$objQuery) {
        $col = <<< __EOS__
             product_id
            ,product_code_min
            ,product_code_max
            ,name
            ,comment1
            ,comment2
            ,comment3
            ,comment4
            ,comment5
            ,comment6
            ,comment7
            ,comment8
            ,comment9
            ,comment10
            ,comment11
            ,comment12
            ,comment13
            ,comment14
            ,comment15
            ,comment16
            ,comment17
            ,comment18
            ,comment19
            ,comment20
            ,main_list_comment
            ,main_image
            ,main_list_image
            ,price01_min
            ,price01_max
            ,price02_min
            ,price02_max
            ,stock_min
            ,stock_max
            ,stock_unlimited_min
            ,stock_unlimited_max
            ,deliv_date_id
            ,status
            ,employment_status
            ,appeal_point
            ,sub_comment1
            ,sub_comment2
            ,sub_comment3
            ,sub_comment4
            ,sub_comment5
            ,sub_comment6
            ,sub_comment7
            ,sub_comment8
            ,sub_comment9
            ,sub_comment10
            ,sub_comment11
            ,work_location_flg
            ,del_flg
            ,update_date
__EOS__;
        $res = $objQuery->select($col, $this->alldtlSQL());
        return $res;
    }
}
