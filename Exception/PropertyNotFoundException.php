<?php

namespace  Klev\Yandex\YmlCreate\Exception;


class PropertyNotFoundException extends KlevYandexYmlCreateException
{
    /*
     * @param $id The unknown property
     */
    public function __construct($id)
    {
        parent::__construct(sprintf('Property not found "%s"!', $id));
    }
}