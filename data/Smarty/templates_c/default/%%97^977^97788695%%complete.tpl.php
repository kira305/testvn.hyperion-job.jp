<?php /* Smarty version 2.6.27, created on 2017-12-08 17:24:03
         compiled from forgot/complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'forgot/complete.tpl', 29, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."popup_header.tpl", 'smarty_include_vars' => array('subtitle' => "パスワードを忘れた方(完了ページ)")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="window_area">
    <h2 class="title">Quên mật khẩu</h2>
    <p class="information">Mật khẩu của bạn đã được cấp lại. Vui lòng sử dụng mật khẩu này để đăng nhập.<br />
        ※Để thay đổi mật khẩu vui lòng vào phần thay đổi thông tin cá nhân tại [Trang cá nhân]</p>
    <form action="?" method="post" name="form1">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <div id="forgot">
            <?php if (((is_array($_tmp=@FORGOT_MAIL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 1): ?>
                    <p><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['new_password'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span></p>
            <?php else: ?>
            <p><span class="attention">Mật khẩu mới đã được gửi vào email đăng ký của bạn</span></p>
            <?php endif; ?>
        </div>
        <div class="btn_area">
            <ul>
                <li><a href="javascript:window.close()" class="bttn">Đóng</a></li>
            </ul>
        </div>
    </form>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."popup_footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>