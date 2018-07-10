            <td class="image_drop_td" style="visibility:hidden; position:absolute; width:0px;">
                <span class="attention"><!--{$arrErr[$key]}--></span>
                <div id="<!--{$key}-->_area" class="image_drop_area" style="vertical-align: middle; position: relative;" align="center">
                    <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                    <img src="<!--{$arrForm.arrFile[$key].filepath}-->" alt="<!--{$arrForm.name|h}-->" />
                    <!--{/if}-->
                    <input type="file" name="<!--{$key}-->_drop_image_input" size="40" style="<!--{$arrErr[$key]|sfGetErrorColor}-->" class="image_input" />
                    <div class="input_message" style="display: table-cell; vertical-align: middle;">
                        <span>ドラッグ＆ドロップ<br />もしくは<br />クリックしてファイル選択</span>
                    </div>
                </div>
                <!--{if $arrForm.arrFile[$key].filepath != ""}-->
                <a href="" onclick="selectAll('category_id'); fnModeSubmit('delete_image', 'image_key', '<!--{$key}-->'); return false;">[画像の取り消し]</a>
                <!--{/if}-->
                <a class="btn-normal" href="javascript:;" name="btn" onclick="selectAll('category_id'); fnModeSubmit('upload_image', 'image_key', '<!--{$key}-->'); return false;">アップロード</a>
            </td>

