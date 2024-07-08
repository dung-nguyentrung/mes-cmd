<?php

namespace DungNguyenTrung\MesCmd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeViewModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mes:vm {name} {folder} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view model in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $model = $this->option('model');
        $namespace = "App\\Modules\\{$folder}\\ViewModels";
        $destinationPath = app_path("Modules/{$folder}/ViewModels/{$name}.php");

        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (file_exists($destinationPath)) {
            $this->error("{$name} View Model already exists!");
            return;
        }

        $className = Str::studly($name);

        $stub = $this->getVMStub();
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $className, $stub);

        File::put($destinationPath, $stub);
        $this->info("View Model created successfully at {$destinationPath}");
    }

    /**
     * Get the view model object stub file content.
     *
     * @return string
     */
    protected function getVMStub()
    {
        return File::get(app_path('Common/Stubs/view-model.stub'));
    }
}
