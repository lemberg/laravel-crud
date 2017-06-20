<?php

namespace Lemberg\CRUD\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Lemberg\CRUD\Exceptions\DirectoryNotFoundException;

class CRUDController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->checkRequiredProperties();
        $this->makeProperties();
    }

    private function checkRequiredProperties()
    {
        if (!property_exists($this, 'model')) {
            throw new \Exception('model property is required');
        }
    }

    private function makeProperties()
    {
        $this->model = app($this->model);
    }

    /**
     * Get view name
     *
     * @param string $viewName
     *
     * @return string
     */
    protected function getViewName($viewName)
    {
        return $this->getViewsFolder() . '.' . $viewName;
    }

    /**
     * Get views folder by class name
     *
     * @return string
     * @throws Exception
     */
    protected function getViewsFolder()
    {
        if (!property_exists($this, 'viewsFolder')) {
            $folder = $this->getCurrentCallingControllerName();
            $paths = resource_path('views') . DIRECTORY_SEPARATOR . $folder;
            if (!is_dir($paths)) {
                $folder = 'crud::default';
            }
            $this->viewsFolder = $folder;
        }

        return $this->viewsFolder;
    }

    /**
     * Get lower current calling class name
     *
     * @return string
     */
    protected function getCurrentCallingControllerName()
    {
        if (!property_exists($this, 'currentCallingControllerName')) {
            $namespace = explode('\\', get_class($this));
            $this->currentCallingControllerName = lcfirst(str_replace('Controller', '', end($namespace)));
        }

        return $this->currentCallingControllerName;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Model $model
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view($this->getViewName('show'), ['entity' => $this->model->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
