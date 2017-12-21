<?php
/**
 * Class Shipping_Insurance_Model_Type_Onepage
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Model_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    /**
     * Initialize quote state to be valid for one page checkout
     *
     * @return Shipping_Insurance_Model_Type_Onepage
     */
    public function initCheckout()
    {
        parent::initCheckout();

        $this->getCheckout()->setStepData('shipping_insurance', 'allow', true);
        return $this;
    }
}
