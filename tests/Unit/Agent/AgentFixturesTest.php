<?php

namespace Atldays\Agent\Tests\Unit\Agent;

use Atldays\Agent\Agent;
use Atldays\Agent\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class AgentFixturesTest extends TestCase
{
    #[DataProvider('fixtureProfiles')]
    public function test_it_matches_expected_profile_for_real_user_agent_fixtures(
        string $userAgent,
        array $expectations,
    ): void {
        $agent = new Agent($userAgent);

        $this->assertSame($expectations['is_bot'], $agent->isBot());

        if ($expectations['is_bot']) {
            $this->assertSame($expectations['bot'], $agent->bot()?->name());
            $this->assertNull($agent->browser());
            $this->assertNull($agent->os());
            $this->assertNull($agent->device());

            return;
        }

        $browser = $agent->browser();
        $os = $agent->os();
        $device = $agent->device();

        $this->assertNotNull($browser);
        $this->assertNotNull($os);
        $this->assertNotNull($device);

        $this->assertSame($expectations['browser'], $browser?->name());
        $this->assertSame($expectations['os'], $os?->name());
        $this->assertSame($expectations['device_type'], $device?->device());

        foreach ($expectations['browser_checks'] as $method => $expected) {
            $this->assertSame($expected, $browser->{$method}(), sprintf('Failed browser assertion for %s', $method));
        }

        foreach ($expectations['os_checks'] as $method => $expected) {
            $this->assertSame($expected, $os->{$method}(), sprintf('Failed OS assertion for %s', $method));
        }

        foreach ($expectations['device_checks'] as $method => $expected) {
            $this->assertSame($expected, $device->{$method}(), sprintf('Failed device assertion for %s', $method));
        }
    }

    public static function fixtureProfiles(): array
    {
        /** @var array<string, array{user_agent: string, expectations: array}> $profiles */
        $profiles = require dirname(__DIR__, 2) . '/Fixtures/agent_profiles.php';

        return array_map(
            static fn (array $profile): array => [$profile['user_agent'], $profile['expectations']],
            $profiles,
        );
    }
}
