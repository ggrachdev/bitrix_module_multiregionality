<?php

namespace GGrach\Multiregionality\Entity;

final class Region {

    protected $id;
    protected $name;
    protected $isDefaultRegion;
    protected $nameForms = [];
    protected $url;
    protected $arLocationIds;
    protected $arLocationsData = null;
    protected $arPricesData = [];
    protected $data = [];

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setLocationIds($arLocationIds) {
        $this->arLocationIds = \array_filter($arLocationIds, function($location) {
            return \is_numeric($location) && $location > 0;
        });
    }

    public function setPricesData($arPrices) {
        
        $arPricesData = [];
        
        if(!empty($arPrices)) {
            foreach ($arPrices as $arPrice) {
                if(
                    isset($arPrice['VALUE']) && 
                    isset($arPrice['ID'])
                )
                {
                    $arPricesData[] = [
                      'CODE' => $arPrice['VALUE'],
                      'ID' => $arPrice['ID']
                    ];
                }
            }
        }
        
        $this->arPricesData = $arPricesData;
    }

    public function getTypePrices(): array {
        return $this->arPricesData;
    }

    public function getLocations(): array {
        if($this->arLocationsData === null)
        {
            if(!empty($this->arLocationIds) && \Bitrix\Main\Loader::includeModule('sale'))
            {
                $arPriceIds = [];
                        
                $dbLocations = \Bitrix\Sale\Location\LocationTable::getList([
                    'filter' => [
                        '=ID' => $this->arLocationIds,
                        'SALE_LOCATION_LOCATION_NAME_LANGUAGE_ID' => 'ru'
                    ],
                    'select' => [
                        'ID',
                        'CODE',
                        'NAME'
                    ]
                ]);
                
                $this->arLocationsData = $dbLocations->fetchAll();
            }
            else
            {
                $this->arLocationsData = [];
            }
        }
        
        return $this->arLocationsData;
    }

    public function getNameForms(): array {
        return $this->nameForms;
    }

    public function getUrl() {
        return $this->url;
    }

    public function getData(): array {
        return $this->data;
    }

    public function getProperty(string $propertyCode) {
        $arProperty = $this->getData()[$propertyCode];
        
        return empty($arProperty) ? null : $arProperty;
    }

    public function isDefaultRegion(): bool {
        return $this->isDefaultRegion === true;
    }


    public function setId($id): void {
        $this->id = $id;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setIsDefaultRegion(bool $isDefaultRegion): void {
        $this->isDefaultRegion = $isDefaultRegion;
    }

    public function setNameForms(array $nameForms): void {
        $this->nameForms = $nameForms;
    }

    public function setUrl($url): void {
        $this->url = $url;
    }

    public function setData($data): void {
        $this->data = $data;
    }

}
