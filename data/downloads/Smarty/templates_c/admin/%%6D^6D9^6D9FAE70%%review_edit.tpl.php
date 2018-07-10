<?php /* Smarty version 2.6.26, created on 2012-09-27 16:43:59
         compiled from products/review_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'script_escape', 'products/review_edit.tpl', 26, false),array('modifier', 'h', 'products/review_edit.tpl', 28, false),array('modifier', 'sfDispDBDate', 'products/review_edit.tpl', 45, false),array('modifier', 'sfGetErrorColor', 'products/review_edit.tpl', 60, false),array('function', 'html_radios_ex', 'products/review_edit.tpl', 72, false),array('function', 'html_options', 'products/review_edit.tpl', 83, false),)), $this); ?>

<form name="form1" id="form1" method="post" action="?">
<input type="hidden" name="<?php echo ((is_array($_tmp=@TRANSACTION_ID_NAME)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['transactionid'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" />
<input type="hidden" name="mode" value="complete" />
<input type="hidden" name="review_id" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['review_id'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
<?php $_from = ((is_array($_tmp=$this->_tpl_vars['arrSearchHidden'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
    <input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" />
<?php endforeach; endif; unset($_from); ?>

<div id="products" class="contents-main">

    <!--▼編集テーブルここから-->
    <table>
        <tr>
            <th>商品名</th>
            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>

            <input type="hidden" name="name" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
">
            </td>
        </tr>
        <tr>
            <th>投稿日</th>
            <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['create_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfDispDBDate', true, $_tmp) : SC_Utils_Ex::sfDispDBDate($_tmp)); ?>

            <input type="hidden" name="create_date" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['create_date'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
">
            </td>
        </tr>
        <tr>
            <th>レビュー表示</th>
            <td>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr']['status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span><?php endif; ?>
                <input type="radio" name="status" value="2" <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 2): ?>checked<?php endif; ?>>非表示<?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 2 && ! ((is_array($_tmp=$this->_tpl_vars['tpl_status_change'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><?php else: ?><input type="radio" name="status" value="1" <?php if (((is_array($_tmp=$this->_tpl_vars['arrForm']['status'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)) == 1): ?>checked<?php endif; ?>>表示<?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>投稿者名 <span class="attention">*</span></th>
            <td>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span><?php endif; ?>
                <input type="text" class="box60" name="reviewer_name" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['reviewer_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_name'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" size=30>
            </td>
        </tr>
        <tr>
            <th>投稿者URL</th>
            <td>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span><?php endif; ?>
                <input type="text" class="box60" name="reviewer_url" maxlength="<?php echo ((is_array($_tmp=@URL_LEN)) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['reviewer_url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr']['reviewer_url'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" size=30>
            </td>
        </tr>
        <tr>
            <th>性別</th>
            <td><?php echo smarty_function_html_radios_ex(array('name' => 'sex','options' => ((is_array($_tmp=$this->_tpl_vars['arrSex'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$this->_tpl_vars['arrForm']['sex'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?>
</td>
        </tr>
        <tr>
            <th>おすすめレベル <span class="attention">*</span></th>
            <td>
                <?php $this->assign('key', 'recommend_level'); ?>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?>
                <span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span>
                <?php endif; ?>
                <select name="<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" >
                <option value="" selected="selected">選択してください</option>
                <?php echo smarty_function_html_options(array('options' => ((is_array($_tmp=$this->_tpl_vars['arrRECOMMEND'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)),'selected' => ((is_array($_tmp=$this->_tpl_vars['arrForm'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))), $this);?>

                </select>
            </td>
        </tr>
        <tr>
            <th>タイトル <span class="attention">*</span></th>
            <td>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr']['title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span><?php endif; ?>
                <input type="text" class="box60" name="title" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr']['title'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" size=30><span class="attention">
            </td>
        </tr>
        <tr>
            <th>コメント <span class="attention">*</span></th>
            <td>
                <?php if (((is_array($_tmp=$this->_tpl_vars['arrErr']['comment'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp))): ?><span class="attention"><?php echo ((is_array($_tmp=$this->_tpl_vars['arrErr']['comment'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)); ?>
</span><?php endif; ?>
                <textarea name="comment" rows="20" cols="60" class="area60" wrap="soft" style="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrErr']['comment'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('sfGetErrorColor', true, $_tmp) : SC_Utils_Ex::sfGetErrorColor($_tmp)); ?>
" ><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['arrForm']['comment'])) ? $this->_run_mod_handler('script_escape', true, $_tmp) : smarty_modifier_script_escape($_tmp)))) ? $this->_run_mod_handler('h', true, $_tmp) : smarty_modifier_h($_tmp)); ?>
</textarea>
            </td>
        </tr>
    </table>
    <!--▲編集テーブルここまで-->

    <div class="btn-area">
        <ul>
            <li><a class="btn-action" href="javascript:;" onclick="document.form1.action='./review.php'; fnModeSubmit('search','',''); return false;" ><span class="btn-prev">検索画面に戻る</span></a></li>
            <li><a class="btn-action" href="javascript:;" onclick="fnModeSubmit('complete','',''); return false;"><span class="btn-next">この内容で登録する</span></a></li>
        </ul>
    </div>
</div>
</form>