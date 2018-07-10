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

<form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="complete" />
<!--{foreach key=key item=item from=$arrSearchHidden}-->
    <!--{if is_array($item)}-->
        <!--{foreach item=c_item from=$item}-->
            <input type="hidden" name="<!--{$key|h}-->[]" value="<!--{$c_item|h}-->" />
        <!--{/foreach}-->
    <!--{else}-->
        <input type="hidden" name="<!--{$key|h}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
<!--{/foreach}-->
<!--{foreach key=key item=item from=$arrForm}-->
    <!--{if $key == 'product_status' || $key == 'employment_status' || $key == 'appeal_point' || $key == 'conditions'}-->
        <!--{foreach item=statusVal from=$item}-->
            <input type="hidden" name="<!--{$key}-->[]" value="<!--{$statusVal|h}-->" />
        <!--{/foreach}-->
    <!--{elseif $key == 'arrCategoryId'}-->
        <!--{* nop *}-->
    <!--{elseif $key == 'arrFile'}-->
        <!--{* nop *}-->
    <!--{else}-->
        <input type="hidden" name="<!--{$key}-->" value="<!--{$item|h}-->" />
    <!--{/if}-->
<!--{/foreach}-->
<div id="products" class="contents-main">

    <table>
        <tr>
            <th>会社名</th>
            <td><!--{$arrAGENCY[$arrForm.agency_id]}--></td>
        </tr>
        <tr>
            <th>薬局名</th>
            <td><!--{$arrCORPORATE[$arrForm.agency_id][$arrForm.corporate_id]}--></td>
        </tr>
        <tr>
            <th><span class="attention2">求人名</span></th>
            <td>
                <!--{$arrForm.name|h}-->
            </td>
        </tr>
        <tr>
            <th>おすすめ情報フラグ</th>
            <td><!--{$arrRECNEWSFLG[$arrForm.rec_news_flg]}--></td>
        </tr>
        <tr>
            <th>新着求人情報</th>
            <td><!--{$arrNEWSFLG[$arrForm.news_flg]}--></td>
        </tr>
        <tr>
            <th><span class="attention2">商品カテゴリ</span></th>
            <td>
                <!--{section name=cnt loop=$arrForm.arrCategoryId}-->
                    <!--{assign var=key value=$arrForm.arrCategoryId[cnt]}-->
                    <!--{$arrCatList[$key]|sfTrim}--><br />
                <!--{/section}-->
            </td>
        </tr>
        <tr>
            <th>公開・非公開</th>
            <td>
                <!--{$arrDISP[$arrForm.status]}-->
            </td>
        </tr>
		<tr>
            <th>掲載終了日</th>
            <td><!--{if strlen($arrForm.year) > 0 && strlen($arrForm.month) > 0 && strlen($arrForm.day) > 0}--><!--{$arrForm.year|h}-->年<!--{$arrForm.month|h}-->月<!--{$arrForm.day|h}-->日<!--{else}-->未登録<!--{/if}--></td>
        </tr>
        <tr>
            <th><span class="attention2">求人ステータス</span></th>
            <td>
                <!--{foreach from=$arrForm.product_status item=status}-->
                    <!--{if $status != ""}-->
                        <img src="<!--{$TPL_URLPATH}--><!--{$arrSTATUS_IMAGE[$status]}-->s.gif" width="80" height="17" alt="<!--{$arrSTATUS[$status]}-->"/>
                    <!--{/if}-->
                <!--{/foreach}-->
            </td>
        </tr>

        <!--{if $arrForm.has_product_class != true}-->
            <tr>
                <th>求人種別</th>
                <td>
                    <!--{$arrProductType[$arrForm.product_type_id]}-->
                </td>
            </tr>
			<tr>
                <th>ダウンロードファイル名</th>
                <td>
                    <!--{$arrForm.down_filename|h}-->
                </td>
            </tr>
            <tr>
                <th>ダウンロードファイルアップロード</th>
                <td>
                    <!--{if $arrForm.down_realfilename != ""}-->
                        <!--{$arrForm.down_realfilename|h}-->
                    <!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>求人コード</th>
                <td>
                    <!--{$arrForm.product_code|h}-->
                </td>
            </tr>
<!--{*
/*            
*　　　　　　　　<tr>
*                <th><!--{$smarty.const.NORMAL_PRICE_TITLE}--></th>
*                <td>
*                    <!--{if strlen($arrForm.price01) >= 1}--><!--{$arrForm.price01|h}--> 円<!--{/if}-->
*                </td>
*            </tr>
*/
*}--> 
            <tr>
                <th><span class="attention2"><!--{$smarty.const.SALE_PRICE_TITLE}--></span></th>
                <td>
                    <!--{if strlen($arrForm.price02) >= 1}--><!--{$arrForm.price02|h}--> 円<!--{/if}-->
                </td>
            </tr>
            <tr>
                <th>求人数</th>
                <td>
                    <!--{if $arrForm.stock_unlimited == 1}-->
                        無制限
                    <!--{else}-->
                        <!--{$arrForm.stock|h}-->
                    <!--{/if}-->
                </td>
            </tr>
        <!--{/if}-->
<!--{*
/*    
*　　　　<tr>
*            <th>商品送料</th>
*            <td>
*                <!--{if strlen($arrForm.deliv_fee) >= 1}--><!--{$arrForm.deliv_fee|h}--> 円<!--{/if}-->
*            </td>
*        </tr>
*        <tr>
*            <th>ポイント付与率</th>
*            <td>
*                <!--{if strlen($arrForm.point_rate) >= 1}--><!--{$arrForm.point_rate|h}--> ％<!--{/if}-->
*            </td>
*        </tr>
*        <tr>
*            <th>発送日目安</th>
*            <td>
*                <!--{$arrDELIVERYDATE[$arrForm.deliv_date_id]|h}-->
*            </td>
*        </tr>
*        <tr>
*/
*}--> 
           <th>応募制限数</th>
            <td>
                <!--{$arrForm.sale_limit|default:'無制限'|h}-->
            </td>
        </tr>
        <tr>
            <th>メーカー</th>
            <td>
                <!--{$arrMaker[$arrForm.maker_id]|h}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">メーカーURL</span></th>
            <td style="word-break: break-all;">
                <!--{$arrForm.comment1|h}-->
            </td>
        </tr>
　　　　
        <tr>
<!--{*
　　　　<th>薬局名</th>
            <td>
              <!--{if strlen($arrForm.shipping_pharmacy) >= 1}--><!--{$arrForm.shipping_pharmacy|h}--><!--{/if}-->
            </td>
        </tr>
        
        <tr>
　　　　<th>管理薬剤師名</th>
            <td>
                <!--{if strlen($arrForm.pharmacist_name1) >= 1}--><!--{$arrForm.pharmacist_name1|h}--><!--{/if}-->
                <!--{if strlen($arrForm.pharmacist_name2) >= 1}--><!--{$arrForm.pharmacist_name2|h}--><!--{/if}-->
            </td>
        </tr>
        
        <tr>
        <th>管理薬剤師(カナ)</th>
            <td>
                <!--{if strlen($arrForm.pharmacist_kana1) >= 1}--><!--{$arrForm.pharmacist_kana1|h}--><!--{/if}-->
                <!--{if strlen($arrForm.pharmacist_kana2) >= 1}--><!--{$arrForm.pharmacist_kana2|h}--><!--{/if}-->
            </td>
        </tr>
        
        <tr>
　　　　<th>郵便番号</th>
            <td>
                <!--{if strlen($arrForm.zip1) >= 1}--><!--{$arrForm.zip1|h}--><!--{/if}-->
                <!--{if strlen($arrForm.zip2) >= 1}--><!--{$arrForm.zip2|h}--><!--{/if}-->
            </td>
        </tr> 
　　　　
        <tr>
　　　　<th>住所</th>
            <td>
                <!--{if strlen($arrForm.addr1) >= 1}--><!--{$arrForm.addr1|h}--><!--{/if}-->
                <!--{if strlen($arrForm.addr2) >= 1}--><!--{$arrForm.addr2|h}--><!--{/if}-->
             </td>
        </tr> 
        
        <tr>
　　　　<th>電話番号</th>
            <td>
                <!--{if strlen($arrForm.tel1) >= 1}--><!--{$arrForm.tel1|h}--><!--{/if}-->
                <!--{if strlen($arrForm.tel2) >= 1}--><!--{$arrForm.tel2|h}--><!--{/if}-->
                <!--{if strlen($arrForm.tel3) >= 1}--><!--{$arrForm.tel3|h}--><!--{/if}-->
             </td>
        </tr>
*}-->
        <tr>
            <th><span class="attention2">検索ワード</span></th>
            <td>
                <!--{$arrForm.comment3|h}-->
            </td>
        </tr>
        <tr>
            <th>備考欄(SHOP専用)</th>
            <td>
                <!--{$arrForm.note|h|nl2br}-->
            </td>
        </tr>
        <tr>
            <th>一覧-メインコメント</th>
            <td>
                <!--{$arrForm.main_list_comment|h|nl2br}-->
            </td>
        </tr>
        <tr>
            <th>詳細-メインコメント</th>
            <td>
                <!--{$arrForm.main_comment|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">サブタイトル</span></th>
            <td>
                <!--{$arrForm.comment7|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">サブタイトル/コメント</span></th>
            <td>
                <!--{$arrForm.comment8|nl2br}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">募集職種</span></th>
            <td>
                <!--{$arrForm.comment9|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールタイトルA</span></th>
            <td>
                <!--{$arrForm.comment10|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールコメントA</span></th>
            <td>
                <!--{$arrForm.comment11|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールタイトルB</span></th>
            <td>
                <!--{$arrForm.comment12|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールコメントB</span></th>
            <td>
                <!--{$arrForm.comment13|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールタイトルC</span></th>
            <td>
                <!--{$arrForm.comment14|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">追加エリア用 アピールコメントC</span></th>
            <td>
                <!--{$arrForm.comment15|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">時給or日給 表記</span></th>
            <td>
                <!--{$arrForm.comment16|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">住所</span></th>
            <td>
                <!--{$arrForm.comment17|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">googlemap用url</span></th>
            <td>
                <!--{$arrForm.comment18|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">勤務先エリア (市町村)</span></th>
            <td>
                <!--{$arrForm.comment19|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">給与備考</span></th>
            <td>
                <!--{$arrForm.comment20|nl2br_html}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">画像１</span></th>
            <td>
                <!--{assign var=key value="main_list_image"}-->
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" /><br />
                <!--{/if}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">画像２</span></th>
            <td>
                <!--{assign var=key value="main_image"}-->
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" /><br />
                <!--{/if}-->
            </td>
        </tr>
        <tr>
            <th><span class="attention2">画像3</span></th>
            <td>
                <!--{assign var=key value="main_large_image"}-->
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" /><br />
                <!--{/if}-->
            </td>
        </tr>

        <!--{* オペビルダー用 *}-->
        <!--{if "sfViewAdminOpe"|function_exists === TRUE}-->
            <!--{include file=`$smarty.const.MODULE_REALDIR`mdl_opebuilder/admin_ope_view.tpl}-->
        <!--{/if}-->

        <!--{section name=cnt loop=$smarty.const.PRODUCTSUB_MAX}-->
            <!--▼商品<!--{$smarty.section.cnt.iteration}-->-->
			<!--{assign var=sub_no value="`$smarty.section.cnt.iteration`"}-->
			<!--{if ($sub_no < 12 || $sub_no > 19) && $sub_no != 6 && $sub_no != 7}-->
            <tr>
                <th><span class="attention2"><!--{$arrSUBTITLE[$sub_no]}--></span></th>
                <td>
                    <!--{assign var=key value="sub_comment`$smarty.section.cnt.iteration`"}-->
                    <!--{$arrForm[$key]|nl2br_html}-->
                </td>
            </tr>
			<!--{/if}-->
            <!--▲商品<!--{$smarty.section.cnt.iteration}-->-->
        <!--{/section}-->

        <!--{if $smarty.const.OPTION_RECOMMEND == 1}-->
            <!--▼関連商品-->
            <!--{section name=cnt loop=$smarty.const.RECOMMEND_PRODUCT_MAX}-->
            <!--{assign var=recommend_no value="`$smarty.section.cnt.iteration`"}-->
                <tr>
                    <th>関連商品(<!--{$smarty.section.cnt.iteration}-->)<br />
                        <!--{if $arrRecommend[$recommend_no].product_id|strlen >= 1}-->
                            <img src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrRecommend[$recommend_no].main_list_image|sfNoImageMainList|h}-->&amp;width=65&amp;height=65" alt="<!--{$arrRecommend[$recommend_no].name|h}-->">
                        <!--{/if}-->
                    </th>
                    <td>
                        <!--{if $arrRecommend[$recommend_no].product_id|strlen >= 1}-->
                            商品コード:<!--{$arrRecommend[$recommend_no].product_code_min}--><br />
                            商品名:<!--{$arrRecommend[$recommend_no].name|h}--><br />
                            コメント:<br />
                            <!--{$arrRecommend[$recommend_no].comment|h|nl2br}-->
                        <!--{/if}-->
                    </td>
                </tr>
            <!--{/section}-->
            <!--▲関連商品-->
        <!--{/if}-->
    </table>

    <div class="btn-area">
        <ul>
            <li><a class="btn-action" href="javascript:;" onclick="fnModeSubmit('confirm_return','',''); return false;"><span class="btn-prev">前のページに戻る</span></a></li>
            <li><a class="btn-action" href="javascript:;" onclick="document.form1.submit(); return false;"><span class="btn-next">この内容で登録する</span></a></li>
        </ul>
    </div>
</div>
</form>
