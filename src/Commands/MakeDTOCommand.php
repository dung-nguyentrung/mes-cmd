<?php

namespace Harry\MesCmd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeDTOCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mes:dto {name} {folder} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new data transfer object in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $model = $this->option('model');
        $namespace = "App\\Modules\\{$folder}\\DataTransferObjects";
        $destinationPath = app_path("Modules/{$folder}/DataTransferObjects/{$name}.php");

        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (file_exists($destinationPath)) {
            $this->error("{$name} DTO already exists!");
            return;
        }

        $className = Str::studly($name);

        $stub = $this->getDTOStub();
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $className, $stub);

        File::put($destinationPath, $stub);
        $this->info("DTO created successfully at {$destinationPath}");
    }

    /**
     * Get the data transfer object stub file content.
     *
     * @return string
     */
    protected function getDTOStub()
    {
        return File::get(app_path('Common/Stubs/dto.stub'));
    }
}
