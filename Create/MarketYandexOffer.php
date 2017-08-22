<?php

namespace Klev\Yandex\YmlCreate\Create;

use DOMElement;
use DOMAttr;

class MarketYandexOffer
{

    use NameSetterProperty;
    use MarketYandexBuilder;

    protected $type;
    protected $id;
    protected $available;
    protected $vendor;
    protected $name;
    protected $model;
    protected $typePrefix;
    protected $picture;
    protected $param;
    protected $description;
    protected $cpa = 1;
    protected $bid;
    protected $cbid;
    protected $fee;
    protected $sales_notes;
    protected $min_quantity;
    protected $step_quantity;
    protected $delivery = true;
    protected $delivery_options;
    protected $pickup;
    protected $store;
    protected $adult;
    protected $barcode;
    protected $oldprice;
    protected $price;
    protected $vat;
    protected $url;

    public function __construct(array $options = array())
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, $key)) {
                $this->{$this->nameSetterProperty($key)}($option);
            }
        }
    }


    public function execute($dom)
    {
        $metod = get_class_methods($this);

        if ($shopMethod = get_object_vars($this)) {

            $offer = $this->getOffer($dom);
            $array = ['id' => '','type' => '','available' => '','bid' => '','cbid' => '','fee' => ''];

            $shopMethod = array_diff_key($shopMethod,$array);

            foreach ($shopMethod as $key => $item) {

                if ($property = $this->nameGetterProperty($key)) {

                    if ($name = $this->{$property}()) {

                        if ($builder = $this->nameGetterProperty('builder_'.$property)) {
                            if (in_array($builder,$metod,true)) {
                                $this->{$builder}($name,$offer);
                                continue;
                            }
                        }

                      $offer->appendChild(new DOMElement($key, htmlspecialchars($name)));
                    }

                }

            }

            return $dom;
        }

    }



    private function getOffer($xml)
    {

        $offer = $xml->appendChild(new DOMElement('offer'));

        if (isset($this->id)) {
            $offer->appendChild(new DOMAttr('id', $this->id));
        } else {
            throw new RequiredPropertyNotFoundException('id');
        }

        if (isset($this->type)) {
            $offer->appendChild(new DOMAttr('type', $this->type));
        }

        if (isset($this->available)) {
            $offer->appendChild(new DOMAttr('available', $this->available));
        }

        if (isset($this->bid)) {
            $offer->appendChild(new DOMAttr('bid', $this->bid));
        }

        if (isset($this->cbid)) {
            $offer->appendChild(new DOMAttr('cbid', $this->cbid));
        }

        if (isset($this->fee)) {
            $offer->appendChild(new DOMAttr('fee', $this->fee));
        }


        return $offer;

    }
    /**
     * @return mixed
     */
    protected function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    protected function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    protected function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    protected function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    protected function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     */
    protected function setAvailable($available)
    {
        $this->available = ($available) ? "true" : "false";
    }

    /**
     * @return mixed
     */
    protected function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    protected function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return mixed
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    protected function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    protected function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    protected function getTypePrefix()
    {
        return $this->typePrefix;
    }

    /**
     * @param mixed $typePrefix
     */
    protected function setTypePrefix($typePrefix)
    {
        $this->typePrefix = $typePrefix;
    }

    /**
     * @return mixed
     */
    protected function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param mixed $picture
     */
    protected function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return mixed
     */
    protected function getParam()
    {
        return $this->param;
    }

    /**
     * @param mixed $param
     */
    protected function setParam($param)
    {
        $this->param = $param;
    }

    /**
     * @return mixed
     */
    protected function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    protected function setDescription($description)
    {
        $this->description = mb_strimwidth(trim($description),0,2997,"...");
    }

    /**
     * @return mixed
     */
    protected function getCpa()
    {
        return $this->cpa;
    }

    /**
     * @param mixed $cpa
     */
    protected function setCpa($cpa)
    {
        $this->cpa = $cpa;
    }

    /**
     * @return mixed
     */
    protected function getBid()
    {
        return $this->bid;
    }

    /**
     * @param mixed $bid
     */
    protected function setBid($bid)
    {
        $this->bid = $bid;
    }

    /**
     * @return mixed
     */
    protected function getCbid()
    {
        return $this->cbid;
    }

    /**
     * @param mixed $cbid
     */
    protected function setCbid($cbid)
    {
        $this->cbid = $cbid;
    }

    /**
     * @return mixed
     */
    protected function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    protected function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    protected function getSalesNotes()
    {
        return $this->sales_notes;
    }

    /**
     * @param mixed $sales_notes
     */
    protected function setSalesNotes($sales_notes)
    {
        $this->sales_notes = $sales_notes;
    }

    /**
     * @return mixed
     */
    protected function getMinQuantity()
    {
        return $this->min_quantity;
    }

    /**
     * @param mixed $min_quantity
     * Внимание. На данный момент элементы min-quantity и step-quantity можно использовать только в категориях: «Автошины», «Грузовые шины», «Мотошины», «Диски». Для остальных категорий используйте элемент sales_notes.
     */
    protected function setMinQuantity($min_quantity)
    {
        $this->min_quantity = $min_quantity;
    }

    /**
     * @return mixed
     */
    protected function getStepQuantity()
    {
        return $this->step_quantity;
    }

    /**
     * @param mixed $step_quantity
     * Внимание. На данный момент элементы min-quantity и step-quantity можно использовать только в категориях: «Автошины», «Грузовые шины», «Мотошины», «Диски». Для остальных категорий используйте элемент sales_notes.
     */
    protected function setStepQuantity($step_quantity)
    {
        $this->step_quantity = $step_quantity;
    }

    /**
     * @return mixed
     */
    protected function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param mixed $delivery
     */
    protected function setDelivery($delivery)
    {
        $this->delivery = ($delivery) ? "true" : "false";
    }

    /**
     * @return mixed
     */
    protected function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param mixed $pickup
     * Внимание. Если вы используете элемент store или pickup со значением true, убедитесь, что в личном кабинете указаны точки продаж или подключена доставка Почтой России. В противном случае при проверке прайс-листа будет выдана ошибка.
     */
    protected function setPickup($pickup)
    {
        $this->pickup = ($pickup) ? "true" : "false";
    }

    /**
     * @return mixed
     */
    protected function getStore()
    {
        return $this->store;
    }

    /**
     * @param mixed $store
     * Внимание. Если вы используете элемент store или pickup со значением true, убедитесь, что в личном кабинете указаны точки продаж или подключена доставка Почтой России. В противном случае при проверке прайс-листа будет выдана ошибка.
     */
    protected function setStore($store)
    {
        $this->store = ($store) ? "true" : "false";
    }

    /**
     * @return mixed
     */
    protected function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param mixed $adult
     */
    protected function setAdult($adult)
    {
        $this->adult = $adult;
    }

    /**
     * @return mixed
     */
    protected function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param mixed $barcode
     * no check digits!
     */
    protected function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return mixed
     */
    protected function getOldprice()
    {
        return $this->oldprice;
    }

    /**
     * @param mixed $oldprice
     */
    protected function setOldprice($oldprice)
    {
        $this->oldprice = $oldprice;
    }

    /**
     * @return mixed
     */
    protected function getVat()
    {
        return $this->vat;
    }

    /**
     * @param mixed $vat
     */
    protected function setVat($vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return mixed
     */
    protected function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    protected function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    protected function getDeliveryOptions()
    {
        return $this->delivery_options;
    }

    /**
     * @param array $shop_delivery_options
     */
    protected function setDeliveryOptions($shop_delivery_options)
    {
        $this->delivery_options = $shop_delivery_options;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


}