<?php /* Smarty version 2.6.27, created on 2017-11-29 14:01:31
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply_popup.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply_popup.tpl', 8, false),array('modifier', 'u', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/user_data/apply_popup.tpl', 55, false),)), $this); ?>
<style>
    #container { width: 100% }
    #topcolumn { display: none; }
</style>

<script>
    $(function(){
        <?php if (((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ''): ?>
        parent.$.colorbox.close();
        window.parent.location.href = '<?php echo ((is_array($_tmp=$this->_tpl_vars['url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
';
        <?php endif; ?>
        
        $('.bttn.back').click(function(){
            parent.$.colorbox.close();
        });
    });
</script>

<div id="apply_popup">
    <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="mode" value="" />
        <div id="concierge_area">
            <div id="concierge_photo">
                <img src="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['image'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['name01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['name02'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            </div>
            <div id="concierge_info">
                <div class="concierge_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['name01'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['name02'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</div>
                Email：<?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['email'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
                Điện thoại：<?php echo ((is_array($_tmp=$this->_tpl_vars['customer_data']['tel'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
            </div>
        </div>
        <?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 'complete'): ?>
        <div id="complete_area">
            <p>Ứng tuyển thành công</p>
            <p>Chúng tôi sẽ sớm liên hệ lại với bạn</p>
        </div>
        <?php else: ?>
        <div id="cv_area">
            <?php if (((is_array($_tmp=$this->_tpl_vars['customer_data']['current_address'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ""): ?>
            <label><input type="radio" name="apply_type" value="1" />Tạo hồ sơ trực tuyến</label>
            <?php else: ?>
            <label><input type="radio" name="apply_type" value="2" />Sử dụng hồ sơ có sẵn</label>
            <?php endif; ?>
            
            <?php if (((is_array($_tmp=$this->_tpl_vars['customer_data']['cv'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ""): ?>
            <label><input type="radio" name="apply_type" value="3" />Sử dụng hồ sơ đã tải lên</label>
            <?php endif; ?>
            
            <label><input type="radio" name="apply_type" value="4" />Tải hồ sơ mới</label>
        </div>
        <div class="btn_area">
            <ul>
                <li>
                    <a href="#" data-url="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
" class="bttn back">Đến trang chi tiết công việc</a>
                </li>
                <li>
                    <a href="#" class="bttn" onClick="eccube.setModeAndSubmit('finish', '', '');">Ứng tuyển</a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
    </form>
</div>