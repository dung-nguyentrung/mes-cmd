<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeViewModelCommand extends Maker
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::VIEW_MODEL;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view model in a custom directory';

    public function __construct()
    {
        $folder = config('mes-cmd.folder.view_model') ?? Folder::VIEW_MODEL;
        parent::__construct($folder);
    }
}
