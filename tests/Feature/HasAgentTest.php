<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\Casts\AgentCast;
use Atldays\Agent\Concerns\HasAgent;
use Atldays\Agent\Contracts\AgentContract;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class HasAgentTest extends TestCase
{
    public function test_it_builds_agent_from_default_user_agent_column(): void
    {
        $model = new class extends Model
        {
            use HasAgent;

            protected $guarded = [];

            protected $table = 'users';
        };

        $model->forceFill([
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->assertInstanceOf(Agent::class, $model->agent());
        $this->assertSame('Chrome', $model->agent()->browser()?->name());
        $this->assertSame('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', $model->userAgent());
    }

    public function test_it_supports_model_with_agent_cast_on_same_attribute(): void
    {
        $model = new class extends Model
        {
            use HasAgent;

            protected $guarded = [];

            protected $table = 'users';

            protected $casts = [
                'user_agent' => AgentCast::class,
            ];
        };

        $model->forceFill([
            'user_agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->assertInstanceOf(Agent::class, $model->agent());
        $this->assertSame('Googlebot', $model->agent()->bot()?->name());
        $this->assertSame('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', $model->userAgent());
    }

    public function test_it_supports_custom_user_agent_column(): void
    {
        $model = new class extends Model
        {
            use HasAgent;

            protected $guarded = [];

            protected $table = 'users';

            protected function getUserAgentColumn(): string
            {
                return 'ua';
            }
        };

        $model->forceFill([
            'ua' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->assertSame('Chrome', $model->agent()->browser()?->name());
    }

    public function test_it_returns_contract_instance(): void
    {
        $model = new class extends Model
        {
            use HasAgent;

            protected $guarded = [];

            protected $table = 'users';
        };

        $model->forceFill([
            'user_agent' => 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
        ]);

        $this->assertInstanceOf(AgentContract::class, $model->agent());
    }

    public function test_it_handles_empty_user_agent_value(): void
    {
        $model = new class extends Model
        {
            use HasAgent;

            protected $guarded = [];

            protected $table = 'users';
        };

        $model->forceFill([
            'user_agent' => null,
        ]);

        $this->assertSame('', $model->agent()->userAgent());
        $this->assertSame('', $model->userAgent());
    }
}
