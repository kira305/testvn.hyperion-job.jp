<!--{*
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2012 LOCKON CO.,LTD. All Rights Reserved.
*
* http://www.lockon.co.jp/
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/
*}-->
<link rel="stylesheet" href="<!--{$TPL_URLPATH}-->css/fullcalendar.css" type="text/css" media="all" />
<link rel="stylesheet" href="<!--{$TPL_URLPATH}-->css/fullcalendar.print.css" type="text/css" media="print" />
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="<!--{$smarty.const.ROOT_URLPATH}-->js/fullcalendar.min.js"></script>
<script type="text/javascript">
<!--
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'agendaDay,agendaWeek,month',
                center: 'prev,next today',
                right: 'title'
            },
            buttonText: {
                today:    '今日',
                month:    '月',
                week:     '週',
                day:      '日'
            },
            dayNames: ['日', '月', '火', '水', '木', '金', '土'],
            dayNamesShort: ['日', '月', '火', '水', '木', '金', '土'],
            titleFormat: {
                month: "yyyy'年'MM'月'",
                week: "yyyy'年' MM'月'dd日{ '&#8212;' [yyyy'年'][MM'月']dd日}",
                day: "yyyy'年'MM'月'dd日(dddd)"
            },
            columnFormat: {
                month: 'ddd',
                week: "M/d'('ddd')'",
                day: "M/d'('dddd')'"
            },
            axisFormat: 'HH:mm',
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                <!--{if $smarty.session.authority == 2}-->
                    var corpSelect = document.getElementById('corporate_id');
                    if(corpSelect.selectedIndex === '' || corpSelect.selectedIndex === 0)
                        alert('Please select your branch pharmacy name');
                    else{
                        fnOpenWindow('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/schedule_job.php?start=' + start + '&end=' + end + '&corporate_id='+corpSelect.options[corpSelect.selectedIndex].value, 'popupWindow', '600', '650');
                        calendar.fullCalendar('unselect');
                    }
                <!--{else}-->
                    fnOpenWindow('<!--{$smarty.const.ROOT_URLPATH}--><!--{$smarty.const.ADMIN_DIR}-->job/schedule_job.php?start=' + start + '&end=' + end, 'popupWindow', '600', '650');
                    calendar.fullCalendar('unselect');
                <!--{/if}-->
                
            },
            editable: true,
            events: "json-jobs.php",
            eventDrop: function(event, dayDelta, minuteDelta) {
                document.form1.mode.value = 'move';
                document.form1.sjob_id.value = event.id;
                document.form1.dayDiff.value = dayDelta;
                document.form1.minuteDiff.value = minuteDelta;
                document.form1.submit();
            },
            eventResize: function(event, dayDelta, minuteDelta) {
                document.form1.mode.value = 'resize';
                document.form1.sjob_id.value = event.id;
                document.form1.dayDiff.value = dayDelta;
                document.form1.minuteDiff.value = minuteDelta;
                document.form1.submit();
            },
            eventRender: function(event, element) {
                element.find('.fc-event-title').append("<br/>" + event.description);
            },
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url, "popupWindow", "width=600,height=650");
                    return false;
                }
            },
            loading: function(bool) {
                if (bool)
                    $('#loading').show();
                else
                    $('#loading').hide();
            }
        });
    });
//-->
</script>
<style>
    div#calendar{
        font-size: 14px;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
    }
    table.form, table.form tr th, table.form tr td{
        border: 1px solid #CCCCCC;
    }
</style>

<form name="form1" id="form1" method="post" action="?">
    <input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
    <input type="hidden" name="mode" value="<!--{$tpl_mode|default:"edit"|h}-->" />
    <input type="hidden" name="sjob_id" value="<!--{$arrForm.sjob_id.value|h}-->" />
    <input type="hidden" name="dayDiff" value="" />
    <input type="hidden" name="minuteDiff" value="" />

    <div id="order" class="contents-main">
        <table class="form">
            <tr>
                <th>会社名</th>
                <td><!--{$agencyName}--></td>
            </tr>
            <tr>
                <th>薬局名</th>
                <td>
                    <!--{if $smarty.session.authority == 2}-->
                    <!--{assign var=key value="corporate_id"}-->
                    <span class="attention"><!--{$arrErr[$key]}--></span>
                    <select id="<!--{$key}-->" name="<!--{$key}-->" style="<!--{$arrErr[$key]|sfGetErrorColor}-->">
                        <option value="">選択してください</option>
                        <!--{html_options options=$arrCORPORATE selected=$arrForm[$key].value}-->
                    </select>
                    <!--{else}-->
                    <!--{$corpName}--><input type="hidden" name="corporate_id" value="<!--{$smarty.session.corporate_id}-->" />
                    <!--{/if}-->
                </td>
            </tr>
        </table>

        <br><br>
        <div id='loading' style='display:none'>loading...</div>
        <div id='calendar'></div>
    </div>
</form>
