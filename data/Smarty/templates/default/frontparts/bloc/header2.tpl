<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
$(function() {
    var topBtn = $('#header2');
    topBtn.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});
</script>

<div id="header2">
    <div id="header2_menu">あいうえお</div>
    <div class="header2_box">