@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Create Post</h1>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @include('admin.posts._form')

    <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
</form>

@endsection