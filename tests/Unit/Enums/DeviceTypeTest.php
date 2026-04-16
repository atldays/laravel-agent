<?php

namespace Atldays\Agent\Tests\Unit\Enums;

use Atldays\Agent\Enums\DeviceType;
use Atldays\Agent\Tests\TestCase;

class DeviceTypeTest extends TestCase
{
    public function test_it_knows_existing_values(): void
    {
        $this->assertTrue(DeviceType::hasValue('desktop'));
        $this->assertTrue(DeviceType::hasValue('portable_media_player'));
        $this->assertFalse(DeviceType::hasValue('unknown'));
    }

    public function test_it_returns_values_as_array(): void
    {
        $this->assertContains('desktop', DeviceType::toArray());
        $this->assertContains('smartphone', DeviceType::toArray());
        $this->assertContains('portable_media_player', DeviceType::toArray());
    }
}
