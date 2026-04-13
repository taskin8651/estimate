@extends('layouts.admin')

@section('content')

<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Posts</h1>
    <a href="{{ route('admin.posts.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded">+ Add</a>
</div>

@if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3 text-left">Title</th>
                <th class="p-3">Images</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($posts as $post)
            <tr class="border-t">
                <td class="p-3">{{ $post->title }}</td>

                <td class="p-3 flex gap-2">
                    @foreach($post->getMedia('images') as $img)
                        <img src="{{ $img->getUrl() }}" class="w-12 h-12 rounded object-cover">
                    @endforeach
                </td>

                <td class="p-3 flex gap-2">
                    <a href="{{ route('admin.posts.edit',$post->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">Edit</a>

                    <form method="POST" action="{{ route('admin.posts.destroy',$post->id) }}">
                        @csrf @method('DELETE')
                        <button class="bg-red-500 text-white px-3 py-1 rounded"
                                onclick="return confirm('Delete?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection