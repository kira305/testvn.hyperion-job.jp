<?php /* Smarty version 2.6.27, created on 2017-12-13 18:20:00
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl', 29, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl', 153, false),array('modifier', 'count', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl', 175, false),array('function', 'html_options', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl', 164, false),array('function', 'html_checkboxes', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/search_products.tpl', 180, false),)), $this); ?>
<script>
    $(function(){
        $('#show_more_condition').on('click', function(){
            $('#more_condition').toggle();
            return false;
        });
        
        var prevTarget = <?php echo ((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
;
        $('select[name=employment_status]').change(function() {
            var target = detectTargetByEmpStatus($(this).val());
            if(prevTarget != target){
                $("select[name=salary_type]").find('option').not(':first').remove();
                $("select[name=currency]").find('option').not(':first').remove();
                $("select[name=salary_range]").find('option').not(':first').remove();
                var categoryList = $("input[name='category_id[]']").closest('.checkList');
                categoryList.html('');
                categoryList.prev().text('Lựa chọn ngành nghề');

                if(target == 0){
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSalaryType'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        $("select[name=salary_type]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        $("select[name=currency]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCategory'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        var label = $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                        var input = $('<input />', { type: 'checkbox', name: 'category_id[]', value: <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 });
                        label.prepend(input);
                        categoryList.append(label);
                    <?php endforeach; endif; unset($_from); ?>
                } else {
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSalaryTypeByTarget'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        if(target == <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                $("select[name=salary_type]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrencyByTarget'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        if(target == <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                $("select[name=currency]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCategoryByTarget'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        if(target == <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                var label = $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                var input = $('<input />', { type: 'checkbox', name: 'category_id[]', value: <?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 });
                                label.prepend(input);
                                categoryList.append(label);
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    if(target == 1){
                        $("select[name=currency]").val('1');
                    } else {
                        $("select[name=salary_type]").val('3');
                    }
                    $(this).blur(); 
                }
                prevTarget = target;
            }
        });
        
        function detectTargetByEmpStatus(empId){
            var target = 0;
            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrTargetByEmploymentStatus'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                if(empId == <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                    target = '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
';
                }
            <?php endforeach; endif; unset($_from); ?>
            return target;
        }

        $('select[name=salary_type], select[name=currency]').change(function(){
            $("select[name=salary_range]").find('option').not(':first').remove();
            var salaryType = $("select[name=salary_type]").val();
            var currency = $("select[name=currency]").val();
            
            if($(this).attr('name') == 'salary_type' && $('select[name=employment_status]').val() == ''){
                $("select[name=currency]").find('option').not(':first').remove();
                if(salaryType == 1 || salaryType == 2){
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrencyByTarget'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        if(<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 == 1){
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                $("select[name=currency]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    $("select[name=currency]").val(1);
                } else {
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        $("select[name=currency]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                    <?php endforeach; endif; unset($_from); ?>
                    $("select[name=currency]").val(currency);
                }
            }
            
            currency = $("select[name=currency]").val();
            if(salaryType != '' && salaryType > 0 && currency != '' && currency > 0){
                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSalaryRangeByTypeAndCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    if(salaryType == <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['t_key'] => $this->_tpl_vars['t_item']):
?>
                            if(currency == <?php echo ((is_array($_tmp=$this->_tpl_vars['t_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
){
                                <?php $_from = ((is_array($_tmp=$this->_tpl_vars['t_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                    $("select[name=salary_range]").append( $("<option>").val("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
").html("<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
") );
                                <?php endforeach; endif; unset($_from); ?>
                            }
                        <?php endforeach; endif; unset($_from); ?>
                    }
                <?php endforeach; endif; unset($_from); ?>
            }
        });
    });
</script>
<?php echo '<div class="block_outer"><div id="search_area"><h2>Tìm kiếm công việc</h2><div class="block_body"><!--検索フォーム--><form name="search_form" id="search_form" method="get" action="'; ?><?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'products/list.php"><input type="hidden" name="'; ?><?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" /><input type="hidden" name="mode" value="search" /><input type="hidden" name="prevPage" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['prevPage'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '"><dl><dt>Từ khóa</dt><dd><input type="text" name="name" class="box380" maxlength="50" value="'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '" placeholder="Nhập từ khóa" /></dd></dl><dl><dt>Loại công việc</dt><dd><select name="employment_status" class="box240">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 2): ?><?php echo '<option label="Lựa chọn công việc" value="">Lựa chọn công việc</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatusByTarget'][$this->_tpl_vars['page']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['employment_status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatus'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['employment_status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</select></dd></dl><dl><dt>Ngành nghề</dt><dd><div class="checkInsideSelect">'; ?><?php $this->assign('count', count(((is_array($_tmp=$_GET['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))); ?><?php echo ''; ?><?php $this->assign('first', ((is_array($_tmp=$_GET['category_id'][0])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo '<a href="#">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 0): ?><?php echo 'Lựa chọn ngành nghề'; ?><?php elseif (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?><?php echo ''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['arrCatList'][$this->_tpl_vars['first']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php else: ?><?php echo '選択条件'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php endif; ?><?php echo '</a><div class="checkList">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'category_id','options' => ((is_array($_tmp=$this->_tpl_vars['arrCategoryByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'category_id','options' => ((is_array($_tmp=$this->_tpl_vars['arrCategory'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</div></div></dd></dl><dl><dt>Địa điểm làm việc</dt><dd><div class="checkInsideSelect">'; ?><?php $this->assign('count', count(((is_array($_tmp=$_GET['region'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))); ?><?php echo ''; ?><?php $this->assign('first', ((is_array($_tmp=$_GET['region'][0])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo '<a href="#">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 0): ?><?php echo 'Lựa chọn địa điểm làm việc'; ?><?php elseif (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?><?php echo ''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['arrRegion'][$this->_tpl_vars['first']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php else: ?><?php echo '選択条件'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php endif; ?><?php echo '</a><div class="checkList" id="regionCheckList">'; ?><?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrRegion'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php echo '<label><input type="checkbox" name="region[]" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" '; ?><?php if (in_array ( ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$_GET['region'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?><?php echo 'checked="checked"'; ?><?php endif; ?><?php echo '>'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '</label><div '; ?><?php if (! in_array ( ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$_GET['region'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?><?php echo 'style=\'display: none\''; ?><?php endif; ?><?php echo '>'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'city','options' => ((is_array($_tmp=$this->_tpl_vars['arrCityByRegion'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['city'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo '</div>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</div></div></dd></dl><div id="more_condition" style="'; ?><?php if (((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == '' && ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == '' && ((is_array($_tmp=$_GET['salary_range'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == '' && count(((is_array($_tmp=$_GET['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))) == 0): ?><?php echo 'display: none'; ?><?php endif; ?><?php echo '"><dl><dt>Lương</dt><dd><select name="salary_type" class="box150">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 2): ?><?php echo '<option label="Lựa chọn hình thức trả lương" value="">Lựa chọn hình thức trả lương</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryTypeByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryType'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</select> &nbsp;<select name="currency" class="box100">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) != 1): ?><?php echo '<option label="Lựa chọn loại tiền tệ" value="">Lựa chọn loại tiền tệ</option>'; ?><?php endif; ?><?php echo ''; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrCurrencyByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</select> &nbsp;<select name="salary_range" class="box150"><option label="Chọn mức lương" value="">Chọn mức lương</option>'; ?><?php if (((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0 && ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryRangeByTypeAndCurrency'][$_GET['salary_type']][$_GET['currency']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_range'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</select></dd></dl><dl><dt>Điều kiện khác</dt><dd><div class="checkInsideSelect">'; ?><?php $this->assign('count', count(((is_array($_tmp=$_GET['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))); ?><?php echo ''; ?><?php $this->assign('first', ((is_array($_tmp=$_GET['welfare'][0])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))); ?><?php echo '<a href="#">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 0): ?><?php echo 'Lựa chọn điều kiện khác'; ?><?php elseif (((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?><?php echo ''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['arrWelfare'][$this->_tpl_vars['first']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php else: ?><?php echo '選択条件'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['count'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo ''; ?><?php endif; ?><?php echo '</a><div class="checkList">'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'welfare','options' => ((is_array($_tmp=$this->_tpl_vars['arrWelfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo '</div></div></dd></dl></div><p class="alignL"><a href="#" id="show_more_condition">≫ Tìm kiếm nâng cao</a></p><p class="btn"><input type="submit" value="TÌM KIẾM" name="search" /><br /></p></form></div></div></div>'; ?>
