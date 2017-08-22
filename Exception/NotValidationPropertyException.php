<?php
/**
 * (C) Kirill Levunin <klevunin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
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