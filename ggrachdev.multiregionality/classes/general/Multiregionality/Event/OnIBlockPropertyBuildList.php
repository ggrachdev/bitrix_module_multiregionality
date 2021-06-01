<?php

namespace GGrach\Multiregionality\Event;
    
class OnIBlockPropertyBuildList {
    
    public function listen() {
        
    }

}

/*
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("ChangeCityPrice", "GetUserTypeDescription"));

class ChangeCityPrice {

    public function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"        => "S",
            "USER_TYPE"            => "TYPE_PRICE",
            "DESCRIPTION"          => "Тип цены",
            "GetPropertyFieldHtml" => array("ChangeCityPrice", "GetPropertyFieldHtml"),
            'ConvertToDB'          => array('ChangeCityPrice', 'ConvertToDB'),
            'ConvertFromDB'        => array('ChangeCityPrice', 'ConvertFromDB')
        );
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $value = unserialize($value['VALUE']);

        CModule::IncludeModule("catalog");
        
        $html = '';
        $html .= '<select name="' . $strHTMLControlName['VALUE'] . '[]" multiple>';
        $html .= '<option value="0">Не выбрано</option>';
        $dbPriceType = CCatalogGroup::GetList(array("SORT" => "ASC", "ID" => "ASC"));
        while ($arPriceType = $dbPriceType->Fetch())
        {
            $selected = '';
            if (in_array($arPriceType['NAME'], $value['VALUE'])) {
                $selected = 'selected';
            }

            $html .= '<option value="' . $arPriceType['NAME'] . '" ' . $selected . '>[' . $arPriceType['ID'] . '] ' . $arPriceType['NAME_LANG'] . '</option>';
        }	
        $html .= '</select>';

        return $html;
    }

    function ConvertToDB($arProperty, $value)
    {
        if(count($value['VALUE']) > 0)
            return serialize($value);
    }
     
    function ConvertFromDB($arProperty, $value)
    {
        return $value;
    }

}

AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("ChangeCityStorage", "GetUserTypeDescription"));

class ChangeCityStorage {

    public function GetUserTypeDescription()
    {
        return array(
            "PROPERTY_TYPE"        => "S",
            "USER_TYPE"            => "STORAGE",
            "DESCRIPTION"          => "Склады",
            "GetPropertyFieldHtml" => array("ChangeCityStorage", "GetPropertyFieldHtml"),
            'ConvertToDB'          => array('ChangeCityStorage', 'ConvertToDB'),
            'ConvertFromDB'        => array(ChangeCityStorage::class, 'ConvertFromDB')
        );
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName)
    {
        $value = unserialize($value['VALUE']);

        CModule::IncludeModule("catalog");
        
        $html = '';
        $html .= '<select name="' . $strHTMLControlName['VALUE'] . '[]" multiple>';
        $html .= '<option value="0">Не выбрано</option>';
        $dbStorageType = CCatalogStore::GetList(array("SORT" => "ASC", "ID" => "ASC"));
        while ($arStorageType = $dbStorageType->Fetch())
        {
            $selected = '';
            if (in_array($arStorageType['ID'], $value['VALUE'])) {
                $selected = 'selected';
            }

            $html .= '<option value="' . $arStorageType['ID'] . '" ' . $selected . '>[' . $arStorageType['ID'] . '] ' . $arStorageType['TITLE'] . '</option>';
        }	
        $html .= '</select>';

        return $html;
    }

    function ConvertToDB($arProperty, $value)
    {
        if(count($value['VALUE']) > 0)
            return serialize($value);
    }
     
    function ConvertFromDB($arProperty, $value)
    {
        return $value;
    }

}
*/