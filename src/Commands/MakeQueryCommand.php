<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Shell;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeQueryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::QUERY;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new query builder in a custom directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $model = $this->option('model');
        $namespace = "App\\Modules\\{$folder}\\QueryBuilders";
        $destinationPath = app_path("Modules/{$folder}/QueryBuilders/{$name}.php");

        // Ensure the folder structure exists
        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        if (file_exists($destinationPath)) {
            $this->error("{$name} QueryBuilder already exists!");
            return;
        }

        if (!Str::endsWith($name, 'QueryBuilder')) {
            $this->error("{$name} must end with 'QueryBuilder'!");
            return;
        }

        $className = Str::studly($name);

        $stub = $this->getQueryBuilderStub();
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        $stub = str_replace('{{class}}', $className, $stub);
        $stub = str_replace('{{folder}}', $folder, $stub);

        File::put($destinationPath, $stub);
        $this->info("QueryBuilder created successfully at {$destinationPath}");

       
    }

    /**
     * Get the query builder stub file content.
     *
     * @return string
     */
    protected function getQueryBuilderStub()
    {
        return File::get(__DIR__ . '/../Stubs/query.stub');
    }
}
