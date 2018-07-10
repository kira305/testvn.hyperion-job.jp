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

<script>
    $(function() {
        var $login_email = $('.login_form input[name=login_email]');

        if (!$login_email.val()) {
            $login_email
                    .val('メールアドレス')
                    .css('color', '#AAA');
        }

        $login_email.focus(function() {
            if ($(this).val() == 'メールアドレス') {
                $(this)
                        .val('')
                        .css('color', '#f37411');
            }
        })
                .blur(function() {
            if (!$(this).val()) {
                $(this)
                        .val('メールアドレス')
                        .css('color', '#AAA');
            }
        });

        $('#header_login_form').submit(function() {
            if (!$('#header_login_area input[name=login_email]').val() || $('#header_login_area input[name=login_email]').val() == 'メールアドレス') {
                if ($('#header_login_area input[name=login_pass]').val()) {
                    alert('メールアドレス/パスワードを入力して下さい。');
                }
                return false;
            }
            return true;
        });
    });
    
    function ajaxLogin() {
        var postData = new Object;
        postData['<!--{$smarty.const.TRANSACTION_ID_NAME}-->'] = "<!--{$transactionid}-->";
        postData['mode'] = 'login';
        postData['login_email'] = $('input[name=login_email]').val();
        postData['login_pass'] = $('input[name=login_pass]').val();
        postData['url'] = $('input[name=url]').val();

        $.ajax({
            type: "POST",
            url: "<!--{$smarty.const.HTTP_URL}-->frontparts/login_check.php",
            data: postData,
            cache: false,
            dataType: "json",
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(textStatus);
            },
            success: function(result){
                if (result.success) {
                    location.href = "/mypage";
                } else {
                    alert(result.login_error);
                }
            }
        });
    }
</script>

<section id="undercolumn">
    <div id="tab_menu_box">
        <div class="tab_menu_contents_1">

            <h2 class="member_entry">MYページ<span>ログイン</span></h2>
            <form name="header_login_form" id="header_login_form" method="post" action="javascript:;" onsubmit="return ajaxLogin();">
                <input type="hidden" name="mode" value="login" />
                <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
                <input type="hidden" name="url" value="/mypage/change.php" />

                <div class="block_body">
                    <ul class="login_form">
                        <li class="login_email"><input type="text" name="login_email" value="" style="ime-mode: disabled;" title="メールアドレスを入力して下さい" /></li>
                        <li class="pass"><input type="password" name="login_pass" title="パスワードを入力して下さい" /></li>
                        <li class="login_btn"><input type="submit" value="ログイン" /></li>
                        <li class="member_btn"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/member_entry.php">新規登録</a></li>
                        <li class="login_memory"><input type="checkbox" name="login_memory" id="header_login_memory" value="1" class="c_checkbox" /><label for="header_login_memory" class="c_checkbox"><span>ログイン状態を記憶する</span></label></li>
                        <li class="login_forgot"><a href="<!--{$smarty.const.ROOT_URLPATH}-->forgot/" onclick="win01('<!--{$smarty.const.ROOT_URLPATH}-->forgot/', 'forget', '600', '400'); return false;" target="_blank">[?] パスワードをお忘れの方はこちら</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</section>
