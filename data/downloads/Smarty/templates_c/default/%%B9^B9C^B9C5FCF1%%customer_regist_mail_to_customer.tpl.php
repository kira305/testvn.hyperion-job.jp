<?php /* Smarty version 2.6.26, created on 2012-10-12 18:53:10
         compiled from mail_templates/customer_regist_mail_to_customer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'mail_templates/customer_regist_mail_to_customer.tpl', 2, false),)), $this); ?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['name01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['name02'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 様

ファーマプレミアムへのご登録有難うございます。早急に担当者から折り返し連絡させていただきます。
＊このメールは当サイトへご登録していただいた方に自動返信しています。
心当たりのない方は、お手数ですが破棄してください。


署名欄

会社名		<?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['company_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

住所			<?php echo ((is_array($_tmp=$this->_tpl_vars['pref'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['addr01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['addr02'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

電話番号	<?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['tel01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['tel02'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
-<?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['tel03'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

ファーマプレミアム	<?php echo ((is_array($_tmp=$this->_tpl_vars['CONF']['email01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>



