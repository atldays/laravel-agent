<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;

class RequestMacroTest extends TestCase
{
    public function test_request_macro_returns_agent_instance(): void
    {
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->assertInstanceOf(Agent::class, $request->agent());
        $this->assertSame('Chrome', $request->agent()->browser()?->name());
    }
}
