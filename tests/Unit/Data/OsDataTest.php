<?php

namespace Atldays\Agent\Tests\Unit\Data;

use Atldays\Agent\Data\Os;
use Atldays\Agent\Tests\TestCase;

class OsDataTest extends TestCase
{
    public function test_it_maps_snake_case_input(): void
    {
        $os = Os::from([
            'name' => 'iOS',
            'short_name' => 'IOS',
            'version' => '17.0',
            'family' => 'iOS',
            'platform' => 'ARM',
        ]);

        $this->assertSame('iOS', $os->name());
        $this->assertSame('IOS', $os->shortName());
        $this->assertSame('17.0', $os->version());
        $this->assertSame('iOS', $os->family());
        $this->assertSame('ARM', $os->platform());
    }
}
