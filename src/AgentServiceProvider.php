<?php

namespace Atldays\Agent;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AgentFactory::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $factory = $this->app->make(AgentFactory::class);

        Request::macro('agent', function () use ($factory) {
            /** @var Request $this */
            return $factory->request($this);
        });
    }
}
