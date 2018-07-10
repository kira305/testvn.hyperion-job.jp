$(document).ready(function() {
	var flag = false;
	var pagetop = $('#page-top');
	$(window).scroll(function () {
		if ($(this).scrollTop() > 700) {
			if (flag == false) {
				flag = true;
				pagetop.stop().animate({
					'right': '10px'
				}, 200);
			}
		} else {
			if (flag) {
				flag = false;
				pagetop.stop().animate({
					'right': '-55px'
				}, 200);
			}
		}
	});
	pagetop.click(function () {
		$('body, html').animate({ scrollTop: 0 }, 500);
		return false;
	});
});

$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 500; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});

$(function(){
  $('.checkAll').on('change', function() {
    $('.' + this.id).prop('checked', this.checked);
  });
});


//チェック
$(function(){
	$(".keep_change button").click(function(){
		if($(this).attr("class")=="keep_on"){
		$(".keep_on").removeClass("keep_on").addClass("keep_off").animate({
    'margin-top': '0px',
    'opacity': '0.8' 
}, 500);}
		});
});

//チェック
$(function(){
	$(".list_button_keep button.list_button keep_on").click(function(){
		if($(this).attr("class")=="list_button keep_on"){
		$(".list_button keep_on").removeClass("list_button keep_on").addClass("list_button keep_off").animate({
    'margin-top': '0px',
    'opacity': '0.8' 
}, 500);}
		});
});


//トップメニュー
$(function(){
	$("div.top_contents ul li.search").hover(
    function(){
        $("div.top_contents ul li.mylist").removeClass("mylist").addClass("mylist_x");
        $("div.top_contents ul li.feature").removeClass("feature").addClass("feature_x");
        $("div.top_contents ul li.hyperion").removeClass("hyperion").addClass("hyperion_x");
        $("div.top_contents ul li.contact").removeClass("contact").addClass("contact_x");
        $("div.top_contents_box").removeClass("").addClass("top_contents_search");
        $("p.top_contents_navi1").text("お仕事検索").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").append("<span>JobSearch</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '140px');
        $("p.top_contents_navi2").text("あなたにぴったりのシゴト　今すぐ見つけて働こう").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").animate({'opacity': '1'}, 200);
        $("p.top_contents_navi2").animate({'opacity': '1'}, 200);
    },function(){
        $("div.top_contents ul li.mylist_x").removeClass("mylist_x").addClass("mylist");
        $("div.top_contents ul li.feature_x").removeClass("feature_x").addClass("feature");
        $("div.top_contents ul li.hyperion_x").removeClass("hyperion_x").addClass("hyperion");
        $("div.top_contents ul li.contact_x").removeClass("contact_x").addClass("contact");
        $("div.top_contents_box").removeClass("top_contents_search").addClass("");
        $("p.top_contents_navi1").text("求人情報サイト").css({opacity: 'hide','color': '#DDD'});
        $("p.top_contents_navi1").append("<span>HYPERION@Job</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '100px');
        $("p.top_contents_navi2").text("▼").css({opacity: 'hide','color': '#DDD'});
});
    });

$(function(){
	$("div.top_contents ul li.mylist").hover(
    function(){
        $("div.top_contents ul li.search").removeClass("search").addClass("search_x");
        $("div.top_contents ul li.feature").removeClass("feature").addClass("feature_x");
        $("div.top_contents ul li.hyperion").removeClass("hyperion").addClass("hyperion_x");
        $("div.top_contents ul li.contact").removeClass("contact").addClass("contact_x");
        $("div.top_contents_box").removeClass("").addClass("top_contents_mylist");
        $("p.top_contents_navi1").text("マイリスト").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").append("<span>MyListBox</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '140px');
        $("p.top_contents_navi2").text("使えるキープ機能で、気になるお仕事を逃さずチェック").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").animate({'opacity': '1'}, 200);
        $("p.top_contents_navi2").animate({'opacity': '1'}, 200);
    },function(){
        $("div.top_contents ul li.search_x").removeClass("search_x").addClass("search");
        $("div.top_contents ul li.feature_x").removeClass("feature_x").addClass("feature");
        $("div.top_contents ul li.hyperion_x").removeClass("hyperion_x").addClass("hyperion");
        $("div.top_contents ul li.contact_x").removeClass("contact_x").addClass("contact");
        $("div.top_contents_box").removeClass("top_contents_mylist").addClass("");
        $("p.top_contents_navi1").text("求人情報サイト").css({opacity: 'hide','color': '#DDD'});
        $("p.top_contents_navi1").append("<span>HYPERION@Job</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '100px');
        $("p.top_contents_navi2").text("▼").css({opacity: 'hide','color': '#DDD'});
    });
});


$(function(){
	$("div.top_contents ul li.feature").hover(
    function(){
        $("div.top_contents ul li.search").removeClass("search").addClass("search_x");
        $("div.top_contents ul li.mylist").removeClass("mylist").addClass("mylist_x");
        $("div.top_contents ul li.hyperion").removeClass("hyperion").addClass("hyperion_x");
        $("div.top_contents ul li.contact").removeClass("contact").addClass("contact_x");
        $("div.top_contents_box").removeClass("").addClass("top_contents_feature");
        $("p.top_contents_navi1").text("特集").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").append("<span>Feature</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '140px');
        $("p.top_contents_navi2").text("お仕事のお得な情報やおもしろ体験などをご紹介").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").animate({'opacity': '1'}, 200);
        $("p.top_contents_navi2").animate({'opacity': '1'}, 200);
    },function(){
        $("div.top_contents ul li.search_x").removeClass("search_x").addClass("search");
        $("div.top_contents ul li.mylist_x").removeClass("mylist_x").addClass("mylist");
        $("div.top_contents ul li.hyperion_x").removeClass("hyperion_x").addClass("hyperion");
        $("div.top_contents ul li.contact_x").removeClass("contact_x").addClass("contact");
        $("div.top_contents_box").removeClass("top_contents_feature").addClass("");
        $("p.top_contents_navi1").text("求人情報サイト").css({opacity: 'hide','color': '#DDD'});
        $("p.top_contents_navi1").append("<span>HYPERION@Job</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '100px');
        $("p.top_contents_navi2").text("▼").css({opacity: 'hide','color': '#DDD'});
    });
});


$(function(){
	$("div.top_contents ul li.hyperion").hover(
    function(){
        $("div.top_contents ul li.search").removeClass("search").addClass("search_x");
        $("div.top_contents ul li.mylist").removeClass("mylist").addClass("mylist_x");
        $("div.top_contents ul li.feature").removeClass("feature").addClass("feature_x");
        $("div.top_contents ul li.contact").removeClass("contact").addClass("contact_x");
        $("div.top_contents_box").removeClass("").addClass("top_contents_hyperion");
        $("p.top_contents_navi1").text("ハイペリオン").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").append("<span>AboutUs</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '140px');
        $("p.top_contents_navi2").text("ハイペリオンが目指す求人の新しい未来").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").animate({'opacity': '1'}, 200);
        $("p.top_contents_navi2").animate({'opacity': '1'}, 200);
    },function(){
        $("div.top_contents ul li.search_x").removeClass("search_x").addClass("search");
        $("div.top_contents ul li.mylist_x").removeClass("mylist_x").addClass("mylist");
        $("div.top_contents ul li.feature_x").removeClass("feature_x").addClass("feature");
        $("div.top_contents ul li.contact_x").removeClass("contact_x").addClass("contact");
        $("div.top_contents_box").removeClass("top_contents_hyperion").addClass("");
        $("p.top_contents_navi1").text("求人情報サイト").css({opacity: 'hide','color': '#DDD'});
        $("p.top_contents_navi1").append("<span>HYPERION@Job</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '100px');
        $("p.top_contents_navi2").text("▼").css({opacity: 'hide','color': '#DDD'});
    });
});


$(function(){
	$("div.top_contents ul li.contact").hover(
    function(){
        $("div.top_contents ul li.search").removeClass("search").addClass("search_x");
        $("div.top_contents ul li.mylist").removeClass("mylist").addClass("mylist_x");
        $("div.top_contents ul li.feature").removeClass("feature").addClass("feature_x");
        $("div.top_contents ul li.hyperion").removeClass("hyperion").addClass("hyperion_x");
        $("div.top_contents_box").removeClass("").addClass("top_contents_contact");
        $("p.top_contents_navi1").text("お問い合わせ").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").append("<span>Contact</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '140px');
        $("p.top_contents_navi2").text("お困りの事がございましたら、お気軽にご相談ください").css({'opacity': '0','color': '#FFF'});
        $("p.top_contents_navi1").animate({'opacity': '1'}, 200);
        $("p.top_contents_navi2").animate({'opacity': '1'}, 200);
    },function(){
        $("div.top_contents ul li.search_x").removeClass("search_x").addClass("search");
        $("div.top_contents ul li.mylist_x").removeClass("mylist_x").addClass("mylist");
        $("div.top_contents ul li.feature_x").removeClass("feature_x").addClass("feature");
        $("div.top_contents ul li.hyperion_x").removeClass("hyperion_x").addClass("hyperion");
        $("div.top_contents_box").removeClass("top_contents_contact").addClass("");
        $("p.top_contents_navi1").text("求人情報サイト").css({opacity: 'hide','color': '#DDD'});
        $("p.top_contents_navi1").append("<span>HYPERION@Job</span>").css('opacity', '1');
        $("p.top_contents_navi1 span").css('font-size', '100px');
        $("p.top_contents_navi2").text("▼").css({opacity: 'hide','color': '#DDD'});
    });
});

//fade
/*$(function(){
$('head').append(
'<style type="text/css">body {display:none;}'
);
$(window).load(function() {
$('body').fadeIn("slow");
});
});*/

//ChromeInput

$(function(){
if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0)
{
    var _interval = window.setInterval(function ()
    {
        var autofills = $('input:-webkit-autofill');
        if (autofills.length > 0)
        {
            window.clearInterval(_interval); // stop polling
            autofills.each(function()
            {
                var clone = $(this).clone(true, true);
                $(this).after(clone).remove();
            });
        }
    }, 20);
}
});
