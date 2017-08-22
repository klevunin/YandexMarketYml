<?php

namespace Klev\Yandex\YmlCreate\Create;


class MarketYandexOffers
{
    protected $offers;

    protected function addOffers(MarketYandexOffer $offer)
    {
        $this->offers = $offer;
    }



}