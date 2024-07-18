<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;


class MakeServiceCommand extends Maker
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::SERVICE;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service in a custom directory';

    public function __construct()
    {
        $folder = config('mes-cmd.folder.service') ?? Folder::SERVICE;
        parent::__construct($folder);
    }
}
