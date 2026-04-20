<?php

namespace Atldays\Agent\Casts;

use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Facades\AgentManager as AgentManagerFacade;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class AgentCast implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): AgentContract
    {
        return AgentManagerFacade::detect((string)$value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof AgentContract) {
            return $value->userAgent();
        }

        return (string)$value;
    }
}
