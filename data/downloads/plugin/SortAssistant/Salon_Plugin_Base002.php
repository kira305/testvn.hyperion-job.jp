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
 * プラグイン の基底クラス.
 *
 * @package SortAssistant
 * @author SalonNetWorkService doishun
 */

abstract class Salon_Plugin_Base002 extends SC_Plugin_Base {

    // プラグインコード
    private $plugin_code;

    public function __construct(array $arrSelfInfo, $code="") {
        parent::__construct($arrSelfInfo);

        if(strlen($code) > 0) $this->plugin_code = $code;
    }

    /**
     * installはプラグインのインストール時に実行されます。
     **/
    public function install($arrPlugin) {}


    /**
     * uninstallはアンインストール時に実行されます。
     **/
    public function uninstall($arrPlugin) {}


    /**
     * enableはプラグインを有効にした際に実行されます。
     **/
    public function enable($arrPlugin) {}


    /**
     * disableはプラグインを無効にした際に実行されます。
     **/
    public function disable($arrPlugin) {}



    /**
     * リクエストパラメーター 'mode' を取得する.
     *
     * 1. $_GET['mode'] の値を取得する.
     * 2. 1 が存在しない場合は $_POST['mode'] の値を取得する.
     * 3. どちらも存在しない場合は null を返す.
     *
     * mode に, 半角英数字とアンダーバー(_) 以外の文字列が検出された場合は null を
     * 返す.
     *
     * @see    LC_Page#getMode
     * @access protected
     * @return string $_GET['mode'] 又は $_POST['mode'] の文字列
     */
    public function getMode($parameter='mode') {
        $pattern = '/^[a-zA-Z0-9_]+$/';
        $mode = null;
        if (isset($_GET[$parameter]) && preg_match($pattern, $_GET[$parameter])) {
            $mode =  $_GET[$parameter];
        } elseif (isset($_POST[$parameter]) && preg_match($pattern, $_POST[$parameter])) {
            $mode = $_POST[$parameter];
        }
        return $mode;
    }


    protected function getPluginRealDir(){
        return realpath(PLUGIN_UPLOAD_REALDIR . $this->plugin_code) . '/';
    }


    protected function getPluginHTMLDir(){
        return realpath(PLUGIN_HTML_REALDIR . $this->plugin_code) . '/';
    }


    /**
     * SQL文の実行
     * 
     * @see /html/isntall/index#lfExecuteSQL
     */
    function lfExecuteSQL($filepath, $disp_err = true) {
        // DB接続情報
        $arrDsn = array(
            'phptype'   => DB_TYPE,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'database'  => DB_NAME,
            'port'      => DB_PORT,
        );

        $arrErr = array();

        if (!file_exists($filepath)) {
            $arrErr['all'] = '>> スクリプトファイルが見つかりません';
        } else {
            if ($fp = fopen($filepath, 'r')) {
                $sql = fread($fp, filesize($filepath));
                fclose($fp);
            }
            // Debugモード指定
            $options['debug'] = PEAR_DB_DEBUG;
            $objDB = MDB2::connect($arrDsn, $options);
            // 接続エラー
            if (!PEAR::isError($objDB)) {
                $objDB->setCharset('utf8');

                // MySQL 用の初期化
                // XXX SC_Query を使うようにすれば、この処理は不要となる
                if ($arrDsn['phptype'] === 'mysql') {
                    $objDB->exec('SET SESSION storage_engine = InnoDB');
                    $objDB->exec("SET SESSION sql_mode = 'ANSI'");
                }

                $sql_split = split(';', $sql);
                foreach ($sql_split as $key => $val) {
                    SC_Utils::sfFlush(true);
                    if (trim($val) != '') {
                        $ret = $objDB->query($val);
                        if (PEAR::isError($ret) && $disp_err) {
                            $arrErr['all'] = '>> ' . $ret->message . '<br />';
                            // エラー文を取得する
                            preg_match('/\[(.*)\]/', $ret->userinfo, $arrKey);
                            $arrErr['all'] .= $arrKey[0] . '<br />';
                            $objPage->update_mess .= '>> テーブル構成の変更に失敗しました。<br />';
                            GC_Utils_Ex::gfPrintLog($ret->userinfo);
                            break;
                        } else {
                            GC_Utils_Ex::gfPrintLog('OK:' . $val);
                        }
                    }
                }
            } else {
                $arrErr['all'] = '>> ' . $objDB->message;
                GC_Utils_Ex::gfPrintLog($objDB->userinfo);
            }
        }
        return $arrErr;
    }



    /**
     * SC_FormParam_Ex#getFormParamListの配列を
     * SC_FormParam_Ex#getHashArrayの配列にコンバートする
     *
     * @access protected
     * @param  array  $arrForm SC_FormParam_Ex#getFormParamListの配列
     * @param  string $keyname
     * @param  string $value
     * @return array  $arrParam SC_FormParam_Ex#getHashArray
     */
    public function convertFormParamListToHashArray($arrForm, $keyname="keyname", $value="value"){
        $arrParam = array();
        foreach($arrForm as $_key => $_value){
            $arrParam[$_value[$keyname]] = $_value[$value];
        }
        return $arrParam;
    }



    // 2.12.0対策
    public static function getPluginInfo2($pluginCode, $arrRename=array()){
        if(strlen($pluginCode) == 0){
            return array();
        }

        $arrPluginInfo = SC_Plugin_Util_Ex::getPluginByPluginCode($pluginCode);
        if(count($arrRename) > 0){
            foreach($arrRename as $_before => $_after){
                $arrPluginInfo[$_after] = $arrPluginInfo[$_before];
                unset($arrPluginInfo[$_before]);
            }
        }
        return $arrPluginInfo;
    }


    /** テンプレートの設定 */
    function setTemplate($template){
        // バージョン分岐

        // A.BB.CCメソッド
        $ver = str_replace(".", "-", ECCUBE_VERSION);
        if(file_exists(sprintf($template, $ver))){
            return sprintf($template, $ver);
        }

        // A.BBメソッド
        $ver = str_replace(".", "-", substr(ECCUBE_VERSION, 0, 4));
        if(file_exists(sprintf($template, $ver))){
            return sprintf($template, $ver);
        }

        return sprintf($template, '');
    }

}

?>