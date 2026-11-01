<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LotteryRequestSecurityTest extends TestCase
{
    use RefreshDatabase;

    #[DataProvider('mutationRoutes')]
    public function test_mutation_routes_do_not_accept_get_requests(string $path): void
    {
        $this->get($path)->assertStatus(405);
    }

    #[DataProvider('mutationRoutes')]
    public function test_mutation_routes_require_a_csrf_token(string $path): void
    {
        $this->actingAs(User::factory()->create());
        $this->app['env'] = 'local';

        $this->post($path)->assertStatus(419);
    }

    /** @return iterable<string, array{string}> */
    public static function mutationRoutes(): iterable
    {
        yield 'run lottery' => ['/events/1/runLottery'];
        yield 'rerun lottery' => ['/events/1/rerunLottery'];
        yield 'playground action' => ['/playground/runTest'];
    }
}
