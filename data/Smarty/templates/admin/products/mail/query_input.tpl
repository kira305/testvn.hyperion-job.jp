<!--{*
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
*}-->



<form name="search_form" id="search_form" method="post" action="?">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="search" />
    <!--{foreach key=key item=item from=$arrForm}-->
    <!--{if $key == 'mail_method' || $key == 'kanrititle' || $key == 'subject' || $key == 'body' || $key == 'template_id' || $key == 'send_id' || $key == 'cid'}-->
    <input type="hidden" name="<!--{$key}-->" value="<!--{$item.value|h}-->" />
    <!--{/if}-->
    <!--{/foreach}-->

    <div id="mail" class="contents-main">
        <h2>配信条件</h2>

        <table class="form">
            <tr>
                <th>会員ID</th>
                <td>
                    <!--{assign var=key value="search_customer_id"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> /></td>
                </td>
            </tr>
            <tr>
                <th>都道府県</th>
                <td>
                    <!--{assign var=key value="search_pref"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <select class="top" name="<!--{$key}-->">
                        <option value="" selected="selected" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}-->>都道府県を選択</option>
                        <!--{html_options options=$arrPref selected=$arrForm[$key].value}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>お名前</th>
                <td>
                    <!--{assign var=key value="search_name"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
            <tr>
                <th>お名前(フリガナ)</th>
                <td>
                    <!--{assign var=key value="search_kana"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}--> />
                </td>
            </tr>
            <tr>
                <th>性別</th>
                <td>
                    <!--{assign var=key value="search_sex"}-->
                    <!--{html_checkboxes name=$key options=$arrSex separator="&nbsp;" selected=$arrForm[$key].value}-->
                </td>
            </tr>
            <tr>
                <th>誕生月</th>
                <td>
                    <!--{assign var=key value="search_birth_month"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <select name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" >
                        <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                </td>
            </tr>
            <tr>
                <th>誕生日</th>
                <td>
                    <!--{assign var=errkey1 value="search_b_start_year"}-->
                    <!--{assign var=errkey2 value="search_b_end_year"}-->
                    <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><span class="attention"><!--{$arrErr[$errkey1]}--><!--{$arrErr[$errkey2]}--></span><br /><!--{/if}-->
                    <!--{assign var=key value="search_b_start_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrBirthYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_b_start_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_b_start_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日～
                    <!--{assign var=key value="search_b_end_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrBirthYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_b_end_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_b_end_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>メールアドレス</th>
                <td>
                    <!--{assign var=key value="search_email"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}-->/>
                </td>
            </tr>
            <tr>
                <th>携帯メールアドレス</th>
                <td>
                    <!--{assign var=key value="search_email_mobile"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" <!--{if $arrErr[$key]}--><!--{sfSetErrorStyle}--><!--{/if}-->/></td>
                </td>
            </tr>
            <tr>
                <th>電話番号</th>
                <td>
                    <!--{assign var=key value="search_tel"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="60" class="box60" /></td>
                </td>
            </tr>
            <tr>
                <th>職業</th>
                <td>
                    <!--{assign var=key value="search_job"}-->
                    <!--{html_checkboxes name=$key options=$arrEMPSTATUS separator="&nbsp;" selected=$arrForm[$key].value}--></td>
                </td>
            </tr>
            <tr>
                <th>購入金額</th>
                <td>
                    <!--{assign var=key1 value="search_buy_total_from"}-->
                    <!--{assign var=key2 value="search_buy_total_to"}-->
                    <!--{if $arrErr[$key1] || $arrErr[$key2]}--><span class="attention">
                        <!--{$arrErr[$key1]}--><!--{$arrErr[$key2]}--></span><br />
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key1].value|h}-->" size="6" class="box6" <!--{if $arrErr[$key1] || $arrErr[$key2]}--><!--{sfSetErrorStyle}--><!--{/if}--> /> 円 ～
                           <input type="text" name="<!--{$key2}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key2].value|h}-->" size="6" class="box6" <!--{if $arrErr[$key1] || $arrErr[$key2]}--><!--{sfSetErrorStyle}--><!--{/if}--> /> 円
                </td>
            </tr>
            <tr>
                <th>購入回数</th>
                <td>
                    <!--{assign var=key1 value="search_buy_times_from"}-->
                    <!--{assign var=key2 value="search_buy_times_to"}-->
                    <!--{if $arrErr.buy_times_from || $arrErr.buy_times_to}-->
                    <span class="attention"><!--{$arrErr.buy_times_from}--><!--{$arrErr.buy_times_to}--></span><br />
                    <!--{/if}-->
                    <input type="text" name="<!--{$key1}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key1].value|h}-->" size="6" class="box6" <!--{if $arrErr[$key1] || $arrErr[$key2]}--><!--{sfSetErrorStyle}--><!--{/if}--> /> 回 ～
                           <input type="text" name="<!--{$key2}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key2].value|h}-->" size="6" class="box6" <!--{if $arrErr[$key1] || $arrErr[$key2]}--><!--{sfSetErrorStyle}--><!--{/if}--> /> 回</td>
                </td>
            </tr>
            <tr>
                <th>登録・更新日</th>
                <td>
                    <!--{assign var=errkey1 value="search_start_year"}-->
                    <!--{assign var=errkey2 value="search_end_year"}-->
                    <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><span class="attention"><!--{$arrErr[$errkey1]}--><!--{$arrErr[$errkey2]}--></span><br /><!--{/if}-->
                    <!--{assign var=key value="search_start_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_start_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_start_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日～
                    <!--{assign var=key value="search_end_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_end_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_end_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>最終購入日</th>
                <td>
                    <!--{assign var=errkey1 value="search_buy_start_year"}-->
                    <!--{assign var=errkey2 value="search_buy_end_year"}-->
                    <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><span class="attention"><!--{$arrErr[$errkey1]}--><!--{$arrErr[$errkey2]}--></span><br /><!--{/if}-->
                    <!--{assign var=key value="search_buy_start_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_buy_start_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_buy_start_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日～
                    <!--{assign var=key value="search_buy_end_year"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">----</option>
                        <!--{html_options options=$arrRegistYear selected=$arrForm[$key].value}-->
                    </select>年
                    <!--{assign var=key value="search_buy_end_month"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrMonth selected=$arrForm[$key].value}-->
                    </select>月
                    <!--{assign var=key value="search_buy_end_day"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey1] || $arrErr[$errkey2]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="" selected="selected">--</option>
                        <!--{html_options options=$arrDay selected=$arrForm[$key].value}-->
                    </select>日
                </td>
            </tr>
            <tr>
                <th>購入商品名</th>
                <td>
                    <!--{assign var=key value="search_buy_product_name"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><!--{/if}-->
                    <span style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
                        <input type="text" name="<!--{$key}-->" maxlength="<!--{$arrForm[$key].length}-->" value="<!--{$arrForm[$key].value|h}-->" size="30" class="box30" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"/>
                    </span>
                </td>
            </tr>
            <tr>
                <th>購入商品コード</th>
                <td>
                    <!--{assign var=key value="search_buy_product_code"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><!--{/if}-->
                    <input type="text" name="<!--{$key}-->" value="<!--{$arrForm[$key].value|h}-->" maxlength="<!--{$arrForm[$key].length}-->" size="30" class="box30" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" >
                </td>
            </tr>
            <tr>
                <th>カテゴリ</th>
                <td>
                    <!--{assign var=key value="search_category_id"}-->
                    <select name="<!--{$key}-->" <!--{if $arrErr[$errkey]}--><!--{sfSetErrorStyle}--><!--{/if}-->>
                            <option value="">選択してください</option>
                        <!--{html_options options=$arrCatList selected=$arrForm[$key].value}-->
                    </select>
                </td>
            </tr>
            <tr>
                <th>配信形式</th>
                <td>
                    <!--{assign var=key value="search_htmlmail"}-->
                    <!--{if $arrErr[$key]}--><span class="attention"><!--{$arrErr[$key]}--></span><br /><!--{/if}-->
                    <!--{html_radios name=$key options=$arrHtmlmail separator="&nbsp;" selected=$arrForm[$key].value}-->
                </td>
            </tr>
            <tr>
                <th>配信メールアドレス種別</th>
                <td>
                    <!--{assign var=key value="search_mail_type"}-->
                    <!--{html_radios name=$key options=$arrMailType separator="<br />" selected=$arrForm[$key].value|default:1}-->
                </td>
            </tr>
        </table>

        <div class="btn">
            <p class="page_rows">検索結果表示件数
                <!--{assign var=key value="search_page_max"}-->
                <select name="<!--{$key}-->">
                    <!--{html_options options=$arrPageRows selected=$arrForm[$key]}-->
                </select> 件</p>
            <div class="btn-area">
                <ul>
                    <li><a class="btn-action" href="javascript:;" onclick="return fnInsertValAndSubmit(document.search_form, 'mode', 'check_customer', '');
                            return false;"><span class="btn-next">この条件で検索する</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</form>

<!--{if count($arrErr) == 0 and ($smarty.post.mode == 'check_customer' or $smarty.post.mode == 'check')}-->

<form name="form1" id="form1" method="post" action="?">
    <!--{foreach key=key item=item from=$arrForm}-->
    <!--{if $key == 'mail_method' || $key == 'kanrititle' || $key == 'subject' || $key == 'body' || $key == 'template_id' || $key == 'send_id' || $key == 'cid'}-->
    <input type="hidden" name="<!--{$key}-->" value="<!--{$item.value|h}-->" />
    <!--{/if}-->
    <!--{/foreach}-->

    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="" />
    <!--{foreach key=key item=item from=$arrHidden}-->
    <!--{if is_array($item)}-->
    <!--{foreach item=c_item from=$item}-->
    <input type="hidden" name="<!--{$key}-->[]" value="<!--{$c_item|h}-->" />
    <!--{/foreach}-->
    <!--{else}-->
    <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
    <!--{/foreach}-->

    <h2>検索結果一覧</h2>
    <div class="btn">
        <span class="attention"><!--検索結果数--><!--{$tpl_linemax}-->件</span>&nbsp;が該当しました。
        <!--{if $tpl_linemax > 0}-->
        <a class="btn-normal" href="javascript:;" onclick="document.form1['mode'].value = 'input';
                            document.form1.submit();
                            return false;"><span>配信先に設定する</span></a>
        <!--{/if}-->
    </div>
    <!--{if count($arrResults) > 0}-->

    <!--{include file=$tpl_pager}-->

    <!--検索結果表示テーブル-->
    <table class="list">
        <col width="5%" />
        <col width="10%" />
        <col width="25%" />
        <col width="30%" />
        <col width="15%" />
        <col width="15%" />
        <tr>
            <th></th>
            <th>会員ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>希望配信</th>
            <th>登録・更新日</th>
        </tr>
        <!--{section name=i loop=$arrResults}-->
        <tr>
            <!--{assign var="cid" value="`$arrResults[i].customer_id`"}-->
            <td class="center"><input type="checkbox" name="cid[]" value="<!--{$arrResults[i].customer_id}-->" <!--{if in_array($cid, $cids)}-->CHECKED<!--{/if}--> /></td>
            <td class="center"><!--{$arrResults[i].customer_id}--></td>
            <td><!--{$arrResults[i].name01|h}--> <!--{$arrResults[i].name02|h}--></td>
            <td><!--{$arrResults[i].email|h}--></td>
            <!--{assign var="key" value="`$arrResults[i].mailmaga_flg`"}-->
            <td class="center"><!--{$arrHtmlmail[$key]}--></td>
            <td class="center"><!--{$arrResults[i].update_date|sfDispDBDate}--></td>
        </tr>
        <!--{/section}-->
    </table>
    <!--検索結果表示テーブル-->
    <!--{/if}-->

</form>

<!--{/if}-->


