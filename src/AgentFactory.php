<?php

namespace Atldays\Agent;

use Atldays\Agent\Contracts\AgentContract;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

class AgentFactory
{
    public function __construct(
        protected Container $container,
    ) {}

    public function detect(string $userAgent): AgentContract
    {
        return new Agent($userAgent);
    }

    public function request(?Request $request = null): AgentContract
    {
        $request ??= $this->resolveRequest();

        return $this->detect((string)($request?->userAgent() ?? ''));
    }

    public function __call(string $method, array $arguments): mixed
    {
        return $this->request()->{$method}(...$arguments);
    }

    protected function resolveRequest(): ?Request
    {
        if (!$this->container->bound('request')) {
            return null;
        }

        $request = $this->container->make('request');

        return $request instanceof Request ? $request : null;
    }
}
