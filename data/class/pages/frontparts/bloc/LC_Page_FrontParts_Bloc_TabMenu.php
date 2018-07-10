<?php

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

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * 新着情報 のページクラス.
 *
 * @package Page
 * @author LOCKON CO.,LTD.
 * @version $Id: LC_Page_FrontParts_Bloc_News.php 21935 2012-06-21 06:02:41Z pineray $
 */
class LC_Page_FrontParts_Bloc_TabMenu extends LC_Page_FrontParts_Bloc_Ex {
    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $this->arrKeepList = $this->lfGetKeepList($objQuery);
        $this->arrNews = $this->lfGetNews($objQuery);
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    public function lfGetKeepList(&$objQuery) {
        $arrKeepList = array();
        if (isset($_SESSION['keep_product_list']) && count($_SESSION['keep_product_list']) > 0) {
            $firstKept = array();
            $customOrder = '';
            foreach ($_SESSION['keep_product_list'] as $key => $pId) {
                if ($key == 3)
                    break;
                $firstKept[] = $pId;
                $customOrder .= ',' . $pId;
            }

            $objProduct = new SC_Product_Ex();
            $objQuery->setOrder('FIELD(alldtl.product_id' . $customOrder . ')');
            $arrKeepList = $objProduct->getListByProductIds($objQuery, $firstKept);
        }
        return $arrKeepList;
    }

    /**
     * 新着情報を取得する.
     *
     * @return array $arrNewsList 新着情報の配列を返す
     */
    function lfGetNews(&$objQuery) {
        $objQuery->setOrder('rank DESC');
        $objQuery->setLimit('6');
        $arrNewsList = $objQuery->select('*', 'dtb_news', 'del_flg = 0');

        // モバイルサイトのセッション保持 (#797)
        if (SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE) {
            foreach ($arrNewsList as $key => $value) {
                $arrRow = & $arrNewsList[$key];
                if (SC_Utils_Ex::isAppInnerUrl($arrRow['news_url'])) {
                    $netUrl = new Net_URL($arrRow['news_url']);
                    $netUrl->addQueryString(session_name(), session_id());
                    $arrRow['news_url'] = $netUrl->getURL();
                }
            }
            return $arrNewsList;
        }

        return $arrNewsList;
    }

}
