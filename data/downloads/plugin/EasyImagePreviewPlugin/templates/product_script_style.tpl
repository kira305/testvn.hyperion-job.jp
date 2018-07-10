
<script type="text/javascript">
$(function() {
    setInputMessage();

    if (window.File) {
    //if (false) {
        var image_td = $('.image_drop_td').attr('style', '');
        $('input', image_td).each(function() {
            $(this).attr('name', $(this).attr('name').replace('_drop_image_input', ''));
        });
        $('input', image_td).each(function() {
            $(this).attr('name', $(this).attr('name').replace('_drop_image_input', ''));
        });
        $('td:not(.image_drop_td)', $('.image_drop_td').parent()).remove();
        

        var image_input = $('.image_drop_area input[type="file"]');
        image_input.change(function (e) {
            var name = $(e.target).attr('name');
            var existing_img = $('#' + name + '_area img');
            if (existing_img.size() > 0) {
                if (existing_img.attr('id') == name + '_temp') {
                    existing_img.remove(); 
                } else {
                    alert('新しい画像の設定は、画像の取り消しをしてからお願いします。');
                    $('#' + name + '_area input').attr('value', '');
                    return;
                }
            }

            var reader = new FileReader();
            var image = e.target.files[0];

            reader.onerror = function () {
                alert("ファイルの読み込みに失敗しました。");
            };

            var url = "";

            reader.onload = function (e2) {
                var img = document.createElement('img');
                img.src = reader.result;
                $(e.target).parent().append(img);
                $(img).attr('id', name + '_temp');

                if (name == 'main_image') {
                    if (canOverwriteImage('main_list_image')) {
                        $('#main_list_image_area img').remove();
                        img = document.createElement('img');
                        img.src = reader.result;
                        $('input[name="main_list_image"]').parent().append(img);
                        $(img).attr('id', 'main_list_image_temp');
                    }
                }
                if (name == 'main_large_image') {
                    if (canOverwriteImage('main_image')) {
                        $('#main_image_area img').remove();
                        img = document.createElement('img');
                        img.src = reader.result;
                        $('input[name="main_image"]').parent().append(img);
                        $(img).attr('id', 'main_image_temp');

                        if (canOverwriteImage('main_list_image')) {
                            $('#main_list_image_area img').remove();
                            img = document.createElement('img');
                            img.src = reader.result;
                            $('input[name="main_list_image"]').parent().append(img);
                            $(img).attr('id', 'main_list_image_temp');
                        }
                    }
                }
                
            setInputMessage();
            };

            url = reader.readAsDataURL(image);
        });
    }
});

function canOverwriteImage(image_name) {
    var img_elm = $('#' + image_name + '_area img');
    return img_elm.size() == 0 ||
           (!$('#' + image_name + '_area input').attr('value') &&
            img_elm.attr('id') == image_name + "_temp");
}

function setInputMessage() {
    $('.image_drop_area img').each( function() {
        $('div.input_message', $(this).parent()).remove();
    });
}
</script>

<style>

.image_drop_area {
  display: inline-block;
  overflow: hidden;
  position: relative;
  border: 1px solid #999;
  background-color: #eee;
}

.image_drop_area input[type="file"] {
  opacity: 0;
  filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
  position: absolute;
  right: 0;
  top: 0;
  margin: 0;
  font-size: 100px;
  cursor: pointer;
}

#main_list_image_area, #main_list_image_area div.input_message, .image_drop_area input[type="file"][name="main_list_image"] {
  width: <!--{$smarty.const.SMALL_IMAGE_WIDTH}-->px;
  height: <!--{$smarty.const.SMALL_IMAGE_HEIGHT}-->px;
}

#main_list_image_temp {
  max-width: <!--{$smarty.const.SMALL_IMAGE_WIDTH}-->px;
  max-height: <!--{$smarty.const.SMALL_IMAGE_HEIGHT}-->px;
}

#main_image_area, #main_image_area div.input_message, .image_drop_area input[type="file"][name="main_image"] {
  width: <!--{$smarty.const.NORMAL_IMAGE_WIDTH}-->px;
  height: <!--{$smarty.const.NORMAL_IMAGE_HEIGHT}-->px;
}
#main_image_temp {
  max-width: <!--{$smarty.const.NORMAL_IMAGE_WIDTH}-->px;
  max-height: <!--{$smarty.const.NORMAL_IMAGE_HEIGHT}-->px;
}

#main_large_image_area, #main_large_image_area div.input_message, .image_drop_area input[type="file"][name="main_large_image"] {
  width: <!--{$smarty.const.LARGE_IMAGE_WIDTH}-->px;
  height: <!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->px;
}
#main_large_image_temp {
  max-width: <!--{$smarty.const.LARGE_IMAGE_WIDTH}-->px;
  max-height: <!--{$smarty.const.LARGE_IMAGE_HEIGHT}-->px;
}
</style>


