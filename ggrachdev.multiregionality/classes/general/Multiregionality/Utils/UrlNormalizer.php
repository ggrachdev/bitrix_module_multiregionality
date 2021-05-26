<?php

namespace GGrach\Multiregionality\Utils;

class UrlNormalizer {

    public static function normalize(string $url) {
        if ($url !== null) {

            $url = trim($url);

            if (!empty($url)) {

                $url = trim($url, '/');

                if (stripos($url, 'http') === false && stripos($url, 'https') === false) {
                    $url = 'https://' . $url;
                }

                $url = preg_replace([
                    '~///*~',
                    '~www\.~'
                    ], [
                    '//',
                    ''
                    ], $url);
            }
        }

        return $url;
    }

}
