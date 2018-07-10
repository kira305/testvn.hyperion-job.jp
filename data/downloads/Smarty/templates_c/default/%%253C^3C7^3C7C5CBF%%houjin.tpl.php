<?php /* Smarty version 2.6.26, created on 2012-10-15 16:31:29
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/user_data/houjin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/user_data/houjin.tpl', 9, false),array('modifier', 'h', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/user_data/houjin.tpl', 9, false),)), $this); ?>

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="co_title"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>
<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'complete'): ?>
        <p>送信完了致しました。</p>
<?php else: ?>
    <?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'input'): ?>
        <h2 class="common_title"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/title/tit_houjin_merit.gif" alt="派遣活用のメリット" /></h2>
        <h3 class="co">フレキシブルな契約期間</h3>
        <p>必要な人材を、必要な時に、必要な期間だけ活用することができます。</p>
        <p class="btm10">契約期間をフレキシブルに設定することで、無駄のない組織編成が可能となります。</p>
        <h3 class="co">労力・コストを軽減</h3>
        <p>募集から採用にかかる労力やコストを軽減。</p>
        <p class="btm10">社会保険等の労務管理も、派遣会社が対応するため、その業務が不要になります。</p>
        <h3 class="co">高スキル・即戦力スタッフのご提供</h3>
        <p class="btm20">質の高い登録者を多数確保。最適な人材を安定的・継続的に派遣いたします。</p>
        <p class="btm20"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/banner/bnr_chart.jpg" alt="派遣" /></p>
        <h3 class="co">お申し込み・お問い合わせはこちらからどうぞ</h3>
    <?php else: ?>
         <h3 class="co">ご登録内容をご確認ください。</h3>
    <?php endif; ?>
       
    <?php if (((is_array($_tmp=@CUSTOMER_CONFIRM_MAIL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
         <p>ご登録されますと、まずは仮会員となります。<br />
              入力されたメールアドレスに、ご連絡が届きますので、本会員になった上でお買い物をお楽しみください。</p>        
    <?php endif; ?>

        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <input type="hidden" name="mode" value="<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'input'): ?>confirm<?php else: ?>complete<?php endif; ?>" />
            <?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'input'): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_corp_input.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => false,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php else: ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_corp_confirm.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => false,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </form>
<?php endif; ?>
    </div>
</div>