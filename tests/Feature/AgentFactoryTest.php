<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\AgentFactory;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;

class AgentFactoryTest extends TestCase
{
    public function test_it_detects_agent_from_user_agent_string(): void
    {
        $factory = $this->app->make(AgentFactory::class);

        $agent = $factory->detect('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)');

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)', $agent->userAgent());
    }

    public function test_it_builds_agent_from_explicit_request(): void
    {
        $factory = $this->app->make(AgentFactory::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $agent = $factory->request($request);

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Chrome', $agent->browser()?->name());
    }

    public function test_it_builds_agent_from_current_request_bound_in_container(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->app->instance('request', $request);

        $agent = $this->app->make(AgentFactory::class)->request();

        $this->assertSame('Googlebot', $agent->bot()?->name());
    }

    public function test_it_proxies_method_calls_to_agent_from_current_request(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->app->instance('request', $request);

        $bot = $this->app->make(AgentFactory::class)->bot();

        $this->assertSame('Googlebot', $bot?->name());
    }
}
