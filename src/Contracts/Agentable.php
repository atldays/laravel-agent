<?php

namespace Atldays\Agent\Contracts;

interface Agentable
{
    public function agent(): AgentContract;
}
