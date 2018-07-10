<?php /* Smarty version 2.6.26, created on 2012-09-27 20:54:03
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/footer.tpl', 26, false),array('modifier', 'date_format', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/footer.tpl', 30, false),)), $this); ?>

<!--▼FOOTER-->
<div id="footer_wrap">
    <div id="footer" class="clearfix">
    	<div id="footer_logo"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/footer_logo.gif" alt="ファーマプレミアム" /></div>
        <div id="pagetop"><a href="#top">このページの先頭へ</a></div>
        <div id="footer_txt">Pharma Premiumは、薬剤師の求人・転職情報・派遣サービスを中心とした情報サイトです。病院、クリニック、ドラッグストア、調剤薬局など様々な業態への求人情報等を提供しています。</div>
        <div id="copyright">Copyright ©
            <?php if (((is_array($_tmp=@RELEASE_YEAR)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ((is_array($_tmp=((is_array($_tmp=time())) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y"))): ?><?php echo ((is_array($_tmp=@RELEASE_YEAR)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
-<?php endif; ?><?php echo ((is_array($_tmp=((is_array($_tmp=time())) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>

             Hyperion Co.,Ltd All rights reserved.
        </div>
    </div>
</div>
<!--▲FOOTER-->