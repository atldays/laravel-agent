<?php

namespace Atldays\Agent\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Atldays\Agent\Contracts\AgentContract detect(string $userAgent)
 * @method static \Atldays\Agent\Contracts\AgentContract request(?\Illuminate\Http\Request $request = null)
 *
 * @see \Atldays\Agent\AgentManager
 */
class AgentManager extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Atldays\Agent\AgentManager::class;
    }
}
