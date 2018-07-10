<?php

class EasyImagePreviewPlugin extends SC_Plugin_Base {

    /**
     * コンストラクタ
     * @param array $arrSelfInfo dtb_pluginの情報配列
     * @return void
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * インストール時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function install($arrPlugin) {
        copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . '/logo.png',
             PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . '/' . 'logo.png');
    }

    /**
     * 削除時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function uninstall($arrPlugin) {
        SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code']);
    }

    /**
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function enable($arrPlugin) {
        // nop
    }

    /**
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function disable($arrPlugin) {
        // nop
    }

    function products_product_action_after($objPage) {
        if ($objPage->getMode() == 'edit' && (
            $_FILES['main_list_image'] || 
            $_FILES['main_image'] || 
            $_FILES['main_large_image'])) {
            $objUpFile = new SC_UploadFile_Ex(IMAGE_TEMP_REALDIR, IMAGE_SAVE_REALDIR);
            $objPage->lfInitFile($objUpFile);
            $objUpFile->setHiddenFileList($_POST);

            $objDownFile = new SC_UploadFile_Ex(DOWN_TEMP_REALDIR, DOWN_SAVE_REALDIR);
            $objPage->lfInitDownFile($objDownFile);
            $objDownFile->setHiddenFileList($_POST);

            $objFormParam = new SC_FormParam_Ex();
            $objPage->lfInitFormParam($objFormParam, $_POST);
            $arrForm = $objFormParam->getHashArray();

            $this->lfUploadImage('main_list_image', $objPage, $objUpFile);
            $this->lfUploadImage('main_image', $objPage, $objUpFile);
            $this->lfUploadImage('main_large_image', $objPage, $objUpFile);

            if (count($objPage->arrErr) > 0) {
                $objPage->tpl_mainpage = 'products/product.tpl';
                $objPage->tpl_onload = $objPage->lfSetOnloadJavaScript_InputPage();
                $objPage->arrForm = $objPage->lfSetViewParam_InputPage($objUpFile, $objDownFile, $arrForm);
                $objPage->arrForm = array_merge((array)$objPage->arrForm, $objUpFile->getHiddenFileList());
            } else {
                $objPage->arrForm = $objPage->lfSetViewParam_ConfirmPage($objUpFile, $objDownFile, $arrForm);
                $objPage->arrForm = array_merge((array)$objPage->arrForm, $objUpFile->getHiddenFileList());
            }
        }
    }

    function lfUploadImage($imageKey, $objPage, $objUpFile) {
        if ($this->lfIsUploadEnable($imageKey, $objPage)) {
            $error = $objUpFile->makeTempFile($imageKey, IMAGE_RENAME);
            if ($error) $objPage->arrErr[$imageKey] = $error;

            $objPage->lfSetScaleImage($objUpFile, $imageKey);
        }
    }

    function lfIsUploadEnable($imageKey, $objPage) {
        return !$objPage->arrErr[$imageKey] &&  $_FILES[$imageKey]['name'] &&
               !$objPage->arrForm['save_' . $imageKey] && !$objPage->arrForm['temp_' . $imageKey];
    }


    /**
     * prefilterコールバック関数
     * テンプレートの変更処理を行います.
     *
     * @param string &$source テンプレートのHTMLソース
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @param string $filename テンプレートのファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        // SC_Helper_Transformのインスタンスを生成.
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo['plugin_code'] . '/templates/';
        // 呼び出し元テンプレートを判定します.
        switch($objPage->arrPageLayout['device_type_id']){
            case DEVICE_TYPE_MOBILE: // モバイル
            case DEVICE_TYPE_SMARTPHONE: // スマホ
                break;
            case DEVICE_TYPE_PC: // PC
                break;
            case DEVICE_TYPE_ADMIN: // 管理画面
                break;
            default:
                if (strpos($filename, 'products/product.tpl') !== false) {
                    $objTransform->select('#products table tr', 23, false)->find('td')->appendChild(
                        file_get_contents($template_dir . 'products_product.tpl'));
                    $objTransform->select('#products table tr', 24, false)->find('td')->appendChild(
                        file_get_contents($template_dir . 'products_product.tpl'));
                    $objTransform->select('#products table tr', 25, false)->find('td')->appendChild(
                        file_get_contents($template_dir . 'products_product.tpl'));
                    $objTransform->select('#form1')->insertBefore(
                        file_get_contents($template_dir . 'product_script_style.tpl'));
               }
                break;
        }

        $source = $objTransform->getHTML();
    }

}

?>
