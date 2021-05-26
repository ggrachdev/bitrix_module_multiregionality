<?php

namespace GGrach\Multiregionality\Utils;

class UrlNormalizer {

    public static function normalize(string $url): string {
        if ($url !== null) {
            $url = trim($url);
            if (!empty($url)) {

                if (stripos($url, 'http') === false && stripos($url, 'https') === false) {
                    $url = 'https://' . $url;
                }

                $url = str_replace([
                    '///'
                    ], [
                    '//'
                    ], $url);
            }
        }

        return $url;
    }

}
