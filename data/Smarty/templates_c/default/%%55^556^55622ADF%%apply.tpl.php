<?php /* Smarty version 2.6.27, created on 2017-11-29 13:47:35
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply.tpl', 2, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply.tpl', 2, false),array('modifier', 'u', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply.tpl', 19, false),)), $this); ?>
<div id="undercolumn">
    <h2 class="title margn"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>
    <div class="mylist_navi">
        <a href="/entry/cv.php" class="bttn">オンラインで履歴書記入</a>
        <a href="/entry/cv_upload.php" class="bttn">履歴書ファイルUpload</a>
    </div>
    
    <form name="form1" id="form1" method="post" action="/user_data/apply.php">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="mode" value="finish" />
        
        <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['cv'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == "" && ((is_array($_tmp=$this->_tpl_vars['arrForm']['current_address'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ""): ?>
            You have to regist or upload your CV in order to apply job.
            <br />
            <div class="btn_area">
                <ul>
                    <?php if (((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>
                    <li>
                        <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
" class="bttn">仕事詳細に戻る</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php else: ?>
            <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['cv'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ""): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_upload_confirm.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => true,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
            <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['current_address'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ""): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_confirm.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => true,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
            <br />
            <div class="btn_area">
                <ul>
                    <?php if (((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>
                    <li>
                        <a href="#" class="bttn" onClick="eccube.setModeAndSubmit('finish', '', '');">応募を完了する</a>
                    </li>
                    <li>
                        <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
" class="bttn">仕事詳細に戻る</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </form>
</div>