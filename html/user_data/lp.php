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
        $this->arrWorkLocationFlg = $masterData->getMasterData('mtb_work_location_flg');
        $this->arrNEWSFLG = array(1 => 'オススメ', 2 => '非表示');
        $this->arrRECNEWSFLG = array(1 => '派遣', 2 => 'スポット派遣', 3 => '紹介');
        $this->arrEMPSTATUS = $masterData->getMasterData('mtb_employment_status');
        $this->arrAPPEALPOINT = $masterData->getMasterData('mtb_appeal_point');
        $this->arrEMPSTATUS_IMAGE = $masterData->getMasterData('mtb_employment_status_image');
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
        $objQuery = & SC_Query_Ex::getSingletonInstance();

        $searchCondition = array();
        $searchCondition['where'] = 'del_flg = 0 AND status = ? AND product_id IN (2, 15, 22, 44, 88, 94)';
        $searchCondition['arrval'][] = 1;

        $objQuery->setWhere($searchCondition['where']);
        $arrProductId = $objProduct->findProductIdsOrder($objQuery, $searchCondition['arrval']);

        $this->arrProducts = $objProduct->getListByProductIds($objQuery, $arrProductId);

        foreach ($this->arrProducts as $product_id => $arrProduct) {
            if (strlen($this->arrProducts[$product_id]['employment_status']) > 0)
                $this->arrProducts[$product_id]['employment_status'] = str_split($this->arrProducts[$product_id]['employment_status']);
            if (strlen($this->arrProducts[$product_id]['appeal_point']) > 0)
                $this->arrProducts[$product_id]['appeal_point'] = str_split($this->arrProducts[$product_id]['appeal_point']);

            $objQuery1 = & SC_Query_Ex::getSingletonInstance();
            $news_url = '/products/detail.php?product_id=' . $product_id;
            $news = $objQuery1->select('*', 'dtb_news', 'news_url = ?', array($news_url));
            $this->arrProducts[$product_id]['rec_news_flg'] = $news[0]['rec_news_flg'];
            if ($news[0]['del_flg'] == 1)
                $this->arrProducts[$product_id]['news_flg'] = 2;
            else
                $this->arrProducts[$product_id]['news_flg'] = 1;
        }

        $objFormParam = new SC_FormParam_Ex();
        $this->lfInitParam($objFormParam);
        $objFormParam->setParam($_POST);
        $objFormParam->convParam();
        $objFormParam->toLower('email');
        $objFormParam->toLower('email_repeat');

        $this->mode = 'confirm';
        $this->values = $_POST;
        $this->msg = '';
        if ($_POST['mode'] == 'confirm') {
            $this->arrErr = $this->lfCheckError($objFormParam);
            if (SC_Utils_Ex::isBlank($this->arrErr))
                $this->mode = 'complete';
        } elseif ($_POST['mode'] == 'complete') {
            $this->values = array();
            $this->msg = 'Registered successfully<br>';

            //regist customer
            $arrVal = array();
            $customer_id = $objQuery->nextVal('dtb_customer_customer_id');
            $arrVal['customer_id'] = $customer_id;
            $arrVal['name01'] = $_POST['name01'];
            $arrVal['name02'] = $_POST['name02'];
            $arrVal['email'] = $_POST['email'];
            $arrVal['kana01'] = $_POST['kana01'];
            $arrVal['kana02'] = $_POST['kana02'];
            $arrVal['tel01'] = $_POST['tel01'];
            $arrVal['tel02'] = $_POST['tel02'];
            $arrVal['tel03'] = $_POST['tel03'];
            $arrVal['create_date'] = 'CURRENT_TIMESTAMP';
            $arrVal['salt'] = SC_Utils_Ex::sfGetRandomString(10);
            $arrVal['password'] = $arrVal['name01'];
            $arrVal['password'] = SC_Utils_Ex::sfGetHashString($arrVal['password'], $arrVal['salt']);
            $arrVal['status'] = 2;
            $arrVal['mailmaga_flg'] = 1;
//            $objQuery->insert('dtb_customer', $arrVal);
//
//            $objCustomer = new SC_Customer_Ex();
//            $objCustomer->setLogin($arrVal['email']);
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

    function lfInitParam(&$objFormParam) {
        $objFormParam->addParam('メールアドレス', 'email', null, 'KVa', array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('メールアドレス(確認)', 'email_repeat', null, 'KVa', array('EXIST_CHECK', 'EMAIL_CHECK', 'EMAIL_CHAR_CHECK'));
        $objFormParam->addParam('お名前1', 'name01', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前2', 'name02', STEXT_LEN, 'KVa', array('EXIST_CHECK', 'SPTAB_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お名前（フリガナ）1', 'kana01', STEXT_LEN, 'KVCa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お名前（フリガナ）2', 'kana02', STEXT_LEN, 'KVCa', array('SPTAB_CHECK', 'MAX_LENGTH_CHECK', 'KANA_CHECK'));
        $objFormParam->addParam('お電話番号1', 'tel01', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お電話番号2', 'tel02', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
        $objFormParam->addParam('お電話番号3', 'tel03', TEL_ITEM_LEN, 'n', array('NUM_CHECK', 'MAX_LENGTH_CHECK'));
    }

    function lfCheckError(&$objFormParam) {
        // 入力データを渡す。
        $arrForm = $objFormParam->getHashArray();
        $objErr = new SC_CheckError_Ex($arrForm);
        $objErr->arrErr = $objFormParam->checkError();
        $objErr->doFunc(array('メールアドレス', 'メールアドレス(確認)', 'email', 'email_repeat'), array('EQUAL_CHECK'));
        return $objErr->arrErr;
    }

}

$objPage = new LC_Page_User();
register_shutdown_function(array($objPage, 'destroy'));
$objPage->init();
$objPage->process();
