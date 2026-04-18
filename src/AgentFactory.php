<?php

namespace Atldays\Agent;

use Atldays\Agent\Contracts\AgentContract;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\ForwardsCalls;

class AgentFactory
{
    use ForwardsCalls;

    public function __construct(
        protected Container $container,
    ) {}

    /**
     * @throws Exception
     */
    public function detect(string $userAgent): AgentContract
    {
        return new Agent($userAgent);
    }

    /**
     * @throws BindingResolutionException
     * @throws Exception
     */
    public function request(?Request $request = null): AgentContract
    {
        if ($request === null && $this->container->bound('request')) {
            $request = $this->container->make('request');

            $request = $request instanceof Request ? $request : null;
        }

        return $this->detect($request?->userAgent() ?? '');
    }

    /**
     * @throws BindingResolutionException
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->forwardCallTo($this->request(), $method, $arguments);
    }
}
