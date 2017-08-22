<?php

namespace Klev\Yandex\YmlCreate\Yml;

use Klev\Yandex\YmlCreate\Create\MarketYandexShop;
use Klev\Yandex\YmlCreate\Create\MarketYandexOffer;
use DOMImplementation;
use DOMElement;
use DOMAttr;

class YandexYml
{

    protected $shop;
    protected $offers;
    public $yml;

    public function __construct()
    {
        $this->execute();
    }

    /**
     * @param $shop object
     * @return object
     */
    public function setShop(MarketYandexShop $shop)
    {
        $this->yml = $shop->execute($this->yml);
    }

    /**
     * @param MarketYandexOffer $offer
     */
    public function setOffers(MarketYandexOffer $offer)
    {
        $this->yml = $offer->execute($this->yml);
    }

    /**
     * @return array
     */
    protected function getOffers()
    {
        return $this->offers;
    }

    protected function execute()
    {

        $imp = new DOMImplementation();
        $dtd = $imp->createDocumentType('yml_catalog', '', "shops.dtd");
        $xml = $imp->createDocument("", "", $dtd);
        $xml->encoding = 'utf-8';
        $xml->formatOutput = TRUE;
        $yml_catalog = $xml->appendChild(new DOMElement('yml_catalog'));
        $yml_catalog->appendChild(new DOMAttr('date', date('Y-m-d H:i:s')));
        $this->yml = $xml;

    }


    protected function saveToFile($file)
    {

    }

    public function getEchoXML()
    {

        echo "<xmp>" . $this->yml->saveXML() . "</xmp>";

    }


}