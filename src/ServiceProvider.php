<?php

namespace Harry\MesCmd;

use Harry\MesCmd\Commands\{
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

class ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
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
