<?php /* Smarty version 2.6.26, created on 2012-09-13 11:49:34
         compiled from mail/template_complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'mail/template_complete.tpl', 26, false),)), $this); ?>

<form name="form1" id="form1" method="post" action="./product_class.php">
<input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
<input type="hidden" name="mode" value="" />
<input type="hidden" name="product_id" value="" />
    <div id="complete">
        <div class="complete-top"></div>
        <div class="contents">
            <div class="message">
                登録が完了致しました。
            </div>
        </div>
        <div class="btn-area-top"></div>
        <div class="btn-area">
            <ul>
                <li><a class="btn-action" href="./template.php"><span class="btn-prev">テンプレート一覧に戻る</span></a></li>
            </ul>
        </div>
        <div class="btn-area-bottom"></div>
    </div>
</div>
</form>