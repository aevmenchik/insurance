<?php

/**
 * Class Shipping_Insurance_Block_Onepage
 *
 * @category   Insurance
 * @package    Shipping_Insurance
 * @author     ae
 */
class Shipping_Insurance_Block_Onepage extends Mage_Checkout_Block_Onepage
{
    /**
     * Get 'one step checkout' step data
     *
     * @return array
     */
    public function getSteps()
    {
        $steps = parent::getSteps();

        $insurance_step_code = 'shipping_insurance';
        $after_step_code = 'shipping_method';

        if (isset($steps[$after_step_code])) {
            $new_steps = array();

            foreach ($steps as $step_code => $step_data) {
                $new_steps[$step_code] = $step_data;
                if ($step_code == $after_step_code) {
                    $new_steps[$insurance_step_code] = $this->getCheckout()->getStepData($insurance_step_code);
                }
            }
            $steps = $new_steps;
        }
        return $steps;
    }
}