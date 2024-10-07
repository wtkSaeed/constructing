{{-- @if ($crud->hasAccess('request_details')) --}}
  <a href="{{ route('request.details',$entry->getKey()) }}" class="btn btn-sm btn-link text-capitalize"><i class="la la-question"></i> request_details</a>
{{-- @endif --}}
