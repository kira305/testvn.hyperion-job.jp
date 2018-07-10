<!--{*
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
 *}-->

<!--{$arrOrder.order_name01}--> <!--{$arrOrder.order_name02}--> 様

<!--{$tpl_header}-->

************************************************
　求人詳細
************************************************
<!--{section name=cnt loop=$arrOrderDetail}-->
<!--{assign var=pid value=`$arrOrderDetail[cnt].product_id`}-->
<!--{assign var=flg value=`$arrProduct[$pid].work_location_flg`}-->


求人コード： <!--{$arrOrderDetail[cnt].product_code}-->
求人名： <!--{$arrOrderDetail[cnt].product_name}--> <!--{$arrOrderDetail[cnt].classcategory_name1}--> <!--{$arrOrderDetail[cnt].classcategory_name2}-->
給与： <!--{$arrOrderDetail[cnt].price|sfCalcIncTax|number_format}-->
就業日： <!--{$arrProduct[$pid].sub_comment3}-->
勤務時間： <!--{$arrProduct[$pid].sub_comment4}-->
勤務地： <!--{$arrWorkLocationFlg[$flg]}--> <!--{$arrProduct[$pid].sub_comment1}-->

<!--{/section}-->
<!--{$tpl_footer}-->