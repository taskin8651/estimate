@extends('layouts.admin')
@section('content')

<div class="mb-8 flex items-center justify-between">

<div>
<h1 class="text-2xl font-semibold text-gray-900">
Edit User
</h1>

<p class="text-sm text-gray-500 mt-1">
Update user information and assigned roles
</p>
</div>

<a href="{{ route('admin.users.index') }}"
class="text-sm text-blue-600 hover:underline">
← Back to list
</a>

</div>



<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
@method('PUT')
@csrf



<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


{{-- USER INFO --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">

<h2 class="text-sm font-semibold text-gray-700 mb-4 uppercase">
User Information
</h2>


<div class="mb-4">
<label class="text-sm font-medium">Name *</label>

<input type="text"
name="name"
value="{{ old('name', $user->name) }}"
required
class="w-full px-3 py-2 border rounded-md text-sm">
</div>



<div class="mb-4">
<label class="text-sm font-medium">Email *</label>

<input type="email"
name="email"
value="{{ old('email', $user->email) }}"
required
class="w-full px-3 py-2 border rounded-md text-sm">
</div>



<div class="mb-4">
<label class="text-sm font-medium">
Password
</label>

<input type="password"
name="password"
placeholder="Leave blank to keep current password"
class="w-full px-3 py-2 border rounded-md text-sm">
</div>



<div class="mb-4">
<label class="text-sm font-medium">
Company Name
</label>

<input type="text"
name="company_name"
value="{{ old('company_name', $user->company_name) }}"
class="w-full px-3 py-2 border rounded-md text-sm">
</div>



<div class="grid grid-cols-2 gap-4">

<div>
<label class="text-sm font-medium">
Status
</label>

<select name="status"
class="w-full px-3 py-2 border rounded-md text-sm">

<option value="1"
{{ $user->status ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ !$user->status ? 'selected' : '' }}>
Inactive
</option>

</select>

</div>



<div>
<label class="text-sm font-medium">
Plan ID
</label>

<input type="number"
name="plan_id"
value="{{ old('plan_id', $user->plan_id) }}"
class="w-full px-3 py-2 border rounded-md text-sm">

</div>

</div>



<div class="grid grid-cols-2 gap-4 mt-4">

<div>
<label class="text-sm font-medium">
Joining Date
</label>

<input type="date"
name="joining_date"
value="{{ old('joining_date', $user->joining_date) }}"
class="w-full px-3 py-2 border rounded-md text-sm">
</div>



<div>
<label class="text-sm font-medium">
Expiry Date
</label>

<input type="date"
name="expiry_date"
value="{{ old('expiry_date', $user->expiry_date) }}"
class="w-full px-3 py-2 border rounded-md text-sm">
</div>

</div>


</div>



{{-- SUBSCRIPTION --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">

<h2 class="text-sm font-semibold text-gray-700 mb-4 uppercase">
Subscription
</h2>



<div class="mb-4">

<label class="text-sm font-medium">
Subscription Status
</label>

<select name="subscription_status"
class="w-full px-3 py-2 border rounded-md text-sm">

<option value="trial"
{{ $user->subscription_status == 'trial' ? 'selected' : '' }}>
Trial
</option>

<option value="active"
{{ $user->subscription_status == 'active' ? 'selected' : '' }}>
Active
</option>

<option value="expired"
{{ $user->subscription_status == 'expired' ? 'selected' : '' }}>
Expired
</option>

<option value="cancelled"
{{ $user->subscription_status == 'cancelled' ? 'selected' : '' }}>
Cancelled
</option>

</select>

</div>



<div class="grid grid-cols-2 gap-4">

<div>

<label class="text-sm font-medium">
Trial Ends
</label>

<input type="datetime-local"
name="trial_ends_at"
value="{{ old('trial_ends_at', $user->trial_ends_at) }}"
class="w-full px-3 py-2 border rounded-md text-sm">

</div>



<div>

<label class="text-sm font-medium">
Subscription Ends
</label>

<input type="datetime-local"
name="subscription_ends_at"
value="{{ old('subscription_ends_at', $user->subscription_ends_at) }}"
class="w-full px-3 py-2 border rounded-md text-sm">

</div>

</div>


</div>



{{-- ROLES --}}
<div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 lg:col-span-2">

<div class="flex justify-between mb-4">

<h2 class="text-sm font-semibold text-gray-700 uppercase">
Roles
</h2>

<div class="flex gap-4 text-xs">

<button type="button"
id="select-all"
class="text-blue-600 hover:underline">
Select All
</button>

<button type="button"
id="deselect-all"
class="text-blue-600 hover:underline">
Deselect All
</button>

</div>

</div>



<div class="grid grid-cols-1 sm:grid-cols-3 gap-3">

@foreach($roles as $id => $role)

<label class="flex items-center gap-2 text-sm">

<input type="checkbox"
name="roles[]"
value="{{ $id }}"
class="role-checkbox"
{{ $user->roles->contains($id) ? 'checked' : '' }}>

{{ $role }}

</label>

@endforeach

</div>

</div>



</div>



<div class="mt-8 flex items-center gap-4">

<button type="submit"
class="px-6 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
Save
</button>

<a href="{{ route('admin.users.index') }}"
class="text-sm text-gray-600 hover:underline">
Cancel
</a>

</div>


</form>

@endsection



@section('scripts')

<script>

document.getElementById('select-all').addEventListener('click', function () {

document.querySelectorAll('.role-checkbox').forEach(cb => cb.checked = true);

});


document.getElementById('deselect-all').addEventListener('click', function () {

document.querySelectorAll('.role-checkbox').forEach(cb => cb.checked = false);

});

</script>

@endsection