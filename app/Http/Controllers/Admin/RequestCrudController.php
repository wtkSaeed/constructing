<?php

namespace App\Http\Controllers\Admin;

use App\HelperClasses\Constants;
use App\Http\Requests\RequestRequest;
use App\Models\Materials;
use App\Models\Project;
use App\Models\request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;
/**
 * Class RequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RequestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Request::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/request');
        CRUD::setEntityNameStrings('request', 'requests');

        CRUD::addButtonFromView("line", "request_details", "request_details");
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        $this->crud->addColumns([

            [
                'name' => 'project',
                'type' => 'closure',
                'label' => 'project name',

                'function' => function ($entry) {
                    return $entry->project->name;
                },
            ],
            [
                'name' => 'user',
                'type' => 'closure',
                'label' => 'user name',
                'orderable' => false,
                'orderLogic' => 'false',

                'searchLogic' => 'false',

                'function' => function ($entry) {
                    return $entry->user->name;
                },
            ],
            [
                'name' => 'status',
                'type' => 'closure',
                'label' => 'status ',
                'orderable' => false,
                'orderLogic' => 'false',

                'searchLogic' => 'false',

                'function' => function ($entry) {
                    return Constants::requestStatus[$entry->status];
                },
            ],
            [
                'name' => 'nb',
                'type' => 'text',
                'label' => 'request number',

            ],
            [
                'name' => 'theDate',
                'type' => 'Date',
                'label' => 'date of request',

            ], [
                'name' => 'note',
                'type' => 'text',
                'label' => 'request note ',

            ],
        ]);

        // CRUD::setFromDb(); // set columns from db columns.
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        request::creating(function($entry) {
            $entry->user_id = backpack_user()->id;
        });
        CRUD::setValidation(RequestRequest::class);
       // CRUD::setFromDb(); // set fields from db columns.
       CRUD::field('user_id')->type('hidden')->value(Auth::id());
        Crud::addFields([
            [
                'name' => 'project_id',
                'type' => 'select_from_array',
                'options' => Project::whereIn('status', [1,2,3])->pluck('name', 'id')->toArray(),
                'label' => 'project name',
            ],



            [
                'name' => 'nb',
                'type' => 'text',
                'label' => 'request number',
            ],
            [
                'name' => 'theDate',
                'type' => 'date',
                'label' => 'date of request',
            ],  [
                'name' => 'note',
                'type' => 'text',
                'label' => 'notes',
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }



}
