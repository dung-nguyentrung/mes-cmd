<?php

namespace DungNguyenTrung\MesCmd\Traits;

use DungNguyenTrung\MesCmd\Constants\Folder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

/**
 * MDirectory class: Check directory is exists and generate it.
 * 
 * @property function makeDirectory(string $destinationPath)
 * 
 */
trait MDirectory
{
    /**
     * makeDirectory
     *
     * @param  string $destinationPath
     * @return void
     */
    public function makeDirectory(string $destinationPath,): void
    {
        $directory = dirname($destinationPath);
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
    }

    protected function buildNamespace(string $folder): string
    {
        $rootFolder = config('mes-cmd.folder.root') ?? Folder::ROOT;
        return "App\\{$rootFolder}\\{$folder}\\{$this->folder}";
    }

    protected function buildFileName(string $name): string
    {
        return "{$name}.php";
    }

    protected function ensureDirectoryExists(string $path): void
    {
        $this->makeDirectory($path);
    }

    protected function fileExists(string $path, string $name): bool
    {
        if (file_exists($path)) {
            $this->error("{$name} {$this->folder} already exists!");
            return true;
        }
        return false;
    }

    protected function invalidFileName(string $name): bool
    {
        $folder = Str::singular($this->folder);
        if (!Str::endsWith($name, "{$folder}")) {
            $this->error("{$name} must end with '{$folder}'!");
            return true;
        }
        return false;
    }

    protected function createFile(string $path, string $stub): void
    {
        File::put($path, $stub);
    }
}
