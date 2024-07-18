<?php

namespace DungNguyenTrung\MesCmd;

use DungNguyenTrung\MesCmd\Commands\{
    MakeControllerCommand,
    MakeDTOCommand,
    MakeModelCommand,
    MakeQueryCommand,
    MakeRepositoryCommand,
    MakeServiceCommand,
    MakeViewCommand,
    MakeViewModelCommand
};
use Illuminate\Support\ServiceProvider;

class MESServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/config/mes-cmd.php' => config_path('mes-cmd.php'),
        ], 'config');
        $this->commands([
            MakeControllerCommand::class,
            MakeDTOCommand::class,
            MakeModelCommand::class,
            MakeQueryCommand::class,
            MakeRepositoryCommand::class,
            MakeServiceCommand::class,
            MakeViewCommand::class,
            MakeViewModelCommand::class,
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
