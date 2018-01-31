<?php /* Smarty version 2.6.27, created on 2017-12-05 17:51:20
         compiled from /var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/category.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/category.tpl', 60, false),array('modifier', 'h', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/category.tpl', 256, false),array('function', 'html_checkboxes', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/category.tpl', 204, false),array('function', 'html_radios', '/var/www/testvn.hyperion-job.jp/html/../data/Smarty/templates/default/frontparts/bloc/category.tpl', 231, false),)), $this); ?>

<script type="text/javascript">//<![CDATA[
    $(function(){
        $('.more').click(function(){
            var filterArea = $(this).parent().next();
            if($(this).text() == '＋'){
                $(this).text('ー');
                var labelCount = filterArea.find('label:visible').size();
                var labelHeight = filterArea.find('label:eq(0)').outerHeight();
                filterArea.animate({"max-height": labelCount * labelHeight + "px"}, 1000);
            } else {
                $(this).text('＋');
                var hgt = 125;
                var isRegionArea = $(this).parent().next().find('input[name="region[]"]').length;
                if(isRegionArea > 0){
                    var addHgt = 0;
                    $(this).parent().next().find('div:visible').each(function(){
                        addHgt = addHgt + $(this).height();
                    });
                    hgt = hgt + addHgt;
                }
                filterArea.animate({"max-height": hgt + "px"}, 1000);
            }
        });
        
        $('.filter_area input[name="region[]"]').change(function(){
            var cities = $(this).parent().next();
            if($(this).is(':checked')){
                cities.find('input').prop('checked', 'checked');
                var hgt = $(this).closest('.filter_area').height() + cities.height();
            } else {
                cities.find('input').prop('checked', '');
                var hgt = $(this).closest('.filter_area').height() - cities.height();
            }
            cities.slideToggle('slow');
            $(this).closest('.filter_area').animate({"max-height": hgt + "px"}, 1000);
        });
        
        var prevTarget = <?php echo ((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
;
        $('input[name="employment_status[]"]').change(function() {
            var target = detectTargetByEmpStatus();
            
            if(prevTarget != target){
                $("#salary_range").hide();
                $("#salary_type").html('');
                $("#currency").html('');
                $("#category_id").html('');
                if(target == 0){
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSalaryType'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        var input = $('<input />', { type: 'radio', name: 'salary_type', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                        $("#salary_type").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        var input = $('<input />', { type: 'radio', name: 'currency', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                        $("#currency").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                    <?php endforeach; endif; unset($_from); ?>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCategory'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        var input = $('<input />', { type: 'checkbox', name: 'category_id[]', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                        $("#category_id").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
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
                                var input = $('<input />', { type: 'radio', name: 'salary_type', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                $("#salary_type").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
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
                                var input = $('<input />', { type: 'radio', name: 'currency', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                $("#currency").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
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
                                var input = $('<input />', { type: 'checkbox', name: 'category_id[]', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                $("#category_id").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    if(target == 1){
                        $("input[name=currency][value=1]").attr('checked', 'checked');
                    } else {
                        $("input[name=salary_type][value=3]").attr('checked', 'checked');
                    }
                }
                prevTarget = target;
            }
        });
        
        function detectTargetByEmpStatus(){
            var target = 0;
            if($('input[name="employment_status[]"]:checked').length > 0){
                var tempTarget;
                $('input[name="employment_status[]"]:checked').each(function(){
                    tempTarget = getTargetByEmpStatus($(this).val());
                    if(target == 0){
                        target = tempTarget;
                    } else if(target != tempTarget){
                        target = 0;
                        return false;
                    }
                });
            }
            return target;
        }
        
        function getTargetByEmpStatus(empId){
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
        
        $("body").on("change", "input[name=salary_type], input[name=currency]", function () {
            $("#salary_range .filter_area").html('');
            var salaryType = $("input[name=salary_type]:checked").val();
            var currency = $("input[name=currency]:checked").val();
            
            if($(this).attr('name') == 'salary_type' && typeof $("input[name=employment_status]:checked").val() === "undefined"){
                $("#currency").html('');
                if(salaryType == 1 || salaryType == 2){
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrencyByTarget'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        if(<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
 == 1){
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['c_key'] => $this->_tpl_vars['c_item']):
?>
                                var input = $('<input />', { type: 'radio', name: 'currency', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                $("#currency").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                            <?php endforeach; endif; unset($_from); ?>
                        }
                    <?php endforeach; endif; unset($_from); ?>
                    $("input[name=currency][value=1]").attr('checked', 'checked');
                } else {
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        var input = $('<input />', { type: 'radio', name: 'currency', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                        $("#currency").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                    <?php endforeach; endif; unset($_from); ?>
                    $("input[name=currency][value=" + currency + "]").attr('checked', 'checked');
                }
            }
            currency = $("input[name=currency]:checked").val();
            
            if(typeof salaryType !== "undefined" && typeof currency !== "undefined"){
                $('#salary_range').show();
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
                                    var input = $('<input />', { type: 'checkbox', name: 'salary_range', value: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' });
                                    $("#salary_range .filter_area").append( $('<label />', { text: '<?php echo ((is_array($_tmp=$this->_tpl_vars['c_item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
' }).prepend(input) );
                                <?php endforeach; endif; unset($_from); ?>
                            }
                        <?php endforeach; endif; unset($_from); ?>
                    }
                <?php endforeach; endif; unset($_from); ?>
            } else {
                $('#salary_range').hide();
            }
        });
    });
//]]></script>

<?php echo '<div class="block_outer"><div id="category_area"><h2>Điều kiện tìm kiếm</h2><div class="block_body"><form name="search_form" id="search_form" method="get" action="'; ?><?php echo ((is_array($_tmp=@ROOT_URLPATH)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo 'products/list.php"><input type="hidden" name="'; ?><?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" /><input type="hidden" name="mode" value="search" /><input type="hidden" name="prevPage" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['prevPage'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '"><h3>Loại công việc</h3><div class="filter_area">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'employment_status','options' => ((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatusByTarget'][$this->_tpl_vars['page']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['employment_status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'employment_status','options' => ((is_array($_tmp=$this->_tpl_vars['arrEmploymentStatus'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['employment_status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</div><h3>Ngành nghề<span class="more">＋</span></h3><div class="filter_area" id="category_id">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'category_id','options' => ((is_array($_tmp=$this->_tpl_vars['arrCategoryByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_checkboxes(array('name' => 'category_id','options' => ((is_array($_tmp=$this->_tpl_vars['arrCategory'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['category_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</div><h3>Vị trí</h3><div class="filter_area">'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'position','options' => ((is_array($_tmp=$this->_tpl_vars['arrPosition'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['position'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo '</div><h3>Địa điểm làm việc<span class="more">＋</span></h3><div class="filter_area">'; ?><?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrRegion'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?><?php echo '<label><input type="checkbox" name="region[]" value="'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '" '; ?><?php if (in_array ( ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$_GET['region'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?><?php echo 'checked="checked"'; ?><?php endif; ?><?php echo '>'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?><?php echo '</label><div '; ?><?php if (! in_array ( ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) , ((is_array($_tmp=$_GET['region'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) )): ?><?php echo 'style=\'display: none\''; ?><?php endif; ?><?php echo '>'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'city','options' => ((is_array($_tmp=$this->_tpl_vars['arrCityByRegion'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['city'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo '</div>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</div><h3>Hình thức trả lương</h3><div class="filter_area noListFilter" id="salary_type">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_radios(array('name' => 'salary_type','options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryTypeByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_radios(array('name' => 'salary_type','options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryType'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</div><h3>Tiền tệ</h3><div class="filter_area noListFilter" id="currency">'; ?><?php if (((is_array($_tmp=$this->_tpl_vars['target'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) > 0): ?><?php echo ''; ?><?php echo smarty_function_html_radios(array('name' => 'currency','options' => ((is_array($_tmp=$this->_tpl_vars['arrCurrencyByTarget'][$this->_tpl_vars['target']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo smarty_function_html_radios(array('name' => 'currency','options' => ((is_array($_tmp=$this->_tpl_vars['arrCurrency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo ''; ?><?php endif; ?><?php echo '</div><div id="salary_range" '; ?><?php if (((is_array($_tmp=$_GET['salary_type'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == '' || ((is_array($_tmp=$_GET['currency'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == ''): ?><?php echo 'style="display: none"'; ?><?php endif; ?><?php echo '><h3>Mức lương<span class="more">＋</span></h3><div class="filter_area">'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'salary_range','options' => ((is_array($_tmp=$this->_tpl_vars['arrSalaryRangeByTypeAndCurrency'][$_GET['salary_type']][$_GET['currency']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['salary_range'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?><?php echo '</div></div><h3>Điều kiện khác<span class="more">＋</span></h3><div class="filter_area">'; ?><?php echo smarty_function_html_checkboxes(array('name' => 'welfare','options' => ((is_array($_tmp=$this->_tpl_vars['arrWelfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$_GET['welfare'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'separator' => ''), $this);?><?php echo '</div><h3>Từ khóa</h3><div class="filter_area"><textarea name="name" placeholder="Nhập từ khóa tìm kiếm">'; ?><?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?><?php echo '</textarea></div><div class="alignC"><input type="submit" value="Tìm kiếm" name="search" /></div></form></div></div></div>'; ?>
