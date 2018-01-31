<?php /* Smarty version 2.6.27, created on 2017-12-07 11:13:30
         compiled from frontparts/search_zero.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'frontparts/search_zero.tpl', 29, false),)), $this); ?>

<?php echo ''; ?><?php echo '<div id="undercolumn_error"><div class="message_area"><!--★エラーメッセージ--><p class="error">'; ?><?php if (((is_array($_tmp=$_GET['mode'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'search'): ?><?php echo 'Kết quả tương ứng : <strong>0 công việc</strong>.<br />Tìm kiếm bằng từ khóa khác'; ?><?php else: ?><?php echo 'Hiện tại không có công việc nào phù hợp'; ?><?php endif; ?><?php echo '</p></div></div>'; ?>
