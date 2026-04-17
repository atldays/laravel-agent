<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\AgentFactory;
use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Http\Middleware\BlockBots;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;
use stdClass;

class AgentServiceProviderTest extends TestCase
{
    public function test_it_registers_factory_as_singleton(): void
    {
        $first = $this->app->make(AgentFactory::class);
        $second = $this->app->make(AgentFactory::class);

        $this->assertSame($first, $second);
    }

    public function test_it_resolves_agent_contract_from_current_request(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->app->instance('request', $request);

        $agent = $this->app->make(AgentContract::class);

        $this->assertSame('Chrome', $agent->browser()?->name());
    }

    public function test_it_resolves_agent_contract_with_empty_user_agent_when_request_is_not_http_request(): void
    {
        $this->app->forgetInstance('request');
        $this->app->bind('request', fn () => new stdClass);

        $agent = $this->app->make(AgentContract::class);

        $this->assertSame('', $agent->userAgent());
    }

    public function test_it_registers_block_bots_middleware_alias(): void
    {
        $this->assertSame(
            BlockBots::class,
            $this->app['router']->getMiddleware()['agent.block-bots'] ?? null
        );
    }
}
