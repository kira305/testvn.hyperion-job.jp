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
<!--▼CONTENTS-->
<div id="undercolumn">
    <div id="undercolumn_shopping">
        
        <h2 class="title"><!--{$tpl_title|h}--></h2>

        <!-- ▼その他決済情報を表示する場合は表示 -->
        <!--{if $arrOther.title.value}-->
            <p><span class="attention">■<!--{$arrOther.title.name}-->情報</span><br />
                <!--{foreach key=key item=item from=$arrOther}-->
                    <!--{if $key != "title"}-->
                        <!--{if $item.name != ""}-->
                            <!--{$item.name}-->：
                        <!--{/if}-->
                            <!--{$item.value|nl2br}--><br />
                    <!--{/if}-->
                <!--{/foreach}-->
            </p>
        <!--{/if}-->
        <!-- ▲コンビに決済の場合には表示 -->

        <div id="complete_area">
            <p class="message"><!--{$arrInfo.shop_name|h}-->をご利用いただき、ありがとうございました。</p>
            <p>ただいま、ご登録の確認メールをお送りさせていただきました。<br />
                万一、ご確認メールが届かない場合は、トラブルの可能性もありますので大変お手数ではございますがもう一度お問い合わせいただくか、お電話にてお問い合わせくださいませ。<br /></p>
            <div class="shop_information">
                <p class="name"><!--{$arrInfo.shop_name|h}--></p>
                <p>TEL：<!--{$arrInfo.tel01}-->-<!--{$arrInfo.tel02}-->-<!--{$arrInfo.tel03}--> <!--{if $arrInfo.business_hour != ""}-->（受付時間/<!--{$arrInfo.business_hour}-->）<!--{/if}--><br />
                E-mail：<a href="mailto:<!--{$arrInfo.email02|escape:'hex'}-->"><!--{$arrInfo.email02|escape:'hexentity'}--></a>
                </p>
            </div>
        </div>

        <div class="btn_area">
            <ul>
                <li>
                    <a href="<!--{$smarty.const.TOP_URLPATH}-->" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage_on.jpg','b_toppage');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg','b_toppage');">
                        <img src="<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg" alt="トップページへ" border="0" name="b_toppage" /></a>
                </li>
            </ul>
        </div>

    </div>
</div>
<!--▲CONTENTS-->

<!-- Google Code for 02&#27714;&#20154;&#24540;&#21215; Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 997306763;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "LcbQCNXylwQQi-PG2wM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/997306763/?value=0&amp;label=LcbQCNXylwQQi-PG2wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<!--応募完了計測（thanksページ）用
/* SiteCatalyst code version: H.21.
Copyright 1996-2010 Adobe, Inc. All Rights Reserved
More info available at http://www.omniture.com */-->
<script language="JavaScript" type="text/javascript" src="https://pharmapremium.jp/s_code.js"></script>
<script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on
the next lines. */
s.events="event4"
s.products=";send2;1;10000"
 /* clickPast */
s.SEMvar = s.getQueryParam('s_kwcid');
s.SEMvar = s.getValOnce(s.SEMvar,'SEM_var',0);
s.clickPast(s.SEMvar,'event26','event27');
/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
if(s.SEMvar||s.events){var s_code=s.t();if(s_code)document.write(s_code)}//--></script>
<!-- End SiteCatalyst code version: H.21. ここまで-->

<!-- リマーケティング タグの Google コード -->
<!--------------------------------------------------
リマーケティング タグは、個人を特定できる情報と関連付けることも、デリケートなカテゴリに属するページに設置することも許可されません。タグの設定方法については、こちらのページをご覧ください。
http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 997306763;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/997306763/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
