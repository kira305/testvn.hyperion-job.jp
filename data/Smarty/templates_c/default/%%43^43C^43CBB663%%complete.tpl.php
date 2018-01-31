<?php /* Smarty version 2.6.27, created on 2017-12-13 13:09:36
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/contact/complete.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/contact/complete.tpl', 36, false),)), $this); ?>

<div id="undercolumn">
    <h2 class="title">Liên hệ</h2>
    <div id="undercolumn_contact">
        <div id="complete_area">
            <p class="message">Câu hỏi của bạn đã được gửi đi.</p>
            <p>
                Trường hợp không nhận được email trả lời vui lòng nhập lại câu hỏi một lần nữa, hoặc liên hệ trực tiếp qua điện thoại.<br />
                Cám ơn bạn đã tin tưởng sử dụng dịch vụ của chúng tôi.
            </p>

            <div class="btn_area">
                <ul>
                <li>
                    <a href="<?php echo ((is_array($_tmp=@TOP_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" class="bttn">Lên đầu trang</a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</div>