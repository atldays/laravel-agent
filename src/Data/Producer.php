<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\ProducerContract;
use Atldays\Url\Contracts\Url as UrlContract;
use Atldays\Url\Data\Casts\UrlCast;
use Atldays\Url\Data\Transformers\UrlTransformer;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;

class Producer extends Data implements ProducerContract
{
    public function __construct(
        public readonly ?string $name = null,
        #[WithCast(UrlCast::class), WithTransformer(UrlTransformer::class)]
        public readonly ?UrlContract $url = null,
    ) {}

    public function name(): ?string
    {
        return $this->name;
    }

    public function url(): ?UrlContract
    {
        return $this->url;
    }
}
