{{-- @if ($crud->hasAccess('edit_project_recommend_material')) --}}
  <a href="{{ url($crud->route.'/showRequierment'.'/'.$entry->getKey()) }}" class="btn btn-sm btn-link text-capitalize"><i class="la la-question"></i> showRequierment</a>
{{-- @endif --}}
