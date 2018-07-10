<?php
/*
 * AssistDesignAdmin
 * Copyright (C) 2013 S-cubism Inc. All Rights Reserved.
 * http://s-cubism.jp/
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * プラグイン の情報クラス.
 *
 * @package AssistDesignAdmin
 * @author S-cubism Inc.
 * @version $Id: $
 */
class plugin_info{
    /** プラグインコード(必須)：プラグインを識別する為キーで、他のプラグインと重複しない一意な値である必要がありま. */
    static $PLUGIN_CODE       = "AssistDesignAdmin";
    /** プラグイン名(必須)：EC-CUBE上で表示されるプラグイン名. */
    static $PLUGIN_NAME       = "デザイン管理アシストプラグイン";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "1.0";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.12.3, 2.12.4, 2.12.5";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "株式会社エスキュービズム";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "デザイン管理のレイアウト設定から、ブロックの編集画面へ直接遷移できるようになります。これまで、ページに飛び一覧から選択していましたが、直感的に修正したいブロックページへ遷移できます。";
    /** プラグインURL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $PLUGIN_SITE_URL   = "http://ec-cube.ec-orange.jp/";
    /** プラグイン作者URL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $AUTHOR_SITE_URL   = "http://ec-cube.ec-orange.jp/";
    /** クラス名(必須)：プラグインのクラス（拡張子は含まない） */
    static $CLASS_NAME       = "AssistDesignAdmin";
    /** フックポイント：フックポイントとコールバック関数を定義します */
    static $HOOK_POINTS       = array(
        array("prefilterTransform", 'prefilterTransform'));
    /** ライセンス */
    static $LICENSE        = "LGPL";
}
?>