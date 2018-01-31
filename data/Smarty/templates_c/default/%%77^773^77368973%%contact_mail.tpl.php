<?php /* Smarty version 2.6.27, created on 2017-12-20 17:38:44
         compiled from mail_templates/contact_mail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'mail_templates/contact_mail.tpl', 22, false),)), $this); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_header'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
 ※Email này được gửi từ <?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_shopname'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

　Nếu có bất kỳ thắc mắc nào vui lòng gửi mail đến địa chỉ <?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_infoemail'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 để được trợ giúp.
┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛

Kính gửi: <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['name01']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['name02']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>


Chúng tôi đã nhận được phản hồi của quý khách.
Xin quý khách vui lòng đợi trong giây lát, chúng tôi sẽ liên hệ lại sau.

■Họ tên　：<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['name01']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['name02']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['kana01']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>(<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['kana01']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['kana02']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
)<?php endif; ?> 様
■Số điện thoại：<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['tel01']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['tel02']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['tel03']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

■Địa chỉ email：<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['email']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

■Nội dung liên hệ
<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm']['contents']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_footer'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
