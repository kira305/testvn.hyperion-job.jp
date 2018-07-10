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
        <h2 class="title">登録説明会お申し込み内容の確認</h2>
        <p class="btm20" style="font-size: 130%; line-height: 25px;">以下の内容で登録説明会へのお申し込みを承ります。<br>よろしければ、「説明会に申し込む」をクリックしてください</p>
        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="complete">
            <!--{foreach from=$arrForm key=key item=item}-->
            <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
            <!--{/foreach}-->

            <table summary="入力内容確認">
                <col width="30%" />
                <col width="70%" />
                <tr>
                    <th>希望会場</th>
                    <td>
                        <img src="<!--{$arrOfficeUrl[$arrForm.office]}-->" alt="<!--{$arrOffice[$arrForm.office]}-->" width="450" height="300" />
                    </td>
                </tr>
                <tr>
                    <th>希望日時</th>
                    <td>
                        <!--{$arrForm.note|h}-->
                    </td>
                </tr>
                <tr>
                    <th>お名前<span class="attention">※</span></th>
                    <td>
                        <!--{$arrForm.name01|h}-->&nbsp;
                        <!--{$arrForm.name02|h}-->
                    </td>
                </tr>
                <tr>
                    <th>お名前(フリガナ)<span class="attention">※</span></th>
                    <td>
                        <!--{$arrForm.kana01|h}-->&nbsp;
                        <!--{$arrForm.kana02|h}-->
                    </td>
                </tr>
                <tr>
                    <th>電話番号<span class="attention">※</span></th>
                    <td>
                        <!--{$arrForm.tel01|h}--> - <!--{$arrForm.tel02|h}--> - <!--{$arrForm.tel03|h}-->
                    </td>
                </tr>
                <tr>
                    <th>メールアドレス<span class="attention">※</span></th>
                    <td>
                        <a href="mailto:<!--{$arrForm.email|escape:'hex'}-->"><!--{$arrForm.email|escape:'hexentity'}--></a>
                    </td>
                </tr>                
            </table>

            <div class="btn_area">
                <ul>
                    <li>
                        <a href="?" onclick="fnModeSubmit('return', '', ''); return false;" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg', 'back')" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg', 'back')"><img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" border="0" name="back" id="back" /></a>
                    </li>
                    <li>
                        <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_regist_on.jpg', this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_regist.jpg', this)" src="<!--{$TPL_URLPATH}-->img/button/btn_regist.jpg" alt="説明会に申し込む" border="0" name="send" id="send" />
                    </li>
                </ul>
            </div>

        </form>
    </div>
</div
