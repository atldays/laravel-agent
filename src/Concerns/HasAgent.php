<?php

namespace Atldays\Agent\Concerns;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Facades\Agent as AgentFacade;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait HasAgent
{
    public function agent(): AgentContract
    {
        $value = $this->getAttribute($this->getUserAgentColumn());

        if ($value instanceof AgentContract) {
            return $value;
        }

        return AgentFacade::detect((string)$value);
    }

    public function userAgent(): string
    {
        return $this->agent()->userAgent();
    }

    protected function getUserAgentColumn(): string
    {
        return 'user_agent';
    }
}
