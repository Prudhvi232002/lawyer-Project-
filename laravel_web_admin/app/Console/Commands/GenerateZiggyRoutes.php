<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class GenerateZiggyRoutes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ziggy:generate-custom {path=resources/js/ziggy.js}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Ziggy routes file with dynamic URL';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Call the default ziggy:generate command to create the initial ziggy.js file
        Artisan::call('ziggy:generate', ['path' => $this->argument('path')]);

        // Get the file path
        $path = $this->argument('path');

        // Check if the file exists
        if (!File::exists($path)) {
            $this->error("The Ziggy routes file was not found at {$path}");
            return 1; // Return an error code
        }

        // Read the content of the generated file
        $content = File::get($path);

        // Replace the "url" and "port" fields with dynamic logic
        $updatedContent = preg_replace(
            [
                '/"url":\s?"[^"]+"/',       // Match the "url" field
                '/"port":\s?\d+/',          // Match the "port" field
            ],
            [
                '"url": window.location.origin',  // Replace with dynamic URL
                '"port": window.location.port || null', // Replace with dynamic port
            ],
            $content
        );

        // Write the updated content back to the file
        File::put($path, $updatedContent);

        $this->info("Ziggy routes file updated successfully at {$path}!");

        return 0;
    }
}
