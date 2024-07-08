<?php

namespace Harry\MesCmd\Commands;

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
    protected $signature = 'mes:query {name} {folder} {--model=}';

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

        // Append to model if --model option is provided
        if ($model) {
            $this->appendToModel($model, $namespace, $className, $folder);
        }
    }

    /**
     * Get the query builder stub file content.
     *
     * @return string
     */
    protected function getQueryBuilderStub()
    {
        return File::get(app_path('Common/Stubs/query.stub'));
    }

    /**
     * Append newEloquentBuilder method to the specified model.
     *
     * @param string $model
     * @param string $namespace
     * @param string $className
     */
    protected function appendToModel($model, $namespace, $className, $folder)
    {
        $modelPath = app_path("Modules/{$folder}/Models/{$model}.php");

        if (!file_exists($modelPath)) {
            $this->error("Model {$model} does not exist!");
            return;
        }

        $modelContent = File::get($modelPath);
        $newEloquentBuilderMethod =  $this->getNewEloquentQueryStub($className);

        $useStatement = "use {$namespace}\\{$className};\n";
        if (!Str::contains($modelContent, $useStatement)) {
            $modelContent = preg_replace('/namespace\s+[^\s;]+;\s*/', "$0\n{$useStatement}", $modelContent, 1);
        }

        $modelContent = preg_replace('/}\s*$/', $newEloquentBuilderMethod . '}', $modelContent);
        File::put($modelPath, $modelContent);

        $this->info("newEloquentBuilder method appended to model {$model}");
    }

    /**
     * getNewEloquentQueryStub
     *
     */
    protected function getNewEloquentQueryStub(string $className)
    {
        return <<<EOT
            /**
             * newEloquentBuilder
             *
             * @param  \Illuminate\Database\Query\Builder \$query
             * @return {$className}
             */
            public function newEloquentBuilder(\$query): {$className}
            {
                return new {$className}(\$query);
            }

        EOT;
    }
}
