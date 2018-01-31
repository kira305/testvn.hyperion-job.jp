<?php /* Smarty version 2.6.27, created on 2017-12-29 17:39:34
         compiled from forgot/mail_complete.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."popup_header.tpl", 'smarty_include_vars' => array('subtitle' => "パスワードを忘れた方(完了ページ)")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="window_area">
    <h2 class="title">Quên địa chỉ email</h2>
    <p class="information">Địa chỉ email mới đã được cấp lại.<br />Chúng tôi đã gửi thông tin tài khoản email bạn vừa đăng nhập. Vui lòng xác nhận lại.</p>
    <div class="btn_area">
        <ul>
            <li><a href="javascript:window.close()" class="bttn">Đóng</a></li>
        </ul>
    </div>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."popup_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>