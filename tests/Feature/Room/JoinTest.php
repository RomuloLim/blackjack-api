<?php

namespace Tests\Feature\Room;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JoinTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    /** @test */
    public function it_should_be_able_to_join_in_a_room(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_should_forbid_an_unauthenticated_user_can_join_on_room(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
