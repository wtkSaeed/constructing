<?php

namespace App\Http\Controllers\Admin;

use App\HelperClasses\Constants;
use App\Http\Requests\ProjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \App\Http\Controllers\Admin\Operations\MaterialRequireOperation;
    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // ; // set columns from db columns.
       CRUD::addButtonFromView("line", "material_require", "material_require");

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        $this->crud->addColumns([
            [
        'name' => 'status',
        'type' => 'closure',
        'label' => 'status',
        'orderable' => false,
        'orderLogic' => 'false',

        'searchLogic' =>'false',


         "function" => function ($entry) {
         return Constants::projectStatus[$entry->status];}


         ],

    ]);

  CRUD::setFromDb();


    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectRequest::class);
      //  CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
        $this->crud->addFields([
            [
                "name" => "name",
                "type" => "text",

                "label" => "name",

                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ],
            [
                "name" => "description",
                "type" => "text",

                "label" => "description",
                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ],
            [
                "name" => "address",
                "type" => "text",

                "label" => "address",
                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ],
            [
                "name" => "start_date",
                "type" => "date",

                "label" => "start_date",
                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ],
            [
                "name" => "end_date",
                "type" => "date",

                "label" => "end_date",
                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ],
            [
                "name" => "status",
                "type" => "select_from_array",

                "label" => "status",
                "options" => Constants::projectStatus,
                'wrapperAttributes' => [
                    'class' => 'col-md-6 form-group'
                ]
            ]]);
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
