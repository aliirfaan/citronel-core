<?php

namespace aliirfaan\CitronelCore\Traits;

trait CitronelMoneyTrait
{
    public function getCitronelDefaultCurrency()
    {
        return config('citronel.currency.default');
    }

    /**
     * Method formatAmount to float
     *
     * @param float $amount [explicite description]
     * @param int $decimals [explicite description]
     *
     * @return float
     */
    public function formatAmount($amount, $decimals = null)
    {
        $decimals = $decimals ?? config('citronel.decimals');

        return floatval(number_format($amount, $decimals));
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
