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
 * 並び替えのヘルパー基底クラス
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

class PLG_Helper_Base {

    public function __construct() {
    }


    /** バージョン分岐 */
    protected function run($obj, $objPage){
        // A.BB.CCメソッド
        $method = "main".ECCUBE_VERSION;
        if(method_exists($obj, $method)){
            $obj->$method($objPage);
            return;
        }
        // A.BBメソッド
        $ver = str_replace(".", "_", substr(ECCUBE_VERSION, 0, 4));
        $method = "main".$ver;
        if(method_exists($obj, $method)){
            $obj->$method($objPage);
            return;
        }

        $obj->main($objPage);
    }


    protected function getContentValues(){
        return isset($_POST['rank']) ? $_POST['rank'] : array();
    }

    protected function update($table, $where){
        $objQuery =& SC_Query_Ex::getSingletonInstance();

        try{
            $objQuery->begin();

            $param = $this->getContentValues();
            if(count($param) == 0) throw new Exception("更新パラメータエラー");

            foreach($param as $_id => $rank){
                // 更新データ
                $ContentValue = array();
                $ContentValue['rank'] = $rank;

                $res = $objQuery->update($table, $ContentValue, $where, array($_id));
                if(!$res) throw new Exception("更新エラー");
            }
            $objQuery->commit();

        }catch(Exception $e){
            $objQuery->rollback();
            return false;
        }

        return true;
    }


    protected function alertbase($str){
        return sprintf('window.alert("%s");', $str);
    }

    protected function alertfail($str="並び替えに失敗しました。"){
        return self::alertbase($str);
    }

    protected function alertsuccess($str="並び替えが完了しました。"){
        return self::alertbase($str);
    }


}

?>
