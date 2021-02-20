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
    public $defaultExchange = 'binance';

    public function __construct()
    {
        $this->client = new CoinGeckoClient();
    }

    public function index()
    {

    }

    /**
     * Check API server status
     * @return array
     * @throws \Exception
     */
    public function ping()
    {
        return $this->client->ping();
    }

    /**
     * Get the current price of any cryptocurrencies in any other supported currencies that you need
     * @param Request $request
     * @return array
     * @throws \Exception
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
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function tokenPrice(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin); // e.g 'ethereum'
        $contractAddresses = $request->input('contractAddresses', null); // e.g '0xE41d2489571d322189246DaFA5ebDe1F4699F498'
        $vsCurrencies = $request->input('vsCurrencies', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->simple()->getTokenPrice($id, $contractAddresses, $vsCurrencies, $params);
    }

    /**
     * Get list of supported_vs_currencies
     * @return array
     * @throws \Exception
     */
    public function supportedCurrencies()
    {
        return $this->client->simple()->getSupportedVsCurrencies();
    }

    /**
     * List all supported coins id, name and symbol
     * @return array
     * @throws \Exception
     */
    public function coinsList()
    {
        return $this->client->coins()->getList();
    }

    /**
     * List all supported coins price, market cap, volume, and market related data
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function marketList(Request $request)
    {
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $params = $request->input('params', []);
        return $this->client->coins()->getMarkets($vsCurrency, $params);
    }

    /**
     * Get current data (name, price, market, ... including exchange tickers) for a coin
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function coin(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        $tickers = $request->input('tickers', false);
        $marketData = $request->input('marketData', false);
        return $this->client->coins()->getCoin($id, ['tickers' => $tickers, 'market_data' => $marketData]);
    }

    /**
     * Get coin tickers (paginated to 100 items)
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function tickers(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        $params = $request->input('params', []);
        return $this->client->coins()->getTickers($id, $params);
    }

    /**
     * Get historical data (name, price, market, stats) at a given date for a coin
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function history(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        $date = $request->input('date', null); // e.g '30-12-2020'
        $params = $request->input('params', []);
        return $this->client->coins()->getHistory($id, $date, $params);
    }

    /**
     * Get historical market data include price, market cap, and 24h volume (granularity auto)
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function marketChart(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $days = $request->input('days', 'max');
        return $this->client->coins()->getMarketChart($id, $vsCurrency, $days);
    }

    /**
     * Get historical market data include price, market cap, and 24h volume within a range of timestamp (granularity auto)
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function marketChartRange(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        $vsCurrency = $request->input('vsCurrency', $this->defaultCurrency);
        $from = $request->input('from', '');
        $to = $request->input('to', '');
        return $this->client->coins()->getMarketChartRange($id, $vsCurrency, $from, $to);
    }

    /**
     * Get status updates for a given coin
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function marketChartRangeBeta(Request $request)
    {
        $id = $request->input('id', $this->defaultCoin);
        return $this->client->coins()->getStatusUpdates($id);
    }

    /**
     * List all derivative exchanges
     * @return array
     * @throws \Exception
     */
    public function exchanges()
    {
        return $this->client->exchanges()->getExchanges();
    }

    /**
     * Show derivative exchange data
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function exchange(Request $request)
    {
        $exchange = $request->input('exchange', $this->defaultExchange);
        return $this->client->exchanges()->getExchange($exchange);
    }

    /**
     * Get volume_chart data for a given exchange (beta)
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function volumeChart(Request $request)
    {
        $days = $request->input('days', '30');
        $exchange = $request->input('exchange', $this->defaultExchange);
        return $this->client->exchanges()->getVolumeChart($exchange, $days);
    }

    /**
     * List all status_updates with data (description, category, created_at, user, user_title and pin)
     * @return array
     * @throws \Exception
     */
    public function statusUpdates()
    {
        return $this->client->statusUpdates()->getStatusUpdates();
    }

    /**
     * Get events, paginated by 100
     * @return array
     * @throws \Exception
     */
    public function events()
    {
        return $this->client->events()->getEvents();
    }

    /**
     * Get cryptocurrency global data
     * @return array
     * @throws \Exception
     */
    public function globalData()
    {
        return $this->client->globals()->getGlobal();
    }

    /**
     * List all finance platforms
     * @return array
     * @throws \Exception
     */
    public function finance()
    {
        return $this->client->finance()->getPlatforms();
    }

    /**
     * List all finance products
     * @return array
     * @throws \Exception
     */
    public function financeProducts()
    {
        return $this->client->events()->getTypes();;
        return $this->client->finance()->getProducts();
    }
}
