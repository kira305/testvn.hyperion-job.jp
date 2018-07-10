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
<!--
    function fnReturn() {
        document.search_form.action = './<!--{$smarty.const.DIR_INDEX_PATH}-->';
        document.search_form.submit();
        return false;
    }
//-->
</script>

<form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="search" />

    <!--{foreach from=$arrHidden key=key item=item}-->
    <!--{if $key ne "staff_id" && $key ne "mode" && $key ne "edit_staff_id" && $key ne $smarty.const.TRANSACTION_ID_NAME}-->
    <!--{if is_array($item)}-->
    <!--{foreach item=c_item from=$item}-->
    <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
    <!--{/foreach}-->
    <!--{else}-->
    <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
    <!--{/if}-->
    <!--{/foreach}-->

    <div id="staff" class="contents-main">
        <table class="form">
            <tr>
                <th>社員ID</th>
                <td colspan="3"><!--{$arrStaff.staff_id|h}--></td>
            </tr>
            <tr>
                <th>お名前</th>
                <td colspan="3"><!--{$arrStaff.name01|h}--><!--{$arrStaff.name02|h}-->　様</td>
            </tr>
            <tr>
                <th>お名前(フリガナ)</th>
                <td colspan="3"><!--{$arrStaff.kana01|h}--><!--{$arrStaff.kana02|h}-->　様</td>
            </tr>
	    <!--{if $arrStaff.is_haken == 0 && $arrStaff.parent_staff_id == 0}-->
            <tr>
                <th>部門/所属</th>
                <td colspan="3"><!--{$arrAffiliation[$arrStaff.affiliation]|h}--></td>
            </tr>
	    <!--{/if}-->
	    <!--{if $arrStaff.parent_staff_id > 0}-->
            <tr>
                <th>扶養主</th>
                <td colspan="3"><!--{$arrStaff.parent_name01|h}--> <!--{$arrStaff.parent_name02|h}--></td>
            </tr>
            <tr>
                <th>扶養主マイナンバー</th>
                <td colspan="3"><!--{$arrStaff.parent_mynumber|h}--></td>
            </tr>
            <tr>
                <th>続柄</th>
                <td colspan="3"><!--{$arrRelation[$arrStaff.relation_id]|h}--></td>
            </tr>
            <tr>
                <th>同居の情報</th>
                <td colspan="3"><!--{$arrIsLiveTogether[$arrStaff.is_live_together]|h}--></td>
            </tr>
            <tr>
                <th>生年月日</th>
                <td colspan="3"><!--{$arrStaff.birth|h}--></td>
            </tr>
	    <!--{/if}-->
            <tr>
                <th>マイナンバー登録</th>
                <td colspan="3"><!--{$arrStaff.mynumber|h}--></td>
            </tr>
            <tr>
                <th>マイナンバー登録（画像 1）</th>
                <td colspan="3">
                    <!--{assign var=key value="mynumber_image"}-->
                    <!--{if $arrStaff.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrStaff.arrFile[$key].filepath}-->" alt="<!--{$arrStaff.mynumber|h}-->" /><br />
                    <!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>マイナンバー登録（画像 2）</th>
                <td colspan="3">
                    <!--{assign var=key value="mynumber_image_back"}-->
                    <!--{if $arrStaff.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrStaff.arrFile[$key].filepath}-->" alt="<!--{$arrStaff.mynumber|h}-->" /><br />
                    <!--{/if}-->
                </td>
            </tr>
        </table>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="javascript:;" onclick="fnSetFormSubmit('form1', 'mode', 'search'); return false;"><span class="btn-prev">検索画面に戻る</span></a></li>
            </ul>
        </div>
    </div>
</form>
