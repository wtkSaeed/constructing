<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait RequestMaterialOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRequestMaterialRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/request-material', [
            'as'        => $routeName.'.requestMaterial',
            'uses'      => $controller.'@requestMaterial',
            'operation' => 'requestMaterial',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRequestMaterialDefaults()
    {
        CRUD::allowAccess('requestMaterial');

        CRUD::operation('requestMaterial', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'request_material', 'view', 'crud::buttons.request_material');
            // CRUD::addButton('line', 'request_material', 'view', 'crud::buttons.request_material');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function requestMaterial()
    {
        CRUD::hasAccessOrFail('requestMaterial');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Request Material '.$this->crud->entity_name;

        // load the view
        return view('crud::operations.request_material', $this->data);
    }
}