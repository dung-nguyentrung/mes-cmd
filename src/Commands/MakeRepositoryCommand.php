<?php

namespace DungNguyenTrung\MesCmd\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mes:repo {name} {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $namespace = "App\\Modules\\{$folder}\\Repositories";
        $namespaceInterface = "App\\Modules\\{$folder}\\Interfaces";
        $destinationPath = app_path("Modules/{$folder}/Repositories/{$name}.php");
        $destinationInterfacePath = app_path("Modules/{$folder}/Interfaces/{$name}Interface.php");

        // Ensure the folder structure exists
        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $directoryInterface = dirname($destinationInterfacePath);
        if (!File::isDirectory($directoryInterface)) {
            File::makeDirectory($directoryInterface, 0755, true);
        }

        if (file_exists($destinationPath)) {
            $this->error("{$name} Repository already exists!");
            return;
        }

        if (file_exists($destinationInterfacePath)) {
            $this->error("{$name} Interface already exists!");
            return;
        }

        if (!Str::endsWith($name, 'Repository')) {
            $this->error("{$name} must end with 'Repository'!");
            return;
        }


        $className = Str::studly($name);

        $stub = $this->getRepoStub();
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $className, $stub);
        $stub = str_replace('{{folder}}', $folder, $stub);

        $stubInterface = $this->getInterfaceStub();
        $stubInterface = str_replace('{{namespace}}', $namespaceInterface, $stubInterface);
        $stubInterface = str_replace('{{class}}', $className, $stubInterface);

        File::put($destinationPath, $stub);
        File::put($destinationInterfacePath, $stubInterface);
        $this->info("Service created successfully at {$destinationPath}");
    }

    /**
     * Get the repository stub file content.
     *
     * @return string
     */
    protected function getRepoStub()
    {
        return File::get(__DIR__ . '/../Stubs/repo.stub');
    }

    /**
     * Get the interface stub file content.
     *
     * @return string
     */
    protected function getInterfaceStub()
    {
        return File::get(app_path('Common/Stubs/repo-interface.stub'));
    }
}
