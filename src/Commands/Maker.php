<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Traits\MDirectory;
use DungNguyenTrung\MesCmd\Traits\MStub;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Maker extends Command
{
    use MDirectory, MStub;

    /**
     * __construct
     *
     */
    public function __construct(
        protected string $folder,
        protected bool $isContainsCharacterInFileName = true
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $rootFolder = config('mes-cmd.folder.root') ?? Folder::ROOT;
        $name = $this->argument('name');
        $folder = $this->argument('folder');
        $model = $this->option('model');

        $namespace = $this->buildNamespace($folder);
        $fileName = $this->buildFileName($name);
        $destinationPath = app_path("{$rootFolder}/{$folder}/{$this->folder}/{$fileName}");

        $this->ensureDirectoryExists($destinationPath);

        if ($this->fileExists($destinationPath, $name)) {
            return;
        }

        if ($this->isContainsCharacterInFileName && $this->invalidFileName($name)) {
            return;
        }

        $className = Str::studly($name);
        $stub = $this->populateStub($namespace, $className, $folder);

        $this->createFile($destinationPath, $stub);

        if (in_array($this->folder, [Folder::SERVICE, Folder::REPO])) {
            $this->handleInterface($folder, $name, $className);
        }

        if ($model) {
            $this->appendToModel($model, $namespace, $className, $folder);
        }

        $this->info("{$this->folder} created successfully at {$destinationPath}");
    }

    /**
     * handleInterface
     *
     * @param  string $folder
     * @param  string $name
     * @param  string $className
     * @return void
     */
    protected function handleInterface(string $folder, string $name, string $className): void
    {
        $namespaceInterface = "App\\Modules\\{$folder}\\Interfaces";
        $interfacePath = app_path("Modules/{$folder}/Interfaces/{$name}Interface.php");

        if (file_exists($interfacePath)) {
            $this->error("{$name} Interface already exists!");
            return;
        }

        $stubInterface = $this->getInterfaceStub();
        $stubInterface = str_replace(['{{namespace}}', '{{class}}'], [$namespaceInterface, $className], $stubInterface);

        File::put($interfacePath, $stubInterface);
    }

    /**
     * appendToModel
     *
     * @param  string $model
     * @param  string $namespace
     * @param  string $className
     * @param  string $folder
     * @return void
     */
    protected function appendToModel(string $model, string $namespace, string $className, string $folder): void
    {
        $modelPath = app_path("Modules/{$folder}/Models/{$model}.php");

        if (!file_exists($modelPath)) {
            $this->error("Model {$model} does not exist!");
            return;
        }

        $modelContent = File::get($modelPath);
        $newEloquentBuilderMethod = $this->getNewEloquentQueryStub($className);
        $useStatement = "use {$namespace}\\{$className};\n";

        if (!Str::contains($modelContent, $useStatement)) {
            $modelContent = preg_replace('/namespace\s+[^\s;]+;\s*/', "$0\n{$useStatement}", $modelContent, 1);
        }

        $modelContent = preg_replace('/}\s*$/', $newEloquentBuilderMethod . '}', $modelContent);
        File::put($modelPath, $modelContent);

        $this->info("newEloquentBuilder method appended to model {$model}");
    }
}
