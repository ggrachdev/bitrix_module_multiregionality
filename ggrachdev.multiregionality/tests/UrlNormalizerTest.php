<?php

use PHPUnit\Framework\TestCase;

class UrlNormalizerTest extends TestCase {

    /**
     * @dataProvider urlProvider
     */
    public function testNotice($url, $normalizedUrl) {
        $url = GGrach\Multiregionality\Utils\UrlNormalizer::normalize($url);
        $this->assertSame($url, $normalizedUrl);
    }

    public function urlProvider() {
        return [
            [
                'https://msk.test.ru',
                'https://msk.test.ru'
            ],
            [
                'http://msk.test.ru',
                'http://msk.test.ru'
            ],
            [
                'http://test.ru',
                'http://test.ru'
            ],
            [
                'test.ru',
                'https://test.ru'
            ],
            [
                'test.ru/',
                'https://test.ru'
            ],
            [
                ' http://test.ru',
                'http://test.ru'
            ],
            [
                'http://test.ru  ',
                'http://test.ru'
            ],
            [
                'dsadasd',
                'https://dsadasd'
            ],
            [
                'http:///test.ru',
                'http://test.ru'
            ],
            [
                'http:///test.ru/',
                'http://test.ru'
            ],
            [
                '//////test.ru/',
                'https://test.ru'
            ],
            [
                'https:////////test.ru/',
                'https://test.ru'
            ],
            [
                'http://www.test.ru/',
                'http://test.ru'
            ],
            [
                'https:////////www.test.ru/',
                'https://test.ru'
            ],
            [
                'https:////////test/',
                'https://test'
            ],
            [
                '   https:////////test/     ',
                'https://test'
            ],
            [
                '',
                ''
            ],
            [
                'xn--80afej9aap.xn--p1ai',
                'https://xn--80afej9aap.xn--p1ai'
            ],
            [
                'www.xn--80afej9aap.xn--p1ai',
                'https://xn--80afej9aap.xn--p1ai'
            ],
        ];
    }

}
