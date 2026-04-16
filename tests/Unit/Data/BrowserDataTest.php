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
    }
}
