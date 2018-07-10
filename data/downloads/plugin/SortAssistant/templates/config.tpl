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

<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
</script>

<form name="form1" id="form1" method="post" action="?plugin_id=<!--{$smarty.get.plugin_id|h}-->">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="">

<h2><!--{$tpl_subtitle}-->について</h2>
<div class="plg_salon_description">
    ECCUBE標準での並び替えの操作は「上」や「下」などのリンクをクリックすることで行います。<br/>
    <img src="<!--{$smarty.const.ROOT_URLPATH}-->plugin/SortAssistant/img/SortAssistant0.png"><br/>
    選択肢やデータが多いと並び替えにそれだけ分「上」「下」をクリックしないといけなくなります。<br/>
    <br/>
    そこでドラッグによって並び替えができるようにサポートします！<br/>
    現在サポートしているページ一覧<br/>

    <div class="clearfix">
    <div class="plg_salon_sortassistant">
        <p>基本情報管理</p>
        <ul>
            <li>配送方法</li>
            <li>支払方法</li>
            <li>会員規約</li>
            <li>定休日</li>
        </ul>
    </div>

    <div class="plg_salon_sortassistant">
        <p>商品管理</p>
        <ul>
            <li>規格管理</li>
            <li>規格分類</li>
            <li>カテゴリ</li>
            <li>メーカー</li>
            <li>商品並び替え</li>
        </ul>
    </div>

    <div class="plg_salon_sortassistant">
        <p>コンテンツ管理</p>
        <ul>
            <li>新着情報</li>
        </ul>
    </div>
    </div>
</div>


<h2>使い方</h2>
<div class="plg_salon_description">
    プラグインを有効にするとサポートしているページに「並び替え開始」ボタンが表示されます。<br/>
    <ol>
        <li>並び替え開始ボタンをクリック</li>
        <li>左カラムの画像を上下にドラッグして並び替え</li>
        <li>並び替え完了or並び替え中止ボタンクリックで操作を終了</li>
    </ol>

    <img src="<!--{$smarty.const.ROOT_URLPATH}-->plugin/SortAssistant/img/SortAssistant1.png"><br/><br/>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->
<style>
div.plg_salon_description { line-height: 1.5em; }
div.plg_salon_description img { padding: 5px 0; }
div.plg_salon_description ul li {
    list-style: disc;
    list-style-position: inside;
}

div.plg_salon_description ul,
div.plg_salon_description ol {
    padding: 3px 0;
}

div.plg_salon_description ol li {
    list-style: decimal;
    list-style-position: inside;
}
div.plg_salon_sortassistant { width:33%; float:left; margin:5px 0; }
div.plg_salon_sortassistant p { font-weight:bold; }
</style>
