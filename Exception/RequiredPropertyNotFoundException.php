<?php

namespace Klev\Yandex\YmlCreate\Exception;


class RequiredPropertyNotFoundException extends KlevYandexYmlCreateException
{
    /*
     * @param $id The unknown property
     */
    public function __construct($id)
    {
        parent::__construct(sprintf('Required property not found "%s"!', $id));
    }
}