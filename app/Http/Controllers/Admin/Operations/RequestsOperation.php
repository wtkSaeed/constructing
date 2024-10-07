<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait RequestsOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRequestsRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/requests', [
            'as'        => $routeName.'.requests',
            'uses'      => $controller.'@requests',
            'operation' => 'requests',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRequestsDefaults()
    {
        CRUD::allowAccess('requests');

        CRUD::operation('requests', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'requests', 'view', 'crud::buttons.requests');
            // CRUD::addButton('line', 'requests', 'view', 'crud::buttons.requests');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function requests()
    {
        CRUD::hasAccessOrFail('requests');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Requests '.$this->crud->entity_name;

        // load the view
        return view('crud::operations.requests', $this->data);
    }
}