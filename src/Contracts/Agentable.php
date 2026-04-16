<?php

namespace Atldays\Agent\Contracts;

interface Agentable
{
    public function getAgent(): AgentContract;
}
