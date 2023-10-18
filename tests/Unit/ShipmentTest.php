<?php

namespace Tests\Unit;

use App\Models\Package;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    public function test_create_shipment_with_valid_data()
    {

        $token = $this->getAuthToken();
        $test_data = $this->getTestData();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->postJson('/api/v1/package', $test_data[0]);

        $response->assertStatus(201);
    }

    public function test_create_shipment_with_empty_body()
    {

        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->postJson('/api/v1/package', []);

        $response->assertStatus(422);
    }

    public function test_get_one_shipment()
    {
        $token = $this->getAuthToken();
        
        $package = Package::first();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->getJson('/api/v1/package/' . $package->transaction_id);

        $response->assertStatus(200);
    }

    public function test_get_all_shipment()
    {
        $token = $this->getAuthToken();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->getJson('/api/v1/package/');

        $response->assertStatus(200);
    }

    public function test_update_patch_shipment()
    {
        $token = $this->getAuthToken();
        $package = Package::first();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->patchJson(
            '/api/v1/package/' . $package->transaction_id,
            [
                "customer_name" => "PT. TEST UPDATE",
                "customer_code" => "1111111",
                "custom_field" => [
                    "catatan_tambahan" => "JANGAN DI BALIK"
                ],
                "currentLocation" => [
                    "name" => "MALANG",
                    "code" => "MLG001",
                    "type" => "Retail"
                ]
            ]
        );

        $response->assertStatus(200)->assertJsonFragment([
            "customer_name" => "PT. TEST UPDATE",
            "customer_code" => "1111111",
            "custom_field" => [
                "catatan_tambahan" => "JANGAN DI BALIK"
            ],
            "currentLocation" => [
                "name" => "MALANG",
                "code" => "MLG001",
                "type" => "Retail"
            ]
        ]);
    }

    public function test_update_put_shipment()
    {
        $token = $this->getAuthToken();
        $test_data = $this->getTestData();
        $package = Package::first();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->putJson('/api/v1/package/' . $package->transaction_id,$test_data[1]);

        $response->assertStatus(200)->assertJsonFragment($test_data[1]);
    }

    public function test_delete_shipment() {
        $token = $this->getAuthToken();
        $package = Package::first();

        $response = $this->withHeaders([
            "Authorization"  => "Bearer " . $token
        ])->deleteJson('/api/v1/package/' . $package->transaction_id);

        $response->assertStatus(200)->assertJsonFragment(["message" => "Package deleted"]);
    }

    protected function getAuthToken()
    {
        $response = $this->postJson('/api/v1/login', [
            "email" => "awaludin@gmail.com",
            "password" => "adminadmin"
        ]);

        $token = $response->decodeResponseJson();

        return $token['access_token'];
    }

    protected function getTestData()
    {
        // Specify the path to your JSON file
        $jsonFilePath = base_path("database/data/seed.json");

        // Read and decode the JSON data
        $data = json_decode(file_get_contents($jsonFilePath), true);
        return $data;
    }
}
