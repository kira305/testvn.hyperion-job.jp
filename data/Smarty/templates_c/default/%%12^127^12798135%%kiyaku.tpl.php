<?php /* Smarty version 2.6.27, created on 2017-12-08 19:20:31
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/entry/kiyaku.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/entry/kiyaku.tpl', 32, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/entry/kiyaku.tpl', 33, false),)), $this); ?>

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="title">Điều khoản đăng ký</h2>
        <p class="message">[Quan trọng] Bạn cần đọc kỹ những quy định dưới đây trước khi đăng ký thành viên </p>
        <p>Quy định về quyền lợi và nghĩa vụ của bạn khi sử dụng dịch vụ của chúng tôi<br />
          Sau khi ấn nút "Hoàn tất" có nghĩa là bạn đã đồng ý với các điều khoản sử dụng của chúng tôi
        </p>

        <form name="form1" id="form1" method="post" action="?">
            <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <textarea name="textfield" class="kiyaku_text" cols="80" rows="30" readonly="readonly"><?php echo "\n"; ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_kiyaku_text'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</textarea>

            <div class="btn_area">
                <ul>
                    <li>
                        <a href="<?php echo ((is_array($_tmp=@TOP_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" class="bttn back">Không đồng ý</a>
                    </li>
                    <li>
                        <a href="<?php echo ((is_array($_tmp=@ENTRY_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" class="bttn">Đồng ý</a>
                    </li>
                </ul>
            </div>

        </form>
    </div>
</div>