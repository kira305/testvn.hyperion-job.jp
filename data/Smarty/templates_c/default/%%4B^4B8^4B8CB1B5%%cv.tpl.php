<?php /* Smarty version 2.6.27, created on 2017-12-14 14:08:02
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/mypage/cv.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/mypage/cv.tpl', 40, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/mypage/cv.tpl', 42, false),)), $this); ?>
<style>
    div.mycontents_area {
        border: 4px solid #CCC;
        padding: 20px;
    }
    p#separator{
        text-align: center;
        color: #000;
        margin: 30px 0;
        padding: 5px 0;
        font-size: 20px;
    }
</style>

<div id="mypagecolumn">
    <form name="form1" id="form1" method="post" action="?" enctype="multipart/form-data">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="mode" value="confirm" />
        <input type="hidden" name="customer_id" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['customer_id']['value'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrForm']['arrHidden'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <?php endforeach; endif; unset($_from); ?>
        
        <?php if (((is_array($_tmp=$this->_tpl_vars['tpl_subtitle'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == '履歴書'): ?>
        
        <h2 class="title"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_subtitle'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>
        <div id="mycontents_area">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_upload_confirm.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_confirm.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => true,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="btn_area">
                <ul>
                    <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['current_address'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ''): ?>
                    <li>
                        <input type="button" class="bttn" value="Tải hồ sơ đính kèm" onClick="eccube.setModeAndSubmit('pdf', '', '');" />
                    </li>
                    <?php endif; ?>
                    <li>
                        <input type="button" class="bttn" value="Chỉnh sửa" onClick="eccube.setModeAndSubmit('edit', '', '');" />
                    </li>
                </ul>
            </div>
        </div>
            
        <?php else: ?>
    
        <div class="mycontents_area">
            <h2 class="title">Tải hồ sơ trực tuyến</h2>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_upload_input.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="btn_area">
                <ul>
                    <li>
                        <button class="bttn" type="button" onClick="eccube.setModeAndSubmit('cv_complete', '', '');"><span>Lưu</span></button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mycontents_area">
            <h2 class="title"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_subtitle'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>
            <p>Vui lòng nhập thông tin vào những mục dưới đây.「<span class="attention">※</span>」là những mục bắt buộc phải nhập<br />
                Sau khi nhập đầy đủ thông tin, ấn nút Lưu ở bên dưới</p>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => (@TEMPLATE_REALDIR)."frontparts/form_cv_input.tpl", 'smarty_include_vars' => array('flgFields' => 3,'emailMobile' => true,'prefix' => "")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <div class="btn_area">
                <ul>
                    <li>
                        <input type="submit" name="confirm" value="Lưu" />
                    </li>
                    <li>
                        <input type="button" class="bttn back" value="Không lưu" onClick="eccube.setModeAndSubmit('cv', '', '');" />
                    </li>
                </ul>
            </div>
        </div>
                   
        <?php endif; ?>
                    
    </form>
</div>