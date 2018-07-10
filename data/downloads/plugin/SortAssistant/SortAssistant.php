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

// プラグイン基底クラスを読み込む
include_once(dirname(__FILE__). "/Salon_Plugin_Base002.php");

// プラグインヘルパークラスを読み込む
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Basis.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Product.php');
include_once(PLUGIN_UPLOAD_REALDIR. '/SortAssistant/helper/PLG_Helper_Contents.php');


class SortAssistant extends Salon_Plugin_Base002 {

    /**
     * 
     **/
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo, "SortAssistant");
    }


    /**
     * installはプラグインのインストール時に実行されます。[必須]
     **/
    public function install($arrPlugin) {
        // プラグインロゴ、jsとcssとコピー
        // /html/plugin/ProductListFlilckChangerSP/
        SC_Utils_Ex::sfCopyDir(PLUGIN_UPLOAD_REALDIR. "SortAssistant/media/"
                             , PLUGIN_HTML_REALDIR  . "SortAssistant/");


        //-----------------------
        // 基本情報管理
        //-----------------------
        $objPlgBasis = new PLG_Helper_Basis();
        $objPlgBasis->install($arrPlugin);

        //-----------------------
        // 商品管理
        //-----------------------
        $objPlgProduct = new PLG_Helper_Product();
        $objPlgProduct->install($arrPlugin);

        //-----------------------
        // コンテンツ管理
        //-----------------------
        $objPlgContents = new PLG_Helper_Contents();
        $objPlgContents->install($arrPlugin);
    }


    /**
     * uninstallはアンインストール時に実行されます。[必須]
     **/
    public function uninstall($arrPlugin) {
        // プラグインディレクトリ削除.
        SC_Helper_FileManager_Ex::deleteFile(PLUGIN_HTML_REALDIR  . "SortAssistant/");

        //-----------------------
        // 基本情報管理
        //-----------------------
        $objPlgBasis = new PLG_Helper_Basis();
        $objPlgBasis->uninstall($arrPlugin);

        //-----------------------
        // 商品管理
        //-----------------------
        $objPlgProduct = new PLG_Helper_Product();
        $objPlgProduct->uninstall($arrPlugin);

        //-----------------------
        // コンテンツ管理
        //-----------------------
        $objPlgContents = new PLG_Helper_Contents();
        $objPlgContents->uninstall($arrPlugin);
    }


    /**
     * updateはアップデート時に実行されます。[必須]
     */
    public function update($arrPlugin) {}


    /**
     * enableはプラグインを有効にした際に実行されます。
     **/
    public function enable($arrPlugin) {}


    /**
     * disableはプラグインを無効にした際に実行されます。
     **/
    public function disable($arrPlugin) {}


    /**
     * registはプラグインインスタンス生成時に実行されます。フックポイントの登録はここで行います。
     **/
    public function register(SC_Helper_Plugin $objHelperPlugin) {

        //---------------------
        // 基本情報管理
        //---------------------
        $objPlgBasis = new PLG_Helper_Basis();
        // 配送方法設定
        $objHelperPlugin->addAction('LC_Page_Admin_Basis_Delivery_action_after'
                                  , array(&$objPlgBasis, 'BasisDeliveryRank'));
        // 支払方法設定
        $objHelperPlugin->addAction('LC_Page_Admin_Basis_Payment_action_after'
                                  , array(&$objPlgBasis, 'BasisPaymentRank'));
        // 会員規約設定
        $objHelperPlugin->addAction('LC_Page_Admin_Basis_Kiyaku_action_after'
                                  , array(&$objPlgBasis, 'BasisKiyakuRank'));
        // 定休日設定
        $objHelperPlugin->addAction('LC_Page_Admin_Basis_Holiday_action_after'
                                  , array(&$objPlgBasis, 'BasisHolidayRank'));


        //---------------------
        // 商品管理
        //---------------------
        $objPlgProduct = new PLG_Helper_Product();
        // 規格管理
        $objHelperPlugin->addAction('LC_Page_Admin_Products_Class_action_after'
                                  , array(&$objPlgProduct, 'ProductClassRank'));
        // 規格分類
        $objHelperPlugin->addAction('LC_Page_Admin_Products_ClassCategory_action_after'
                                  , array(&$objPlgProduct, 'ProductClassCategoryRank'));
        // カテゴリ管理
        $objHelperPlugin->addAction('LC_Page_Admin_Products_Category_action_after'
                                  , array(&$objPlgProduct, 'ProductCategoryRank'));
        // メーカー管理
        $objHelperPlugin->addAction('LC_Page_Admin_Products_Maker_action_after'
                                  , array(&$objPlgProduct, 'ProductMakerRank'));
        // 商品並び替え
        $objHelperPlugin->addAction('LC_Page_Admin_Products_ProductRank_action_after'
                                  , array(&$objPlgProduct, 'ProductRank'));

        //-----------------------
        // コンテンツ管理
        //-----------------------
        $objPlgContents = new PLG_Helper_Contents();
        // 新着情報管理
        $objHelperPlugin->addAction('LC_Page_Admin_Contents_action_after'
                                  , array(&$objPlgContents, 'ContentsIndexRank'));

        // おすすめ商品管理
        $objHelperPlugin->addAction('LC_Page_Admin_Contents_Recommend_action_after'
                                  , array(&$objPlgContents, 'ContentsRecommendRank'));


        // テンプレートフック
        $objHelperPlugin->addAction('prefilterTransform', array(&$this, 'prefilterTransform'),1);

        // ヘッダへの追加
        $template_dir = Salon_Plugin_Base002::getPluginRealDir(). '/templates/';
        $objHelperPlugin->setHeadNavi($template_dir . 'plg_SortAssistant_header.tpl');
    }


    /**
     * テンプレートコンパイル時に呼び出される関数
    **/
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        $objTransform = new SC_Helper_Transform($source);
        $template_dir = Salon_Plugin_Base002::getPluginRealDir(). '/templates/';
        $script = $_SERVER['SCRIPT_NAME'];

        switch($objPage->arrPageLayout['device_type_id']){
            case DEVICE_TYPE_MOBILE:
            case DEVICE_TYPE_SMARTPHONE:
            case DEVICE_TYPE_PC:
                break;

            default:
            case DEVICE_TYPE_ADMIN:
                //-----------------------
                // 基本情報管理
                //-----------------------
                // 配送設定
                if(strpos($filename, 'basis/delivery.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'basis/delivery/plg_SortAssistant_basis_delivery%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'basis/plg_SortAssistant_basis_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn')
                                 ->insertAfter(file_get_contents($layout))
                                 ->insertAfter(file_get_contents($btn))
                                 ->insertAfter('<h2 id="plg_rankview_header">配送方法一覧</h2>');
                }
                // 支払方法設定
                if(strpos($filename, 'basis/payment.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'basis/payment/plg_SortAssistant_basis_payment%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'basis/plg_SortAssistant_basis_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn')
                                 ->insertAfter(file_get_contents($layout))
                                 ->insertAfter(file_get_contents($btn))
                                 ->insertAfter('<h2 id="plg_rankview_header">支払方法一覧</h2>');
                }
                // 会員規約設定
                if(strpos($filename, 'basis/kiyaku.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'basis/kiyaku/plg_SortAssistant_basis_kiyaku%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'basis/plg_SortAssistant_basis_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn-area')
                                 ->insertAfter(file_get_contents($layout))
                                 ->insertAfter(file_get_contents($btn))
                                 ->insertAfter('<h2 id="plg_rankview_header">会員規約</h2>');
                }
                // 定休日管理
                if(strpos($filename, 'basis/holiday.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'basis/holiday/plg_SortAssistant_basis_holiday%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'basis/plg_SortAssistant_basis_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn-area')
                                 ->insertAfter(file_get_contents($layout))
                                 ->insertAfter(file_get_contents($btn))
                                 ->insertAfter('<h2 id="plg_rankview_header">定休日一覧</h2>');
                }


                //-----------------------
                // 商品管理
                //-----------------------
                // 規格
                if(strpos($filename, 'products/class.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'products/class/plg_SortAssistant_products_class%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'products/plg_SortAssistant_products_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn-area')->insertAfter(file_get_contents($layout));
                    $objTransform->select('div.btn-area')->replaceElement(file_get_contents($btn));
                }
                // 規格分類
                if(strpos($filename, 'products/classcategory.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'products/classcategory/plg_SortAssistant_products_classcategory%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'products/plg_SortAssistant_products_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn-area')->insertAfter(file_get_contents($layout));
                    $objTransform->select('div.btn-area')->replaceElement(file_get_contents($btn));
                }
                // カテゴリ
                if(strpos($filename, 'products/category.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'products/category/plg_SortAssistant_products_category%s.tpl');

                    $objTransform->select('table.list')->replaceElement(file_get_contents($layout));
                }
                // メーカー
                if(strpos($filename, 'products/maker.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'products/maker/plg_SortAssistant_products_maker%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'products/plg_SortAssistant_products_btn%s.tpl');

                    $objTransform->select('table.list')->removeElement();
                    $objTransform->select('div.btn-area')->insertAfter(file_get_contents($layout));
                    $objTransform->select('div.btn-area')->replaceElement(file_get_contents($btn));
                }
                // 商品並び替え
                if(strpos($filename, 'products/product_rank.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'products/rank/plg_SortAssistant_products_rank%s.tpl');

                    $objTransform->select('table#categoryTable')->removeElement();
                    $objTransform->select('div.pager')->insertAfter(file_get_contents($layout));
                }


                //-----------------------
                // コンテンツ管理
                //-----------------------
                // 新着情報設定
                if(strpos($filename, 'contents/index.tpl') !== false) {
                    $layout = $this->setTemplate($template_dir.'contents/index/plg_SortAssistant_contents_index%s.tpl');
                    $btn    = $this->setTemplate($template_dir.'contents/index/plg_SortAssistant_contents_btn%s.tpl');

                    $objTransform->select('table.list')->replaceElement(
                                                              file_get_contents($btn)
                                                             .file_get_contents($layout)
                                                         );
                }
//                // おすすめ商品はテンプレートに難あり(特に2.12系)
//                // マイナーバージョンでも差異があるため見送り
//                // おすすめ商品管理
//                // ボタン追加は元テンプレートに適当なセレクタがない
//                // 共通テンプレート内で処理をする
//                if(strpos($filename, 'main_frame') !== false) {
//                    $objTransform->select('#contents')->appendFirst(file_get_contents($template_dir . 'contents/recommend/plg_SortAssistant_recommend_btn.tpl'));
//                }
//                if(strpos($filename, 'contents/recommend.tpl') !== false) {}

                break;
        }
        $source = $objTransform->getHTML();
    }
}
?>
