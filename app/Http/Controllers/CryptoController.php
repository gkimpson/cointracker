<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;

class CryptoController extends Controller
{
    public $client;
    public $defaultCoin = 'bitcoin';
    public $defaultCurrency = 'usd';

    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    public function index()
    {
    
    }

    public function ping()
    {
        return $this->client->ping();
    }

    /**
     * Get the current price of any cryptocurrencies in any other supported currencies that you need
     */
    public function price(Request $request)
    {
        $coinIds = $request->input('coinIds', $this->defaultCoin);
        $vsCurrencies = $request->input('vsCurrencies', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->simple()->getPrice($coinIds, $vsCurrencies, $params);
    }

    /**
     * Get current price of tokens (using contract addresses) for a given platform in any other currency that you need
     */
    public function tokenPrice(Request $request)
    {
        $id = $request->input('id', null);
        $contractAddresses = $request->input('contractAddresses', null);
        $vsCurrencies = $request->input('vsCurrencies', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->simple()->getTokenPrice($id, $contractAddresses, $vsCurrencies, $params);
    }

    /**
     * Get list of supported_vs_currencies.
     */
    public function supportedCurrencies()
    {
        return $this->client->simple()->getSupportedVsCurrencies();
    }

    /**
     * List all supported coins id, name and symbol
     */
    public function coinsList()
    {
        return $this->client->coins()->getList();
    }

    /**
     * List all supported coins price, market cap, volume, and market related data
     */
    public function marketList(Request $request)
    {
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->coins()->getMarkets($vsCurrency, $params);
    }

    /**
     * Get current data (name, price, market, ... including exchange tickers) for a coin
     */
    public function coin(Request $request)
    {
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $tickers = $request->input('tickers', false);
        $marketData = $request->input('marketData', false);
        return $this->client->coins()->getCoin($vsCurrency, ['tickers' => $tickers, 'market_data' => $marketData]);
    }

    /**
     * Get coin tickers (paginated to 100 items)
     */
    public function tickers(Request $request) 
    {
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->coins()->getTickers($vsCurrency, $params);
    }

    /**
     * Get historical data (name, price, market, stats) at a given date for a coin
     */
    public function history(Request $request)
    {
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $date = $request->input('date', null); // e.g '30-12-2020'
        $params = $request->input('params', []);
        return $this->client->coins()->getHistory($vsCurrency, $date, $params);
    }

    /**
     * Get historical market data include price, market cap, and 24h volume (granularity auto)
     */
    public function marketChart(Request $request)
    {
        $coinId = $request->input('coinId', $this->defaultCoin);
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $days = $request->input('days', 'max');
        return $this->client->coins()->getMarketChart($coinId, $vsCurrency, $days);
    }

    public function marketChartRange(Request $request)
    {
        $coinId = $request->input('coinId', $this->defaultCoin);
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $from = $request->input('from', null);
        $to = $request->input('to', null);
        return $this->client->coins()->getMarketChartRange($coinId, $vsCurrency, $from, $to);
    }

    public function marketChartRangeBeta(Request $request)
    {
        $coinId = $request->input('coinId', $this->defaultCoin);
        return $this->client->coins()->getStatusUpdates($coinId);
    }

}
