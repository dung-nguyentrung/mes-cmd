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
