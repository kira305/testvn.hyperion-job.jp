<?php /* Smarty version 2.6.27, created on 2017-10-26 16:35:08
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/sphone/frontparts/bloc/category.tpl', 26, false),)), $this); ?>

<section id="category_area">
    <h2 class="title_block">仕事カテゴリ</h2>
    <nav id="categorytree">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@SMARTPHONE_TEMPLATE_REALDIR)."frontparts/bloc/category_tree_fork.tpl", 'smarty_include_vars' => array('children' => ((is_array($_tmp=$this->_tpl_vars['arrTree'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'treeID' => "",'display' => 1,'level' => 0)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </nav>
</section><!-- id="category_area" -->