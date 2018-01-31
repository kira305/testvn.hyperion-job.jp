<?php /* Smarty version 2.6.27, created on 2017-12-15 13:33:24
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/guide/privacy.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/guide/privacy.tpl', 29, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/guide/privacy.tpl', 29, false),)), $this); ?>

<div id="undercolumn">
    <div id="undercolumn_entry">
        <h2 class="title">Chính sách bảo mật</h2>
        <p>
            <?php if (((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['company_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ''): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['company_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
&nbsp;<?php endif; ?>
            Hiểu được tầm quan trọng của việc bảo mật thông tin cá nhân, chúng tôi tuân thủ Luật Bảo vệ Thông tin cá nhân và Chính sách Bảo mật này và để đảm bảo an toàn thông tin cá nhân của khách hàng.
        </p>
        <br />
        <p class="message">Định nghĩa thông tin cá nhân</p>
        <p>Là những thông tin đưa ra để có thể xác định được đối tượng khách hàng, chẳng hạn như tên, địa chỉ, số điện thoại. Ngoài ra nó có thể bao gồm những thông tin đặc biệt khác.</p>

    </div>
</div>