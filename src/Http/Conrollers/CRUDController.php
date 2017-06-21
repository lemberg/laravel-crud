<?php

namespace Lemberg\CRUD\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\ResponseFactory;

/**
 * Class CRUDController
 * @package Lemberg\CRUD\Http\Controllers
 */
class CRUDController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var ResponseFactory
     */
    protected $response;

    /**
     * CRUDController constructor.
     */
    public function __construct()
    {
        $this->checkRequiredProperties();
        $this->makeProperties();
        $this->setRoute();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->getViewName('index'), [
            'data' => $this->model->paginate(10),
            'route' => $this->route,
            'viewsFolder' => $this->viewsFolder,
            'model' => $this->model,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->getViewName('create'), ['entity' => $this->model, 'route' => $this->route]);
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
        $data = $this->request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                unset($data[$key]);
            }
        }
        $this->model->create($data);

        return $this->redirectTo('index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        return view($this->getViewName('show'), [
            'entity' => $this->model->findOrFail($id),
            'route' => $this->route
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view($this->getViewName('edit'), ['entity' => $this->model->findOrFail($id), 'route' => $this->route]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->request->all();
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                unset($data[$key]);
            }
        }
        $this->model->findOrFail($id)->update($data);

        return $this->redirectTo('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();

        return $this->redirectTo('index');
    }

    private function checkRequiredProperties()
    {
        if (!property_exists($this, 'model')) {
            throw new \Exception('model property is required');
        }

        if (!property_exists($this, 'request')) {
            throw new \Exception('request property is required');
        }
    }

    private function makeProperties()
    {
        $this->model = app($this->model);
        $this->request = app($this->request);
        $this->response = app(ResponseFactory::class);
    }

    private function setRoute()
    {
        if (!property_exists($this, 'route')) {

            $this->route = $this->getCurrentCallingControllerName();
        }

        return $this->route;
    }

    /**
     * Redirect to url
     *
     * @param string $url
     *
     * @param array $params
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($url, $params = [])
    {
        return $this->response->redirectToRoute($this->route . "." . $url, $params);
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

}
