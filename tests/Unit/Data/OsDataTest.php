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
        $this->assertTrue($os->isApple());
        $this->assertTrue($os->isIos());
        $this->assertFalse($os->isAndroid());
        $this->assertFalse($os->isLinux());
        $this->assertFalse($os->isMacOs());
        $this->assertFalse($os->isWindows());
    }

    public function test_it_detects_linux_operating_system(): void
    {
        $os = Os::from([
            'name' => 'GNU/Linux',
            'short_name' => 'LIN',
            'family' => 'Linux',
        ]);

        $this->assertTrue($os->isLinux());
        $this->assertFalse($os->isApple());
        $this->assertFalse($os->isAndroid());
        $this->assertFalse($os->isIos());
        $this->assertFalse($os->isMacOs());
        $this->assertFalse($os->isWindows());
    }

    public function test_it_detects_macos_operating_system(): void
    {
        $os = Os::from([
            'name' => 'macOS',
            'short_name' => 'MAC',
            'family' => 'macOS',
        ]);

        $this->assertTrue($os->isApple());
        $this->assertTrue($os->isMacOs());
        $this->assertFalse($os->isAndroid());
        $this->assertFalse($os->isIos());
        $this->assertFalse($os->isLinux());
        $this->assertFalse($os->isWindows());
    }
}
