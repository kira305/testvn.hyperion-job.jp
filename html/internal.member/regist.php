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
	if ($this->getMode() != '') {
	    $_SESSION['parent_staff_id'] = '0';
	    if (isset($_POST['parent_staff_id']))
		$_SESSION['parent_staff_id'] = $_POST['parent_staff_id'];
	    switch ($this->getMode()) {
		case 'card_aru':
		    $_SESSION['mynumber_card'] = '1';
		    $_SESSION['is_family_member'] = '0';
		    break;
		case 'card_nai':
		    $_SESSION['mynumber_card'] = '0';
		    $_SESSION['is_family_member'] = '0';
		    break;
		case 'family_card_aru':
		    $_SESSION['mynumber_card'] = '1';
		    $_SESSION['is_family_member'] = '1';
		    break;
		case 'family_card_nai':
		    $_SESSION['mynumber_card'] = '0';
		    $_SESSION['is_family_member'] = '1';
		    break;
		default :
		    break;
	    }
	    SC_Response_Ex::sendRedirect('entry.php');
	    SC_Response_Ex::actionExit();
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
