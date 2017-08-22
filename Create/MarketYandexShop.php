<?php

namespace Klev\Yandex\YmlCreate\Create;

use DOMDocument;
use DOMElement;
use DOMAttr;

class MarketYandexShop
{
    use NameSetterProperty;
    use MarketYandexBuilder;

    protected $shop_name;
    protected $shop_company;
    protected $shop_url;
    protected $shop_platform;
    protected $shop_version;
    protected $shop_agency;
    protected $shop_email;
    protected $shop_currencies;
    protected $shop_categories;
    protected $shop_delivery_options;
    protected $shop_cpa;
    protected $shop_offers;
    protected $shop_adult;


    /**
     * MarketYandexShop constructor.
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, 'shop_'.$key)) {
                $this->{$this->nameSetterProperty('shop_'.$key)}($option);
            }
        }
    }

    public function execute($dom)
    {
        $metod = get_class_methods($this);

        if ($shopMethod = get_object_vars($this)) {

            foreach ($shopMethod as $key => $item) {

                if ($property = $this->nameGetterProperty($key)) {

                    if ($name = $this->{$property}()) {

                        if ($builder = $this->nameGetterProperty('builder_'.$property)) {
                            if (in_array($builder,$metod,true)) {
                                $this->{$builder}($name,$dom);
                                continue;
                            }
                        }
                        $dom->appendChild(new DOMElement(mb_substr($key, 5), htmlspecialchars($name)));
                    }

                }

            }

            return $dom;
        }

    }

    public function getXml($xml = null)
    {
        if (is_null($xml)) {
            return null;
        }

        $metod = get_class_methods($this);

        if ($shopMethod = get_object_vars($this)) {
            foreach ($shopMethod as $key => $item) {

                if ($property = $this->nameGetterProperty($key)) {

                    if ($name = $this->{$property}()) {

                        if ($builder = $this->nameGetterProperty('builder_'.$property)) {
                            if (in_array($builder,$metod,true)) {
                                $xml = $this->{$builder}($name,$xml);
                                continue;
                            }
                        }
                        $xml->appendChild(new DOMElement(mb_substr($key, 5), htmlspecialchars($name)));
                    }

                }

            }
        }

    }


    /**
     * @return mixed
     */
    private function getShopName()
    {
        return $this->shop_name;
    }

    /**
     * @param mixed $shop_name
     */
    protected function setShopName($shop_name)
    {
        $this->shop_name = $shop_name;
    }

    /**
     * @return mixed
     */
    private function getShopCompany()
    {
        return $this->shop_company;
    }

    /**
     * @param mixed $shop_company
     */
    protected function setShopCompany($shop_company)
    {
        $this->shop_company = $shop_company;
    }

    /**
     * @return mixed
     */
    private function getShopUrl()
    {
        return $this->shop_url;
    }

    /**
     * @param mixed $shop_url
     */
    protected function setShopUrl($shop_url)
    {
        $this->shop_url = $shop_url;
    }

    /**
     * @return mixed
     */
    private function getShopPlatform()
    {
        return $this->shop_platform;
    }

    /**
     * @param mixed $shop_platform
     */
    protected function setShopPlatform($shop_platform)
    {
        $this->shop_platform = $shop_platform;
    }

    /**
     * @return mixed
     */
    private function getShopVersion()
    {
        return $this->shop_version;
    }

    /**
     * @param mixed $shop_version
     */
    protected function setShopVersion($shop_version)
    {
        $this->shop_version = $shop_version;
    }

    /**
     * @return mixed
     */
    private function getShopAgency()
    {
        return $this->shop_agency;
    }

    /**
     * @param mixed $shop_agency
     */
    protected function setShopAgency($shop_agency)
    {
        $this->shop_agency = $shop_agency;
    }

    /**
     * @return mixed
     */
    private function getShopEmail()
    {
        return $this->shop_email;
    }

    /**
     * @param mixed $shop_email
     */
    protected function setShopEmail($shop_email)
    {
        $this->shop_email = $shop_email;
    }

    /**
     * @return mixed
     */
    private function getShopCurrencies()
    {
        return $this->shop_currencies;
    }

    /**
     * @param array $shop_currencies
     */
    protected function setShopCurrencies($shop_currencies)
    {
        $this->shop_currencies = $shop_currencies;
    }

    /**
     * @return mixed
     */
    private function getShopCategories()
    {
        return $this->shop_categories;
    }

    /**
     * @param array $shop_categories
     */
    protected function setShopCategories($shop_categories)
    {
        $this->shop_categories = $shop_categories;
    }

    /**
     * @return mixed
     */
    private function getShopDeliveryOptions()
    {
        return $this->shop_delivery_options;
    }

    /**
     * @param array $shop_delivery_options
     */
    protected function setShopDeliveryOptions($shop_delivery_options)
    {
        $this->shop_delivery_options = $shop_delivery_options;
    }

    /**
     * @return mixed
     */
    private function getShopCpa()
    {
        return $this->shop_cpa;
    }

    /**
     * @param mixed $shop_cpa
     */
    protected function setShopCpa($shop_cpa)
    {
        $this->shop_cpa = $shop_cpa;
    }

    /**
     * @return mixed
     */
    public function getShopAdult()
    {
        return $this->shop_adult;
    }

    /**
     * @param mixed $adult
     */
    protected function setShopAdult($adult)
    {
        $this->shop_adult = $adult;
    }

    /**
     * @return mixed
     */
    private function getShopOffers()
    {
        return $this->shop_offers;
    }

    /**
     * @param mixed $shop_offers
     */
    protected function setShopOffers($shop_offers)
    {
        $this->shop_offers = $shop_offers;
    }

}