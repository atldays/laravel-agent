<?php

namespace Atldays\Agent\Tests;

use Atldays\Agent\AgentServiceProvider;
use Atldays\Url\UrlServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Spatie\LaravelData\LaravelDataServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LaravelDataServiceProvider::class,
            UrlServiceProvider::class,
            AgentServiceProvider::class,
        ];
    }
}
