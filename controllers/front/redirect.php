<?php
/*
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2015 PrestaShop SA
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

/**
*  @category  Module / payments_gateways
*  @version   3.0.13
*  @author    E-Transactions <support@e-transactions.fr>
*  @copyright 2012-2016 E-Transactions
*  @license   http://opensource.org/licenses/OSL-3.0
*  @link      http://www.e-transactions.fr/
 */
class ETransactionsRedirectModuleFrontController extends ModuleFrontController
{
    /**
     * Initialising content with empty template to prevent Smarty compilation error
     * https://github.com/E-Transactions-CA/CMS-ETR-Prestashop-1.5.x-1.6.x-1.7.x/issues/12
     *
     * @throws PrestaShopException
     */
    public function initContent() {
        // Setting empty template
        if(_PS_VERSION_ >= '1.7')$this->setTemplate('module:etransactions/views/templates/front/validation.tpl');
        else $this->setTemplate('validation.tpl');
    }

	/**
     * @see FrontController::postProcess()
     */
    public function postProcess()
    {
		$action = isset($_GET['a']) ? $_GET['a'] : null;
		$c = new ETransactionsController();
		try {
			switch ($action) {
				// Cancel
				case 'c':
					$c->cancelAction();
					break;

				// Failure
				case 'f':
					$c->failureAction();
					break;

				// Redirect
				case 'r':
					$c->redirectAction();
					break;

				// Success
				case 's':
					$c->successAction();
					break;


				default:
					$c->defaultAction();
			}
		} catch (Exception $e) {
			header('Status: 500 Error', true, 500);
			echo $e->getMessage();
		}
	}
}
?>
