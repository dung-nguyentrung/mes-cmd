<?php

namespace Harry\MesCmd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mes:view {name} {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $destinationPath = app_path("Modules/{$folder}/Views/{$name}.blade.php");

        // Ensure the folder structure exists
        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (file_exists($destinationPath)) {
            $this->error("View {$name} already exists!");
            return;
        }

        File::put($destinationPath, "<div>\n<!-- Write code here -->\n</div>\n<!-- Created by Harry -->");
        $this->info("View created successfully at {$destinationPath}");
    }
}
