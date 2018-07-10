<?php
/**
 * プラグインの登録情報
 */
class plugin_info{
    /** プラグインコード(必須)：プラグインを識別する為キーで、他のプラグインと重複しない一意な値である必要がありま. */
    static $PLUGIN_CODE       = "EasyImagePreviewPlugin";
    /** プラグイン名(必須)：EC-CUBE上で表示されるプラグイン名. */
    static $PLUGIN_NAME       = "かんたん商品画像登録プラグイン";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "1.0";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.12.5";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "エスキュービズム";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "商品画像の登録をドラッグ＆ドロップで行い、その場でプレビューすることが出来るようになります。また、アップロードボタンを押さずとも、登録時に画像を一括アップロードすることができます。";
    /** プラグインURL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $PLUGIN_SITE_URL   = "";
    /** プラグイン作者URL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $AUTHOR_SITE_URL   = "http://ec-cube.ec-orange.jp/";
    /** クラス名(必須)：プラグインのクラス（拡張子は含まない） */
    static $CLASS_NAME        = "EasyImagePreviewPlugin";
    /** フックポイント：フックポイントとコールバック関数を定義します */
    static $HOOK_POINTS       = array(
       array("LC_Page_Admin_Products_Product_action_after", 'products_product_action_after'),
       array("prefilterTransform", 'prefilterTransform'));
    /** ライセンス */
    static $LICENSE        = "LGPL";
}
?>
