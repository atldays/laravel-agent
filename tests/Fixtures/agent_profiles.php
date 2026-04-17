<?php

return [
    'chrome_windows_desktop' => [
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Chrome',
            'browser_checks' => ['isChrome' => true, 'isEdge' => false, 'isFirefox' => false, 'isOpera' => false, 'isSafari' => false],
            'os' => 'Windows',
            'os_checks' => ['isWindows' => true, 'isAndroid' => false, 'isIos' => false, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'desktop',
            'device_checks' => ['isDesktop' => true, 'isMobile' => false, 'isTablet' => false, 'isPhone' => false, 'isApple' => false, 'isIphone' => false],
        ],
    ],
    'safari_iphone' => [
        'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Mobile Safari',
            'browser_checks' => ['isChrome' => false, 'isEdge' => false, 'isFirefox' => false, 'isOpera' => false, 'isSafari' => true],
            'os' => 'iOS',
            'os_checks' => ['isWindows' => false, 'isAndroid' => false, 'isIos' => true, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'smartphone',
            'device_checks' => ['isDesktop' => false, 'isMobile' => true, 'isTablet' => false, 'isPhone' => true, 'isApple' => true, 'isIphone' => true],
        ],
    ],
    'safari_ipad_tablet' => [
        'user_agent' => 'Mozilla/5.0 (iPad; CPU OS 17_0 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.0 Mobile/15E148 Safari/604.1',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Mobile Safari',
            'browser_checks' => ['isChrome' => false, 'isEdge' => false, 'isFirefox' => false, 'isOpera' => false, 'isSafari' => true],
            'os' => 'iPadOS',
            'os_checks' => ['isWindows' => false, 'isAndroid' => false, 'isIos' => true, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'tablet',
            'device_checks' => ['isDesktop' => false, 'isMobile' => true, 'isTablet' => true, 'isPhone' => false, 'isApple' => true, 'isIphone' => false],
        ],
    ],
    'chrome_android_phone' => [
        'user_agent' => 'Mozilla/5.0 (Linux; Android 14; Pixel 8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Chrome Mobile',
            'browser_checks' => ['isChrome' => true, 'isEdge' => false, 'isFirefox' => false, 'isOpera' => false, 'isSafari' => false],
            'os' => 'Android',
            'os_checks' => ['isWindows' => false, 'isAndroid' => true, 'isIos' => false, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'smartphone',
            'device_checks' => ['isDesktop' => false, 'isMobile' => true, 'isTablet' => false, 'isPhone' => true, 'isApple' => false, 'isIphone' => false],
        ],
    ],
    'edge_windows_desktop' => [
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 Edg/135.0.0.0',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Microsoft Edge',
            'browser_checks' => ['isChrome' => false, 'isEdge' => true, 'isFirefox' => false, 'isOpera' => false, 'isSafari' => false],
            'os' => 'Windows',
            'os_checks' => ['isWindows' => true, 'isAndroid' => false, 'isIos' => false, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'desktop',
            'device_checks' => ['isDesktop' => true, 'isMobile' => false, 'isTablet' => false, 'isPhone' => false, 'isApple' => false, 'isIphone' => false],
        ],
    ],
    'firefox_linux_desktop' => [
        'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Firefox',
            'browser_checks' => ['isChrome' => false, 'isEdge' => false, 'isFirefox' => true, 'isOpera' => false, 'isSafari' => false],
            'os' => 'GNU/Linux',
            'os_checks' => ['isWindows' => false, 'isAndroid' => false, 'isIos' => false, 'isLinux' => true, 'isMacOs' => false],
            'device_type' => 'desktop',
            'device_checks' => ['isDesktop' => true, 'isMobile' => false, 'isTablet' => false, 'isPhone' => false, 'isApple' => false, 'isIphone' => false],
        ],
    ],
    'opera_windows_desktop' => [
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36 OPR/117.0.0.0',
        'expectations' => [
            'is_bot' => false,
            'browser' => 'Opera',
            'browser_checks' => ['isChrome' => false, 'isEdge' => false, 'isFirefox' => false, 'isOpera' => true, 'isSafari' => false],
            'os' => 'Windows',
            'os_checks' => ['isWindows' => true, 'isAndroid' => false, 'isIos' => false, 'isLinux' => false, 'isMacOs' => false],
            'device_type' => 'desktop',
            'device_checks' => ['isDesktop' => true, 'isMobile' => false, 'isTablet' => false, 'isPhone' => false, 'isApple' => false, 'isIphone' => false],
        ],
    ],
    'googlebot' => [
        'user_agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        'expectations' => [
            'is_bot' => true,
            'bot' => 'Googlebot',
        ],
    ],
];
