<?php /* Smarty version 2.6.27, created on 2017-12-14 14:03:47
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/regist/complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/regist/complete.tpl', 26, false),array('modifier', 'u', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/regist/complete.tpl', 59, false),)), $this); ?>

 <script type="text/javascript">//<![CDATA[
    $(function(){
        $('.finishOrder').click(function(){
            $.colorbox({href:"<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=@USER_DIR)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
apply_popup.php", iframe:true, fastIframe:false, width:"600px", height:"360px", transition:"fade", scrolling:false});
        });
    });
//]]></script>

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="title">Đăng ký thành viên(Hoàn thành)</h2>
        <div id="complete_area">
            <p class="message">Đăng ký thành công</p>
            <p>●　Những đối tượng tìm việc làm thêm có thể ứng tuyển ngay<br />
              ●　Những đối tượng tìm việc làm chính thức sau khi hoàn tất hồ sơ hoặc upload hồ sơ mới có thể ứng tuyển<br />
              ●　Sau khi đăng ký vẫn có thể chỉnh sửa thông tin</p>

            <br />
            <form name="form1" id="form1" method="post" action="/user_data/apply.php">
                <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                <input type="hidden" name="mode" value="finish" />
                <div class="btn_area">
                    <ul>
                        <li>
                            <a href="/entry/cv.php" class="bttn">Tạo hồ sơ trực tuyến</a>
                        </li>
                        <li>
                            <a href="/entry/cv_upload.php" class="bttn">Tải hồ sơ đính kèm</a>
                        </li>
                        <?php if (((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>
                            <?php if (((is_array($_tmp=$this->_tpl_vars['applyProductEmploymentStatus'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 1): ?>
                            <li>
                                <a href="#" class="bttn finishOrder">Hoàn thành</a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
" class="bttn">Đến trang chi tiết công việc</a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
products/list.php" class="bttn">Đến trang danh sách công việc</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</div>