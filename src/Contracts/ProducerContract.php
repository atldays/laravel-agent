<?php

namespace Atldays\Agent\Contracts;

use Atldays\Url\Contracts\Url as UrlContract;
use Illuminate\Contracts\Support\Arrayable;

interface ProducerContract extends Arrayable
{
    public function getName(): ?string;

    public function getUrl(): ?UrlContract;
}
