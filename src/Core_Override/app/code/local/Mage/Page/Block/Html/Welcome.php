<?php
/**
 * Maho
 *
 * @category   Mage
 * @package    Mage_Page
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://magento.com)
 * @copyright  Copyright (c) 2020-2024 The OpenMage Contributors (https://openmage.org)
 * @copyright  Copyright (c) 2024 Maho (https://mahocommerce.com)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Html page block
 *
 * @category   Mage
 * @package    Mage_Page
 *
 * @method $this setWelcome(string $value)
 */
class Mage_Page_Block_Html_Welcome extends Mage_Core_Block_Template
{
    /**
     * Get customer session
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    /**
     * Get block message
     *
     * @return string
     */
    #[\Override]
    protected function _toHtml()
    {
        return 'Welcome from Core_Override';
    }

    /**
     * Get tags array for saving cache
     *
     * @return array
     */
    #[\Override]
    public function getCacheTags()
    {
        if ($this->_getSession()->isLoggedIn()) {
            $this->addModelTags($this->_getSession()->getCustomer());
        }

        return parent::getCacheTags();
    }
}
