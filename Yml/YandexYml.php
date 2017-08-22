<?php

namespace Klev\Yandex\YmlCreate\Yml;

use Klev\Yandex\YmlCreate\Create\MarketYandexShop;
use Klev\Yandex\YmlCreate\Create\MarketYandexOffers;

class YandexYml
{

    protected $shop;
    protected $offers;

    /**
     * @param $shop object
     * @return object
     */
    public function setShop(MarketYandexShop $shop)
    {
     return $this->shop = $shop;
    }

    /**
     * @param MarketYandexOffer $offer
     */
    public function setOffers(MarketYandexOffer $offer)
    {
        $this->offers[] = $offer->getYml();
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


        echo "!!!!<xmp>" . $xml->saveXML() . "</xmp>";
    }


    protected function save()
    {

    }


}