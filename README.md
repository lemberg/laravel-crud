# Lemberg Laravel CRUD package #

## install via composer ##

```composer require lemberg/laravelcrud:dev-master```

add to providers array in ```config/app.php```

```
Collective\Html\HtmlServiceProvider::class,
DaveJamesMiller\Breadcrumbs\ServiceProvider::class,
Lemberg\CRUD\Providers\CRUDServiceProvider::class,
```

add to aliases array in ```config/app.php```

```
'Breadcrumbs' => DaveJamesMiller\Breadcrumbs\Facade::class,
'Form' => Collective\Html\FormFacade::class,
'Html' => Collective\Html\HtmlFacade::class,
```

