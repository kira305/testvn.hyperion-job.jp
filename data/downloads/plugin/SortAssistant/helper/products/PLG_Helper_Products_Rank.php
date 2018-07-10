<?php
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

/**
 * 商品表示 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

require_once(PLUGIN_UPLOAD_REALDIR. 'SortAssistant/helper/PLG_Helper_Base.php');

final class PLG_Helper_Products_Rank extends PLG_Helper_Base {

    private $surplus = 3;


    public function __construct() {}


    /**
     * 商品表示
     * HookPoint:LC_Page_Admin_Products_ProductRank_action_after
     **/
    public function main($objPage){
        $pageRows = array(10=> 10, 20=>20, 50=>50, 100=> 100);
        $objPage->pageRows = $pageRows;

        // 処理モード取得
        $objPage->mode = Salon_Plugin_Base002::getMode();
        switch ($objPage->mode) {
            // 並び替え実行
            case 'sort_excu':
                $res = $this->update();
                if(!$res){
                    $objPage->tpl_onload = parent::alertfail();
                    break;
                }
                $objPage->tpl_onload = parent::alertsuccess();
                break;
        }

        $objPage->search_page_max = isset($_POST['search_page_max']) ? $_POST['search_page_max'] : 10;
        $objPage->arrProductsList = $this->lfGetProduct($objPage, $objPage->arrForm['parent_category_id'], $objPage->search_page_max+$this->surplus);
        // TODO テンプレートで対応
//        // 次の5件 # 改ページ対策
//        $objPage->arrProductsList5 = array_slice($objPage->arrProductsList, $objPage->search_page_max);
//        $objPage->arrProductsList  = array_slice($objPage->arrProductsList, 0, $objPage->search_page_max);

        // 最後のページ # 改ページ
        $objPage->is_lastpage = $objPage->tpl_pageno == $objPage->tpl_pagemax;

        $objPage->sortCount       = count($objPage->arrProductsList);
    }


    /**
     * 商品読み込み
     * 
     * @see LC_Page_Admin_Products_ProductRank
     * @return array
     */
    private function lfGetProduct(&$objPage, $category_id, $page_max=SEARCH_PMAX) {
        // FIXME SC_Product クラスを使用した実装
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $col = 'alldtl.product_id, name, main_list_image, product_code_min, product_code_max, status, rank';
        $objProduct = new SC_Product();
        $table = $objProduct->alldtlSQL();
        $table.= ' LEFT JOIN dtb_product_categories AS T5 ON alldtl.product_id = T5.product_id';
        $where = 'del_flg = 0 AND category_id = ?';

        // 行数の取得
        $linemax = $objQuery->count($table, $where, array($category_id));
        // 該当件数表示用
        $objPage->tpl_linemax = $linemax;

        $objNavi = new SC_PageNavi_Ex($objPage->tpl_pageno, $linemax, $page_max-$this->surplus, 'fnNaviPage', NAVI_PMAX);
        $startno = $objNavi->start_row;
        $objPage->tpl_start_row = $objNavi->start_row;
        $objPage->tpl_strnavi = $objNavi->strnavi;     // Navi表示文字列
        $objPage->tpl_pagemax = $objNavi->max_page;    // ページ最大数（「上へ下へ」表示判定用）
        $objPage->tpl_disppage = $objNavi->now_page;   // 表示ページ番号（「上へ下へ」表示判定用）

        // 取得範囲の指定(開始行番号、行数のセット)
        $objQuery->setLimitOffset($page_max, $startno);

        $objQuery->setOrder('rank DESC, alldtl.product_id DESC');

        $arrRet = $objQuery->select($col, $table, $where, array($category_id));
        return $arrRet;
    }


    /**
     * 並び替えの更新処理
     * 
     * @Override
     * @return boolean
     */
    protected function update($parent_category_id){
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        try{
            $objQuery->begin();

            $table = 'dtb_product_categories';
            $parent_category_id = $_POST['parent_category_id'];

            $param = $this->getContentValues();
            if(count($param) == 0) throw new Exception("更新パラメータエラー");

            foreach($param as $_id => $rank){
                // 更新データ
                $ContentValue = array();
                $ContentValue['rank'] = $rank;

                $where = "category_id = ? and product_id = ?";
                $res = $objQuery->update($table, $ContentValue, $where, array($parent_category_id, $_id));
                if(!$res) throw new Exception("更新エラー");
            }
            $objQuery->commit();

        }catch(Exception $e){
            $objQuery->rollback();
            return false;
        }

        return true;
    }

}

?>
