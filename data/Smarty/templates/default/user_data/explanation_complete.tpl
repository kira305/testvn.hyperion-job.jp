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

<div id="undercolumn">
    <div id="undercolumn_content">
        <h2 class="title">登録説明会お申し込みの完了</h2>
        <p class="btm20">以下の内容で、登録説明会へのお申込を受け付けました。ご登録いただいたメールアドレスにもお申し込み内容を送付しております。<br><br>
            ご希望を踏まえて説明会の日時を調整した上で、こちらからまたご連絡差し上げます。<br>
            よろしくお願いいたします。<br><br>
            ■　希望会場：<a href="<!--{$arrOfficeUrl[$arrForm.office]}-->"><!--{$arrOfficeAddr[$arrForm.office]}--></a><br>
            &nbsp; &nbsp;<img src="<!--{$arrOfficeUrl[$arrForm.office]}-->" alt="" width="450" height="300" /><br>
            ■　希望日時：<!--{$arrForm.note|h}--><br>
            ■　お名前：<!--{$arrForm.name01|h}-->&nbsp;<!--{$arrForm.name02|h}--><br>
            ■　お名前(フリガナ)：<!--{$arrForm.kana01|h}-->&nbsp;<!--{$arrForm.kana02|h}--><br>
            ■　電話番号：<!--{$arrForm.tel01|h}--> - <!--{$arrForm.tel02|h}--> - <!--{$arrForm.tel03|h}--><br>
            ■　メールアドレス：<!--{$arrForm.email|escape:'hexentity'}-->
        </p>
        <div id="complete_area">
            <!--<p class="message">登録説明会へのお申込を受け付けました。</p>-->
            <div class="shop_information">
                <p class="name"><!--{$arrSiteInfo.company_name|h}--></p>
                <p>TEL：<!--{$arrSiteInfo.tel01}-->-<!--{$arrSiteInfo.tel02}-->-<!--{$arrSiteInfo.tel03}-->
                    <!--{if $arrSiteInfo.business_hour != ""}-->（受付時間/<!--{$arrSiteInfo.business_hour}-->）<!--{/if}--><br />
                    E-mail：<a href="mailto:<!--{$arrSiteInfo.email02|escape:'hex'}-->"><!--{$arrSiteInfo.email02|escape:'hexentity'}--></a>
                </p>
            </div>

            <div class="btn_area">
                <ul>
                    <li>
                        <a href="<!--{$smarty.const.TOP_URLPATH}-->" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage_on.jpg', 'b_toppage');" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg', 'b_toppage');"><img src="<!--{$TPL_URLPATH}-->img/button/btn_toppage.jpg" alt="トップページへ" border="0" name="b_toppage" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

