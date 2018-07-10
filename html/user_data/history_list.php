<?php

require_once '../require.php';
require_once CLASS_EX_REALDIR . 'page_extends/LC_Page_Ex.php';
require_once PLUGIN_UPLOAD_REALDIR . 'CheckedItems/CheckedItems.php';

/**
 * ユーザーカスタマイズ用のページクラス
 *
 * 管理画面から自動生成される
 *
 * @package Page
 */
class LC_Page_User extends LC_Page_Ex {

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $masterData = new SC_DB_MasterData_Ex();
        $this->arrWORKLOCATIONFLG = $masterData->getMasterData('mtb_work_location_flg');
        $this->arrSTATUS = $masterData->getMasterData('mtb_status');
        $this->arrSTATUS_IMAGE = $masterData->getMasterData('mtb_status_image');
        $this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
        $this->arrEMPSTATUS_IMAGE = $masterData->getMasterData('mtb_employment_status_image');
        $this->arrAPPEALPOINT = $masterData->getMasterData('mtb_appeal_point');
        $this->arrAPPEALPOINT_IMAGE = $masterData->getMasterData('mtb_appeal_point_image');
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        parent::process();
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        $objProduct = new SC_Product_Ex();
        $objCustomer = new SC_Customer_Ex();

        $product_id = $_POST['product_id'];
        $this->disp_number = 5;
        if (!isset($_POST['pageno']))
            $_POST['pageno'] = 1;
        $this->pageno = $_POST['pageno'];
        $this->mode = $this->getMode();

        switch ($this->mode) {
            case 'cart_to_shopping':
                $objCartSess = new SC_CartSession_Ex();
                $objSiteSess = new SC_SiteSession_Ex();
                $objProduct->setProductsClassByProductIds(array($product_id));
                $product_class_id = $objProduct->classCategories[$product_id]['__unselected']['__unselected']['product_class_id'];
                $objCartSess->addProduct($product_class_id, 1);

                $cartKeys = $objCartSess->getKeys();
                $this->lfSetCurrentCart($objSiteSess, $objCartSess, $cartKeys[0]);

                if ($objCustomer->isLoginSuccess(true))
                    SC_Response_Ex::sendRedirect('/user_data/entry_form_confirm.php');
                else
                    SC_Response_Ex::sendRedirect('/user_data/entry_form.php');
                SC_Response_Ex::actionExit();
                break;
            case 'cart':
                if (!in_array($product_id, $_SESSION['keep_product_list'])) {
                    if (!isset($_SESSION['keep_product_list']))
                        $_SESSION['keep_product_list'] = array();
                    array_unshift($_SESSION['keep_product_list'], $product_id);
                }
                break;
            default:
                break;
        }

        $cnt = 0;
        $plugin = CheckedItems::getPlgInfo();
        $save_count = $plugin['item_count'];
        $arrItem = CheckedItems::getCookieArray();
        $arrItem = array_reverse($arrItem, true);
        $arrAllProductId = array();
        $customOrder = '';
        foreach ($arrItem as $name => $value) {
            $arrAllProductId[] = $value;
            $customOrder .= ',' . $value;
            if ($save_count <= $cnt)
                break;
        }

        $this->arrProduct = array();
        if (count($arrAllProductId) > 0) {
            $this->tpl_linemax = count($arrAllProductId);
            $this->objNavi = new SC_PageNavi_Ex($this->pageno, $this->tpl_linemax, $this->disp_number, 'fnNaviPage', NAVI_PMAX, "pageno=#page#", SC_Display_Ex::detectDevice() !== DEVICE_TYPE_MOBILE);
            $strnavi = $this->objNavi->strnavi;
            $this->tpl_strnavi = empty($strnavi) ? '&nbsp;' : $strnavi;
            $this->before = ($this->objNavi->now_page > 1) ? $this->objNavi->arrPagenavi['before'] : "";
            $this->next = ($this->objNavi->now_page < $this->objNavi->max_page) ? $this->objNavi->arrPagenavi['next'] : "";

            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $objQuery->setLimitOffset($this->disp_number, $this->objNavi->start_row);
            $objQuery->setWhere('product_id IN (' . SC_Utils_Ex::sfGetCommaList($arrAllProductId) . ')');
            $objQuery->setOrder('FIELD(product_id' . $customOrder . ')');
            $arrProductId = $objProduct->findProductIdsOrder($objQuery);

            $objQuery = & SC_Query_Ex::getSingletonInstance();
            $objQuery->setOrder('FIELD(alldtl.product_id' . $customOrder . ')');
            $this->arrProduct = $objProduct->getListByProductIds($objQuery, $arrProductId);
            $objProduct->setProductsClassByProductIds($arrProductId);
            $this->productStatus = $objProduct->getProductStatus($arrProductId);
            foreach ($this->arrProduct as $product_id => $arrProduct) {
                if (strlen($this->arrProduct[$product_id]['employment_status']) > 0)
                    $this->arrProduct[$product_id]['employment_status'] = str_split($this->arrProduct[$product_id]['employment_status']);
                if (strlen($this->arrProduct[$product_id]['appeal_point']) > 0)
                    $this->arrProduct[$product_id]['appeal_point'] = str_split($this->arrProduct[$product_id]['appeal_point']);
            }

            if ($objCustomer->isLoginSuccess(true)) {
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $customer_id = $objCustomer->getValue('customer_id');
                $from = 'dtb_order_detail as T1 LEFT JOIN dtb_order as T2 ON T1.order_id = T2.order_id';
                $arrOrderDetail = $objQuery->select('T1.product_id', $from, 'customer_id = ?', array($customer_id));
                $this->arrOrderedProductId = array();
                foreach ($arrOrderDetail as $detail)
                    $this->arrOrderedProductId[] = $detail['product_id'];
            }
        }
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }

    function lfSetCurrentCart(&$objSiteSess, &$objCartSess, $cartKey) {
        // 正常に登録されたことを記録しておく
        $objSiteSess->setRegistFlag();
        $pre_uniqid = $objSiteSess->getUniqId();
        // 注文一時IDの発行
        $objSiteSess->setUniqId();
        $uniqid = $objSiteSess->getUniqId();
        // エラーリトライなどで既にuniqidが存在する場合は、設定を引き継ぐ
        if ($pre_uniqid != '') {
            $this->lfUpdateOrderTempid($pre_uniqid, $uniqid);
        }
        // カートを購入モードに設定
        $objCartSess->registerKey($cartKey);
        $objCartSess->saveCurrentCart($uniqid, $cartKey);
    }

    function lfUpdateOrderTempid($pre_uniqid, $uniqid) {
        $sqlval['order_temp_id'] = $uniqid;
        $where = 'order_temp_id = ?';
        $objQuery = SC_Query_Ex::getSingletonInstance();
        $res = $objQuery->update('dtb_order_temp', $sqlval, $where, array($pre_uniqid));
        if ($res != 1) {
            return false;
        }
        return true;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
