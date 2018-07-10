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

<script type="text/javascript">
// 表示非表示切り替え
function lfDispSwitch(id){
    var obj = document.getElementById(id);
    if (obj.style.display == 'none') {
        obj.style.display = '';
    } else {
        obj.style.display = 'none';
    }
}

// セレクトボックスのリストを移動
// (移動元セレクトボックスID, 移動先セレクトボックスID)
function fnMoveSelect(select, target) {
    $('#' + select).children().each(function() {
        if (this.selected) {
            $('#' + target).append(this);
            $(this).attr({selected: false});
        }
    });
    // IE7再描画不具合対策
    if ($.browser.msie && $.browser.version >= 7) {
        $('#' + select).hide();
        $('#' + select).show();
        $('#' + target).hide();
        $('#' + target).show();
    }
}

// target の子要素を選択状態にする
function selectAll(target) {
    $('#' + target).children().attr({selected: true});
}

function throwAlert(id){
	<!--{foreach key=key item=item from=$arrWorkLocationFlg}-->
		if(id == <!--{$key}-->){
			alert('地域は（ <!--{$item}--> ）でよろしいですか。');
		}
	<!--{/foreach}-->
}

function fill_subcomment(no, checked_flg, val){
	if(checked_flg == true){
		var cmt = document.getElementsByName('sub_comment'+no);
		cmt[0].value = cmt[0].value+' '+val;
	}
}

function agencyChanged(agencySelect){
    if(agencySelect.selectedIndex !== 0){
        var corporateSelect = document.getElementById('corporate_id');
        corporateSelect.options.length = 0;
        var newOption = document.createElement('option');
        newOption.value = '';
        if (typeof newOption.textContent === 'undefined')
        {
            newOption.innerText = '選択してください';
        }
        else
        {
            newOption.textContent = '選択してください';
        }
        corporateSelect.appendChild(newOption);
        
        <!--{foreach from=$arrCORPORATE key=k item=v}-->
            if(agencySelect.selectedIndex == '<!--{$k}-->'){
                <!--{foreach from=$v key=index item=value}-->
                    newOption = document.createElement('option');
                    newOption.value = '<!--{$index}-->';
                    if (typeof newOption.textContent === 'undefined')
                    {
                        newOption.innerText = '<!--{$value}-->';
                    }
                    else
                    {
                        newOption.textContent = '<!--{$value}-->';
                    }
                    corporateSelect.appendChild(newOption);
                <!--{/foreach}-->
            }
        <!--{/foreach}-->
    }
}

</script>

<form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<!--{foreach key=key item=item from=$arrSearchHidden}-->
    <!--{if is_array($item)}-->
        <!--{foreach item=c_item from=$item}-->
        <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
    <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
<!--{/foreach}-->
<input type="hidden" name="mode" value="edit" />
<input type="hidden" name="image_key" value="" />
<input type="hidden" name="down_key" value="">
<input type="hidden" name="product_id" value="<!--{$arrForm.product_id|h}-->" />
<input type="hidden" name="product_class_id" value="<!--{$arrForm.product_class_id|h}-->" />
<input type="hidden" name="copy_product_id" value="<!--{$arrForm.copy_product_id|h}-->" />
<input type="hidden" name="anchor_key" value="" />
<input type="hidden" name="select_recommend_no" value="" />
<input type="hidden" name="has_product_class" value="<!--{$arrForm.has_product_class|h}-->" />
<!--{foreach key=key item=item from=$arrForm.arrHidden}-->
<input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
<!--{/foreach}-->
    
    
<div ID="admin_sample_01" onClick="document.all.item('admin_sample_01').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_01.png" width="600" height="600"/></div>
<div ID="admin_sample_02" onClick="document.all.item('admin_sample_02').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_02.png" width="600" height="600"/></div>
<div ID="admin_sample_03" onClick="document.all.item('admin_sample_03').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_03.png" width="600" height="600"/></div>
<div ID="admin_sample_04" onClick="document.all.item('admin_sample_04').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_04.png" width="600" height="600"/></div>
<div ID="admin_sample_05" onClick="document.all.item('admin_sample_05').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_05.png" width="600" height="600"/></div>
<div ID="admin_sample_06" onClick="document.all.item('admin_sample_06').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_06.png" width="600" height="600"/></div>
<div ID="admin_sample_07" onClick="document.all.item('admin_sample_07').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_07.png" width="600" height="600"/></div>
<div ID="admin_sample_08" onClick="document.all.item('admin_sample_08').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_08.png" width="600" height="600"/></div>
<div ID="admin_sample_09" onClick="document.all.item('admin_sample_09').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_09.png" width="600" height="600"/></div>
<div ID="admin_sample_10" onClick="document.all.item('admin_sample_10').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_10.png" width="600" height="600"/></div>
<div ID="admin_sample_11" onClick="document.all.item('admin_sample_11').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_11.png" width="600" height="600"/></div>
<div ID="admin_sample_12" onClick="document.all.item('admin_sample_12').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_12.png" width="600" height="600"/></div>
<div ID="admin_sample_13" onClick="document.all.item('admin_sample_13').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_13.png" width="600" height="600"/></div>
<div ID="admin_sample_14" onClick="document.all.item('admin_sample_14').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_14.png" width="600" height="600"/></div>
<div ID="admin_sample_15" onClick="document.all.item('admin_sample_15').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_15.png" width="600" height="600"/></div>
<div ID="admin_sample_16" onClick="document.all.item('admin_sample_16').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_16.png" width="600" height="600"/></div>
<div ID="admin_sample_17" onClick="document.all.item('admin_sample_17').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_17.png" width="600" height="600"/></div>
<div ID="admin_sample_18" onClick="document.all.item('admin_sample_18').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_18.png" width="600" height="600"/></div>
<div ID="admin_sample_19" onClick="document.all.item('admin_sample_19').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_19.png" width="600" height="600"/></div>
<div ID="admin_sample_20" onClick="document.all.item('admin_sample_20').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_20.png" width="600" height="600"/></div>
<div ID="admin_sample_21" onClick="document.all.item('admin_sample_21').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_21.png" width="600" height="600"/></div>
<div ID="admin_sample_22" onClick="document.all.item('admin_sample_22').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_22.png" width="600" height="600"/></div>
<div ID="admin_sample_23" onClick="document.all.item('admin_sample_23').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_23.png" width="600" height="600"/></div>
<div ID="admin_sample_24" onClick="document.all.item('admin_sample_24').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_24.png" width="600" height="600"/></div>
<div ID="admin_sample_25" onClick="document.all.item('admin_sample_25').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_25.png" width="600" height="600"/></div>
<div ID="admin_sample_26" onClick="document.all.item('admin_sample_26').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_26.png" width="600" height="600"/></div>
<div ID="admin_sample_27" onClick="document.all.item('admin_sample_27').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_27.png" width="600" height="600"/></div>
<div ID="admin_sample_28" onClick="document.all.item('admin_sample_28').style.display='none'" style="display:none;"><img src="<!--{$TPL_URLPATH}-->img/admin/admin_sample_28.png" width="600" height="600"/></div>
    
<div id="products" class="contents-main">
    <h2>基本情報</h2>

    <table class="form">
        <tr>
            <th>会社名<span class="attention"> *</span></th>
            <td>
                <!--{assign var=key value="agency_id"}-->
                <!--{if $smarty.session.authority == 2 || $smarty.session.authority == 3}-->
                    <!--{$arrAGENCY[$smarty.session.agency_id]}--><input type="hidden" name="<!--{$key}-->" value="<!--{$smarty.session.agency_id}-->" />
                <!--{else}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <select id="<!--{$key}-->" name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" onchange="agencyChanged(this);">
                        <option value="">選択してください</option>
                        <!--{html_options options=$arrAGENCY selected=$arrForm[$key]}-->
                    </select>
                <!--{/if}-->
            </td>
        </tr>

        <tr>
            <th>薬局名<span class="attention"> *</span></th>
            <td>
                <!--{assign var=key value="corporate_id"}-->
                <!--{if $smarty.session.authority == 3}-->
                    <!--{$arrCORPORATE[$smarty.session.agency_id][$smarty.session.corporate_id]}--><input type="hidden" name="<!--{$key}-->" value="<!--{$smarty.session.corporate_id}-->" />
                <!--{else}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <select id="<!--{$key}-->" name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
                        <option value="">選択してください</option>
                        <!--{html_options options=$arrCORPORATE[$arrForm.agency_id] selected=$arrForm[$key]}-->
                    </select>
                <!--{/if}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">求人ID</span></th>
            <td><!--{$arrForm.product_id|h}--></td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_01').style.display='block'" onClick="document.all.item('admin_sample_01').style.display='none'">求人名</span><span class="attention"> *</span></span>
                </th>
            <td>
                <span class="attention"><!--{$arrErr.name}--></span>
                <input type="text" name="name" value="<!--{$arrForm.name|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.name != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
                <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th>おすすめ情報フラグ</th>
            <td>
                <!--{html_radios name="rec_news_flg" options=$arrRECNEWSFLG selected=$arrForm.rec_news_flg separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <tr>
            <th>新着求人情報</th>
            <td>
                <!--{html_radios name="news_flg" options=$arrNEWSFLG selected=$arrForm.news_flg separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_22').style.display='block'" onClick="document.all.item('admin_sample_22').style.display='none'">求人カテゴリ</span><span class="attention"> *</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.category_id}--></span>
                <table class="layout">
                    <tr>
                        <td>
                            <select name="category_id[]" id="category_id" style="<!--{if $arrErr.category_id != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}--> height: 120px; min-width: 200px;" onchange="" size="10" multiple>
                            </select>
                        </td>
                        <td style="padding: 15px;">
                            <a class="btn-normal" href="javascript:;" name="on_select" onclick="fnMoveSelect('category_id_unselect','category_id'); return false;">&nbsp;&nbsp;&lt;-&nbsp;登録&nbsp;&nbsp;</a><br /><br />
                            <a class="btn-normal" href="javascript:;" name="un_select" onclick="fnMoveSelect('category_id','category_id_unselect'); return false;">&nbsp;&nbsp;削除&nbsp;-&gt;&nbsp;&nbsp;</a>
                        </td>
                        <td>
                            <select name="category_id_unselect[]" id="category_id_unselect" onchange="" size="10" style="height: 120px; min-width: 200px;" multiple>
                                <!--{html_options values=$arrCatVal output=$arrCatOut selected=$arrForm.category_id}-->
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <th><span class="attention2">公開・非公開<span class="attention"> *</span></span></th>
            <td>
                <!--{html_radios name="status" options=$arrDISP selected=$arrForm.status separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <tr>
            <th>ダミーフラグ</th>
            <td>
                <!--{html_radios name="dummy_flg" options=$arrDUMMYFLG selected=$arrForm.dummy_flg separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <tr>
            <th>掲載終了日</th>
            <td>
                <span class="attention"><!--{$arrErr.year}--></span>
                <select name="year" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                    <option value="" selected="selected">------</option>
                    <!--{html_options options=$arrYear selected=$arrForm.year}-->
                </select>年
                <select name="month" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                    <option value="" selected="selected">----</option>
                    <!--{html_options options=$arrMonth selected=$arrForm.month}-->
                </select>月
                <select name="day" <!--{if $arrErr.year != ""}--><!--{sfSetErrorStyle}--><!--{/if}--> >
                    <option value="" selected="selected">----</option>
                    <!--{html_options options=$arrDay selected=$arrForm.day"}-->
                </select>日
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_10').style.display='block'" onClick="document.all.item('admin_sample_10').style.display='none'">優遇/待遇/シフト 【合計14件目安】</span></span></th>
            <td>
                <!--{html_checkboxes name="product_status" options=$arrSTATUS selected=$arrForm.product_status separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <!--{if $arrForm.has_product_class == false}-->
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_10').style.display='block'" onClick="document.all.item('admin_sample_10').style.display='none'">雇用形態 【合計14件目安】</span></span></th>
            <td>
                <!--{html_checkboxes name="employment_status" options=$arrEMPSTATUS selected=$arrForm.employment_status separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_10').style.display='block'" onClick="document.all.item('admin_sample_10').style.display='none'">アピールポイント 【合計14件目安】</span></span></th>
            <td>
                <!--{html_checkboxes name="appeal_point" options=$arrAPPEALPOINT selected=$arrForm.appeal_point separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
		<input type="hidden" value="1" name="product_type_id" />
        <tr>   
            <th>ダウンロードファイル名</th>
            <td>
                <span class="attention"><!--{$arrErr.down_filename}--></span>
                <input type="text" name="down_filename" value="<!--{$arrForm.down_filename|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.down_filename != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}--><!--{/if}-->" size="60" class="box60" />
                <span class="red"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <!--{assign var=key value="down_file"}-->
            <th>ダウンロードファイルアップロード</th>
            <td>
                <a name="<!--{$key}-->"></a>
                <span class="attention"><!--{$arrErr[$key]}--><!--{$arrErr.down_realfilename}--></span>
                    <!--{if $arrForm.down_realfilename != ""}-->
                       <!--{$arrForm.down_realfilename|h}--><input type="hidden" name="down_realfilename" value="<!--{$arrForm.down_realfilename|h}-->">
                     <a href="" onclick="selectAll('category_id'); fnModeSubmit('delete_down', 'down_key', '<!--{$key}-->'); return false;">[ファイルの取り消し]</a><br>
                   <!--{/if}-->
                   <input type="file" name="down_file" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                    <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); fnModeSubmit('upload_down', 'down_key', '<!--{$key}-->'); return false;">アップロード</a><br />登録可能拡張子：<!--{$smarty.const.DOWNLOAD_EXTENSION}-->　(パラメーター DOWNLOAD_EXTENSION)
            </td>
        </tr>
		<tr>
            <th><span class="attention2">取引先 就業先<span class="attention"> *</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.product_code}--></span>
                <input type="text" name="product_code" value="<!--{$arrForm.product_code|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.product_code != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
                <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
<!--{*
/*        
*         <tr>
*            <th><!--{$smarty.const.NORMAL_PRICE_TITLE}--></th>
*            <td>
*                <span class="attention"><!--{$arrErr.price01}--></span>
*                <input type="text" name="price01" value="<!--{$arrForm.price01|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.PRICE_LEN}-->" style="<!--{if $arrErr.price01 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>円
*                <span class="attention"> (半角数字で入力)</span>
*            </td>
*        </tr>
*/
*}--> 
         <tr>
             <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_07').style.display='block'" onClick="document.all.item('admin_sample_07').style.display='none'"><!--{$smarty.const.SALE_PRICE_TITLE}--></span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.price02}--></span>
                <input type="text" name="price02" value="<!--{$arrForm.price02|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.PRICE_LEN}-->" style="<!--{if $arrErr.price02 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>円
            </td>
        </tr>
        <tr>
            <th>求人数<span class="attention"> *</span></th>
            <td>
                <span class="attention"><!--{$arrErr.stock}--></span>
                <input type="text" name="stock" value="<!--{$arrForm.stock|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.AMOUNT_LEN}-->" style="<!--{if $arrErr.stock != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <input type="checkbox" name="stock_unlimited" value="1" <!--{if $arrForm.stock_unlimited == "1"}-->checked<!--{/if}--> onclick="fnCheckStockLimit('<!--{$smarty.const.DISABLED_RGB}-->');"/>無制限
            </td>
        </tr>
        <!--{/if}-->
<!--{*
/*
*         <tr>
*            <th>（商品送料）</th>
*            <td>
*                <span class="attention"><!--{$arrErr.deliv_fee}--></span>
*                <input type="text" name="deliv_fee" value="<!--{$arrForm.deliv_fee|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.PRICE_LEN}-->" style="<!--{if $arrErr.deliv_fee != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>円
*                <span class="attention"> (半角数字で入力)</span>
*                <!--{if $smarty.const.OPTION_PRODUCT_DELIV_FEE != 1}--><br /><span class="attention">※現在無効です</span> (パラメーター OPTION_PRODUCT_DELIV_FEE)<!--{/if}-->
*            </td>
*        </tr>
*        <tr>
*            <th>(ポイント付与率）<span class="attention"> *</span></th>
*            <td>
*                <span class="attention"><!--{$arrErr.point_rate}--></span>
*                <input type="text" name="point_rate" value="<!--{$arrForm.point_rate|default:$arrForm.arrInfo.point_rate|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.PERCENTAGE_LEN}-->" style="<!--{if $arrErr.point_rate != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>％
*                <span class="attention"> (半角数字で入力)</span>
*            </td>
*        </tr>
*        <tr>
*            <th>（発送日目安）</th>
*            <td>
*                <span class="attention"><!--{$arrErr.deliv_date_id}--></span>
*                <select name="deliv_date_id" style="<!--{$arrErr.deliv_date_id|sfGetErrorColor}-->">
*                    <option value="">選択してください</option>
*                    <!--{html_options options=$arrDELIVERYDATE selected=$arrForm.deliv_date_id}-->
*                </select>
*            </td>
*        </tr>    
*		 <tr>
*            <th>応募制限数</th>
*            <td>
*                <span class="attention"><!--{$arrErr.sale_limit}--></span>
*                <input type="text" name="sale_limit" value="<!--{$arrForm.sale_limit|h}-->" size="6" class="box6" maxlength="<!--{$smarty.const.AMOUNT_LEN}-->" style="<!--{if $arrErr.sale_limit != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
*                <span class="attention"> (半角数字で入力)</span>
*            </td>
*        </tr>
*/
*}-->   
		<input type="hidden" name="sale_limit" value="1" />
        <tr>
            <th>会社名</th>
            <td>
                <span class="attention"><!--{$arrErr.maker_id}--></span>
                <select name="maker_id" style="<!--{$arrErr.maker_id|sfGetErrorColor}-->">
                    <option value="">選択してください</option>
                    <!--{html_options options=$arrMaker selected=$arrForm.maker_id}-->
                </select>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_27').style.display='block'" onClick="document.all.item('admin_sample_27').style.display='none'">URL</span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment1}--></span>
                <input type="text" name="comment1" value="<!--{$arrForm.comment1|h}-->" maxlength="<!--{$smarty.const.URL_LEN}-->" size="60" class="box60" style="<!--{$arrErr.comment1|sfGetErrorColor}-->" />
                <span class="attention"> (上限<!--{$smarty.const.URL_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th>条件</th>
            <td>
                <!--{html_checkboxes name="conditions" options=$arrCONDITION selected=$arrForm.conditions separator='&nbsp;&nbsp;'}-->
            </td>
        </tr>
<!--{*
        <tr>
            <th>薬局名</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.shipping_pharmacy}--></span>
                <input type="text" name="shipping_pharmacy" value="<!--{$arrForm.shipping_pharmacy|h}-->" size="50" class="box50" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.shipping_pharmacy != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
       </tr>
        <tr>
            <th>求人担当者名</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.pharmacist_name1}--></span>
                <input type="text" name="pharmacist_name1" value="<!--{$arrForm.pharmacist_name1|h}-->" size="25" class="box25" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.pharmacist_name1 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <span class="attention"><!--{$arrErr.pharmacist_name2}--></span>
                <input type="text" name="pharmacist_name2" value="<!--{$arrForm.pharmacist_name2|h}-->" size="25" class="box25" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.pharmacist_name2 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
       </tr>
　　　　<tr>
            <th>求人担当者名(カナ)</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.pharmacist_kana1}--></span>
                <input type="text" name="pharmacist_kana1" value="<!--{$arrForm.pharmacist_kana1|h}-->" size="25" class="box25" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.pharmacist_kana1 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <span class="attention"><!--{$arrErr.pharmacist_kana2}--></span>
                <input type="text" name="pharmacist_kana2" value="<!--{$arrForm.pharmacist_kana2|h}-->" size="25" class="box25" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.pharmacist_kana2 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
       </tr>
　　　　<tr>
            <th>郵便番号</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.zip1}--></span>
                <input type="text" name="zip1" value="<!--{$arrForm.zip1|h}-->" size="10" class="box10" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.zip1 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <span class="attention"><!--{$arrErr.zip2}--></span>
                <input type="text" name="zip2" value="<!--{$arrForm.zip2|h}-->" size="10" class="box10" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.zip2 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
        </tr>　
        <tr>
            <th>住所</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.addr1}--></span>
                <input type="text" name="addr1" value="<!--{$arrForm.addr1|h}-->" size="50" class="box50" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.addr1 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                
                <span class="attention"><!--{$arrErr.addr2}--></span>
                <input type="text" name="addr2" value="<!--{$arrForm.addr2|h}-->" size="50" class="box50" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.addr2 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
       </tr>
　　　　<tr>
            <th>電話番号</th>
　　　　　　<td>
                <span class="attention"><!--{$arrErr.tel1}--></span>
                <input type="text" name="tel1" value="<!--{$arrForm.tel1|h}-->" size="10" class="box10" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.tel1 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <span class="attention"><!--{$arrErr.tel2}--></span>
                <input type="text" name="tel2" value="<!--{$arrForm.tel2|h}-->" size="10" class="box10" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.tel2 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
                <span class="attention"><!--{$arrErr.tel3}--></span>
                <input type="text" name="tel3" value="<!--{$arrForm.tel3|h}-->" size="10" class="box10" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.tel3 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"/>
            </td>　
       </tr>
 *}-->
　　　　<tr>
        <th><span class="attention2">検索ワード</span><br />※複数の場合は、カンマ( , )区切りで入力して下さい</th>
            <td>
                <span class="attention"><!--{$arrErr.comment3}--></span>
                <textarea name="comment3" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr.comment3|sfGetErrorColor}-->"><!--{$arrForm.comment3|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th>備考欄(SHOP専用)</th>
            <td>
                <span class="attention"><!--{$arrErr.note}--></span>
                <textarea name="note" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr.note|sfGetErrorColor}-->"><!--{$arrForm.note|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th>一覧-メインコメント</th>
            <td>
                <span class="attention"><!--{$arrErr.main_list_comment}--></span>
                <textarea name="main_list_comment" maxlength="<!--{$smarty.const.MTEXT_LEN}-->" style="<!--{if $arrErr.main_list_comment != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" cols="60" rows="8" class="area60"><!--{$arrForm.main_list_comment|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.MTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_02').style.display='block'" onClick="document.all.item('admin_sample_02').style.display='none'">サブタイトル</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment7}--></span>
                <input type="text" name="comment7" value="<!--{$arrForm.comment7|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment7 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_03').style.display='block'" onClick="document.all.item('admin_sample_03').style.display='none'">サブタイトル/コメント</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment8}--></span>
                <textarea type="text" name="comment8" value="<!--{$arrForm.comment8|nl2br}-->" maxlength="135" style="<!--{if $arrErr.comment8 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" cols="60" rows="4" class="area60"><!--{$arrForm.comment8|h}--></textarea><br />
<span class="attention"> (上限 4行まで 135文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_05').style.display='block'" onClick="document.all.item('admin_sample_05').style.display='none'">募集職種</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment9}--></span>
                <input type="text" name="comment9" value="<!--{$arrForm.comment9|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment9 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_13').style.display='block'" onClick="document.all.item('admin_sample_13').style.display='none'">追加エリア用 アピールタイトルA</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment10}--></span>
                <input type="text" name="comment10" value="<!--{$arrForm.comment10|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment10 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_14').style.display='block'" onClick="document.all.item('admin_sample_14').style.display='none'">追加エリア用 アピールコメントA</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment11}--></span>
                <textarea type="text" name="comment11" value="<!--{$arrForm.comment11|nl2br}-->" maxlength="300" style="<!--{if $arrErr.comment11 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"  cols="60" rows="4" class="area60"><!--{$arrForm.comment11|h}--></textarea><br />
<span class="attention"> (上限 7行まで 300文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_15').style.display='block'" onClick="document.all.item('admin_sample_15').style.display='none'">追加エリア用 アピールタイトルB</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment12}--></span>
                <input type="text" name="comment12" value="<!--{$arrForm.comment12|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment12 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_16').style.display='block'" onClick="document.all.item('admin_sample_16').style.display='none'">追加エリア用 アピールコメントB</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment13}--></span>
                <textarea type="text" name="comment13" value="<!--{$arrForm.comment13|nl2br}-->" maxlength="300" style="<!--{if $arrErr.comment13 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"  cols="60" rows="4" class="area60"><!--{$arrForm.comment13|h}--></textarea><br />
<span class="attention"> (上限 7行まで 300文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_18').style.display='block'" onClick="document.all.item('admin_sample_18').style.display='none'">追加エリア用 アピールタイトルC</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment14}--></span>
                <input type="text" name="comment14" value="<!--{$arrForm.comment14|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment14 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_19').style.display='block'" onClick="document.all.item('admin_sample_19').style.display='none'">追加エリア用 アピールコメントC</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment15}--></span>
                <textarea type="text" name="comment15" value="<!--{$arrForm.comment15|nl2br}-->" maxlength="300" style="<!--{if $arrErr.comment15 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"  cols="60" rows="4" class="area60"><!--{$arrForm.comment15|h}--></textarea><br />
<span class="attention"> (上限 7行まで 300文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_06').style.display='block'" onClick="document.all.item('admin_sample_06').style.display='none'">時給or日給 表記</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment16}--></span>
                <input value="時給" type="text" name="comment16" value="<!--{$arrForm.comment16|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment16 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>                
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_27').style.display='block'" onClick="document.all.item('admin_sample_27').style.display='none'">住所</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment17}--></span>
                <input type="text" name="comment17" value="<!--{$arrForm.comment17|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment17 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>              
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_12').style.display='block'" onClick="document.all.item('admin_sample_12').style.display='none'">googlemap用url</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment18}--></span>
                <input value="https://www.google.co.jp/maps/place/" type="text" name="comment18" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment18 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>                
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_28').style.display='block'" onClick="document.all.item('admin_sample_28').style.display='none'">勤務先エリア (市町村)</span></span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment19}--></span>
                <input type="text" name="comment19" value="<!--{$arrForm.comment19|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr.comment19 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
<span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>                
            </td>
        </tr>
        <tr>
            <th><span class="attention2">給与備考</span><span class="attention">　</span></th>
            <td>
                <span class="attention"><!--{$arrErr.comment20}--></span>
                <textarea type="text" name="comment20" value="<!--{$arrForm.comment20|nl2br}-->" maxlength="300" style="<!--{if $arrErr.comment20 != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->"  cols="60" rows="4" class="area60"><!--{$arrForm.comment20|h}--></textarea><br />
<span class="attention"> (上限 7行まで 300文字)</span>              
            </td>
        </tr>
        <tr>
            <th>詳細-メインコメント<span class="attention">(タグ許可)*</span></th>
            <td>
                <span class="attention"><!--{$arrErr.main_comment}--></span>
                <textarea name="main_comment" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{if $arrErr.main_comment != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" cols="60" rows="8" class="area60"><!--{$arrForm.main_comment|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
　　　　<tr>
            <!--{assign var=key value="main_list_image"}-->
        <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_04').style.display='block'" onClick="document.all.item('admin_sample_04').style.display='none'">画像１</span></span><br />[<!--{$smarty.const.SMALL_IMAGE_WIDTH}-->×<!--{$smarty.const.SMALL_IMAGE_HEIGHT}-->]</th>
            <td>
                <a name="<!--{$key}-->"></a>
                <a name="main_image"></a>
                <a name="main_large_image"></a>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                <!--{/if}-->
                <input type="file" name="main_list_image" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); fnModeSubmit('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
            </td>
        </tr>
        <tr>
            <!--{assign var=key value="main_image"}-->
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_17').style.display='block'" onClick="document.all.item('admin_sample_17').style.display='none'">画像２</span></span><br />[<!--{$smarty.const.NORMAL_IMAGE_WIDTH}-->×<!--{$smarty.const.NORMAL_IMAGE_HEIGHT}-->]</th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                <!--{/if}-->
                <input type="file" name="main_image" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); fnModeSubmit('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
            </td>
        </tr>
        <tr>
            <!--{assign var=key value="main_large_image"}-->
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_20').style.display='block'" onClick="document.all.item('admin_sample_20').style.display='none'">画像３</span></span><br />[<!--{$smarty.const.LARGE_IMAGE_WIDTH}-->×<!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->]</th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />　<a href="" onclick="selectAll('category_id'); fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a><br />
                <!--{/if}-->
                <input type="file" name="<!--{$key}-->" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" />
                <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); fnModeSubmit('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
            </td>
        </tr>
    </table>

    <!--{* オペビルダー用 *}-->
    <!--{if "sfViewAdminOpe"|function_exists === TRUE}-->
    <!--{include file=`$smarty.const.MODULE_REALDIR`mdl_opebuilder/admin_ope_view.tpl}-->
    <!--{/if}-->

    <div class="btn">
        <a class="btn-normal" href="javascript:;" onclick="selectAll('category_id'); lfDispSwitch('sub_detail1'); return false;"><span>サブ情報１表示/非表示</span></a>
    </div>

    <!--{if $arrForm.sub_find == true}-->
    <div id="sub_detail1" style="">
    <!--{else}-->
    <div id="sub_detail1" style="display:none">
    <!--{/if}-->
    <h2>サブ情報</h2>
    <table class="form">
		<tr>
            <th><span class="attention2">地域</span></th>
            <td>
                <!--{html_radios name="work_location_flg" options=$arrWorkLocationFlg selected=$arrForm.work_location_flg separator='&nbsp;&nbsp;' onchange="throwAlert(this.value);"}-->
            </td>
        </tr>

        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_27').style.display='block'" onClick="document.all.item('admin_sample_27').style.display='none'"><!--{$arrSUBTITLE[1]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment1" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment1|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_11').style.display='block'" onClick="document.all.item('admin_sample_11').style.display='none'"><!--{$arrSUBTITLE[2]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment2" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment2|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_09').style.display='block'" onClick="document.all.item('admin_sample_09').style.display='none'"><!--{$arrSUBTITLE[3]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment3" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment3|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_08').style.display='block'" onClick="document.all.item('admin_sample_08').style.display='none'"><!--{$arrSUBTITLE[4]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment4" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment4|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_23').style.display='block'" onClick="document.all.item('admin_sample_23').style.display='none'"><!--{$arrSUBTITLE[5]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment5" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment5|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_21').style.display='block'" onClick="document.all.item('admin_sample_21').style.display='none'"><!--{$arrSUBTITLE[8]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment8" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment8|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_24').style.display='block'" onClick="document.all.item('admin_sample_24').style.display='none'"><!--{$arrSUBTITLE[9]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment9" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment9|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_25').style.display='block'" onClick="document.all.item('admin_sample_25').style.display='none'"><!--{$arrSUBTITLE[10]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment10" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment10|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <tr>
            <th><span class="attention2"><span class="admin_sample" onClick="document.all.item('admin_sample_26').style.display='block'" onClick="document.all.item('admin_sample_26').style.display='none'"><!--{$arrSUBTITLE[11]}--></span></span><span class="attention">(タグ許可)</span></th>
            <td>
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="sub_comment11" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm.sub_comment11|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
            </td>
        </tr>
    </table>
    </div>

	<div class="btn">
        <a class="btn-normal" href="javascript:;" onclick="selectAll('category_id'); lfDispSwitch('sub_detail2'); return false;"><span>サブ情報２表示/非表示</span></a>
    </div>

    <!--{if $arrForm.sub_find == true}-->
    <div id="sub_detail2" style="">
    <!--{else}-->
    <div id="sub_detail2" style="display:none">
    <!--{/if}-->
    <h2>サブ情報</h2>
    <table class="form">
        <!--{section name=cnt loop=$smarty.const.PRODUCTSUB_MAX}-->
		<!--{assign var=sub_no value="`$smarty.section.cnt.iteration`"}-->
		<!--{if $sub_no > 19}-->
        <!--▼商品<!--{$smarty.section.cnt.iteration}-->-->
        <tr>
            <th><!--{$arrSUBTITLE[$sub_no]}--><span class="attention">(タグ許可)</span></th>
            <!--{assign var=key value="sub_comment`$smarty.section.cnt.iteration`"}-->
            <td>
				<!--{if $sub_no == 39}-->
				<input type="checkbox" name="add_subcomment39" value="交通費全額支給" onchange="fill_subcomment(39, this.checked, this.value);">交通費全額支給
				<input type="checkbox" name="add_subcomment39" value="白衣貸与" onchange="fill_subcomment(39, this.checked, this.value);">白衣貸与<br>
				<!--{elseif $sub_no == 40}-->
				<input type="checkbox" name="add_subcomment40" value="総合" onchange="fill_subcomment(40, this.checked, this.value);">総合
				<input type="checkbox" name="add_subcomment40" value="内科" onchange="fill_subcomment(40, this.checked, this.value);">内科
				<input type="checkbox" name="add_subcomment40" value="耳鼻科" onchange="fill_subcomment(40, this.checked, this.value);">耳鼻科
				<input type="checkbox" name="add_subcomment40" value="小児科" onchange="fill_subcomment(40, this.checked, this.value);">小児科
				<input type="checkbox" name="add_subcomment40" value="精神科" onchange="fill_subcomment(40, this.checked, this.value);">精神科
				<input type="checkbox" name="add_subcomment40" value="皮膚科" onchange="fill_subcomment(40, this.checked, this.value);">皮膚科
				<input type="checkbox" name="add_subcomment40" value="眼科" onchange="fill_subcomment(40, this.checked, this.value);">眼科
				<input type="checkbox" name="add_subcomment40" value="整形外科" onchange="fill_subcomment(40, this.checked, this.value);">整形外科
				<!--{/if}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>

				<!--{if $sub_no == 20 || $sub_no == 21 || $sub_no == 22 || $sub_no == 24 || $sub_no == 25 || $sub_no == 27 || $sub_no == 41}-->
                <input type="text" name="sub_comment<!--{$smarty.section.cnt.iteration}-->" value="<!--{$arrForm[$key]|h}-->" maxlength="<!--{$smarty.const.STEXT_LEN}-->" style="<!--{if $arrErr[$key] != ""}-->background-color: <!--{$smarty.const.ERR_COLOR}-->;<!--{/if}-->" size="60" class="box60" />
                <span class="attention"> (上限<!--{$smarty.const.STEXT_LEN}-->文字)</span>
				<!--{else}-->
				<textarea name="sub_comment<!--{$smarty.section.cnt.iteration}-->" cols="60" rows="8" class="area60" maxlength="<!--{$smarty.const.LLTEXT_LEN}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->"><!--{$arrForm[$key]|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LLTEXT_LEN}-->文字)</span>
				<!--{/if}-->

            </td>
        </tr>
        <!--▲商品<!--{$smarty.section.cnt.iteration}-->-->
		<!--{/if}-->
        <!--{/section}-->
    </table>
    </div>

    <div class="btn">
        <a class="btn-normal" href="javascript:;" onclick="selectAll('category_id'); lfDispSwitch('recommend_select'); return false;"><span>関連商品表示/非表示</span></a>
    </div>

    <!--{if $smarty.const.OPTION_RECOMMEND == 1}-->
    <!--{if count($arrRecommend) > 0}-->
    <div id="recommend_select" style="">
    <!--{else}-->
    <div id="recommend_select" style="display:none">
    <!--{/if}-->
    <h2>関連商品</h2>
    <table class="form">
        <!--▼関連商品-->
        <!--{section name=cnt loop=$smarty.const.RECOMMEND_PRODUCT_MAX}-->
        <!--{assign var=recommend_no value="`$smarty.section.cnt.iteration`"}-->
        <tr>
            <!--{assign var=key value="recommend_id`$smarty.section.cnt.iteration`"}-->
            <!--{assign var=anckey value="recommend_no`$smarty.section.cnt.iteration`"}-->
            <th>関連商品(<!--{$smarty.section.cnt.iteration}-->)<br />
                <!--{if $arrRecommend[$recommend_no].product_id}-->
                    <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrRecommend[$recommend_no].main_list_image|sfNoImageMainList|h}-->&width=65&height=65" alt="<!--{$arrRecommend[$recommend_no].name|h}-->" />
                <!--{/if}-->
            </th>
            <td>
                <a name="<!--{$anckey}-->"></a>
                <input type="hidden" name="<!--{$key}-->" value="<!--{$arrRecommend[$recommend_no].product_id|h}-->" />
                <a class="btn-normal" href="javascript:;" name="change" onclick="selectAll('category_id'); win03('./product_select.php?no=<!--{$smarty.section.cnt.iteration}-->', 'search', '615', '500'); return false;">変更</a>
                <!--{assign var=key value="recommend_delete`$smarty.section.cnt.iteration`"}-->
                <input type="checkbox" name="<!--{$key}-->" value="1" />削除<br />
                <!--{assign var=key value="recommend_comment`$smarty.section.cnt.iteration`"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                商品コード:<!--{$arrRecommend[$recommend_no].product_code_min}--><br />
                商品名:<!--{$arrRecommend[$recommend_no].name|h}--><br />
                <textarea name="<!--{$key}-->" cols="60" rows="8" class="area60" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" ><!--{$arrRecommend[$recommend_no].comment|h}--></textarea><br />
                <span class="attention"> (上限<!--{$smarty.const.LTEXT_LEN}-->文字)</span>
            </td>
        </tr>
        <!--{/section}-->
        <!--▲関連商品-->
    </table>
    </div>
    <!--{/if}-->

    <div class="btn-area">
        <!--{if count($arrSearchHidden) > 0}-->
        <!--▼検索結果へ戻る-->
        <ul>
            <li><a class="btn-action" href="javascript:;" onclick="fnChangeAction('<!--{$smarty.const.ADMIN_PRODUCTS_URLPATH}-->'); fnModeSubmit('search','',''); return false;"><span class="btn-prev">検索画面に戻る</span></a></li>
        <!--▲検索結果へ戻る-->
        <!--{/if}-->
            <li><a class="btn-action" href="javascript:;" onclick="selectAll('category_id'); document.form1.submit(); return false;"><span class="btn-next">確認ページへ</span></a></li>
        </ul>
    </div>
</div>
</form>
