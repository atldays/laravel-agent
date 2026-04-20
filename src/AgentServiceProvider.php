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
        $this->app->singleton(AgentManager::class);

        $this->app->bind('agent', fn (Application $app) => $app->make(AgentManager::class)->request());

        $this->app->alias('agent', AgentContract::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $manager = $this->app->make(AgentManager::class);

        Request::macro('agent', function () use ($manager) {
            /** @var Request $this */
            return $manager->request($this);
        });

        $this->app->make(Router::class)->aliasMiddleware('agent.block-bots', BlockBots::class);
    }
}
