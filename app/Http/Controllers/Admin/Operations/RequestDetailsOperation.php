<?php

namespace App\Http\Controllers\Admin\Operations;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

trait RequestDetailsOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupRequestDetailsRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/request-details', [
            'as'        => $routeName.'.requestDetails',
            'uses'      => $controller.'@requestDetails',
            'operation' => 'requestDetails',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupRequestDetailsDefaults()
    {
        CRUD::allowAccess('requestDetails');

        CRUD::operation('requestDetails', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'request_details', 'view', 'crud::buttons.request_details');
            // CRUD::addButton('line', 'request_details', 'view', 'crud::buttons.request_details');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function requestDetails()
    {
        CRUD::hasAccessOrFail('requestDetails');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Request Details '.$this->crud->entity_name;

        // load the view
        return view('crud::operations.request_details', $this->data);
    }
}