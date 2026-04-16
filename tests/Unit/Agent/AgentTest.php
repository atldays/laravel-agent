<?php

namespace Atldays\Agent\Tests\Unit\Agent;

use Atldays\Agent\Agent;
use Atldays\Agent\Enums\DeviceType;
use Atldays\Agent\Tests\TestCase;

class AgentTest extends TestCase
{
    public function test_it_parses_browser_os_and_device_from_browser_user_agent(): void
    {
        $agent = new Agent('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36');

        $this->assertSame('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', $agent->userAgent());
        $this->assertSame(hash('sha256', $agent->userAgent()), $agent->hash());

        $this->assertNotNull($agent->os());
        $this->assertSame('Windows', $agent->os()?->name());

        $this->assertNotNull($agent->browser());
        $this->assertSame('Chrome', $agent->browser()?->name());
        $this->assertSame('Chrome', $agent->browser()?->family());

        $this->assertNotNull($agent->device());
        $this->assertSame(DeviceType::Desktop, $agent->device()?->type());
        $this->assertSame('desktop', $agent->device()?->device());

        $this->assertNull($agent->bot());
    }

    public function test_it_parses_bot_information(): void
    {
        $agent = new Agent('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');

        $this->assertNotNull($agent->bot());
        $this->assertSame('Googlebot', $agent->bot()?->name());
        $this->assertSame('Search bot', $agent->bot()?->category());
        $this->assertSame('https://developers.google.com/search/docs/crawling-indexing/overview-google-crawlers', (string)$agent->bot()?->url());

        $this->assertNotNull($agent->bot()?->producer());
        $this->assertSame('Google Inc.', $agent->bot()?->producer()?->name());
        $this->assertSame('https://www.google.com', (string)$agent->bot()?->producer()?->url());

        $this->assertNull($agent->os());
        $this->assertNull($agent->browser());
        $this->assertNull($agent->device());
    }

    public function test_it_returns_empty_structure_for_empty_user_agent(): void
    {
        $agent = new Agent('');

        $this->assertSame('', $agent->userAgent());
        $this->assertNull($agent->os());
        $this->assertNull($agent->browser());
        $this->assertNull($agent->bot());
        $this->assertNull($agent->device());
        $this->assertSame([
            'user_agent' => '',
            'hash' => hash('sha256', ''),
            'os' => null,
            'browser' => null,
            'bot' => null,
            'device' => null,
        ], $agent->toArray());
    }
}
