<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeDTOCommand extends Maker
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::DTO;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new dto in a custom directory';

    public function __construct()
    {
        $folder = config('mes-cmd.folder.dto') ?? Folder::DTO;
        parent::__construct($folder, false);
    }
}
