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
 * 規格分類 並び替えのヘルパークラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

require_once(PLUGIN_UPLOAD_REALDIR. 'SortAssistant/helper/PLG_Helper_Base.php');

final class PLG_Helper_Products_ClassCategory extends PLG_Helper_Base {


    public function __construct() {}


    /**
     * 規格分類
     * HookPoint:LC_Page_Admin_Design_MainEdit_action_after
     **/
    public function main($objPage){
        $class_id = $this->getClassId();
        $objPage->class_id = $class_id;

        // 処理モード取得
        $objPage->mode = Salon_Plugin_Base002::getMode();
        switch($objPage->mode){
            // 並び替え実行
            case 'sort_excu':
                $table = "dtb_classcategory";
                $where = "classcategory_id = ?";
                $res = parent::update($table, $where);
                if(!$res){
                    $objPage->tpl_onload = parent::alertfail();
                    break;
                }
                $objPage->tpl_onload = parent::alertsuccess();
                break;
        }

        // 規格分類の取得
        $objPage->arrClassCat = $this->lfGetClassCat($class_id);
        $objPage->sortCount   = count($objPage->arrClassCat);
    }



    private function getClassId(){
        $objFormParam = new SC_FormParam_Ex();
        $objFormParam->addParam('規格ID', 'class_id', INT_LEN, 'n', array('NUM_CHECK'));

        $objFormParam->setParam($_REQUEST);
        $objFormParam->convParam();
        $class_id = $objFormParam->getValue('class_id');
        return $class_id;
    }


    /**
     * 有効な規格分類情報の取得
     *
     * @param integer $class_id 規格ID
     * @return array 規格分類情報
     * @see LC_Page_Admin_Products_ClassCategory#lfGetClassCat
     */
    private function lfGetClassCat($class_id) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        $where = 'del_flg <> 1 AND class_id = ?';
        $objQuery->setOrder('rank DESC'); // XXX 降順
        // rankを取得カラムに追加
        $arrClassCat = $objQuery->select('name, classcategory_id, rank', 'dtb_classcategory', $where, array($class_id));
        return $arrClassCat;
    }


}

?>
