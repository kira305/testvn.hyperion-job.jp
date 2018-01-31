<?php /* Smarty version 2.6.27, created on 2017-12-22 13:15:16
         compiled from error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'error.tpl', 28, false),)), $this); ?>

<?php echo '<div id="undercolumn"><div id="undercolumn_error"><div class="message_area"><!--★エラーメッセージ--><p class="error">'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_error'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '</p></div><div class="btn_area"><ul><li>'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['return_top'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><?php echo '<a href="'; ?><?php echo ((is_array($_tmp=@TOP_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" class="bttn">Về trang chủ</a>'; ?><?php else: ?><?php echo '<a href="javascript:history.back()" class="bttn back">Quay lại</a>'; ?><?php endif; ?><?php echo '</li></ul></div></div></div>'; ?>
