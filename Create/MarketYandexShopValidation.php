<?php
/**
 * (C) Kirill Levunin <klevunin@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Klev\Yandex\YmlCreate;

use Klev\Yandex\YmlCreate\Exception\PropertyNotFoundException;
use Klev\Yandex\YmlCreate\Exception\RequiredPropertyNotFoundException;
use Klev\Yandex\YmlCreate\Exception\NotValidationPropertyException;

/**
 * You can use data validation if you want
 * But I think that this is wrong.
 * The data will be checked on the Yandex side.
 * Verification makes sense if you process other people's data
 * It's better to check your data when preparing on your side, correcting them.
 *
 * @author Kirill Levunin <klevunin@gmail.com>
 */
class MarketYandexShopValidation extends MarketYandexShop
{

    /**
     * {@inheritdoc}
     */
    public function __construct(array $options = array())
    {
        foreach ($options as $key => $option) {
            if (property_exists($this, 'shop_'.$key)) {
                $this->{$this->nameSetterProperty('shop_'.$key)}($option);
            } else {
                throw new PropertyNotFoundException($key);
            }
        }

        if (!is_string($this->shop_name)) {
            throw new RequiredPropertyNotFoundException('shop_name');
        }

        if (!is_string($this->shop_company)) {
            throw new RequiredPropertyNotFoundException('shop_company');
        }
        /**
         * URL главной страницы магазина. Максимальная длина — 50 символов. Допускаются кириллические ссылки.
         * Элемент обязателен при размещении по модели «Переход на сайт» .
         */
        if (!is_string($this->shop_url)) {
            throw new RequiredPropertyNotFoundException('shop_url');
        }
        if (!is_array($this->shop_currencies)) {
            throw new RequiredPropertyNotFoundException('shop_currencies');
        }
        if (!is_array($this->shop_categories)) {
            throw new RequiredPropertyNotFoundException('shop_categories');
        }
        /**
         * Стоимость и сроки курьерской доставки по своему региону.
         * Обязательный элемент, если все данные по доставке передаются в прайс-листе.
         */
        if (!is_array($this->shop_delivery_options)) {
            throw new RequiredPropertyNotFoundException('shop_delivery_options');
        }
    }


    /**
     * {@inheritdoc}
     */
    protected function setShopName($shop_name)
    {
        if ((!is_string($shop_name)) || (mb_strlen($shop_name) > 20)) {
            throw new NotValidationPropertyException('shop_name');
        }
        parent::setShopName($shop_name);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopCompany($shop_company)
    {
        if (!is_string($shop_company)) {
            throw new NotValidationPropertyException('shop_company');
        }
        parent::setShopCompany($shop_company);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopUrl($shop_url)
    {
        /**
         * url only ASCII!!!
         * URL главной страницы магазина. Максимальная длина — 50 символов. Допускаются кириллические ссылки.
         * кириллические ссылки не пройдут проверку
         * нет проверки на http:// https:// ...
         */
        if (!(filter_var($shop_url, FILTER_VALIDATE_URL))) {
            throw new NotValidationPropertyException('shop_url');
        }
        if (mb_strlen($shop_url) > 50) {
            throw new NotValidationPropertyException('shop_url');
        }

        parent::setShopUrl($shop_url);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopPlatform($shop_platform)
    {
        if (!is_string($shop_platform)) {
            throw new NotValidationPropertyException('shop_platform');
        }
        parent::setShopPlatform($shop_platform);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopVersion($shop_version)
    {
        if (!is_string($shop_version)) {
            throw new NotValidationPropertyException('shop_version');
        }
        parent::setShopVersion($shop_version);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopAgency($shop_agency)
    {
        if (!is_string($shop_agency)) {
            throw new NotValidationPropertyException('shop_agency');
        }
        parent::setShopAgency($shop_agency);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopEmail($shop_email)
    {
        if (!(filter_var($shop_email, FILTER_VALIDATE_EMAIL))) {
            throw new NotValidationPropertyException('shop_email');
        }
        parent::setShopEmail($shop_email);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopCurrencies($shop_currencies)
    {
        if (!is_array($shop_currencies)) {
            throw new NotValidationPropertyException('shop_currencies');
        }
        foreach ($shop_currencies as $key => $value) {

            if (!in_array($key, ['RUR', 'USD', 'EUR', 'UAH', 'KZT'],true)) {
                throw new NotValidationPropertyException('shop_currencies');
            }

            if (!in_array($value, ['CBRF', 'NBU', 'NBK', 'СВ'],true)) {
                if (!is_numeric($value)) {
                    throw new NotValidationPropertyException('shop_currencies');
                }
            }
        }
        parent::setShopCurrencies($shop_currencies);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopCategories($shop_categories)
    {
        if (!is_array($shop_categories)) {
            throw new NotValidationPropertyException('shop_categories');
        }

        foreach ($shop_categories as $key => $category) {
            if (!is_int($key)) {
                throw new NotValidationPropertyException('shop_categories');
            }

            if ((!isset($category['name'])) && (!is_string($category['name']))) {
                throw new NotValidationPropertyException('shop_categories');
            }
            if (count($category) > 2) {
                throw new NotValidationPropertyException('shop_categories');
            }

            if (count($category) == 2) {
                if ((!isset($category['parentId'])) || (!isset($shop_categories[$category['parentId']]))) {
                    throw new NotValidationPropertyException('shop_categories');
                }
            }
        }
        parent::setShopCategories($shop_categories);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopDeliveryOptions($shop_delivery_options)
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
        parent::setShopDeliveryOptions($shop_delivery_options);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopCpa($shop_cpa)
    {
        if ((!is_numeric($shop_cpa)) || ($shop_cpa != 1 || 0 )) {
            throw new NotValidationPropertyException('shop_cpa');
        }
        parent::setShopCpa($shop_cpa);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopAdult($adult)
    {
        if ((!is_bool($adult)) || (!$adult)) {
            throw new NotValidationPropertyException('adult');
        }
        parent::setShopAdult($adult);
    }

    /**
     * {@inheritdoc}
     */
    protected function setShopOffers($shop_offers)
    {
        if (!($shop_offers instanceof MarketYandexOffers)) {
            throw new NotValidationPropertyException('shop_offers');
        }
        parent::setShopOffers($shop_offers);
    }

}