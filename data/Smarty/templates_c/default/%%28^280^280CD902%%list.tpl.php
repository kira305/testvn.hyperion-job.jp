<?php /* Smarty version 2.6.27, created on 2017-12-14 15:47:09
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl', 87, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl', 88, false),array('modifier', 'u', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl', 171, false),array('modifier', 'sfNoImageMainList', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl', 192, false),array('modifier', 'nl2br', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/list.tpl', 197, false),)), $this); ?>

<script type="text/javascript">//<![CDATA[
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        eccube.setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }
    // 並び順を変更
    function fnChangeOrderby(orderby) {
        eccube.setValue('orderby', orderby);
        eccube.setValue('pageno', 1);
        eccube.submitForm();
    }
    // 表示件数を変更
    function fnChangeDispNumber(dispNumber) {
        eccube.setValue('disp_number', dispNumber);
        eccube.setValue('pageno', 1);
        eccube.submitForm();
    }
    // カゴに入れる
    function fnInCart(th, mode) {
        var searchForm = $("#form1");
        var cartForm = $(th).closest('form');
        // 検索条件を引き継ぐ
        var hiddenValues = ['mode','prevPage','employment_status','category_id','region','position','city','name','welfare','orderby','disp_number','pageno','rnd'];
        $.each(hiddenValues, function(){
            // 仕事別のフォームに検索条件の値があれば上書き
            if (cartForm.has('input[name='+this+']').length != 0) {
                cartForm.find('input[name='+this+']').val(searchForm.find('input[name='+this+']').val());
            }
            // なければ追加
            else {
                cartForm.append($('<input type="hidden" />').attr("name", this).val(searchForm.find('input[name='+this+']').val()));
            }
        });
        cartForm.find('input[name=mode]').val(mode);
        // 仕事別のフォームを送信
        cartForm.submit();
    }
    
    $(document).ready(function() {
  $("h3 a, .skill").dotdotdot({
            ellipsis  : '...',
            wrap  : 'letter',
            height  : null
  });
    });

    $(window).load(function(){
        if($('.list_area_form').length > 0){
            for (var i = 0; i < $('.list_area_form').length; i += 2) {
                if( $('.list_area_form').eq(i).height() > $('.list_area_form').eq(i+1).height() ){
                    $('.list_area_form .list_area').eq(i+1).height( $('.list_area_form .list_area').eq(i).height() );
                } else {
                    $('.list_area_form .list_area').eq(i).height( $('.list_area_form .list_area').eq(i+1).height() );
                }
            }
        }
    });
//]]></script>

<div id="undercolumn">
    <form name="form1" id="form1" method="get" action="?">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="mode" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['mode'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <!-- {* ▼検索条件 *} -->
        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSearchData'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if (is_array ( ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?>
                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_item']):
?>
                    <input type="hidden" name="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
[]" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                <input type="hidden" name="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
                        <input type="hidden" name="orderby" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orderby'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <input type="hidden" name="disp_number" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['disp_number'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <input type="hidden" name="pageno" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_pageno'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
        <input type="hidden" name="prevPage" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['prevPage'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
                <input type="hidden" name="rnd" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tpl_rnd'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
    </form>

    <!--★タイトル★-->
    <h2 class="title"><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?>Việc làm tại&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['arrTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php else: ?>Thông tin việc làm<?php endif; ?></h2>

    <!--▼ページナビ(本文)-->
    <?php ob_start(); ?>
        <div class="pagenumber_area clearfix">
            <div class="change">
                Sắp xếp theo：
                <?php if (((is_array($_tmp=$this->_tpl_vars['orderby'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 'salary'): ?>
                    <a href="javascript:fnChangeOrderby('salary');">Mức lương</a>
                <?php else: ?>
                    <span class="attention">Mức lương</span>
                <?php endif; ?>&nbsp;/&nbsp;
                <?php if (((is_array($_tmp=$this->_tpl_vars['orderby'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 'date'): ?>
                        <a href="javascript:fnChangeOrderby('date');">Ngày đăng</a>
                <?php else: ?>
                    <span class="attention">Ngày đăng</span>
                <?php endif; ?>&nbsp; &nbsp; &nbsp;
                Hiển thị：
                <select name="disp_number" onchange="javascript:fnChangeDispNumber(this.value);">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrPRODUCTLISTMAX'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['num'] => $this->_tpl_vars['dispnum']):
?>
                        <?php if (((is_array($_tmp=$this->_tpl_vars['num'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['disp_number'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
                            <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['num'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" selected="selected" ><?php echo ((is_array($_tmp=$this->_tpl_vars['dispnum'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</option>
                        <?php else: ?>
                            <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['num'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" ><?php echo ((is_array($_tmp=$this->_tpl_vars['dispnum'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</option>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </div>
            <div class="navi"><?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_strnavi'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</div>
        </div>
    <?php $this->_smarty_vars['capture']['page_navi_body'] = ob_get_contents(); ob_end_clean(); ?>
    <!--▲ページナビ(本文)-->

    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrProducts'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arrProducts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arrProducts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['arrProduct']):
        $this->_foreach['arrProducts']['iteration']++;
?>

        <?php if (((is_array($_tmp=($this->_foreach['arrProducts']['iteration'] <= 1))) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
            <!--▼件数-->
            <div>
                <span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_linemax'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 </span>công việc.
            </div>
            <!--▲件数-->

            <!--▼ページナビ(上部)-->
            <form name="page_navi_top" id="page_navi_top" action="?">
                <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                <?php if (((is_array($_tmp=$this->_tpl_vars['tpl_linemax'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo $this->_smarty_vars['capture']['page_navi_body']; ?>
<?php endif; ?>
            </form>
            <!--▲ページナビ(上部)-->
        <?php endif; ?>

        <?php $this->assign('id', ((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?>
        <?php $this->assign('arrErr', ((is_array($_tmp=$this->_tpl_vars['arrProduct']['arrErr'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?>
        <!--▼仕事-->
        <form name="product_form<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" action="?" class="list_area_form">
            <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <input type="hidden" name="product_id" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
            <input type="hidden" name="product_class_id" id="product_class_id<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_product_class_id'][$this->_tpl_vars['id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
            <div class="list_area clearfix">
                <a name="product<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
"></a>
                <!--★仕事名★-->
                <h3>
                    <a target="_blank" href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</a>
                </h3>

                <div class="table">
                    <div class="table_cell">
                        <?php if (count ( ((is_array($_tmp=$this->_tpl_vars['productStatus'][$this->_tpl_vars['id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
                        <!--▼仕事ステータス-->
                            <p class="product_status">
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['productStatus'][$this->_tpl_vars['id']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['status']):
?>
                                <span><?php echo ((is_array($_tmp=$this->_tpl_vars['arrSTATUS'][$this->_tpl_vars['status']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span>
                            <?php endforeach; endif; unset($_from); ?>
                            </p>
                        <!--▲仕事ステータス-->
                        <?php endif; ?>
                        <p><b>Loại công việc： </b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatus'][$this->_tpl_vars['arrProduct']['employment_status']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</p>
                        <p><b>Lương：</b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['salary_full'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</p>
                        <p><b>Địa điểm làm việc： </b><?php echo ((is_array($_tmp=$this->_tpl_vars['arrRegion'][$this->_tpl_vars['arrProduct']['region']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrCity'][$this->_tpl_vars['arrProduct']['city']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['work_location_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</p>
                    </div>
                    <div class="table_cell">
                        <div class="listphoto">
                            <a target="_blank" href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
">
                                <img src="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['main_large_image'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfNoImageMainList', true, $_tmp) : SC_Utils_Ex::sfNoImageMainList($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" class="picture" /></a>
                        </div>
                    </div>
                </div>
                        
                <p class="skill"><b>Yêu cầu： </b><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['skill_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
<br />　<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['qualification_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)))) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</p>

                <ul class="list_button">
                    <?php if (in_array ( ((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$this->_tpl_vars['arrCheckedItems'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?>
                    <li><a href="#" onclick="return false;">Bỏ lưu</a></li>
                    <?php else: ?>
                    <li><a href="#" onclick="fnInCart(this, 'cart'); return false;">Lưu công việc</a></li>
                    <?php endif; ?>
                    <li><a target="_blank" href="<?php echo ((is_array($_tmp=@P_DETAIL_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('u', true, $_tmp) : smarty_modifier_u($_tmp)); ?>
">Xem chi tiết</a</li>
                </ul>
            </div>
        </form>
        <!--▲仕事-->

        <?php if (((is_array($_tmp=($this->_foreach['arrProducts']['iteration'] == $this->_foreach['arrProducts']['total']))) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
            <!--▼ページナビ(下部)-->
            <form name="page_navi_bottom" id="page_navi_bottom" action="?">
                <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                <?php if (((is_array($_tmp=$this->_tpl_vars['tpl_linemax'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo $this->_smarty_vars['capture']['page_navi_body']; ?>
<?php endif; ?>
            </form>
            <!--▲ページナビ(下部)-->
        <?php endif; ?>

    <?php endforeach; else: ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "frontparts/search_zero.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; unset($_from); ?>

</div>