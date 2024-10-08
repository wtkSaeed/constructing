<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestDetailRequest;
use App\Models\request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

use Exception;

use Alert;
use App\HelperClasses\Constants;
use App\Models\Materials;
use App\Models\Project;

use App\Models\requestDetails;

/**
 * Class RequestDetailCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RequestDetailCrudController extends CrudController
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
        CRUD::setModel(\App\Models\requestDetails::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/request-detail');
        CRUD::setEntityNameStrings('request detail', 'request details');
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
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RequestDetailRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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

    public function addRequestDetails($id)
    {

        $req = \App\Models\request::findOrFail($id);
        $materials = Materials::all();
        // $details = $req->requestDetails();dd($details);
         $details = requestDetails::where('request_id',$req->id)->get();
        $requestStatus=Constants::requestStatus;

        return view('add_request_details', compact(['req', 'materials', 'details','requestStatus']));
    }

    public function saveRequestMaterials(\Illuminate\Http\Request $request)
    {
        // dd($request->all());
        // //dd($request->id);
        $validator = Validator::make($request->all(), [
            'request_id' => 'required|exists:requests,id',

            'material_id' => [
                'required',

                \Illuminate\Validation\Rule::unique('request_details')->where(function ($query) use ($request) {
                    return $query->where('request_id', $request->request_id);
                }),
                \Illuminate\Validation\Rule::exists('project_materials')->where(function ($query) use ($request) {
                    return $query->where('material_id', $request->material_id);
                }),

            ],
 'quantity' => 'required|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        try {
            // dd( $validator);
            requestDetails::create($request->all());

            Alert::success('Material added ...')->flash();

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            // show a bubble with the error message
            Alert::error('Error, ' . $e->getMessage())->flash();

            return redirect()->back()->withInput();
        }
    }


    public function materialsRequestUpdate(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0', // Validate quantity
        ]);

        requestDetails::where('id', $id)
            ->first()
            ->update(['quantity' => $request->quantity]);
        return redirect()->back()->with('success', 'Material updated successfully!');
    }

    public function destroy($id)
    {
        try {
            // dd( $validator);
            requestDetails::find($id)->delete();

            Alert::success('Material deleted ...')->flash();

            return redirect()->back()->withInput();
        } catch (Exception $e) {
            // show a bubble with the error message
            Alert::error('Error, ' . $e->getMessage())->flash();

            return redirect()->back()->withInput();
        }
    }
}
