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

<!--{$arrForm.name01.value}--> <!--{$arrForm.name02.value}--><!--{$tpl_header}-->

■　お名前：<!--{$arrForm.name01.value}--> <!--{$arrForm.name02.value}--> (<!--{$arrForm.kana01.value}--> <!--{$arrForm.kana02.value}-->) 様
■　郵便番号：<!--{if $arrForm.zip01.value && $arrForm.zip02.value}-->〒<!--{$arrForm.zip01.value}-->-<!--{$arrForm.zip02.value}--><!--{/if}-->
■　住所：<!--{$arrPref[$arrForm.pref.value]}--><!--{$arrForm.addr01.value}--><!--{$arrForm.addr02.value}-->
■　電話番号：<!--{$arrForm.tel01.value}-->-<!--{$arrForm.tel02.value}-->-<!--{$arrForm.tel03.value}-->
■　お問い合わせの内容
<!--{$arrForm.contents.value}-->

<!--{$tpl_footer}-->
