@extends('layouts.admin')
@section('content')

<div class="mb-8 flex items-center justify-between">

<div>
<h1 class="text-2xl font-semibold text-gray-900">
Users
</h1>

<p class="text-sm text-gray-500 mt-1">
Manage application users and their roles
</p>
</div>

@can('user_create')
<a href="{{ route('admin.users.create') }}"
class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
+ Add User
</a>
@endcan

</div>



<div class="bg-white border border-gray-200 rounded-lg shadow-sm">

<div class="overflow-x-auto">

<table class="min-w-full text-sm datatable datatable-User">

<thead class="bg-gray-50 border-b">

<tr class="text-left text-gray-600 font-medium">

<th class="px-6 py-3 w-10"></th>

<th class="px-6 py-3">ID</th>

<th class="px-6 py-3">User</th>

<th class="px-6 py-3">Company</th>

<th class="px-6 py-3">Plan</th>

<th class="px-6 py-3">Subscription</th>

<th class="px-6 py-3">Status</th>

<th class="px-6 py-3">Roles</th>

<th class="px-6 py-3 text-right">Actions</th>

</tr>

</thead>



<tbody class="divide-y divide-gray-100">

@foreach($users as $user)

<tr class="hover:bg-gray-50 transition"
data-entry-id="{{ $user->id }}">

<td class="px-6 py-4"></td>



<td class="px-6 py-4 font-medium text-gray-900">
#{{ $user->id }}
</td>



<td class="px-6 py-4">

<div class="flex items-center gap-3">

<div class="w-9 h-9 rounded-full bg-blue-600 text-white
flex items-center justify-center font-semibold text-sm">

{{ strtoupper(substr($user->name,0,1)) }}

</div>

<div>

<p class="font-medium text-gray-900">
{{ $user->name }}
</p>

<p class="text-xs text-gray-500">
{{ $user->email }}
</p>

</div>

</div>

</td>



<td class="px-6 py-4 text-gray-700">

{{ $user->company_name ?? '—' }}

</td>



<td class="px-6 py-4">

@if($user->plan_id)

<span class="px-2 py-1 text-xs bg-indigo-100 text-indigo-700 rounded">

Plan #{{ $user->plan_id }}

</span>

@else

—

@endif

</td>



<td class="px-6 py-4">

@if($user->subscription_status == 'active')

<span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
Active
</span>

@elseif($user->subscription_status == 'trial')

<span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">
Trial
</span>

@elseif($user->subscription_status == 'expired')

<span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
Expired
</span>

@else

<span class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded">
Cancelled
</span>

@endif

</td>



<td class="px-6 py-4">

@if($user->status)

<span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
Active
</span>

@else

<span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">
Inactive
</span>

@endif

</td>



<td class="px-6 py-4">

<div class="flex flex-wrap gap-1">

@foreach($user->roles as $role)

<span class="px-2 py-1 text-xs rounded-md
bg-gray-100 text-gray-700 border">

{{ $role->title }}

</span>

@endforeach

</div>

</td>



<td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">

@can('user_show')

<a href="{{ route('admin.users.show', $user->id) }}"
class="px-3 py-1 text-xs border rounded text-gray-700 hover:bg-gray-100">

View

</a>

@endcan



@can('user_edit')

<a href="{{ route('admin.users.edit', $user->id) }}"
class="px-3 py-1 text-xs border border-blue-600 text-blue-600 rounded hover:bg-blue-50">

Edit

</a>

@endcan



@can('user_delete')

<form action="{{ route('admin.users.destroy', $user->id) }}"
method="POST"
class="inline-block"
onsubmit="return confirm('Are you sure?');">

@method('DELETE')
@csrf

<button type="submit"
class="px-3 py-1 text-xs border border-red-600 text-red-600 rounded hover:bg-red-50">

Delete

</button>

</form>

@endcan

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection