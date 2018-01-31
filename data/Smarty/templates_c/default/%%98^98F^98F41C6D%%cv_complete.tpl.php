<?php /* Smarty version 2.6.27, created on 2017-12-14 19:37:55
         compiled from entry/cv_complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'entry/cv_complete.tpl', 31, false),array('modifier', 'u', 'entry/cv_complete.tpl', 43, false),)), $this); ?>

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="title">Tải hồ sơ trực tuyến (Trang hoàn thành)</h2>
        <div id="complete_area">
            <p class="message">Tạo hồ sơ mới thành công</p>

            <br />
            <form name="form1" id="form1" method="post" action="/user_data/apply.php">
                <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                <input type="hidden" name="mode" value="finish" />
                <div class="btn_area">
                    <ul>
                        <li>
                            <a href="/mypage/change.php" class="bttn">Đến trang cá nhân</a>
                        </li>
                        <?php if (((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>
                            <li>
                                <a href="#" class="bttn" onClick="eccube.setModeAndSubmit('finish', '', '');">Hoàn thành</a>
                            </li>
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