<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\Facades\Agent as AgentFacade;
use Atldays\Agent\Facades\AgentManager as AgentManagerFacade;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;

class FacadeTest extends TestCase
{
    public function test_manager_facade_detect_returns_explicit_agent(): void
    {
        $agent = AgentManagerFacade::detect('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Googlebot', $agent->bot()?->name());
    }

    public function test_manager_facade_request_returns_current_request_agent(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->app->instance('request', $request);

        $agent = AgentManagerFacade::request();

        $this->assertInstanceOf(Agent::class, $agent);
        $this->assertSame('Chrome', $agent->browser()?->name());
    }

    public function test_agent_facade_proxies_to_current_request_agent_contract(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->app->instance('request', $request);

        $this->assertSame('Chrome', AgentFacade::browser()?->name());
        $this->assertSame('Windows', AgentFacade::os()?->name());
    }
}
