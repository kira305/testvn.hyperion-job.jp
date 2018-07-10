<?php /* Smarty version 2.6.26, created on 2012-10-08 11:33:13
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl', 10, false),array('modifier', 'h', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl', 27, false),array('function', 'html_radios', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl', 18, false),array('function', 'html_checkboxes', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl', 20, false),array('function', 'html_options', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/search_products.tpl', 24, false),)), $this); ?>


<div class="block_outer">
    <div id="search_area">
    <h2><span class="title"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/title/tit_bloc_search.gif" alt="検索条件" /></span></h2>
        <div class="block_body_b">
            <!--検索フォーム-->
            <form name="search_form" id="search_form" method="get" action="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
products/list.php">
            <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <input type="hidden" name="mode" value="search" />
            <dl id="searchlist">
                <dt>地域</dt>
               <dd><?php echo smarty_function_html_radios(array('name' => 'work_location_flg','options' => ((is_array($_tmp=$this->_tpl_vars['arrWorkLocationFlg'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => '&nbsp;&nbsp;'), $this);?>
</dd>
                <dt>雇用形態</dt>
                <dd><?php echo smarty_function_html_checkboxes(array('name' => 'employment_status','options' => ((is_array($_tmp=$this->_tpl_vars['arrEMPSTATUS'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => '&nbsp;&nbsp;'), $this);?>
</dd>
                <dt>仕事内容</dt>
                <dd><select name="category_id" class="box145">
                <option label="すべての求人" value="" />全ての求人</option>
                <?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrCatList'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$this->_tpl_vars['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?>

                </select></dd>
                <dt>フリーワード</dt>
                <dd><input type="text" name="name" class="box180" maxlength="50" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" /></dd>
            </dl>
            <p class="btn"><input type="image" onmouseover="chgImgImageSubmit('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_bloc_search_on.jpg',this)" onmouseout="chgImgImageSubmit('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_bloc_search.jpg',this)" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_bloc_search.jpg" alt="検索" name="search" /></p>
            </form>
        </div>
    </div>
</div>