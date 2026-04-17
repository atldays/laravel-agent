<?php

namespace Atldays\Agent\Http\Middleware;

use Atldays\Agent\AgentFactory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlockBots
{
    public function __construct(protected AgentFactory $factory) {}

    public function handle(Request $request, Closure $next, string ...$allowedBots): Response
    {
        $agent = $this->factory->request($request);

        if (!$agent->isBot()) {
            return $next($request);
        }

        $botName = $agent->bot()?->name();

        if ($botName !== null && in_array($botName, $allowedBots, true)) {
            return $next($request);
        }

        throw new HttpException(Response::HTTP_FORBIDDEN, 'Bots are not allowed.');
    }
}
