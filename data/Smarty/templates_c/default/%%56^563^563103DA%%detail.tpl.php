<?php /* Smarty version 2.6.27, created on 2017-12-27 19:28:21
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl', 34, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl', 77, false),array('modifier', 'date_format', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl', 85, false),array('modifier', 'strtotime', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl', 96, false),array('modifier', 'nl2br_html', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/products/detail.tpl', 156, false),)), $this); ?>

<script type="text/javascript">//<![CDATA[
    // 規格2に選択肢を割り当てる。
    function fnSetClassCategories(form, classcat_id2_selected) {
        var $form = $(form);
        var product_id = $form.find('input[name=product_id]').val();
        var $sele1 = $form.find('select[name=classcategory_id1]');
        var $sele2 = $form.find('select[name=classcategory_id2]');
        eccube.setClassCategories($form, product_id, $sele1, $sele2, classcat_id2_selected);
    }

    function applyPopup(){
        $.colorbox({href:"<?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=@USER_DIR)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
apply_popup.php", iframe:true, fastIframe:false, width:"600px", height:"360px", transition:"fade", scrolling:false});
    }

    $(function(){
        var detailHeader = $(".detail_header").clone();
        $('<div />', { class: 'detail_header_float' }).append(detailHeader).insertAfter("#detailarea");

        var detailHeaderVisibleHeight = $('#header_wrap').outerHeight() + $('#topcolumn').outerHeight() + 20 + $('.detail_header').outerHeight();
        var flag = false;
        $(window).scroll(function () {
            var scrollTop = $(this).scrollTop();
            if (scrollTop > detailHeaderVisibleHeight) {
                if (flag == false) {
                    flag = true;
                    $('.detail_header_float').stop().animate({
                        'top': '0'
                    }, 500);
                }
            } else {
                if (flag) {
                    flag = false;
                    $('.detail_header_float').stop().animate({
                        'top': '-100px'
                    }, 500);
                }
            }
        });
    });
//]]></script>

<div id="undercolumn">
    <form name="form1" id="form1" method="post" action="?">
        <input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="mode" value="cart" />
        <input type="hidden" name="product_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
        <input type="hidden" name="product_class_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['tpl_product_class_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" id="product_class_id" />
        <input type="hidden" name="favorite_product_id" value="" />
        <input type="hidden" name="quantity" value="1" />
        <div id="detailarea" class="clearfix">
            <div class="detail_header">
                <div id="detailphotobloc">
                    <?php $this->assign('key', 'main_large_image'); ?>
                    <!--★画像★-->
                    <a href="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" class="expansion" target="_blank">
                        <img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrFile'][$this->_tpl_vars['key']]['filepath'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
                    </a>
                </div>
                <div id="detailrightbloc">
                    <!--★仕事名★-->
                    <h2><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>

                    <div class="end_date">Ngày hết hạn： <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['end_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</div>

                    <div class="btn_area" id="detail_btn_area">
                        <?php if (in_array ( ((is_array($_tmp=$this->_tpl_vars['tpl_product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$this->_tpl_vars['arrCheckedItems'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?>
                        <button class="bttn" type="button" onClick=""><span>Bỏ lưu</span></button>
                        <?php else: ?>
                        <button class="bttn" type="button" onClick="javascript:eccube.changeAction('?product_id=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
'); eccube.setModeAndSubmit('cart', '', '');"><span>Lưu công việc</span></button>
                        <?php endif; ?>
                        &nbsp; &nbsp;
                        <?php if (((is_array($_tmp=$this->_tpl_vars['isApplied'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
                            <button class="bttn" type="button" onClick=""><span>Đã ứng tuyển</span></button>
                        <?php elseif (((is_array($_tmp=$this->_tpl_vars['arrProduct']['end_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != '' && ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['end_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp)) <= ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=time())) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d") : smarty_modifier_date_format($_tmp, "%Y-%m-%d")))) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp))): ?>
                            <button class="bttn" type="button" onClick=""><span>Hết hạn ứng tuyển</span></button>
                        <?php else: ?>
                            <button class="bttn" type="button" onclick="javascript:eccube.changeAction('?product_id=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
'); eccube.setModeAndSubmit('cart_to_shopping', 'quantity', 1);"><span>Ứng tuyển</span></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div id="detailphotobloc" style="display: none">
                <div class="photo">
                    <?php $this->assign('key', 'main_large_image'); ?>
                    <!--★画像★-->
                    <a href="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" class="expansion" target="_blank">
                        <img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrFile'][$this->_tpl_vars['key']]['filepath'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" class="picture" />
                    </a>
                </div>
                <span class="mini">
                    <!--★拡大する★-->
                    <a href="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" class="expansion" target="_blank">Phóng to ảnh</a>
                </span>
            </div>
            <div id="detailrightbloc" style="display: none">
                <!--★仕事名★-->
                <h2><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['name_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</h2>

                <div class="end_date">Ngày hết hạn： <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['end_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</div>

                <div class="btn_area" id="detail_btn_area">
                    <?php if (in_array ( ((is_array($_tmp=$this->_tpl_vars['tpl_product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$this->_tpl_vars['arrCheckedItems'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?>
                    <button class="bttn" type="button" onClick=""><span>Hủy lưu</span></button>
                    <?php else: ?>
                    <button class="bttn" type="button" onClick="javascript:eccube.changeAction('?product_id=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
'); eccube.setModeAndSubmit('cart', '', '');"><span>Lưu công việc</span></button>
                    <?php endif; ?>
                    &nbsp; &nbsp;
                    <?php if (((is_array($_tmp=$this->_tpl_vars['isApplied'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
                    <button class="bttn" type="button" onClick=""><span>Đã ứng tuyển</span></button>
                    <?php else: ?>
                        <?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['end_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp)) <= ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=time())) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")))) ? $this->_run_mod_handler('strtotime', true, $_tmp) : strtotime($_tmp))): ?>
                            <button class="bttn" type="button" onClick=""><span>Hết hạn ứng tuyển</span></button>
                        <?php else: ?>
                            <button class="bttn" type="button" onclick="javascript:eccube.changeAction('?product_id=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['product_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
'); eccube.setModeAndSubmit('cart_to_shopping', 'quantity', 1);"><span>Ứng tuyển</span></button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="table">
                <div class="table_cell">
                    <p class="detail_block_title">Thông tin tuyển dụng</p>
                    <table class="detail_block_table">
                        <tr>
                            <th>Loại công việc</th>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatus'][$this->_tpl_vars['arrProduct']['employment_status']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Vị trí</th>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['arrPosition'][$this->_tpl_vars['arrProduct']['position']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Lương</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['salary_full'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
<br /><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['salary_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Địa điểm làm việc</th>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['arrRegion'][$this->_tpl_vars['arrProduct']['region']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['arrCity'][$this->_tpl_vars['arrProduct']['city']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['work_location_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Hướng dẫn đi lại</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['traffic_access_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Thời gian làm việc</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['working_hour_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
<br />Giờ nghỉ trưa： <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['lunch_time_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Ngày làm việc</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['working_day_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Thời gian thử việc</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['trial_period_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                    </table>

                    <p class="detail_block_title">Yêu cầu công việc</p>
                    <table class="detail_block_table">
                        <tr>
                            <th>Số lượng tuyển</th>
                            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['offer_number'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Giới tính</th>
                            <td>
                                <?php if (count ( ((is_array($_tmp=$this->_tpl_vars['arrProduct']['sex'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
                                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrProduct']['sex'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arrSex'][$this->_tpl_vars['item']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php if (((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) < count ( ((is_array($_tmp=$this->_tpl_vars['arrProduct']['sex'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) - 1): ?>, <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Trình độ học vấn</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['qualification_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Tính cách</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['personality_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Kinh nghiệm, kỹ năng</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['skill_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                    </table>

                    <p class="detail_block_title">Chế độ, phúc lợi</p>
                    <table class="detail_block_table">
                        <tr>
                            <th>Tăng lương</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['payrise_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Thưởng</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['bonus_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Bảo hiểm</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['insurance_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Phúc lợi</th>
                            <td>
                                <?php if (count ( ((is_array($_tmp=$this->_tpl_vars['arrProduct']['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
                                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrProduct']['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <?php echo ((is_array($_tmp=$this->_tpl_vars['arrWelfare'][$this->_tpl_vars['item']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
                                    <?php endforeach; endif; unset($_from); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Phúc lợi khác</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['other_welfare_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <th>Khám sức khỏe</th>
                            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['medical_checkup_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                        </tr>
                    </table>
                </div>
                <div class="table_cell">
                    <p class="detail_block_title">Mô tả công việc</p>
                    <div class="detail_block_area">
                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['main_comment_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>

                    </div>
                    <?php if (((is_array($_tmp=$this->_tpl_vars['arrProduct']['employment_status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?>
                    <p class="detail_block_title">Thông tin nhà tuyển dụng</p>
                    <div class="detail_block_area"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['client_introduction_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</div>
                    <?php endif; ?>
                </div>
            </div>

            <p class="detail_block_title">Phương pháp ứng tuyển</p>
            <table class="detail_block_table">
                <tr>
                    <th>Phương pháp ứng tuyển</th>
                    <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrProduct']['applicate_method_vn'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('nl2br_html', true, $_tmp) : smarty_modifier_nl2br_html($_tmp)); ?>
</td>
                </tr>
                <tr>
                    <th>Quy trình xét tuyển</th>
                    <td>
                        <?php if (count ( ((is_array($_tmp=$this->_tpl_vars['arrProduct']['selection_process'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) > 0): ?>
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrProduct']['selection_process'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <div class="selection_process">
                                <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['arrProcessImage'][$this->_tpl_vars['item']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrProcess'][$this->_tpl_vars['item']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" id="icon<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                                <p><?php echo ((is_array($_tmp=$this->_tpl_vars['arrProcess'][$this->_tpl_vars['item']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</p>
                            </div><?php if (((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) < count ( ((is_array($_tmp=$this->_tpl_vars['arrProduct']['selection_process'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) ) - 1): ?><span class="selection_arrow">›</span><?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != ''): ?>
                <tr>
                    <th>Người phụ trách</th>
                    <td>
                        <div id="concierge_info">
                            <img src="<?php echo ((is_array($_tmp=@IMAGE_SAVE_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info']['image'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
                            <span>Tư vấn viên</span>
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
                            <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/icon/ico_phone.png" alt="phone" /> <?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info']['tel'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
                            <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['TPL_URLPATH'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
img/icon/ico_mail.png" alt="mail" /> <?php echo ((is_array($_tmp=$this->_tpl_vars['arrProduct']['concierge_info']['email'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
<br />
                            Văn phòng đại diện <?php echo ((is_array($_tmp=$this->_tpl_vars['arrTarget'][$this->_tpl_vars['arrProduct']['concierge_info']['workplace']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>

                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </table>

        </div>
    </form>

    <!--詳細ここまで-->

</div>