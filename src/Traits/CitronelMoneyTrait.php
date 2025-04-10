<?php

namespace aliirfaan\CitronelCore\Traits;

trait CitronelMoneyTrait
{
    public function getCitronelDefaultCurrency()
    {
        return config('citronel.currency.default');
    }

    /**
     * Method getBaseCurrencyCode
     *
     * @return string
     */
    public function getCitronelBaseCurrencyCode()
    {
        return config('citronel.currency.base');
    }

    /**
     * Method formatAmount to calculations
     *
     * @param float $amount [explicite description]
     * @param int $decimals [explicite description]
     *
     * @return string
     */
    public function formatAmount($amount, $decimals = null)
    {
        $decimals = $decimals ?? config('citronel.decimals');
    
        $amount = (string) $amount;
    
        // Shift amount by one extra decimal place
        $multiplier = bcpow('10', $decimals + 1);
        $shifted = bcmul($amount, $multiplier, 0);
    
        // Get the last digit for rounding
        $lastDigit = (int) substr($shifted, -1);
        $truncated = substr($shifted, 0, -1);
    
        // Apply rounding (half-up)
        if ($lastDigit >= 5) {
            $truncated = bcadd($truncated, '1');
        }
    
        // Divide back down to get the correctly rounded amount, string, safe for DECIMAL colum
        return bcdiv($truncated, bcpow('10', $decimals), $decimals);
    }
    
    
    /**
     * Method formatCurrencyAmount
     *
     * @param int|float $amount [explicite description]
     * @param int $decimals [explicite description]
     * @param string $currency [explicite description]
     * @param string $decimalSeparator [explicite description]
     * @param string $thousandsSeparator [explicite description]
     *
     * @return string
     */
    public function formatCurrencyAmountWithSymbol($amount, $decimals = null, $currency = null, $decimalSeparator = '.', $thousandsSeparator = ',')
    {
        $decimals = $decimals ?? config('citronel.decimals');

        $currency = $currency ?? $this->getCitronelDefaultCurrency();
        $currencySymbol = strval(config('citronel.currency.supported.' . $currency . '.symbol'));

        $amount = number_format($amount, $decimals, $decimalSeparator, $thousandsSeparator);

        return $currencySymbol . ' ' . $amount;
    }
    
    /**
     * Method formatCurrencyAmountWithCode
     *
     * @param int|float $amount [explicite description]
     * @param int $decimals [explicite description]
     * @param string $currency [explicite description]
     * @param string $decimalSeparator [explicite description]
     * @param string $thousandsSeparator [explicite description]
     *
     * @return void
     */
    public function formatCurrencyAmountWithCode($amount, $decimals = null, $currency = null, $decimalSeparator = '.', $thousandsSeparator = ',')
    {
        $decimals = $decimals ?? config('citronel.decimals');

        $currency = $currency ?? $this->getCitronelDefaultCurrency();
        $currencyCode = strval(config('citronel.currency.supported.' . $currency . '.code'));

        $amount = number_format($amount, $decimals, $decimalSeparator, $thousandsSeparator);

        return $currencyCode . ' ' . $amount;
    }
}
