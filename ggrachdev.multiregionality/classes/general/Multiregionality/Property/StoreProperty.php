<?php

namespace GGrach\Multiregionality\Property;

class StoreProperty {

    public function GetUserTypeDescription() {
        return [
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "STORES",
            "DESCRIPTION" => "Склады",
            "GetPropertyFieldHtml" => [StoreProperty::class, 'GetPropertyFieldHtml'],
            'ConvertToDB' => [StoreProperty::class, 'ConvertToDB'],
            'ConvertFromDB' => [StoreProperty::class, 'ConvertFromDB']
        ];
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName) {
        $value = unserialize($value['VALUE']);

        $html = '';

        if (\Bitrix\Main\Loader::includeModule('catalog')) {
            $html .= '<select name="' . $strHTMLControlName['VALUE'] . '[]" multiple>';
            $html .= '<option value="0">Не выбрано</option>';
            $dbStorageType = \CCatalogStore::GetList(["SORT" => "ASC", "ID" => "ASC"]);
            while ($arStorageType = $dbStorageType->Fetch()) {
                $selected = '';
                if (in_array($arStorageType['TITLE'] . '###' . $arStorageType['ID'], $value['VALUE'])) {
                    $selected = 'selected';
                }

                $html .= '<option value="' . $arStorageType['TITLE'] . '###' . $arStorageType['ID'] . '" ' . $selected . '>[' . $arStorageType['ID'] . '] ' . $arStorageType['TITLE'] . '</option>';
            }
            $html .= '</select>';
        }

        return $html;
    }

    public function ConvertToDB($arProperty, $value) {
        if (count($value['VALUE']) > 0) {
            return serialize($value);
        }
    }

    public function ConvertFromDB($arProperty, $value) {
        return $value;
    }

}
