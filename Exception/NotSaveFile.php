<?php

namespace Klev\Yandex\YmlCreate\Exception;


class NotSaveFile extends KlevYandexYmlCreateException
{
    /*
    * @param $id The unknown property
    */
    public function __construct($id)
    {
        parent::__construct(sprintf('Can not save file "%s"!', $id));
    }

}