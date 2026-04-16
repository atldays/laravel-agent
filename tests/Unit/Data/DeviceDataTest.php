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
    }

    public function test_it_falls_back_to_desktop_for_unknown_type(): void
    {
        $device = new Device('Spaceship');

        $this->assertSame(DeviceType::Desktop, $device->type());
    }
}
