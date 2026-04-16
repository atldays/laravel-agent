<?php

namespace Atldays\Agent\Contracts;

use Atldays\Url\Contracts\Url as UrlContract;
use Illuminate\Contracts\Support\Arrayable;

interface BotContract extends Arrayable
{
    public function getName(): string;

    public function getCategory(): ?string;

    public function getUrl(): ?UrlContract;

    public function getProducer(): ?ProducerContract;
}
