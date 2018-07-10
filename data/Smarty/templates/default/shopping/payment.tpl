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

<script type="text/javascript">//<![CDATA[
    $(function() {
        if ($('input[name=deliv_id]:checked').val()
            || $('#deliv_id').val()) {
            showForm(true);
        } else {
            showForm(false);
        }
        $('input[id^=deliv_]').click(function() {
            showForm(true);
            var data = {};
            data.mode = 'select_deliv';
            data.deliv_id = $(this).val();
            data['<!--{$smarty.const.TRANSACTION_ID_NAME}-->'] = '<!--{$transactionid}-->';
            $.ajax({
                type : 'POST',
                url : location.pathname,
                data: data,
                cache : false,
                dataType : 'json',
                error : remoteException,
                success : function(data, dataType) {
                    if (data.error) {
                        remoteException();
                    } else {
                        // 支払い方法の行を生成
                        var payment_tbody = $('#payment tbody');
                        payment_tbody.empty();
                        for (var i in data.arrPayment) {
                            // ラジオボタン
                            <!--{* IE7未満対応のため name と id をベタ書きする *}-->
                            var radio = $('<input type="radio" name="payment_id" id="pay_' + i + '" />')
                                .val(data.arrPayment[i].payment_id);
                            // ラベル
                            var label = $('<label />')
                                .attr('for', 'pay_' + i)
                                .text(data.arrPayment[i].payment_method);
                            // 行
                            var tr = $('<tr />')
                                .append($('<td />')
                                    .addClass('alignC')
                                    .append(radio))
                                .append($('<td />').append(label));

                            // 支払方法の画像が登録されている場合は表示
                            if (data.img_show) {
                                var payment_image = data.arrPayment[i].payment_image;
                                $('th#payment_method').attr('colspan', 3);
                                if (payment_image) {
                                    var img = $('<img />').attr('src', '<!--{$smarty.const.IMAGE_SAVE_URLPATH}-->' + payment_image);
                                    tr.append($('<td />').append(img));
                                } else {
                                    tr.append($('<td />'));
                                }
                            } else {
                                $('th#payment_method').attr('colspan', 2);
                            }

                            tr.appendTo(payment_tbody);
                        }
                        // お届け時間を生成
                        var deliv_time_id_select = $('select[id^=deliv_time_id]');
                        deliv_time_id_select.empty();
                        deliv_time_id_select.append($('<option />').text('指定なし').val(''));
                        for (var i in data.arrDelivTime) {
                            var option = $('<option />')
                                .val(i)
                                .text(data.arrDelivTime[i])
                                .appendTo(deliv_time_id_select);
                        }
                    }
                }
            });
        });

        /**
         * 通信エラー表示.
         */
        function remoteException(XMLHttpRequest, textStatus, errorThrown) {
            alert('通信中にエラーが発生しました。カート画面に移動します。');
            location.href = '<!--{$smarty.const.CART_URLPATH}-->';
        }

        /**
         * 配送方法の選択状態により表示を切り替える
         */
        function showForm(show) {
            if (show) {
                $('#payment, div.delivdate, .select-msg').show();
                $('.non-select-msg').hide();
            } else {
                $('#payment, div.delivdate, .select-msg').hide();
                $('.non-select-msg').show();
            }
        }
    });
//]]></script>
<div id="undercolumn">
    <div id="undercolumn_shopping">
        <h2 class="title"><!--{$tpl_title|h}--></h2>

        <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
        <input type="hidden" name="mode" value="confirm" />
        <input type="hidden" name="uniqid" value="<!--{$tpl_uniqid}-->" />

        <div class="pay_area02">
            <p>その他お問い合わせ事項がございましたら、こちらにご入力ください。</p>
            <div>
                <!--★その他お問い合わせ事項★-->
                <!--{assign var=key value="message"}-->
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <textarea name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" cols="70" rows="8" class="txtarea" wrap="hard"><!--{$arrForm[$key].value|h}--></textarea>
                <p class="attention"> (<!--{$smarty.const.LTEXT_LEN}-->文字まで)</p>
            </div>
        </div>


        <div class="btn_area">
            <ul>
                <li>
                <a href="?mode=return" onmouseover="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back_on.jpg','back03')" onmouseout="chgImg('<!--{$TPL_URLPATH}-->img/button/btn_back.jpg','back03')">
                    <img src="<!--{$TPL_URLPATH}-->img/button/btn_back.jpg" alt="戻る" border="0" name="back03" id="back03" /></a>
                </li>
                <li>
                    <input type="image" onmouseover="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_next_on.jpg',this)" onmouseout="chgImgImageSubmit('<!--{$TPL_URLPATH}-->img/button/btn_next.jpg',this)" src="<!--{$TPL_URLPATH}-->img/button/btn_next.jpg" alt="次へ" name="next" id="next" />
                </li>
            </ul>
        </div>
        </form>
    </div>
</div>

<!--応募フォーム閲覧計測用
/* SiteCatalyst code version: H.21.
Copyright 1996-2010 Adobe, Inc. All Rights Reserved
More info available at http://www.omniture.com */-->
<script language="JavaScript" type="text/javascript" src="https://pharmapremium.jp/s_code.js"></script>
<script language="JavaScript" type="text/javascript"><!--
/* You may give each page an identifying name, server, and channel on
the next lines. */
s.events="event3"
s.products=";formview2;1;1000"
	/* clickPast */
s.SEMvar = s.getQueryParam('s_kwcid');
s.SEMvar = s.getValOnce(s.SEMvar,'SEM_var',0);
s.clickPast(s.SEMvar,'event26','event27');

/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
if(s.SEMvar||s.events){var s_code=s.t();if(s_code)document.write(s_code)}//--></script>
<!-- End SiteCatalyst code version: H.21. ここまで-->
