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
        $this->arrSTATUS = $masterData->getMasterData('mtb_status');
        $this->arrSTATUS_IMAGE = $masterData->getMasterData('mtb_status_image');
        $this->arrDELIVERYDATE = $masterData->getMasterData('mtb_delivery_date');
        $this->arrPRODUCTLISTMAX = $masterData->getMasterData('mtb_product_list_max');
        $this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
        $this->arrEMPSTATUS_IMAGE = $masterData->getMasterData('mtb_employment_status_image');
        $this->arrAPPEALPOINT = $masterData->getMasterData('mtb_appeal_point');
        $this->arrAPPEALPOINT_IMAGE = $masterData->getMasterData('mtb_appeal_point_image');
        $this->arrWorkLocationFlg = $masterData->getMasterData('mtb_work_location_flg');
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
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        $searchCondition = array();
        $searchCondition['where'] = 'del_flg = 0 AND status = 1 AND product_id IN (SELECT product_id FROM dtb_product_status WHERE product_status_id = ?)';
        $searchCondition['arrval'][] = 3;

        $objQuery->setWhere($searchCondition['where']);
        $arrProductId = $objProduct->findProductIdsOrder($objQuery, $searchCondition['arrval']);

        $arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);
        $objProduct->setProductsClassByProductIds($arrProductId);
        $this->productStatus = $objProduct->getProductStatus($arrProductId);
        $this->arrProducts = $arrProducts;

        foreach ($this->arrProducts as $product_id => $arrProduct) {
            if (strlen($this->arrProducts[$product_id]['employment_status']) > 0)
                $this->arrProducts[$product_id]['employment_status'] = str_split($this->arrProducts[$product_id]['employment_status']);
            if (strlen($this->arrProducts[$product_id]['appeal_point']) > 0)
                $this->arrProducts[$product_id]['appeal_point'] = str_split($this->arrProducts[$product_id]['appeal_point']);
        }
        
        $this->tpl_class_name1 = $objProduct->className1;
        $this->tpl_class_name2 = $objProduct->className2;
        $this->arrClassCat1 = $objProduct->classCats1;
        $this->tpl_classcat_find1 = $objProduct->classCat1_find;
        $this->tpl_classcat_find2 = $objProduct->classCat2_find;
        $this->tpl_stock_find = $objProduct->stock_find;
        $this->tpl_product_class_id = $objProduct->product_class_id;
        $this->tpl_product_type = $objProduct->product_type;
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
