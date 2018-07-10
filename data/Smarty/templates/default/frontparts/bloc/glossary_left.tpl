<!--{*
 * 
 * Copyright(c) 2000-2012 PharmaPremium All Rights Reserved.
 *
*}-->
<script type="text/javascript">
$(document).ready(function(){
    $('.accordion_head').click(function() {
    	$(this).toggleClass("selected").next().slideToggle();
}).next().hide();
});
</script>

<div class="block_outer">
<div id="gl_area" class="block_body">

<h3><img src="<!--{$TPL_URLPATH}-->img/title/tit_glossary_left.gif" alt="薬剤師用語集" /></h3>
<ul class="accordion">
<li>
  <a href="#a">ア行</a>
</li>
<li>
  <a href="#ka">カ行</a>
</li>
<li>
<a href="#sa">サ行</a>
</li>
<li>
<a href="#ta">タ行</a>
</li>
<li>
<a href="#na">ナ行</a> 
</li>
<li>
<a href="#ha">ハ行</a>
</li>
<li>
<a href="#ma">マ行</a>  
</li>
<li>
<a href="#ya">ヤ行</a>
</li>
<li>
<a href="#ra">ラ行</a>
</li>
</ul>

</div><!-- /block_body -->
</div><!-- /block_outer -->