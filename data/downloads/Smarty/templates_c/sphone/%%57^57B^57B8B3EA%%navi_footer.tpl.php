<?php /* Smarty version 2.6.26, created on 2012-08-16 11:04:35
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/navi_footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/navi_footer.tpl', 24, false),array('modifier', 'sfTrimURL', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/navi_footer.tpl', 25, false),array('modifier', 'h', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/navi_footer.tpl', 31, false),)), $this); ?>

<ul class="footer_navi">
    <?php if (((is_array($_tmp=$this->_tpl_vars['tpl_login'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
        <li><a rel="external" href="<?php echo ((is_array($_tmp=((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfTrimURL', true, $_tmp) : SC_Utils_Ex::sfTrimURL($_tmp)); ?>
/mypage/login.php"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_mypage_off.png" alt="MYページ" width="75" height="50" /></a></li>
        <li><a rel="external" href="<?php echo ((is_array($_tmp=((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfTrimURL', true, $_tmp) : SC_Utils_Ex::sfTrimURL($_tmp)); ?>
/mypage/favorite.php"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_favorite_off.png" alt="お気に入り" width="75" height="50" /></a></li>
    <?php else: ?>
        <li><a data-transition="slideup" href="<?php echo ((is_array($_tmp=((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfTrimURL', true, $_tmp) : SC_Utils_Ex::sfTrimURL($_tmp)); ?>
/mypage/login.php"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_mypage_off.png" alt="MYページ" width="75" height="50" /></a></li>
        <li><a data-transition="slideup" href="<?php echo ((is_array($_tmp=((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfTrimURL', true, $_tmp) : SC_Utils_Ex::sfTrimURL($_tmp)); ?>
/mypage/login.php"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_favorite_off.png" alt="お気に入り" width="75" height="50" /></a></li>
    <?php endif; ?>
    <li><a rel="external" href="<?php echo ((is_array($_tmp=((is_array($_tmp=@CART_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_cart_off.png" alt="カゴの中を見る" width="75" height="50" /></a></li>
    <li><a rel="external" href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_footer_toppage_off.png" alt="トップページへ" width="75" height="50" /></a></li>
</ul>