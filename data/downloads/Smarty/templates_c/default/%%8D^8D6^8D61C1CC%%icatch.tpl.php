<?php /* Smarty version 2.6.26, created on 2012-10-01 12:02:45
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/icatch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/icatch.tpl', 9, false),)), $this); ?>

<div id="main_image" class="clearfix">
    <div id="main_image_left">
        <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
1">
            <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/banner/bnr_top_main.jpg" alt="詳細はこちら" id="bnr_top_main" name="bnr_top_main" />
        </a>
    </div>
    <div id="main_image_right">
        <p class="date">&nbsp;</p>
        <p class="count">&nbsp;</p>
        <p class="new">&nbsp;</p>
        <p class="bot">
           <a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
entry/kiyaku.php" onmouseover="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_main_right_on.gif','entry2');" onmouseout="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_main_right.gif','entry2');" ><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_main_right.gif" alt="会員登録" name="entry2" id="entry2" /></a>
        </p>
    </div>
</div>