<?php

namespace Atldays\Agent\Contracts;

use Atldays\Url\Contracts\Url as UrlContract;
use Illuminate\Contracts\Support\Arrayable;

interface ProducerContract extends Arrayable
{
    public function name(): ?string;

    public function url(): ?UrlContract;
}
