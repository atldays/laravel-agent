<?php

namespace Atldays\Agent\Tests\Unit\Data;

use Atldays\Agent\Data\Browser;
use Atldays\Agent\Tests\TestCase;

class BrowserDataTest extends TestCase
{
    public function test_it_maps_snake_case_input(): void
    {
        $browser = Browser::from([
            'name' => 'Chrome',
            'short_name' => 'CH',
            'version' => '135.0',
            'family' => 'Chrome',
            'engine' => 'Blink',
            'engine_version' => '135.0',
        ]);

        $this->assertSame('Chrome', $browser->name());
        $this->assertSame('CH', $browser->shortName());
        $this->assertSame('135.0', $browser->version());
        $this->assertSame('Chrome', $browser->family());
        $this->assertSame('Blink', $browser->engine());
        $this->assertSame('135.0', $browser->engineVersion());
        $this->assertTrue($browser->isChrome());
        $this->assertFalse($browser->isEdge());
        $this->assertFalse($browser->isFirefox());
        $this->assertFalse($browser->isOpera());
        $this->assertFalse($browser->isSafari());
    }

    public function test_it_detects_edge_browser(): void
    {
        $browser = Browser::from([
            'name' => 'Microsoft Edge',
            'short_name' => 'ED',
            'family' => 'Edge',
        ]);

        $this->assertTrue($browser->isEdge());
        $this->assertFalse($browser->isChrome());
        $this->assertFalse($browser->isFirefox());
        $this->assertFalse($browser->isOpera());
        $this->assertFalse($browser->isSafari());
    }

    public function test_it_detects_firefox_browser(): void
    {
        $browser = Browser::from([
            'name' => 'Firefox',
            'short_name' => 'FF',
            'family' => 'Firefox',
        ]);

        $this->assertTrue($browser->isFirefox());
        $this->assertFalse($browser->isChrome());
        $this->assertFalse($browser->isEdge());
        $this->assertFalse($browser->isOpera());
        $this->assertFalse($browser->isSafari());
    }

    public function test_it_detects_opera_browser(): void
    {
        $browser = Browser::from([
            'name' => 'Opera',
            'short_name' => 'OP',
            'family' => 'Opera',
        ]);

        $this->assertTrue($browser->isOpera());
        $this->assertFalse($browser->isChrome());
        $this->assertFalse($browser->isEdge());
        $this->assertFalse($browser->isFirefox());
        $this->assertFalse($browser->isSafari());
    }
}
