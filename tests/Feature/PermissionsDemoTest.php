<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionsDemoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function it_recognizes_blade_hasrole_directive(){
        $response = $this->get('/');

        $response->assertSeeText('customer');
        $response->assertDontSeeText('@hasRole');
        // $response->assertStatus(200);
    }

    public function it_shows_message_confirming_permission_is_not_granted()
    {
        $response = $this->get('/');

        $response->assertSeeText('Sorry, you may NOT edit.');
    }

    public function it_shows_message_confirming_permission_is_granted()
    {
        $response = $this->actingAs(\App\Models\User::find(1))->get('/');

        $response->assertSeeText("You have permission to 'edit'.");
        $response->assertDontSeeText('@hasrole');
    }
}
