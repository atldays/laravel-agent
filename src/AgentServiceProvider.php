<?php

namespace Atldays\Agent;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Http\Middleware\BlockBots;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class AgentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AgentFactory::class);

        $this->app->bind(
            AgentContract::class,
            fn (Application $app) => $app->make(AgentFactory::class)->request(),
        );

        $this->app->alias(AgentContract::class, 'agent');
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

        $this->app->make(Router::class)->aliasMiddleware('agent.block-bots', BlockBots::class);
    }
}
