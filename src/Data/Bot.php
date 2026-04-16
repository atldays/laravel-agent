<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\BotContract;
use Atldays\Agent\Contracts\ProducerContract;
use Atldays\Url\Contracts\Url as UrlContract;
use Atldays\Url\Data\Casts\UrlCast;
use Atldays\Url\Data\Transformers\UrlTransformer;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;

class Bot extends Data implements BotContract
{
    public function __construct(
        #[Required, StringType]
        public readonly string $name,
        public readonly ?string $category = null,
        #[WithCast(UrlCast::class), WithTransformer(UrlTransformer::class)]
        public readonly ?UrlContract $url = null,
        public readonly ?Producer $producer = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function getUrl(): ?UrlContract
    {
        return $this->url;
    }

    public function getProducer(): ?ProducerContract
    {
        return $this->producer;
    }
}
