<?php /* Smarty version 2.6.26, created on 2012-10-15 13:38:56
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl', 7, false),array('modifier', 'u', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl', 15, false),array('modifier', 'sfNoImageMainList', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl', 16, false),array('modifier', 'h', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl', 16, false),array('modifier', 'nl2br', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/frontparts/bloc/recommend.tpl', 26, false),)), $this); ?>

<?php if (count ( ((is_array($_tmp=$this->_tpl_vars['arrBestProducts'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
    <div class="block_outer clearfix">
        <div id="recommend_area">
            <h2><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/title/tit_bloc_news.jpg" alt="新着情報" class="title_icon" /></h2>
            <div class="block_body clearfix">
                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrBestProducts'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_products'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_products']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['arrProduct']):
        $this->_foreach['recommend_products']['iteration']++;
?>
                    <div class="product_item clearfix">
                        <div class="productImage">
                            <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
">
                                <img src="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
resize_image.php?image=<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['main_list_image'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfNoImageMainList', true, $_tmp) : SC_Utils_Ex::sfNoImageMainList($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
&amp;width=80&amp;height=80" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
                            </a>
                        </div>
                        <div class="productContents">
                            <h3>
                                <a href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</a>
                            </h3>
                            <p class="sale_price">
                                <?php echo ((is_array($_tmp=@SALE_PRICE_TITLE)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
： <span class="price"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['price02_min_inctax'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 円</span>
                            </p>
                            <p class="mini comment"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['comment'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>
                        </div>
                    </div>
                    <?php if (((is_array($_tmp=$this->_foreach['recommend_products']['iteration'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) % 2 === 0): ?>
                        <div class="clear"></div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </div>
        </div>
    </div>
<?php endif; ?>