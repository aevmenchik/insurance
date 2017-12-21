<?php
/**
 * Shipping insurance module base helper
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Helper_Data extends Mage_Core_Helper_Data
{
    /**
     * Add insurance rate to block total data
     *
     * @param Mage_Adminhtml_Block_Sales_Totals $block_total
     *
     * @return Mage_Sales_Helper_Data
     */
    public function addInsuranceTotal($block_total)
    {
        if ($block_total->getTotal(Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING)
            && $block_total->getSource()->getShippingInsurance() == Shipping_Insurance_Model_Insurance::ACTIVE) {
            $total = new Varien_Object(array(
                'code'  => 'shipping_insurance',
                'field' => 'shipping_insurance_amount',
                'value' => $block_total->getSource()->getShippingInsuranceAmount(),
                'label' => $block_total->__('Shipping Insurance')
            ));
            $block_total->addTotal($total, Mage_Customer_Model_Address_Abstract::TYPE_SHIPPING);
        }
        return $this;
    }
}