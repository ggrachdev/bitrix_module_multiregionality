<?php

namespace GGrach\Multiregionality\Property;

class PriceTypeProperty {

    public function GetUserTypeDescription() {
        return [
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "TYPE_PRICE",
            "DESCRIPTION" => "Тип цены",
            "GetPropertyFieldHtml" => [PriceTypeProperty::class, "GetPropertyFieldHtml"],
            'ConvertToDB' => [PriceTypeProperty::class, 'ConvertToDB'],
            'ConvertFromDB' => [PriceTypeProperty::class, 'ConvertFromDB']
        ];
    }

    public function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName) {
        $value = unserialize($value['VALUE']);

        $html = '';

        if (\Bitrix\Main\Loader::includeModule('catalog')) {
            $html .= '<select name="' . $strHTMLControlName['VALUE'] . '[]" multiple>';
            $html .= '<option value="0">Не выбрано</option>';
            $dbPriceType = \CCatalogGroup::GetList(["SORT" => "ASC", "ID" => "ASC"]);
            while ($arPriceType = $dbPriceType->Fetch()) {
                $selected = '';
                if (in_array($arPriceType['NAME'], $value['VALUE'])) {
                    $selected = 'selected';
                }

                $html .= '<option value="' . $arPriceType['NAME'] . '" ' . $selected . '>[' . $arPriceType['ID'] . '] ' . $arPriceType['NAME'] . '</option>';
            }
            $html .= '</select>';
        }

        return $html;
    }

    function ConvertToDB($arProperty, $value) {
        if (count($value['VALUE']) > 0) {
            return serialize($value);
        }
    }

    function ConvertFromDB($arProperty, $value) {
        return $value;
    }

}
