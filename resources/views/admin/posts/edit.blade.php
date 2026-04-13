@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">Edit Post</h1>

<form action="{{ route('admin.posts.update',$post->id) }}" method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow space-y-4">

    @csrf
    @method('PUT')

    @include('admin.posts._form')

    <button class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
</form>

@endsection