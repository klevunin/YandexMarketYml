<?php
namespace Klev\Yandex\YmlCreate\Exception;


class NotValidationPropertyException extends KlevYandexYmlCreateException
{
    /*
         * @param $id The unknown property
         */
    public function __construct($id)
    {
        parent::__construct(sprintf('Not validation property "%s"!', $id));
    }
}