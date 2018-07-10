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
        $objCartSess = new SC_CartSession_Ex();
        $this->cartKeys = $objCartSess->getKeys();
        $this->cartItems = $objCartSess->getAllCartList();
        
        $this->isLogged = true;
        $this->arrForm = $_SESSION['customer'];
        list($this->arrForm['birth_date'], $this->arrForm['birth_time']) = explode(' ', $this->arrForm['birth']);
        list($this->arrForm['year'], $this->arrForm['month'], $this->arrForm['day']) = explode('-', $this->arrForm['birth_date']);
        
        $this->mode = $this->getMode();
        switch ($this->mode) {
            case 'complete':
                $objCustomer = new SC_Customer_Ex();
                $objSiteSess = new SC_SiteSession_Ex();
                $objPurchase = new SC_Helper_Purchase_Ex();
                $objQuery = & SC_Query_Ex::getSingletonInstance();
                $objHelperMail = new SC_Helper_Mail_Ex();
                $objHelperMail->setPage($this);
                
                $this->tpl_uniqid = $objSiteSess->getUniqId();
                $objPurchase->verifyChangeCart($this->tpl_uniqid, $objCartSess);
                $this->cartKey = $objCartSess->getKey();
                $arrForm = $objCartSess->calculate($this->cartKey, $objCustomer);
                $arrForm['update_date'] = 'CURRENT_TIMESTAMP';
                $arrForm['order_id'] = $objQuery->nextval('dtb_order_order_id');
                $_SESSION['order_id'] = $arrForm['order_id'];
                $arrForm['order_temp_id'] = $this->tpl_uniqid;
                $objPurchase->saveOrderTemp($this->tpl_uniqid, $arrForm, $objCustomer);
                $objSiteSess->setRegistFlag();
                $objPurchase->completeOrder(ORDER_NEW);
                $template_id = SC_Display_Ex::detectDevice() == DEVICE_TYPE_MOBILE ? 2 : 1;
                $objHelperMail->sfSendOrderMail($arrForm['order_id'], $template_id);

                $this->tpl_mainpage = 'user_data/entry_form_done.tpl';
                $this->registeredFully = true;
                break;
            default:
                break;
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
