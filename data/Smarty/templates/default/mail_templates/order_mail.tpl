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

<!--{$arrOrder.order_name01}--> <!--{$arrOrder.order_name02}--><!--{$tpl_header}-->

<!--{$arrOrder.create_date|sfDispDBDate}-->

************************************************
　ご入力頂いた内容
************************************************

■　お名前： <!--{$arrOrder.order_name01}--> <!--{$arrOrder.order_name02}--> 様
■　電話番号： <!--{$arrOrder.order_tel01}-->-<!--{$arrOrder.order_tel02}-->-<!--{$arrOrder.order_tel03}-->
■　メールアドレス： <!--{$arrOrder.order_email}-->

************************************************
　お仕事の詳細
************************************************
<!--{section name=cnt loop=$arrOrderDetail}-->
<!--{assign var=pid value=`$arrOrderDetail[cnt].product_id`}-->
<!--{assign var=flg value=`$arrProduct[$pid].work_location_flg`}-->

■　求人名： <!--{$arrOrderDetail[cnt].product_name}--> <!--{$arrOrderDetail[cnt].classcategory_name1}--> <!--{$arrOrderDetail[cnt].classcategory_name2}-->
■　給与： <!--{$arrOrderDetail[cnt].price|sfCalcIncTax|number_format}--> 円
■　掲載： <!--{$arrProduct[$pid].sub_comment1}-->
■　詳細URL： http://www.hyperion-job.jp/products/detail.php?product_id=<!--{$arrProduct[$pid].product_id}-->
<!--{/section}-->
<!--{$arrOrder.message}-->
<!--{$tpl_footer}-->