<?php

namespace Tests\Feature;

use App\Models\Predictions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PredictionsApiTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePredictionPost()
    {
        /*Simple Creation*/
        $data = [
            "event_id" => 1,
            "market_type" => "correct_score",
            "prediction" => "3:2"
        ];
        $this->json('POST', 'api/v1/predictions', $data, ['Accept' => 'application/json'])->assertStatus(204);

    }

    public function testCreatePredictionValidationPost()
    {
        /*Validation*/
        $data = [
            "event_id" => '',
            "market_type" => "null",
            "prediction" => "3:2"
        ];
        $this->json('POST', '/api/v1/predictions', $data, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                "event_id" => [
                    "The event id field is required."
                ],
                "market_type" => [
                    "The selected market type is invalid."
                ],
            ]);

    }

    public function testListPredictionsGet()
    {
        Predictions::create([
            "event_id" => '2',
            "market_type" => "correct_score",
            "prediction" => "4:4"
        ]);

        $response = $this->get('api/v1/predictions');
        $response->assertStatus(200);

        $this->json('GET', 'api/v1/predictions', [], ['Accept' => 'application/json'])
            ->assertStatus(200)->assertSee('4:4');
    }

}
