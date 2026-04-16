<?php

namespace Atldays\Agent\Tests;

use Atldays\Agent\Enums\DeviceType;
use PHPUnit\Framework\TestCase;

class DeviceTypeTest extends TestCase
{
    public function test_it_knows_existing_values(): void
    {
        $this->assertTrue(DeviceType::hasValue('desktop'));
        $this->assertFalse(DeviceType::hasValue('unknown'));
    }

    public function test_it_returns_values_as_array(): void
    {
        $this->assertContains('desktop', DeviceType::toArray());
        $this->assertContains('smartphone', DeviceType::toArray());
    }
}
