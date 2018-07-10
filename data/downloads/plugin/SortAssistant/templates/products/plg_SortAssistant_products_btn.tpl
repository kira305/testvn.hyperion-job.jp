<!--{*
 * SortAssistant
 * 
 * Copyright (c) 2014 doishun
 * http://www.salon.ne.jp
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 *}-->

<div class="btn-area" id="btn_addnew">
<ul>

<!--{* 並び替え前 *}-->
<!--{if $mode == "" || $mode != "sortable"}-->

    <!--{if $sortCount > 1}-->
    <!--{if $mode != 'pre_edit'}-->
    <li>
        <a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'sortable', '', ''); return false;">
            <span class="btn-next">並び替え開始</span>
        </a>
    </li>
    <!--{/if}-->
    <!--{/if}-->

    <!--{* EC標準 *}-->
    <li><a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1', 'edit', '', ''); return false;"><span class="btn-next">この内容で登録する</span></a></li>

<!--{* 並び替え中 *}-->
<!--{else}-->
    <li>
        <a class="btn-action" id="sort_stop" href="javascript:;">
            <span class="btn-prev">並び替え中止</span>
        </a>
    </li>

    <li>
        <a class="btn-action" href="javascript:;" onclick="fnFormModeSubmit('form1','sort_excu','',''); return false;">
            <span class="btn-next">並び替え完了</span>
        </a>
    </li>


<!--{/if}-->

</ul>
</div>