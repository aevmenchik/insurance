<?php

/**
 * Create shipping insurance block in Checkout progress section
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress
{
    /**
     * Return shipping insurance enable
     *
     * @return bool
     */
    public function getShippingInsurance()
    {
        return $this->getQuote()->getShippingAddress()->getShippingInsurance() == Shipping_Insurance_Model_Insurance::ACTIVE;
    }

    /**
     * Return rate of shipping insurance in price format
     *
     * @return string
     */
    public function getShippingInsuranceValueFormat()
    {
        if ($this->getShippingInsurance()) {
            $insurance_rate = $this->getQuote()->getShippingAddress()->getShippingInsuranceAmount();
            $insurance_value_format = Mage::getSingleton('checkout/cart')->getQuote()->getStore()->convertPrice($insurance_rate, true);
            return $insurance_value_format;
        }
        return '';
    }

    /**
     * Get checkout steps codes
     *
     * @return array
     */
    protected function _getStepCodes()
    {
        $step_codes = parent::_getStepCodes();

        $insurance_step_code = 'shipping_insurance';
        $after_step_code = 'shipping_method';

       if (in_array($after_step_code, $step_codes)) {
            $new_step_codes = array();

            foreach ($step_codes as $step_code) {
                $new_step_codes[] = $step_code;
                if ($step_code == $after_step_code) {
                    $new_step_codes[] = $insurance_step_code;
                }
            }
            $step_codes = $new_step_codes;
        }
        return $step_codes;
    }
}
