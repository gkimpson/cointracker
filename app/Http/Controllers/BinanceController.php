<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class BinanceController extends Controller
{
    protected $apiKey;
    protected $secretKey;
    protected $api;

    public function __construct()
    {
        $this->apiKey = env('BINANCE_APP_KEY');
        $this->secretKey = env('BINANCE_APP_SECRET');
        $this->api = new \Binance\API($this->apiKey, $this->secretKey);
    }

    public function index()
    {
//        dd($this->api->balances(true));

        $tickerCollection = collect($this->api->balances());
        dd($tickerCollection);

        dd($this->api->price("BNBBTC"));
    }

}
