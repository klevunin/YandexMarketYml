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
    private $offersyml;

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
        $this->shop = $shop->execute($this->shop);
        $this->offersyml = $this->shop->appendChild(new DOMElement('offers'));
    }

    /**
     * @param MarketYandexOffer $offer
     */
    public function setOffers(MarketYandexOffer $offer)
    {
        $this->offersyml = $offer->execute($this->offersyml);
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
        $this->shop = $yml_catalog->appendChild(new DOMElement('shop'));
        $this->yml = $xml;

    }


    public function saveToFile($file)
    {

        if ($fh = fopen($file, "w+")) {
            fwrite($fh, $this->yml->saveXML());
            fclose($fh);
        } else {
            echo 'Нет досутпа к файлу '.$sitemap_file.'!';
        }

    }

    public function getEchoXML()
    {

        echo "<xmp>" . $this->yml->saveXML() . "</xmp>";

    }


}