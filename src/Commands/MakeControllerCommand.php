<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeControllerCommand extends Maker
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::CONTROLLER;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller in a custom directory';

    public function __construct()
    {
        $folder = config('mes-cmd.folder.controller') ?? Folder::CONTROLLER;
        parent::__construct($folder, false);
    }
}
