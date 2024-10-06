{{-- @if ($crud->hasAccess('material_require')) --}}
  <a href="{{ url($crud->route.'/'.$entry->getKey().'/material_require') }}" class="btn btn-sm btn-link text-capitalize"><i class="la la-question"></i> material_require</a>
{{-- @endif --}}

