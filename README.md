****
**Yandex Market Yml**

Библиотека для генерации YML файла

https://yandex.ru/support/partnermarket/yml/about-yml.html

>Это библиотека не готова на 100%, ее нельзя использовать! Не было проведененно UNIT тестирование!
>Библиотека теоретически должна работать правильно, при правильных входных данных.
>Если вы увидите плохое решение в коде, пожалуйста сообщите мне об этом <klevunin@gmail.com> 
>Лицензия MIT 

**Use**

>Эту библеотеку можно установить с помощью Composer <https://getcomposer.org/>
```php
"repositories": [
        {
            "type": "git",
            "url":  "git@github.com:klevunin/YandexMarketYml.git"
        }
    ],
"require-dev": {
    "klev/yandex-market-yml": "*"
},
```

>У вас должен быть набор данных по вашим товарам. 
 Вы должны скормить библиотеки массив данных $shop=[]; 
 Эти данные формируют ```<shop></shop>```
 Вы скорей всего будите обходить ваши товары и с какими-то вашими условиями записывать их в YML. По этой причине у меня реализовано добавление одного ```<offer/>```
 Вы должны передать массив с данными $offer=[];


```php
use Klev\Yandex\YmlCreate\Yml\YandexYml;

require_once __DIR__ . '/../vendor/autoload.php';

$Yml = new YandexYml();
$Yml->setShop(new MarketYandexShopValidation($shop));
foreach ($offers as $offer) {
 $Yml->setOffers(new MarketYandexOfferValidation($offer));
}

```
*Или сделать все тоже самое но без проверки валидации данных*
```php
$Yml = new YandexYml();
$Yml->setShop(new MarketYandexShop($shop));
foreach ($offers as $offer) {
 $Yml->setOffers(new MarketYandexOffer($offer));
}
```
>При ошибки валидации я буду кидать исключения подкласса ```KlevYandexYmlCreateException```. 
Это может быть полезно на стадии настройки. 

>Вы можете запросить метод, что бы увидеть текущий результат:

```php
$Yml->getEchoXML();
```

>Чтобы сохранить в файл, нужно вызвать метод с указанием имени файла:
```php
$Yml->saveToFile($file);
```


