<?php /* Smarty version 2.6.27, created on 2017-12-25 15:21:57
         compiled from mypage/login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'mypage/login.tpl', 28, false),array('modifier', 'h', 'mypage/login.tpl', 31, false),array('modifier', 'sfGetErrorColor', 'mypage/login.tpl', 42, false),array('modifier', 'sfGetChecked', 'mypage/login.tpl', 45, false),)), $this); ?>

<div id="undercolumn">
    <h2 class="title">Trang cá nhân (Đăng nhập)</h2>
    <div id="undercolumn_login">
        <form name="login_mypage" id="login_mypage" method="post" action="<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
frontparts/login_check.php" onsubmit="return eccube.checkLoginFormInputted('login_mypage')">
            <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <input type="hidden" name="mode" value="login" />
            <input type="hidden" name="url" value="<?php if (((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>/products/detail.php?product_id=<?php echo ((is_array($_tmp=$this->_tpl_vars['applyProductId'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php else: ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
<?php endif; ?>" />

            <div class="login_area">
                <h3>Đăng nhập nếu bạn đã có tài khoản</h3>
                <p class="inputtext">Trường hợp đã đăng ký thành viên, vui lòng nhập mail và mật khẩu để đăng nhập</p>
                <div class="inputbox">
                    <dl class="formlist clearfix">
                        <?php $this->assign('key', 'login_email'); ?>
                        <dt>Email&nbsp;：</dt>
                        <dd>
                            <span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span>
                            <input type="text" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_login_email'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" maxlength="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
; ime-mode: disabled;" class="box300" />
                            <p class="login_memory">
                                <?php $this->assign('key', 'login_memory'); ?>
                                <input type="checkbox" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="1"<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_login_memory'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetChecked', true, $_tmp, 1) : SC_Utils_Ex::sfGetChecked($_tmp, 1)); ?>
 id="login_memory" />
                                <label for="login_memory">Cho phép máy tính lưu địa chỉ email</label>
                            </p>
                        </dd>
                    </dl>
                    <dl class="formlist clearfix">
                        <?php $this->assign('key', 'login_pass'); ?>
                        <dt>
                            Mật khẩu&nbsp;：
                        </dt>
                        <dd>
                            <span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span>
                            <input type="password" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" maxlength="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']]['length'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" class="box300" />
                        </dd>
                    </dl>
                    <div class="btn_area">
                        <ul>
                            <li style="vertical-align: top;">
                                <input type="submit" value="Đăng nhập" name="log" id="log" />
                            </li>
                            <li>
                                <div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div>
                            </li>
                        </ul>
                    </div>
                </div>
                <p>
                    ※Trường hợp quên mật khẩu vui lòng nhấp vào <a href="<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
forgot/<?php echo ((is_array($_tmp=@DIR_INDEX_PATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" onclick="eccube.openWindow('<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
forgot/<?php echo ((is_array($_tmp=@DIR_INDEX_PATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
','forget','600','460',{scrollbars:'no',resizable:'no'}); return false;" target="_blank">đây</a><br />
                    ※Trường hợp quên địa chỉ email hoặc gặp khó khăn khi đăng nhập vui lòng liên hệ với chúng tôi từ <a href="<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
forgot/mail.php" onclick="eccube.openWindow('<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
forgot/mail.php','forget','600','470',{scrollbars:'no',resizable:'no'}); return false;" target="_blank">trang liên hệ</a>
                </p>
            </div>

            <div class="login_area">
                <h3>Đăng ký nếu bạn chưa có tài khoản</h3>
                <p class="inputtext">Sau khi đăng ký thành viên, bạn có thể truy cập vào trang Cá nhân<br />
                    Chúng tôi có thể giới thiệu công việc theo mong muốn của bạn
                </p>
                <div class="inputbox">
                    <div class="btn_area">
                        <ul>
                            <li>
                                <a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
entry/kiyaku.php" class="bttn">Đăng ký</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>