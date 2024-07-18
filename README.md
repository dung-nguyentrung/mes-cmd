## Generate file for Greenland Project

## Folder Structure

```
├── app
│   └── Common
│       ├── Constants
│       ├── Controllers
│       └── Helpers
│       └── Interfaces
│       └── Middleware
│       └── Models
│       └── Repositories
│       └── Services
│       └── Traits
│   └── Modules
│       ├── Auth
│           ├── Controllers
│           ├── DataTransferObjects
│           ├── Exceptions
│           ├── Interfaces
│           ├── Models
│           ├── QueryBuilders
│           ├── Requests
│           ├── Routes
│           ├── Rules
│           ├── Services
│           ├── Exports
│           ├── Imports
│           ├── Jobs
│       ├── ...
├── ...
```

## Config

### Publish Config File

`mes-cmd.php`

```shell
php artisan vendor:publish

  Which provider or tag's files would you like to publish?
  All providers and tags ......................................................................................................................... 0
  Provider: DungNguyenTrung\MesCmd\MESServiceProvider ............................................................................................ 1
  Provider: Illuminate\Foundation\Providers\FoundationServiceProvider ............................................................................ 2
  Provider: Illuminate\Mail\MailServiceProvider .................................................................................................. 3
  Provider: Illuminate\Notifications\NotificationServiceProvider ................................................................................. 4
  Provider: Illuminate\Pagination\PaginationServiceProvider ...................................................................................... 5
  Provider: Laravel\Sail\SailServiceProvider ..................................................................................................... 6
  Provider: Laravel\Sanctum\SanctumServiceProvider ............................................................................................... 7
  Provider: Laravel\Tinker\TinkerServiceProvider ................................................................................................. 8
  Tag: config .................................................................................................................................... 9
  Tag: laravel-errors ........................................................................................................................... 10
  Tag: laravel-mail ............................................................................................................................. 11
  Tag: laravel-notifications .................................................................................................................... 12
  Tag: laravel-pagination ....................................................................................................................... 13
  Tag: sail ..................................................................................................................................... 14
  Tag: sail-bin ................................................................................................................................. 15
  Tag: sail-database ............................................................................................................................ 16
  Tag: sail-docker .............................................................................................................................. 17
  Tag: sanctum-config ........................................................................................................................... 18
  Tag: sanctum-migrations ....................................................................................................................... 19
  .....
```

Type `1` to publish this package's config

### Config Folders Setting

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MES Command Line Config
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'folder' => [
        'root' => 'Modules',
        'controller' => 'Controller',
        'dto' => 'DataTransferObjects',
        'model' => 'Models',
        'query' => 'QueryBuilders',
        'repo' => 'Repositories',
        'service' => 'Services',
        'view' => 'Views',
        'view_model' => 'ViewModels',
    ],
];
```

## Description

This package includes some custom collectors:

- Create a new controller
- Create a new DTO
- Create a new Model
- Create a new Query
- Create a new Repository
- Create a new Service
- Create a new View
- Create a new ViewModel

## Installation

Require this package with composer. It is recommended to only require the package for development.

```shell
composer require dung-nguyentrung/mes-cmd:dev-master --dev
```

## Usage

### Make Controller

```shell
php artisan mes:controller ControllerName Folder
```

<span style="color: green;">
Controller created successfully at yourPath/app\Modules/{Folder}/Controllers/{ControllerName}.php
</span>

### Make Model

```shell
php artisan mes:model ModelName Folder
```

<span style="color: green;">
Model created successfully at yourPath/app\Modules/{Folder}/Models/{ModelName}.php
</span>

### Make Query Builder

- Basic

```shell
php artisan mes:query QueryBuilderName Folder
```

- Add --model Tag

```shell
php artisan mes:query QueryBuilderName Folder --model=YourModel
```

`YourModel.php`

```php
<?php

...
use App\Modules/{Folder}/QueryBuilders/{QueryBuilderName};

class YourModel extends BaseModel
{
    use HasFactory;

    ...

    /**
     * newEloquentBuilder
     *
     * @param  $query
     * @return QueryBuilderName
     */
    public function newEloquentBuilder($query): QueryBuilderName
    {
        return new QueryBuilderName($query);
    }
}

```

<span style="color: green;">
QueryBuilder created successfully at yourPath/app\Modules/{Folder}/QueryBuilders/{QueryBuilderName}.php
</span>

### Make View

```shell
php artisan mes:view view-name Folder
```

<span style="color: green;">
View created successfully at yourPath/app\Modules/{Folder}/View/{view-name}.blade.php
</span>

### Make View Model

```shell
php artisan mes:vm ViewModelName Folder
```

<span style="color: green;">
View Model created successfully at yourPath/app\Modules/{Folder}/ViewModels/{ViewModelName}.php
</span>

### Make Service

```shell
php artisan mes:service ServiceName Folder
```

<span style="color: green;">
Service created successfully at yourPath/app\Modules/{Folder}/Services/{ServiceName}.php
</span>
<span style="color: green;">
{ServiceName}Interface created successfully at yourPath/app\Modules/{Folder}/Interfaces/{ServiceName}Interface.php
</span>

### Make Repository

```shell
php artisan mes:repo RepositoryName Folder
```

<span style="color: green;">
View created successfully at yourPath/app\Modules/{Folder}/Repositories/{RepositoryName}.php
</span>
<span style="color: green;">
{RepositoryName}Interface created successfully at yourPath/app\Modules/{Folder}/Interfaces/{RepositoryName}Interface.php
</span>
