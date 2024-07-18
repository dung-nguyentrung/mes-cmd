<?php

namespace DungNguyenTrung\MesCmd\Commands;


use DungNguyenTrung\MesCmd\Constants\Folder;
use DungNguyenTrung\MesCmd\Constants\Shell;

class MakeRepositoryCommand extends Maker
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Shell::REPOSITORY;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repo builder in a custom directory';

    public function __construct()
    {
        $folder = config('mes-cmd.folder.repo') ?? Folder::REPO;
        parent::__construct($folder);
    }
}
