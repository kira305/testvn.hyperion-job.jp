/*
 * SortAssistant
 * 
 * Copyright (c) 2014 doishun
 * http://www.salon.ne.jp
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 * 
 */

(function($){
    var updateUpDown = function(sortable){
        var c = $('div:not(.ui-sortable-helper)', sortable).size();

        $('div:not(.ui-sortable-helper)', sortable)
            .removeClass('last')
            .removeClass('nextitem')
            .filter(':last').addClass('last').end()
            .removeClass('first')
            .filter(':first').addClass('first').end();

        if($("#is_lastpage").val() != 1){
            $('div:not(.ui-sortable-helper)', sortable)
                .eq(c-3).addClass('nextitem').end()
                .eq(c-2).addClass('nextitem').end()
                .eq(c-1).addClass('nextitem').end();
        }
    };

    var sortableUpdate = function(e, ui){
        updateUpDown(this);
        if(ui.sender){
            updateUpDown(ui.sender[0]);
        }

        // 表示番号の補正
        result = $('.sortable').sortable('toArray');
        if (typeof mode === "undefined"){
            mode = 'ASC';
        }

        if(mode == 'DESC'){
            index = index_start_row;
            hiddn = hiddn_start_row;
            for(var i in result) {
                if(result[i].slice(0, 4) != "item") continue;
                var obj = "#"+result[i];
                $(".num", obj).text(index);
                $(obj+"_hidden").val(hiddn);
                index++;
                hiddn--;
            }

        }else{
            for(var index in result) {
                var obj = "#"+result[index];
                $(".num", obj).text(parseInt(index)+1);
                $(obj+"_hidden").val(parseInt(index)+1);
            }
        }
    };

    $(document).ready(function(){
        $("#sort_stop").bind("click", function(){
            if(!window.confirm('並び替えを中止します。よろしいですか？')){
                return;
            }
            document.form1.target = "_self";
            fnFormModeSubmit('form1','sort_stop','','');
        });

        var els = ['.sortable'];
        var $els = $(els.toString());

        $els.each(function(){
            updateUpDown(this);
        });

        $els.sortable({
            items: '> div',
            handle: 'td.handler img',
            cursor: 'n-resize',
            appendTo: 'body',
            placeholder: 'clone',
            placeholder: 'placeholder',
            connectWith: els,
            containment:'#contents-main',
            axis:'y',
            start: function(e,ui) {
                ui.item.css("background", "#f5f5f5");
                ui.helper.css("width", ui.item.width());

                // 開始位置セット
//                var start_pos = parseInt($(".num", "#"+ui.item.attr("id")).text());
                var start_pos = ui.item.index(".sort_item");

                ui.item.data('start_pos', start_pos);
            },

            stop: function(e,ui) {
                ui.item.css("background", "#ffffff")
                       .addClass("E");

            },

            change: function(e, ui) {
//                // 開始位置ゲット
                var start_pos = ui.item.data('start_pos');
                var position = parseInt($("div:not(.ui-sortable-helper)", ".sortable").index(ui.placeholder))+1;

                var index = start_pos;
                if(start_pos > position){
//                    var next = "#"+ui.placeholder.next().attr("id")
//                    $(".num", next).text(index)
                    index--;

                }

                if(start_pos < position){
//                    var prev = "#"+ui.placeholder.prev().attr("id")
//                    $(".num", prev).text(index)
                    index++;
                }

                // 並び順を変更した場合
                if(start_pos != index){
                    ui.item.addClass("sorted");

                }else if(!ui.item.hasClass("E")){
                    ui.item.removeClass("sorted");
                }
//                $(".num", ui.item).text(index);
//                ui.item.data('start_pos', index);
            },

            update: sortableUpdate
        });
    });
})(jQuery);