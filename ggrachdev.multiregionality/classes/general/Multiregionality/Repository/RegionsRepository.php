<?php

namespace GGrach\Multiregionality\Repository;

use GGrach\Multiregionality\Contract\IRegionsRepository;
use GGrach\Multiregionality\Contract\IConfigurator;
use GGrach\Multiregionality\Entity\Region;
use \Bitrix\Iblock\Iblock;

class RegionsRepository implements IRegionsRepository {

    private $configurator;
    private $iblockEntityClassName;
    private $iblockIdRepository;

    public function __construct(IConfigurator $configurator) {
        $this->configurator = $configurator;

        if (\Bitrix\Main\Loader::includeModule('iblock')) {
            $res = \CIBlock::GetList([],
                    [
                        "CODE" => $this->configurator->getCodeIblockRegionsCode()
                    ],
                    true
            );

            if ($arResIblock = $res->Fetch()) {
                $this->iblockIdRepository = $arResIblock['ID'];
                $this->iblockEntityClassName = Iblock::wakeUp($arResIblock['ID'])->getEntityDataClass();
            }
        }
    }

    public function create(): bool {
        $resultCreate = false;

        if (empty($this->iblockIdRepository)) {

            global $DB;

            // Добавление типа инфоблоков
            $arFields = [
                'ID' => $this->configurator->getCodeTypeIblockRegionsCode(),
                'SECTIONS' => 'N',
                'IN_RSS' => 'N',
                'SORT' => 100,
                'LANG' => [
                    'ru' => [
                        'NAME' => 'Мультирегиональность',
                        'SECTION_NAME' => 'Секции',
                        'ELEMENT_NAME' => 'Регионы'
                    ],
                    'en' => [
                        'NAME' => 'Multiregionality',
                        'SECTION_NAME' => 'Sections',
                        'ELEMENT_NAME' => 'Products'
                    ]
                ]
            ];

            $obBlocktype = new \CIBlockType();
            $DB->StartTransaction();
            $res = $obBlocktype->Add($arFields);
            if (!$res) {
                $DB->Rollback();
                //  echo 'Error: ' . $obBlocktype->LAST_ERROR . '<br>';
            } else {
                $DB->Commit();
            }

            // Добавление инфоблока
            $ib = new \CIBlock();
            $arFieldsIblock = [
                "ACTIVE" => "Y", // флаг указывающий, что информационный блок является активным
                "NAME" => "Регионы", // название создаваемого информационного блока(!! обязательно для заполнения)
                "CODE" => $this->configurator->getCodeIblockRegionsCode(), // код создаваемого информационного блока
                "API_CODE" => $this->configurator->getCodeIblockRegionsApi(), // код создаваемого информационного блока
//            "LIST_PAGE_URL" => "#SITE_DIR#/multiregionality/index.php?ID=#IBLOCK_ID#",
//            "SECTION_PAGE_URL" => "#SITE_DIR#/multiregionality/list.php?SECTION_ID=#SECTION_ID#", //URL страницы раздела
//            "DETAIL_PAGE_URL" => "#SITE_DIR#/multiregionality/detail.php?ID=#ELEMENT_ID#",
                "CANONICAL_PAGE_URL" => "", // Если не указать сохранится как NULL, а после пересохранения из интерфейса Bitrix как пустая строка
                "IBLOCK_TYPE_ID" => $this->configurator->getCodeTypeIblockRegionsCode(), // Id типа информационного блока в который производится добавление нового информационного блока
                "SITE_ID" => ["s1"], // Сайты к которым осуществляется приявзка
                "SORT" => "500", // сортировка
                "DESCRIPTION" => "Текст описания", // текст описания, обычно пустое
                "DESCRIPTION_TYPE" => "text", // тип текста описания text или html, в данном примере указан text так, как при создании инфоблока из админки по умолчанию будет установлен такой
                "GROUP_ID" => ["2" => "R"], // установка доступов к инфоблоку. 2 - группа все пользователи. Права следующие: D - нет доступа, R - чтение, U - документооборот, W - запись, X - полный доступ
                "LIST_MODE" => "", //Создаётся как NULL если не указать
// В тех примерах которые я нашел в Интернет не передавались параметры ниже этой строчки, тем не менее я описываю их в данном массиве, с целью создания информационного блока из API аналогичного тому который создаётся из административной панели, расхождения которые возможны описаны в комментариях к параметрам
                "SECTION_PROPERTY" => false, // Если не передавать изначально будет установлено в NULL, после пересохранения в N. Если при создании установить в "1" по будет Y после пересохранения из админки N.Даже если установить в Y, после пересохранения информации с настройками инфоблока будет установлено в N, А если установить в N то всё равно при создании будет Y, а после пересохранения из админки N
                "WORKFLOW" => "N", // Если не указать то создаётся Y, затем после пересохранения настроек инфоблока из админки в N
                "PROPERTY_INDEX" => "N", // Если не указать то после создания будет NULL а после пересохранения из админки N, если при создании установить в N то N и будет.
                "EDIT_FILE_BEFORE" => "", // Если не устанавливать то при создании будет NULL а после пересохранения из админки пустая строка, если сразу установить пустую строку то она будет при создании и после сохранения из админки
                "EDIT_FILE_AFTER" => "",
                "SECTIONS_NAME" => "Разделы", // Если не установить при создании будет NULL после сохранения из админки Разделы
                "SECTION_NAME" => "Раздел", // Если не установить при создании будет NULL после сохранения из админки Раздел
                "ELEMENTS_NAME" => "Регионы", // Если не установить при создании будет NULL, после сохранения из админки Элементы
                "ELEMENT_NAME" => "Регион", // Если не установить при создании будет NULL, после сохранения из админки Элемент
                "ELEMENT_ADD" => "Добавить регион",
                "ELEMENT_EDIT" => "Изменить регион",
                "ELEMENT_DELETE" => "Удалить регион",
            ];

            $iblockId = $ib->Add($arFieldsIblock);

            $resultCreate = $iblockId > 0;
        }
        else
        {
            $iblockId = $this->iblockIdRepository;
        }

        if ($resultCreate) {
            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "URL региона",
                "ACTIVE" => "Y",
                "SORT" => 1000,
                "CODE" => $this->configurator->getCodePropertyUrlRegion(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Какой?) 1 #FORM_NAME_REGION_1#",
                "ACTIVE" => "Y",
                "SORT" => 1100,
                "CODE" => $this->configurator->getCodePropertyFormName1(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Какое?) 2 #FORM_NAME_REGION_2#",
                "ACTIVE" => "Y",
                "SORT" => 1200,
                "CODE" => $this->configurator->getCodePropertyFormName2(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Какая?) 3 #FORM_NAME_REGION_3#",
                "ACTIVE" => "Y",
                "SORT" => 1300,
                "CODE" => $this->configurator->getCodePropertyFormName3(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Какие?) 4 #FORM_NAME_REGION_4#",
                "ACTIVE" => "Y",
                "SORT" => 1400,
                "CODE" => $this->configurator->getCodePropertyFormName4(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Где?) 5 #FORM_NAME_REGION_5#",
                "ACTIVE" => "Y",
                "SORT" => 1500,
                "CODE" => $this->configurator->getCodePropertyFormName5(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);

            $ibp = new \CIBlockProperty();
            $arFieldsProperty = [
                "NAME" => "Форма имени региона (Откуда? Из?) 6 #FORM_NAME_REGION_6#",
                "ACTIVE" => "Y",
                "SORT" => 1600,
                "CODE" => $this->configurator->getCodePropertyFormName6(),
                "PROPERTY_TYPE" => "S",
                "IBLOCK_ID" => $iblockId
            ];
            $propId = $ibp->Add($arFieldsProperty);
        }

        return $resultCreate;
    }

    public function getFilteredList(array $arFilter = []): array {
        $arList = [];

        if (!empty($this->iblockEntityClassName)) {
            $dbRegions = $this->iblockEntityClassName::getList([
                    "cache" => ["ttl" => 3600],
                    "filter" => $arFilter,
                    'select' => [
                        'ID',
                        'NAME',
                        'CODE',
                        $this->configurator->getCodePropertyUrlRegion() . '_' => $this->configurator->getCodePropertyUrlRegion(),
                        $this->configurator->getCodePropertyFormName1() . '_' => $this->configurator->getCodePropertyFormName1(),
                        $this->configurator->getCodePropertyFormName2() . '_' => $this->configurator->getCodePropertyFormName2(),
                        $this->configurator->getCodePropertyFormName3() . '_' => $this->configurator->getCodePropertyFormName3(),
                        $this->configurator->getCodePropertyFormName4() . '_' => $this->configurator->getCodePropertyFormName4(),
                        $this->configurator->getCodePropertyFormName5() . '_' => $this->configurator->getCodePropertyFormName5(),
                        $this->configurator->getCodePropertyFormName6() . '_' => $this->configurator->getCodePropertyFormName6()
                    ]
            ]);

            $resRegions = $dbRegions->fetchAll();

            if (!empty($resRegions)) {
                foreach ($resRegions as $regionItem) {
                    $region = new Region();
                    $region->setName($regionItem['NAME']);
                    $region->setId($regionItem['ID']);
                    $region->setUrl($regionItem[$this->configurator->getCodePropertyUrlRegion() . '_VALUE']);
                    $region->setNameForms([
                        $regionItem[$this->configurator->getCodePropertyFormName1() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName2() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName3() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName4() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName5() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName6() . '_VALUE'],
                    ]);
                    $arList[] = $region;
                }
            }
        }

        return $arList;
    }

    public function getList(): array {
        $arList = [];

        if (!empty($this->iblockEntityClassName)) {
            $dbRegions = $this->iblockEntityClassName::getList([
                    "cache" => ["ttl" => 3600],
                    'select' => [
                        'ID',
                        'NAME',
                        'CODE',
                        $this->configurator->getCodePropertyUrlRegion() . '_' => $this->configurator->getCodePropertyUrlRegion(),
                        $this->configurator->getCodePropertyFormName1() . '_' => $this->configurator->getCodePropertyFormName1(),
                        $this->configurator->getCodePropertyFormName2() . '_' => $this->configurator->getCodePropertyFormName2(),
                        $this->configurator->getCodePropertyFormName3() . '_' => $this->configurator->getCodePropertyFormName3(),
                        $this->configurator->getCodePropertyFormName4() . '_' => $this->configurator->getCodePropertyFormName4(),
                        $this->configurator->getCodePropertyFormName5() . '_' => $this->configurator->getCodePropertyFormName5(),
                        $this->configurator->getCodePropertyFormName6() . '_' => $this->configurator->getCodePropertyFormName6()
                    ]
            ]);

            $resRegions = $dbRegions->fetchAll();

            if (!empty($resRegions)) {
                foreach ($resRegions as $regionItem) {
                    $region = new Region();
                    $region->setName($regionItem['NAME']);
                    $region->setId($regionItem['ID']);
                    $region->setUrl($regionItem[$this->configurator->getCodePropertyUrlRegion() . '_VALUE']);
                    $region->setNameForms([
                        $regionItem[$this->configurator->getCodePropertyFormName1() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName2() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName3() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName4() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName5() . '_VALUE'],
                        $regionItem[$this->configurator->getCodePropertyFormName6() . '_VALUE'],
                    ]);
                    $arList[] = $region;
                }
            }
        }

        return $arList;
    }

}
