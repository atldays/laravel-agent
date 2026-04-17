<?php

namespace Atldays\Agent\Tests\Unit\Data;

use Atldays\Agent\Data\Bot;
use Atldays\Agent\Tests\TestCase;
use Atldays\Url\Contracts\Url as UrlContract;

class BotDataTest extends TestCase
{
    public function test_it_casts_nested_producer_and_url(): void
    {
        $bot = Bot::from([
            'name' => 'Googlebot',
            'category' => 'Search bot',
            'url' => 'http://www.google.com/bot.html',
            'producer' => [
                'name' => 'Google Inc.',
                'url' => 'http://www.google.com',
            ],
        ]);

        $this->assertSame('Googlebot', $bot->name());
        $this->assertSame('Search bot', $bot->category());
        $this->assertInstanceOf(UrlContract::class, $bot->url());
        $this->assertSame('http://www.google.com/bot.html', (string)$bot->url());
        $this->assertSame('Google Inc.', $bot->producer()?->name());
        $this->assertSame('http://www.google.com', (string)$bot->producer()?->url());
        $this->assertSame([
            'name' => 'Googlebot',
            'category' => 'Search bot',
            'url' => 'http://www.google.com/bot.html',
            'producer' => [
                'name' => 'Google Inc.',
                'url' => 'http://www.google.com',
            ],
        ], $bot->toArray());
    }
}
