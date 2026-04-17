<?php

namespace Atldays\Agent\Tests\Unit\Data;

use Atldays\Agent\Data\Device;
use Atldays\Agent\Enums\DeviceType;
use Atldays\Agent\Tests\TestCase;

class DeviceDataTest extends TestCase
{
    public function test_it_resolves_known_type(): void
    {
        $device = new Device('smartphone', 'Apple', 'iPhone');

        $this->assertSame(DeviceType::Smartphone, $device->type());
        $this->assertSame('Apple', $device->brand());
        $this->assertSame('iPhone', $device->model());
        $this->assertTrue($device->isMobile());
        $this->assertTrue($device->isPhone());
        $this->assertFalse($device->isTablet());
        $this->assertFalse($device->isDesktop());
        $this->assertTrue($device->isApple());
        $this->assertTrue($device->isIphone());
    }

    public function test_it_falls_back_to_desktop_for_unknown_type(): void
    {
        $device = new Device('Spaceship');

        $this->assertSame(DeviceType::Desktop, $device->type());
        $this->assertTrue($device->isDesktop());
        $this->assertFalse($device->isMobile());
    }
}
