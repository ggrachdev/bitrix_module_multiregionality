Что делает модуль?
--------------------------  
Модуль позволяет организовать мультирегиональность на Вашем сайте исходя из текущего url, например, 
зашли на moscow.site.ru - будут одни данные, зашли на spb.site.ru - другие.
В данный момент модуль может подставлять только формы названия города (Московский, Московская, Московское, Москва, Москве и тп, их заполняете самостоятельно), в будущем появится привязка к типам цен. Присутствует возможность добавлять пользовательские поля. 
Чтобы модуль заработал нужно установить модуль, заполнить регионы и в init.php подключить модуль:

```php
\Bitrix\Main\Loader::includeModule('ggrachdev.multiregionality');
```

Теперь на странице вы можете вставлять плейсхолдеры:

```html
#NAME_REGION#
#FORM_NAME_REGION_1#
#FORM_NAME_REGION_2#
#FORM_NAME_REGION_3#
#FORM_NAME_REGION_4#
#FORM_NAME_REGION_5#
#FORM_NAME_REGION_6#
```

Они будут заменены на данные региона из инфоблока, можете так же работать с модулем через код:

```php
$regions = \GGrach\Multiregionality\RegionsFactory::getInstance();

// Все регионы, массив array<GGrach\Multiregionality\Entity\Region>
$arRegions = $regions->getRegionsData();

// Данные текущего региона GGrach\Multiregionality\Entity\Region
$nowRegion = $regions->getNowRegionData();

Доступные методы:
$nowRegion->getId();
$nowRegion->getName();
$nowRegion->getNameForms();
$nowRegion->getUrl();
$nowRegion->getData();
// Получить данные вашего свойства, префикс PROPERTY_ писать не надо
$nowRegion->getProperty('CUSTOM_PROPERTY_CODE');
$nowRegion->isDefaultRegion();

// Вместо вызова \GGrach\Multiregionality\RegionsFactory::getInstance() вы можете получить инстанцию:
$regions = MRG();
$arRegions = $regions->getRegionsData();
$arRegions = MRG()->getRegionsData();
// ...
```

Если вам нужно определить текущий регион не исходя из текущего url, то передайте в фабрику параметр:
```php
$regions = \GGrach\Multiregionality\RegionsFactory::getInstance('irkutsk.site.ru');
```

События:
```php
// 1) OnAfterGetListRegions - После первичного получения регионов из репозитория, вторичное получение будет закешировано

// Пример вызова:
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'ggrachdev.multiregionality',
    "OnAfterGetListRegions",
    "OnAfterGetListRegionsHandler"
);
/**
 * @param array<\GGrach\Multiregionality\Entity\Region> $arList - 
 * @param array $arFilter - переданный фильтр
 * @return type
 */
function OnAfterGetListRegionsHandler(array $arList, array $arFilter) {
    return $arList;
}


// 2) OnAfterDeterminateRegionHandler - После определения текущего региона, нужно вернуть \GGrach\Multiregionality\Entity\Region

// Пример создания слушателя:
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'ggrachdev.multiregionality',
    "OnAfterDeterminateRegion",
    "OnAfterDeterminateRegionHandler"
);

/**
 * @param string $url - Определенный модулем текущий url
 * @param \GGrach\Multiregionality\Contract\IRegionsRepository $repository
 * @param \GGrach\Multiregionality\Entity\Region $determinateRegion
 * @return \GGrach\Multiregionality\Entity\Region
 */
function OnAfterDeterminateRegionHandler(
    string $url, 
    \GGrach\Multiregionality\Contract\IRegionsRepository $repository, 
    \GGrach\Multiregionality\Entity\Region $determinateRegion
) {
    return $determinateRegion;
}
```
