<?php /* Smarty version 2.6.27, created on 2017-12-05 18:36:25
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/main_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/main_menu.tpl', 2, false),)), $this); ?>
<ul id="main_menu">
    <?php if (((is_array($_tmp=$this->_tpl_vars['tpl_page_class_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) !== 'LC_Page_Index'): ?>
    <li><a href="/">TRANG CHỦ</a></li>
    <li <?php if (strpos ( ((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , '/user_data/vietnam.php' ) !== false): ?>class='active'<?php endif; ?>><a href="/user_data/vietnam.php">TÌM VIỆC TẠI VIỆT NAM</a></li>
    <li <?php if (strpos ( ((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , '/user_data/japan.php' ) !== false): ?>class='active'<?php endif; ?>><a href="/user_data/japan.php">TÌM VIỆC TẠI NHẬT BẢN</a></li>
    <?php endif; ?>

    <li <?php if (strpos ( ((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , '/abouts/' ) !== false): ?>class='active'<?php endif; ?>><a href="/abouts">VỀ CÔNG TY</a></li>
    <li <?php if (strpos ( ((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , '/contact/' ) !== false): ?>class='active'<?php endif; ?>><a href="/contact">LIÊN HỆ</a></li>
</ul>