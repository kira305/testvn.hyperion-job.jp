<?php /* Smarty version 2.6.26, created on 2012-10-01 13:18:21
         compiled from /var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/header.tpl', 13, false),array('modifier', 'h', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/header.tpl', 13, false),array('modifier', 'count', '/var/www/pharmapremium.jp/html/../data/Smarty/templates/20120817/header.tpl', 35, false),)), $this); ?>

<!--▼HEADER-->
<div id="header_wrap">
    <div id="header" class="clearfix">
        <div id="logo_area">
            <p id="site_description">薬剤師の求人・転職・派遣はファーマプレミアム</p>
            <h1>
                <a href="<?php echo ((is_array($_tmp=@TOP_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/logo.gif" alt="薬剤師の求人・転職・派遣はファーマプレミアム" /><span><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrSiteInfo']['shop_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
/<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</span></a>
            </h1>
            

            <?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == "/shigoto.php"): ?><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_top_on.gif" alt="薬剤師の求人・転職・派遣はファーマプレミアム" /><?php endif; ?>
        </div>
        <div id="header_utility" class=" clearfix">
            <div id="header_navi">
                <ul>
                    <li class="start">
                        <a href="<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/shigoto.php" />初めての方</a>
                    </li>
                    <li class="faq">
                        <a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/qanda.php"  />Ｑ＆Ａ</a>
                    </li>
                    <li class="about">
                        <a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/corp.php"  />会社概要</a>
                    </li>
                </ul>
            </div>
            <div id="headerInternalColumn">
                        <?php if (count(((is_array($_tmp=$this->_tpl_vars['arrPageLayout']['HeaderInternalNavi'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))) > 0): ?>
                                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrPageLayout']['HeaderInternalNavi'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['HeaderInternalNaviKey'] => $this->_tpl_vars['HeaderInternalNaviItem']):
?>
                    <!-- ▼<?php echo ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem']['bloc_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 -->
                    <?php if (((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem']['php_path'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ""): ?>
                        <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem']['php_path'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)), 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array('items' => ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))), $this); ?>

                    <?php else: ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem']['tpl_path'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)), 'smarty_include_vars' => array('items' => ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    <?php endif; ?>
                    <!-- ▲<?php echo ((is_array($_tmp=$this->_tpl_vars['HeaderInternalNaviItem']['bloc_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 -->
                <?php endforeach; endif; unset($_from); ?>
                            <?php endif; ?>
                        </div>
            <div class="cnt"><a href="<?php echo ((is_array($_tmp=@HTTPS_URL)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
contact/index.php" onmouseover="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_head_cont_on.gif','contact');" onmouseout="chgImg('<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_head_cont.gif','contact');"><img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/button/btn_head_cont.gif" alt="お問い合わせ" name="contact" id="contact" /></a></div>
        </div>
    </div>
  <div id="gnav">
    <ul  class="clearfix">
    
    <li class="top"><a href="<?php echo ((is_array($_tmp=@TOP_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
">
    <?php $this->assign('top', (@ROOT_URLPATH)."index.php"); ?><?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['top'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_top_on.gif" alt="トップページ" /><?php endif; ?><span>TOP</span></a></li>
    
    <li class="job"><a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/shigoto.php">
    <?php $this->assign('shigoto', (@ROOT_URLPATH)."user_data/shigoto.php"); ?><?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['shigoto'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_job_on.gif" alt="薬剤師派遣" /><?php endif; ?><span>薬剤師派遣</span></a></li>
    
    <li class="supp"><a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/service.php">
    <?php $this->assign('service', (@ROOT_URLPATH)."user_data/service.php"); ?><?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['service'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_supp_on.gif" alt="派遣サービス" /><?php endif; ?><span>派遣サービス</span></a></li>
    
    <li class="info"><a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/useful.php">
    <?php $this->assign('useful', (@ROOT_URLPATH)."user_data/useful.php"); ?><?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['useful'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_info_on.gif" alt="お役立ち情報" /><?php endif; ?><span>お役立ち情報</span></a></li>
    
    <li class="corp"><a href="<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
user_data/houjin.php">
    <?php $this->assign('houjin', (@ROOT_URLPATH)."user_data/houjin.php"); ?><?php if (((is_array($_tmp=$_SERVER['PHP_SELF'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['houjin'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
    <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/common/gnavi/nav_corp_on.gif" alt="人材をお探しの法人の方" /><?php endif; ?><span>人材をお探しの法人の方</span></a></li>
    </ul>
  </div>
</div>
<!--▲HEADER-->