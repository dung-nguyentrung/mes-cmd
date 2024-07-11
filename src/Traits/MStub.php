<?php

namespace DungNguyenTrung\MesCmd\Traits;

use DungNguyenTrung\MesCmd\Constants\Folder;

trait MStub
{
    protected function getNewEloquentQueryStub(string $className): string
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

    protected function populateStub(string $namespace, string $className, string $folder): string
    {
        $stub = $this->getStub();
        return str_replace(['{{namespace}}', '{{className}}', '{{folder}}'], [$namespace, $className, $folder], $stub);
    }

    protected function getStub(): string
    {
        $stubName = Stub::${$this->folder};
        return File::get(__DIR__ . "/../Stubs/{$stubName}.stub");
    }

    protected function getInterfaceStub(): string
    {
        if ($this->folder == Folder::REPO)
            return File::get(__DIR__ . '/../Stubs/repo-interface.stub');
        return File::get(__DIR__ . '/../Stubs/interface.stub');
    }
}
