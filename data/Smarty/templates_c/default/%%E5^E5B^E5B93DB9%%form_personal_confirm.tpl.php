<?php /* Smarty version 2.6.27, created on 2017-12-14 13:57:38
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/form_personal_confirm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/form_personal_confirm.tpl', 33, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/form_personal_confirm.tpl', 33, false),array('modifier', 'escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/form_personal_confirm.tpl', 80, false),)), $this); ?>

<?php echo '<col width="30%" /><col width="70%" /><tr><th>Tên của bạn</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."name01"); ?><?php echo ''; ?><?php $this->assign('key2', ($this->_tpl_vars['prefix'])."name02"); ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '&nbsp;'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr><tr><th>Tên của bạn</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."kana01"); ?><?php echo ''; ?><?php $this->assign('key2', ($this->_tpl_vars['prefix'])."kana02"); ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '&nbsp;'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr><tr><th>Giới tính</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."sex"); ?><?php echo ''; ?><?php $this->assign('sex_id', ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrSex'][$this->_tpl_vars['sex_id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr><tr><th>Ngày sinh</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."year"); ?><?php echo ''; ?><?php $this->assign('key2', ($this->_tpl_vars['prefix'])."month"); ?><?php echo ''; ?><?php $this->assign('key3', ($this->_tpl_vars['prefix'])."day"); ?><?php echo ''; ?><?php if (strlen ( ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0 && strlen ( ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0 && strlen ( ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '/'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '/'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo ''; ?><?php else: ?><?php echo 'Chưa đăng ký'; ?><?php endif; ?><?php echo '</td></tr><tr><th>Số điện thoại</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."tel01"); ?><?php echo ''; ?><?php $this->assign('key2', ($this->_tpl_vars['prefix'])."tel02"); ?><?php echo ''; ?><?php $this->assign('key3', ($this->_tpl_vars['prefix'])."tel03"); ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo ' - '; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo ' - '; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key3']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr><tr><th>Email</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."email"); ?><?php echo '<a href="mailto:'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hex') : smarty_modifier_escape($_tmp, 'hex')); ?><?php echo '">'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?><?php echo '</a></td></tr>'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['emailMobile'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><?php echo '<tr><th>Địa chỉ email trên điện thoại</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."email_mobile"); ?><?php echo ''; ?><?php if (strlen ( ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?><?php echo '<a href="mailto:'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hex') : smarty_modifier_escape($_tmp, 'hex')); ?><?php echo '">'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('escape', true, $_tmp, 'hexentity') : smarty_modifier_escape($_tmp, 'hexentity')); ?><?php echo '</a>'; ?><?php else: ?><?php echo 'Chưa đăng ký'; ?><?php endif; ?><?php echo '</td></tr>'; ?><?php endif; ?><?php echo '<tr><th>Mật khẩu</th><td>'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['passlen'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '</td></tr><tr><th>Gợi ý khi bạn quên mật khẩu</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."reminder"); ?><?php echo ''; ?><?php $this->assign('key2', ($this->_tpl_vars['prefix'])."reminder_answer"); ?><?php echo ''; ?><?php $this->assign('reminder_id', ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo 'Câu hỏi：'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrReminder'][$this->_tpl_vars['reminder_id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '<br />Câu trả lời：'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key2']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr><tr><th>Nhận thông báo qua email</th><td>'; ?><?php $this->assign('key1', ($this->_tpl_vars['prefix'])."mailmaga_flg"); ?><?php echo ''; ?><?php $this->assign('mailmaga_flg_id', ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key1']]['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo ''; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrMAILMAGATYPE'][$this->_tpl_vars['mailmaga_flg_id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</td></tr>'; ?>
