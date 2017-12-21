<?php

/**
 * Create shipping insurance block in Checkout
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Onepage_Insurance extends Mage_Checkout_Block_Onepage_Abstract
{
    protected $_rates;

    /**
     * Constructor
     */
    protected function _construct()
    {
        $this->getCheckout()->setStepData('shipping_insurance', array(
            'label' => Mage::helper('checkout')->__('Shipping Insurance'),
            'is_show' => true
        ));
        parent::_construct();
    }

    /**
     * Declare template for payment method form block
     *
     * @param   string $method
     * @param   string $template
     * @return  Shipping_Insurance_Block_Onepage_Insurance
     */
    public function setMethodFormTemplate($method='', $template='')
    {
        if (!empty($method) && !empty($template)) {
            if ($block = $this->getChild('payment.method.'.$method)) {
                $block->setTemplate($template);
            }
        }
        return $this;
    }

    /**
     * Define if shipping insurance is added
     *
     * @return bool
     */
    public function isShippingInsuranceActive()
    {
        return Mage::getSingleton('checkout/cart')->getQuote()->getShippingAddress()->getShippingInsurance() == Shipping_Insurance_Model_Insurance::ACTIVE;
    }

    /**
     * Return shipping insurance rate for current shipping method and subtotal of order
     *
     * @return array
     */
    public function getAvailableShippingInsuranceRate()
    {
        $subtotal = Mage::getSingleton('checkout/cart')->getQuote()->getTotals()['subtotal']->getValue();
        $shipping_method = $this->getRequest()->getPost('shipping_method');
        $insurance_rate = Mage::getModel('shipping_insurance/insurance')->getAvailableInsuranceRate($shipping_method, $subtotal);
        return $insurance_rate;
    }

    /**
     * Get Carrier Name
     *
     * @param string $carrierCode
     * @return mixed
     */
    public function getCarrierName($carrierCode)
    {
        $name = Mage::getStoreConfig('carriers/' . $carrierCode . '/title');
        if ($name) {
            return $name;
        }
        return $carrierCode;
    }
}