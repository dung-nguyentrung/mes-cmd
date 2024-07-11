<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Shell;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::MODEL;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $namespace = "App\\Modules\\{$folder}\\Models";
        $destinationPath = app_path("Modules/{$folder}/Models/{$name}.php");

        if (file_exists($destinationPath)) {
            $this->error("{$name} Model already exists!");
            return;
        }

        $result = $this->call('make:model', [
            'name' => $name
        ]);

        if ($result === 0) {
            $sourcePath = app_path("{$name}.php");
            if (!File::isDirectory(app_path("Modules/{$folder}/Models"))) {
                File::makeDirectory(app_path("Modules/{$folder}/Models"), 0755, true);
            }
            File::move($sourcePath, $destinationPath);
            $fileContents = File::get($destinationPath);
            $fileContents = str_replace("namespace App;", "namespace {$namespace};", $fileContents);
            File::put($destinationPath, $fileContents);

            $this->info("Model created successfully at {$destinationPath}");
        } else {
            $this->error("Failed to create the model.");
        }
    }
}
