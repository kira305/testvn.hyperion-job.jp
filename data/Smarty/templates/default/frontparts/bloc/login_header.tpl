<script type="text/javascript">//<![CDATA[
   $(function(){
        var $login_email = $('#header_login_area input[name=login_email]');

        if (!$login_email.val()) {
            $login_email
                .val('メールアドレス')
                .css('color', '#AAA');
        }

        $login_email
            .focus(function() {
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
            if (!$('#header_login_area input[name=login_email]').val()
                || $('#header_login_area input[name=login_email]').val() == 'メールアドレス') {
                if ($('#header_login_area input[name=login_pass]').val()) {
                    alert('メールアドレス/パスワードを入力して下さい。');
                }
                return false;
            }
            return true;
        });
    });
//]]>
</script>
<div class="block_outer clearfix">
    <div id="header_login_area">
        <form name="header_login_form" id="header_login_form" method="post" action="<!--{$smarty.const.ROOT_URLPATH}-->frontparts/login_check.php" onsubmit="return fnCheckLogin('header_login_form')">
            <input type="hidden" name="mode" value="login" />
            <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
            <input type="hidden" name="url" value="/" />
            <div class="block_body">
                <ul class="login_form">

            <!--{if $tpl_login}-->
                    <a href="<!--{$smarty.const.ROOT_URLPATH}-->mypage/"><li class="login_name"><span class="user_name"><!--{$tpl_name1|h}--> <!--{$tpl_name2|h}--> 様 <!--{if $smarty.const.USE_POINT !== false}-->/ 所持: <!--{$tpl_user_point|number_format|default:0}-->pt<!--{/if}--></span></li></a>
                <!--{if !$tpl_disable_logout}-->    
                <li class="logout_btn"><input type="button" onclick="fnFormModeSubmit('header_login_form', 'logout', '', ''); return false;" value="ログアウト" /></li>
                <!--{/if}-->
            <!--{else}-->
                    <li class="login_email"><input type="text" name="login_email" value="" style="ime-mode: disabled;" title="メールアドレスを入力して下さい" /></li>
                    <li class="pass"><input type="password" name="login_pass" title="パスワードを入力して下さい" /></li>
                    <li class="login_btn"><input type="submit" value="ログイン" /></li>
                    <li class="member_btn"><a href="<!--{$smarty.const.ROOT_URLPATH}-->user_data/member_entry.php">新規登録</a></li>
                    <li class="login_memory"><input type="checkbox" name="login_memory" id="header_login_memory" value="1" class="c_checkbox" /><label for="header_login_memory" class="c_checkbox"><span>ログイン状態を記憶する</span></label></li>
                    <li class="login_forgot"><a href="<!--{$smarty.const.ROOT_URLPATH}-->forgot/" 
                onclick="win01('<!--{$smarty.const.ROOT_URLPATH}-->forgot/','forget','600','400'); return false;" target="_blank">[?] パスワードをお忘れの方はこちら</a></li>
            <!--{/if}-->

                 </ul>
            </div>
        </form>
    </div>
</div>