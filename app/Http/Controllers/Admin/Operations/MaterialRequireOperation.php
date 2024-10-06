<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\ProjectMaterials;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;

use Alert;
use App\Models\Materials;
use App\Models\Project;

trait MaterialRequireOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupMaterialRequireRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/{id}/material_require', [
            'as' => $routeName . '.materialRequire',
            'uses' => $controller . '@materialRequire',
            'operation' => 'materialRequire',
        ]);
        Route::post($segment . '/{id}/material_require', [
            'as' => $routeName . '.save_material',
            'uses' => $controller . '@saveMaterial',
            'operation' => 'materialRequire',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupMaterialRequireDefaults()
    {
        CRUD::allowAccess('materialRequire');

        CRUD::operation('materialRequire', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            // CRUD::addButton('top', 'material_require', 'view', 'crud::buttons.material_require');
            CRUD::addButton('line', 'material_require', 'view', 'crud::buttons.material_require');
        });
    }

    /**
     * Show the view for performing the operation.
     *
     * @return Response
     */
    public function materialRequire()
    {
        CRUD::hasAccessOrFail('materialRequire');

        // prepare the fields you need to show
        $this->data['crud'] = $this->crud;
        $this->data['title'] = CRUD::getTitle() ?? 'Material Require ' . $this->crud->entity_name;
        $this->data['entry'] = $this->crud->getCurrentEntry();
        $this->data['materials'] = Materials::all();
        $this->data['project'] = Project::find($this->crud->getCurrentEntry()->id);
        // load the view
//  dd($this->data);
        return view('crud::operations.material_require_form', $this->data);
    }

    public function saveMaterial(Request $request)
    {
// dd($request->all());
        // //dd($request->id);
        $validator = Validator::make($request->all(), [
            'project_id' => 'required|exists:projects,id',

            'material_id' => [
                'required',

                \Illuminate\Validation\Rule::unique('project_materials')->where(function ($query) use ($request)  {
                    return $query->where('project_id', $request->project_id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $entry = $this->crud->getCurrentEntry();

        try {
// dd( $validator);
ProjectMaterials::create( $request->all());

            Alert::success('Material added ...')->flash();

            return redirect(url($this->crud->route));
        } catch (Exception $e) {
            // show a bubble with the error message
            Alert::error('Error, ' . $e->getMessage())->flash();

            return redirect()->back()->withInput();
        }
    }
}
