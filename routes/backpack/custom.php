<?php

use App\Http\Controllers\Admin\ProjectMaterialsCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('project', 'ProjectCrudController');
    Route::crud('materials', 'MaterialsCrudController');
    Route::crud('project-materials/{passed_project_id?}', 'ProjectMaterialsCrudController');

route::get('project/showRequierment/{id}', action: [ProjectMaterialsCrudController::class, 'showRequierment'])->name(name: 'project.materials.showRequierment');

route::get('/projectRecommendMaterial/{id}/show', action: [ProjectMaterialsCrudController::class, 'projectRecommendMaterial'])->name(name: 'project.materials.recommand');





}); // this should be the absolute last line of this file






/**
 * DO NOT ADD ANYTHING HERE.
 */
