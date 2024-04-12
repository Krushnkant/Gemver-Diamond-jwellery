<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Settings;

class InstagramCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'instagram:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'instagram refresh access token';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $setting = Settings::first();
        $json_feed_url="https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token={$setting->instagram_token}";
        $json_feed = @file_get_contents($json_feed_url);
        $contents = json_decode($json_feed, true, 512, JSON_BIGINT_AS_STRING);
        $setting->instagram_token = $contents['access_token'];
        $setting->save();
        // \Log::info("instagram refresh access token successfully!");
    }
}
