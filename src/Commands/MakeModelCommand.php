<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeModelCommand extends Maker
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

    public function __construct()
    {
        $folder = config('mes-cmd.folder.model') ?? Folder::MODEL;
        parent::__construct($folder, false);
    }
}
