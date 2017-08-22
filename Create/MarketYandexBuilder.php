<?php


namespace Klev\Yandex\YmlCreate\Create;

use DOMElement;
use DOMAttr;

trait MarketYandexBuilder
{

    protected function getBuilderGetShopCurrencies($name,$xml)
    {
        $shop_currencies = $xml->appendChild(new DOMElement('currencies'));
        foreach ($name as $id => $rate) {
            $currencies = $shop_currencies->appendChild(new DOMElement('currency'));
            $currencies->appendChild(new DOMAttr('id', $id));
            $currencies->appendChild(new DOMAttr('rate', $rate));
            $shop_currencies->appendChild($currencies);
        }
        $xml->appendChild($shop_currencies);
        return $xml;
    }

    protected function getBuilderGetShopCategories($name,$xml)
    {
        $shop_categories = $xml->appendChild(new DOMElement('categories'));
        foreach ($name as $id => $rate) {
            $categories = $shop_categories->appendChild(new DOMElement('category', htmlspecialchars($rate['name'])));
            $categories->appendChild(new DOMAttr('id', $id));
            if (isset($rate['parentId'])) {
                $categories->appendChild(new DOMAttr('parentId', $rate['parentId']));
            }
            $shop_categories->appendChild($categories);
        }
        $xml->appendChild($shop_categories);
        return $xml;
    }

    protected function getBuilderGetShopDeliveryOptions($name,$xml)
    {
        $shop_delivery_options = $xml->appendChild(new DOMElement('delivery-options'));
        foreach ($name as $option) {
            $delivery_options = $shop_delivery_options->appendChild(new DOMElement('option'));
            $delivery_options->appendChild(new DOMAttr('cost', $option['cost']));
            $delivery_options->appendChild(new DOMAttr('days', $option['days']));
            $delivery_options->appendChild(new DOMAttr('order-before', $option['order-before']));
            $shop_delivery_options->appendChild($delivery_options);
        }
        $xml->appendChild($shop_delivery_options);
        return $xml;
    }

    protected function getBuilderGetDeliveryOptions($name,$xml)
    {
        $shop_delivery_options = $xml->appendChild(new DOMElement('delivery-options'));
        foreach ($name as $option) {
            $delivery_options = $shop_delivery_options->appendChild(new DOMElement('option'));
            $delivery_options->appendChild(new DOMAttr('cost', $option['cost']));
            $delivery_options->appendChild(new DOMAttr('days', $option['days']));
            $delivery_options->appendChild(new DOMAttr('order-before', $option['order-before']));
            $shop_delivery_options->appendChild($delivery_options);
        }
        $xml->appendChild($shop_delivery_options);
        return $xml;
    }
}