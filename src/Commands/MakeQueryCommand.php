<?php

namespace DungNguyenTrung\MesCmd\Commands;

use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeQueryCommand extends Maker
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

    public function __construct()
    {
        $folder = config('mes-cmd.folder.query') ?? Folder::QUERY;
        parent::__construct($folder);
    }
}
