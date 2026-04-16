<?php

namespace Atldays\Agent\Data;

use Atldays\Agent\Contracts\BrowserContract;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class Browser extends Data implements BrowserContract
{
    public function __construct(
        #[Required, StringType]
        public readonly string $name,
        public readonly ?string $shortName,
        public readonly ?string $version = null,
        public readonly ?string $family = null,
        public readonly ?string $engine = null,
        public readonly ?string $engineVersion = null,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getShortName(): ?string
    {
        return $this->shortName;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function getEngine(): ?string
    {
        return $this->engine;
    }

    public function getEngineVersion(): ?string
    {
        return $this->engineVersion;
    }
}
