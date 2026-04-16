<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\AgentFactory;
use Atldays\Agent\Tests\TestCase;

class AgentServiceProviderTest extends TestCase
{
    public function test_it_registers_factory_as_singleton(): void
    {
        $first = $this->app->make(AgentFactory::class);
        $second = $this->app->make(AgentFactory::class);

        $this->assertSame($first, $second);
    }
}
