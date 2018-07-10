<?php

require_once '../require.php';
require_once CLASS_EX_REALDIR . 'page_extends/LC_Page_Ex.php';

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

        $this->disp_number = 5;
        if (!isset($_POST['pageno']))
            $_POST['pageno'] = 1;
        $this->pageno = $_POST['pageno'];

        $objQuery = SC_Query_Ex::getSingletonInstance();
        $objQuery->setOrder('T2.create_date DESC');
        $objQuery->setLimit(20);
        $from = 'dtb_order_detail as T1 LEFT JOIN dtb_order as T2 ON T1.order_id = T2.order_id';
        $arrOrderDetail = $objQuery->select('T1.product_id', $from, 'T2.del_flg = 0 AND customer_id = ?', array($objCustomer->getValue('customer_id')));
        
        $arrAllProductId = array();
        $customOrder = '';
        foreach ($arrOrderDetail as $detail){
            $arrAllProductId[] = $detail['product_id'];
            $customOrder .= ',' . $detail['product_id'];
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

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
