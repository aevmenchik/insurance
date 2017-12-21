<?php
/**
 * Adminhtml add shipping insurance block to invoice form
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Adminhtml_Sales_Invoice_Totals extends Mage_Adminhtml_Block_Sales_Order_Invoice_Totals
{
    /**
     * Initialize order totals array
     *
     * @return Mage_Sales_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        Mage::helper('shipping_insurance')->addInsuranceTotal($this);
        return $this;
    }
}
