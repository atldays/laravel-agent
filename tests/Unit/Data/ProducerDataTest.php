<?php

namespace Atldays\Agent\Tests\Unit\Data;

use Atldays\Agent\Data\Producer;
use Atldays\Agent\Tests\TestCase;
use Atldays\Url\Contracts\Url as UrlContract;

class ProducerDataTest extends TestCase
{
    public function test_it_casts_and_transforms_url(): void
    {
        $producer = Producer::from([
            'name' => 'Google Inc.',
            'url' => 'http://www.google.com',
        ]);

        $this->assertSame('Google Inc.', $producer->name());
        $this->assertInstanceOf(UrlContract::class, $producer->url());
        $this->assertSame('http://www.google.com', (string)$producer->url());
        $this->assertSame([
            'name' => 'Google Inc.',
            'url' => 'http://www.google.com',
        ], $producer->toArray());
    }
}
