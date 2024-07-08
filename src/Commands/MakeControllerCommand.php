<?php

namespace DungNguyenTrung\MesCmd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeControllerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mes:controller {name} {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $namespace = "App\\Modules\\{$folder}\\Controllers";
        $destinationPath = app_path("Modules/{$folder}/Controllers/{$name}.php");

        if (file_exists($destinationPath)) {
            $this->error("{$name} Controller already exists!");
            return;
        }

        if (!Str::endsWith($name, 'Controller')) {
            $this->error("{$name} must end with 'Controller'!");
            return;
        }

        $className = Str::studly($name);

        $stub = $this->getControllerStub();
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{className}}', $className, $stub);

        File::put($destinationPath, $stub);
        $this->info("Controller created successfully at {$destinationPath}");
    }

    /**
     * getControllerStub
     *
     */
    protected function getControllerStub()
    {
        return File::get(app_path('Common/Stubs/controller.stub'));
    }
}
