<?php

namespace Atldays\Agent\Facades;

use Atldays\Agent\AgentFactory;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \Atldays\Agent\Contracts\AgentContract detect(string $userAgent)
 * @method static \Atldays\Agent\Contracts\AgentContract request(?\Illuminate\Http\Request $request = null)
 * @method static string userAgent()
 * @method static string hash()
 * @method static ?\Atldays\Agent\Contracts\OsContract os()
 * @method static ?\Atldays\Agent\Contracts\BrowserContract browser()
 * @method static ?\Atldays\Agent\Contracts\BotContract bot()
 * @method static ?\Atldays\Agent\Contracts\DeviceContract device()
 * @method static array toArray()
 *
 * @see AgentFactory
 */
class Agent extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return AgentFactory::class;
    }
}
