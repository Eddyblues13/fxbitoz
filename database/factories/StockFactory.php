<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stockNames = [
            'AMAZON',
            'NETFLIX',
            'Apple',
            'Microsoft',
            'Tesla',
            'Google',
            'META',
            'PayPal',
            'MCDONALD',
            'COCA-COLA',
            'Shopify',
            'GME'
        ];

        $stockName = $this->faker->randomElement($stockNames);
        $pictureName = time() . '_stock_' . strtolower($stockName) . '.jpg';

        return [
            'stock_name' => $stockName,
            'stock_max_amount' => $this->faker->randomNumber(5),
            'stock_min_amount' => $this->faker->randomNumber(3),
            'stock_js' => $this->generateStockJS($stockName),
            'stock_graph' => 'stock',
            'top_up_amount' => $this->faker->randomElement(['10%', '20%', '30%', '40%']),
            'top_up_interval' => $this->faker->randomElement(['Daily', 'Weekly', 'Monthly']),
            'top_up_type' => $this->faker->randomElement(['Percentage', 'Fixed']),
            'investment_duration' => $this->faker->randomElement(['1 Week', '2 Weeks', '1 Month', '6 Months']),
            'top_up_status' => $this->faker->randomElement(['Open', 'Closed']),
            'performance' => $this->faker->randomFloat(2, -1000, 1000),
            'copier_roi' => $this->faker->randomFloat(2, 0, 100),
            'years_of_experience' => $this->faker->randomDigitNotNull(),
            'picture' => $pictureName,
        ];
    }

    /**
     * Generate stock JS based on stock name.
     *
     * @param string $stockName
     * @return string
     */
    private function generateStockJS(string $stockName): string
    {
        return <<<JS
<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-symbol-overview.js" async>
{
    "symbols": [
        [
            "$stockName",
            "NASDAQ:{$stockName}|1M"
        ]
    ],
    "chartOnly": false,
    "width": "100%",
    "height": "100%",
    "locale": "en",
    "colorTheme": "light",
    "autosize": true,
    "showVolume": true,
    "hideDateRanges": false,
    "hideMarketStatus": false,
    "hideSymbolLogo": false,
    "scalePosition": "right",
    "scaleMode": "Normal",
    "fontFamily": "-apple-system, BlinkMacSystemFont, Trebuchet MS, Roboto, Ubuntu, sans-serif",
    "fontSize": "10",
    "noTimeScale": false,
    "valuesTracking": "1",
    "changeMode": "price-and-percent",
    "chartType": "line"
}
</script>
JS;
    }
}
