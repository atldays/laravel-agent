<?php

namespace Atldays\Agent\Contracts;

use Atldays\Url\Contracts\Url as UrlContract;
use Illuminate\Contracts\Support\Arrayable;

interface BotContract extends Arrayable
{
    public function name(): string;

    public function category(): ?string;

    public function url(): ?UrlContract;

    public function producer(): ?ProducerContract;
}
