<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Members_donationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("members_donations")->insert([
            [
                "doacao" => 1000.5,
                "member_id" => 1,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 2,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 3,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 4,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 5,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 6,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 7,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 8,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 9,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 550,
                "member_id" => 10,
                "campaign_id" => 1,
            ],
            [
                "doacao" => 1550.5,
                "member_id" => 11,
                "campaign_id" => 3,
            ],
            [
                "doacao" => 250.75,
                "member_id" => 12,
                "campaign_id" => 3,
            ],
        ]);
    }
}
