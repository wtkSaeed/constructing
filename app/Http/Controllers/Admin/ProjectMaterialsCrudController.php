<?php

namespace App\Http\Controllers\Admin;

use App\HelperClasses\Constants;
use App\Http\Requests\ProjectMaterialsRequest;
use App\Models\Materials;
use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Exception;
use Validator;
use Alert;

/**
 * Class ProjectMaterialsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProjectMaterialsCrudController extends CrudController
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
        CRUD::setModel(\App\Models\ProjectMaterials::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project-materials');
        CRUD::setEntityNameStrings('project materials', 'project materials');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
*/
        $this->crud->addColumns([
                [
            'name' => 'material',
            'type' => 'closure',
            'label' => 'material name',
            'orderable' => false,
            'orderLogic' => 'false',

            'searchLogic' =>'false',


            "function" => function ($entry) {
                return $entry->materials->name;
            },



        ],
             [
            'name' => 'project',
            'type' => 'closure',
            'label' => 'project name',

            "function" => function ($entry) {
                return $entry->projects->name;
            }



        ]

        ]);



    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProjectMaterialsRequest::class);
      //  CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    Crud::addFields(
        [
            [
                "name" => "project_id",
                "type" => "select_from_array",
               'options' => Project::where('status',1)
                    ->pluck('name', 'id')->toArray(),
                "label" => "project name",
            ],
            [
                "name" => "material_id",
                "type" => "select_from_array",
                'options' => Materials::pluck('name', 'id')->toArray(),
                "label" => "material name",
            ],

            [
                "name" => "quantity",
                "type" => "text",
                "label" => "quantity",
            ]


        ]
   );




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



public function showRequierment(Request $request)

{
// //dd($request->id);
$project=Project::with('materials')->find($request->id);


return
view('project_Requirement_Materials',compact('project'));
}



public function projectRecommendMaterial(Request $request)
{
// //dd($request->id);
    $project=Project::with('materials')->find($request->id);


return
       view('vendor.backpack.projectMaterials',compact('project'));
}


}
