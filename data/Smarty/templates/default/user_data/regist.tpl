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

<style>
    #bottomcolumn{
        display: none;
    }
    #undercolumn_login .login_area h3, .inputtext{
        margin: 10px auto;
        width: 842px;
        text-align: left;
    }
    .inputbox{
        padding: 30px 0;
        text-align: center;
    }
    .btn_area ul li{
	float: left;
	width: 48%;
	text-align: right;
    }
    .linkBtn{
        border: 1px solid #DDDDDD;
        background-color: #EB720C;
        font-size: 1.2em;
        color: white;
        box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
        border-radius: 6px;
	height: 70px;
	width: 350px;
    }
</style>

<div id="undercolumn">
    <div id="undercolumn_login">
	<form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="mode" value="card_aru" />
	    <h2 class="title">マイナンバー登録</h2>
            <div class="login_area">
                <h3>ハイペリオン従業員専用</h3>
		<p class="inputtext">平成28年1月から社会保障・税・災害対策に至る行政手続きでマイナンバーが必要になります。<br />つきましては、以下のフォームより個人番号を提出いただきますようご協力をお願いします。</p>
                <div class="inputbox">
		    <div class="btn_area">
                        <ul>
                            <li><button class="linkBtn" onclick="fnModeSubmit('card_aru', '', ''); return false;">① 個人番号カードをお持ちの方はこちら</button></li>
                            <li style="text-align: left;"><button style="background-color: #2C72AF;" class="linkBtn" onclick="fnModeSubmit('card_nai', '', ''); return false;">② 個人番号カードお持ちではない<br />（通知カードをお持ち）の方はこちら</button></li>
			</ul>
                    </div>
                </div>
	    </div>
	    <br /><br />
	    <div class="login_area">
		<h3>扶養家族専用</h3>
                <div class="btn_area">
		    <ul>
			<li style="margin-top: 20px;"><button class="linkBtn" onclick="fnModeSubmit('family_card_aru', '', ''); return false;">① 個人番号カードをお持ちの方はこちら</button></li>
			<li style="margin-top: 20px; text-align: left;"><button style="background-color: #2C72AF;" class="linkBtn" onclick="fnModeSubmit('family_card_nai', '', ''); return false;">② 個人番号カードお持ちではない<br />（通知カードをお持ち）の方はこちら</button></li>
		    </ul>
		</div>
            </div>
        </form>
    </div>
</div>
