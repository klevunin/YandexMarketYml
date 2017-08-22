<?php
/**
 * (C) Kirill Levunin <klevunin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Klev\Yandex\YmlCreate\Yml;

use DOMImplementation;
use DOMElement;
use DOMDocument;
use DOMAttr;
use DOMNode;

/**
 * Class YandexMarketYml
 *
 * @author Kirill Levunin <klevunin@gmail.com>
 */
class YandexMarketYml implements MarketYandex
{
    public $validate = false;
    private $xml;
    private $filename;
    private $shop;
    private $offers;
    protected $xmloffers;


    public function __construct(bool $validate = null)
    {
        if (($validate) && (is_bool($validate))) {
            $this->validate = $validate;
        }
    }

    public function setXmlShop(array $shop = array())
    {

        if ($this->validate) {
            $MarketYandexShop = new MarketYandexShopValidation($shop);
        } else {
            $MarketYandexShop = new MarketYandexShop($shop);
        }

        return $MarketYandexShop->getXml($this->xml);
    }

    public function setXmlOffers(array $offers = array())
    {
        $MarketYandexOffers = new MarketYandexOffers($this->validate);
        $MarketYandexOffers->setOffersArray($this->offers);

        return $MarketYandexOffers->getXml($this->xml);
    }

    public function getXml($xml = null)
    {
        // TODO: Implement getXml() method.

        $imp = new DOMImplementation();
        $dtd = $imp->createDocumentType('yml_catalog', '', "shops.dtd");
        $xml = $imp->createDocument("", "", $dtd);
        $xml->encoding = 'utf-8';
        $xml->formatOutput = TRUE;
        $yml_catalog = $xml->appendChild(new DOMElement('yml_catalog'));
        $yml_catalog->appendChild(new DOMAttr('date', date('Y-m-d H:i:s')));

        $this->xml = $yml_catalog->appendChild(new DOMElement('shop'));
        $this->xml = $this->setXmlShop($this->shop);
        $this->xml = $yml_catalog->appendChild(new DOMElement('offers'));
        $this->xml = $this->setXmlOffers($this->offers);
        //$this->xml->appendChild(new DOMElement('ofrs','saasd'));

        //$this->xml = $offers->appendChild(new DOMElement('offersssdsd','sd'));

        echo "!!!!<xmp>" . $xml->saveXML() . "</xmp>";
    }


    public function setShop(array $shop)
    {
        $this->shop = $shop;
    }

    public function setOffers(array $Offers)
    {
        $this->offers = $Offers;
    }

    public function saveXml()
    {

    }

}