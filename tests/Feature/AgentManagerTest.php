<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\AgentManager;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;

class AgentManagerTest extends TestCase
{
    public function test_it_detects_agent_from_user_agent_string(): void
    {
        $manager = $this->app->make(AgentManager::class);

        $agent = $manager->detect('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)');

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X)', $agent->userAgent());
    }

    public function test_it_builds_agent_from_explicit_request(): void
    {
        $manager = $this->app->make(AgentManager::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $agent = $manager->request($request);

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Chrome', $agent->browser()?->name());
    }

    public function test_it_builds_agent_from_current_request_bound_in_container(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->app->instance('request', $request);

        $agent = $this->app->make(AgentManager::class)->request();

        $this->assertSame('Googlebot', $agent->bot()?->name());
    }

    public function test_it_returns_current_request_agent_for_follow_up_data_access(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->app->instance('request', $request);

        $bot = $this->app->make(AgentManager::class)->request()->bot();

        $this->assertSame('Googlebot', $bot?->name());
    }

    public function test_it_falls_back_to_empty_user_agent_when_request_is_missing(): void
    {
        $this->app->offsetUnset('request');

        $agent = $this->app->make(AgentManager::class)->request();

        $this->assertSame('', $agent->userAgent());
        $this->assertNull($agent->browser());
        $this->assertNull($agent->os());
        $this->assertNull($agent->device());
        $this->assertNull($agent->bot());
    }
}
