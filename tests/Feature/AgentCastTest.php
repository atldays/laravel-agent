<?php

namespace Atldays\Agent\Tests\Feature;

use Atldays\Agent\Agent;
use Atldays\Agent\Casts\AgentCast;
use Atldays\Agent\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

class AgentCastTest extends TestCase
{
    public function test_it_casts_user_agent_attribute_to_agent_instance(): void
    {
        $model = new class extends Model
        {
            protected $guarded = [];

            protected $table = 'users';

            protected $casts = [
                'user_agent' => AgentCast::class,
            ];
        };

        $model->forceFill([
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36',
        ]);

        $this->assertInstanceOf(Agent::class, $model->user_agent);
        $this->assertSame('Chrome', $model->user_agent->browser()?->name());
    }

    public function test_it_serializes_agent_back_to_user_agent_string(): void
    {
        $model = new class extends Model
        {
            protected $guarded = [];

            protected $table = 'users';

            protected $casts = [
                'user_agent' => AgentCast::class,
            ];
        };

        $model->user_agent = new Agent('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');

        $this->assertSame(
            'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
            $model->getAttributes()['user_agent']
        );
    }

    public function test_it_returns_agent_for_null_value_as_empty_user_agent(): void
    {
        $model = new class extends Model
        {
            protected $guarded = [];

            protected $table = 'users';

            protected $casts = [
                'user_agent' => AgentCast::class,
            ];
        };

        $model->forceFill([
            'user_agent' => null,
        ]);

        $this->assertInstanceOf(Agent::class, $model->user_agent);
        $this->assertSame('', $model->user_agent->userAgent());
    }

    public function test_it_serializes_plain_string_without_changes(): void
    {
        $model = new class extends Model
        {
            protected $guarded = [];

            protected $table = 'users';

            protected $casts = [
                'user_agent' => AgentCast::class,
            ];
        };

        $model->user_agent = 'Custom UA';

        $this->assertSame('Custom UA', $model->getAttributes()['user_agent']);
    }
}
