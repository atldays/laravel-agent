<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Http\Middleware\BlockBots;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlockBotsMiddlewareTest extends TestCase
{
    public function test_it_allows_human_requests(): void
    {
        $middleware = $this->app->make(BlockBots::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $response = $middleware->handle($request, fn () => response('ok'));

        $this->assertSame('ok', $response->getContent());
    }

    public function test_it_blocks_bots(): void
    {
        $middleware = $this->app->make(BlockBots::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        try {
            $middleware->handle($request, fn () => response('ok'));
            $this->fail('Expected middleware to block bot requests.');
        } catch (HttpException $exception) {
            $this->assertSame(Response::HTTP_FORBIDDEN, $exception->getStatusCode());
        }
    }

    public function test_it_allows_explicitly_allowed_bot(): void
    {
        $middleware = $this->app->make(BlockBots::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $response = $middleware->handle($request, fn () => response('ok'), 'Googlebot');

        $this->assertSame('ok', $response->getContent());
    }

    public function test_it_allows_any_bot_from_allow_list(): void
    {
        $middleware = $this->app->make(BlockBots::class);
        $request = Request::create('/', 'GET', server: [
            'HTTP_USER_AGENT' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $response = $middleware->handle($request, fn () => response('ok'), 'Bingbot', 'Googlebot');

        $this->assertSame('ok', $response->getContent());
    }

    public function test_it_blocks_request_without_user_agent_gracefully(): void
    {
        $middleware = $this->app->make(BlockBots::class);
        $request = Request::create('/', 'GET');

        $response = $middleware->handle($request, fn () => response('ok'));

        $this->assertSame('ok', $response->getContent());
    }
}
