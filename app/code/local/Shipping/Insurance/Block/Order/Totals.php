<?php
/**
 * Create shipping insurance block in totals section
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Order_Totals extends Mage_Sales_Block_Order_Totals
{
    /**
     * Initialize order totals array with shipping insurance
     *
     * @return Shipping_Insurance_Block_Order_Totals
     */
    protected function _initTotals()
    {
        parent::_initTotals();

        Mage::helper('shipping_insurance')->addInsuranceTotal($this);
        return $this;
    }
}
