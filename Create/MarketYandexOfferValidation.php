<?php

namespace Klev\Yandex\YmlCreate\Create;

use Klev\Yandex\YmlCreate\Exception\PropertyNotFoundException;
use Klev\Yandex\YmlCreate\Exception\RequiredPropertyNotFoundException;
use Klev\Yandex\YmlCreate\Exception\NotValidationPropertyException;

class MarketYandexOfferValidation extends MarketYandexOffer
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = array())
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, $key)) {
                $this->{$this->nameSetterProperty($key)}($option);
            } else {
              throw new PropertyNotFoundException($key);
            }
        }

        if (!is_string($this->type)) {
            if (!is_string($this->name)) {
                throw new RequiredPropertyNotFoundException('name');
            }
        } else {
            if (!is_string($this->vendor)) {
                throw new RequiredPropertyNotFoundException('vendor');
            }
            if (!is_string($this->model)) {
                throw new RequiredPropertyNotFoundException('model');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        if ((!is_string($type)) || (!in_array($type, ['vendor.model', 'medicine', 'books', 'audiobooks', 'artist.title', 'event-ticket', 'tour'], true))) {
            throw new NotValidationPropertyException('type');
        }

        parent::setType($type);
    }


    /**
     * {@inheritdoc}
     */
    public function setId($id)
    {
        if ((is_array($id)) || (mb_strlen($id) > 20)) {
            throw new NotValidationPropertyException('id');
        }
        parent::setId($id);
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailable($available)
    {
        if (!is_bool($available)) {
            throw new NotValidationPropertyException('available');
        }
        parent::setAvailable($available);
    }

    /**
     * {@inheritdoc}
     */
    public function setVendor($vendor)
    {
        if (!is_string($vendor)) {
            throw new NotValidationPropertyException('vendor');
        }
        parent::setVendor($vendor);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        if (!is_string($name)) {
            throw new NotValidationPropertyException('name');
        }
        parent::setName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function setModel($model)
    {
        if (!is_string($model)) {
            throw new NotValidationPropertyException('model');
        }
        parent::setModel($model);
    }

    /**
     * {@inheritdoc}
     */
    public function setTypePrefix($typePrefix)
    {
        if (!is_string($typePrefix)) {
            throw new NotValidationPropertyException('typePrefix');
        }
        parent::setTypePrefix($typePrefix);
    }

    /**
     * {@inheritdoc}
     */
    public function setPicture($picture)
    {
        if (!is_array($picture)) {
            throw new NotValidationPropertyException('picture');
        }
        parent::setPicture($picture);
    }

    /**
     * {@inheritdoc}
     */
    public function setParam($param)
    {
        if (!is_array($param)) {
            throw new NotValidationPropertyException('param');
        }
        parent::setParam($param);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        if ((!is_string($description)) || (mb_strlen($description) > 3000)) {
            throw new NotValidationPropertyException('description');
        }
        parent::setDescription($description);
    }

    /**
     * {@inheritdoc}
     */
    public function setCpa($cpa)
    {
        if ((!is_numeric($cpa)) || ($cpa != 0 || 1)) {
            throw new NotValidationPropertyException('cpa');
        }
        parent::setCpa($cpa);
    }

    /**
     * {@inheritdoc}
     */
    public function setBid($bid)
    {
        if ((!is_numeric($bid)) || (!is_int($bid)) || ($bid <= 0)) {
            throw new NotValidationPropertyException('bid');
        }
        parent::setBid($bid);
    }

    /**
     * {@inheritdoc}
     */
    public function setCbid($cbid)
    {
        if ((!is_numeric($cbid)) || (!is_int($cbid)) || ($cbid <= 0)) {
            throw new NotValidationPropertyException('cbid');
        }
        parent::setCbid($cbid);
    }

    /**
     * {@inheritdoc}
     */
    public function setFee($fee)
    {
        if ((!is_numeric($fee)) || (!is_int($fee)) || ($fee <= 0)) {
            throw new NotValidationPropertyException('fee');
        }
        parent::setFee($fee);
    }

    /**
     * {@inheritdoc}
     */
    public function setSalesNotes($sales_notes)
    {
        if (!is_string($sales_notes)) {
            throw new NotValidationPropertyException('sales_notes');
        }
        parent::setSalesNotes($sales_notes);
    }

    /**
     * {@inheritdoc}
     */
    public function setMinQuantity($min_quantity)
    {
        if ((!is_numeric($min_quantity)) || (!is_int($min_quantity)) || ($min_quantity <= 0)) {
            throw new NotValidationPropertyException('min_quantity');
        }
        parent::setMinQuantity($min_quantity);
    }

    /**
     * {@inheritdoc}
     */
    public function setStepQuantity($step_quantity)
    {
        if ((!is_numeric($step_quantity)) || (!is_int($step_quantity)) || ($step_quantity <= 0)) {
            throw new NotValidationPropertyException('step_quantity');
        }
        parent::setStepQuantity($step_quantity);
    }

    /**
     * {@inheritdoc}
     */
    public function setDelivery($delivery)
    {
        if (!is_bool($delivery)) {
            throw new NotValidationPropertyException('delivery');
        }
        parent::setDelivery($delivery);
    }

    /**
     * {@inheritdoc}
     */
    public function setPickup($pickup)
    {
        if (!is_bool($pickup)) {
            throw new NotValidationPropertyException('pickup');
        }
        parent::setPickup($pickup);
    }

    /**
     * {@inheritdoc}
     */
    public function setStore($store)
    {
        if (!is_bool($store)) {
            throw new NotValidationPropertyException('store');
        }
        parent::setStore($store);
    }

    /**
     * {@inheritdoc}
     */
    public function setAdult($adult)
    {
        if ((!is_bool($adult)) || (!$adult)) {
            throw new NotValidationPropertyException('adult');
        }
        parent::setAdult($adult);
    }

    /**
     * {@inheritdoc}
     */
    public function setBarcode($barcode)
    {
        if ((!is_string($barcode)) || (!ctype_digit($barcode))) {
            throw new NotValidationPropertyException('barcode');
        }
        $n = mb_strlen($barcode);
        if ($n > 13 || $n < 8) {
            throw new NotValidationPropertyException('barcode');
        }
        if (($n != 13) && ($n != 12) && ($n != 8)) {
            throw new NotValidationPropertyException('barcode');
        }
        parent::setBarcode($barcode);
    }

    /**
     * {@inheritdoc}
     */
    public function setOldprice($oldprice)
    {
        if ((!is_string($oldprice)) || (!ctype_digit($oldprice))) {
            throw new NotValidationPropertyException('oldprice');
        }
        parent::setOldprice($oldprice);
    }

    /**
     * {@inheritdoc}
     */
    public function setVat($vat)
    {
        if (!in_array($vat, ['1', 'VAT_18', '3', 'VAT_18_118', '2', 'VAT_10', '4', 'VAT_10_110', '5', 'VAT_0', '6', 'NO_VAT'], true)) {
            throw new NotValidationPropertyException('vat');
        }
        parent::setVat($vat);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        if ((!is_string($price)) || (!ctype_digit($price))) {
            throw new NotValidationPropertyException('price');
        }
        parent::setPrice($price);
    }

    /**
     * {@inheritdoc}
     */
    protected function setDeliveryOptions($shop_delivery_options)
    {
        if ((!is_array($shop_delivery_options)) || (!count($shop_delivery_options))) {
            throw new NotValidationPropertyException('shop_delivery_options');
        }

        foreach ($shop_delivery_options as $optionarray) {
            if (count($optionarray) != 3) {
                throw new NotValidationPropertyException('shop_delivery_options');
            }

            foreach ($optionarray as $item => $option) {

                if (!in_array($item, ['cost', 'days', 'order-before'],true)) {
                    throw new NotValidationPropertyException('shop_delivery_options');
                }

                if (!is_string($option)) {
                    throw new NotValidationPropertyException('shop_delivery_options');
                }
            }
        }
        parent::setDeliveryOptions($shop_delivery_options);
    }

}