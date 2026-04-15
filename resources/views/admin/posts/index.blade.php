@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6 p-4">
    <h1 class="text-2xl font-semibold text-gray-800">Posts</h1>

    <a href="{{ route('admin.posts.create') }}" 
       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
        + Add Post
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 p-3 mb-4 rounded-lg">
        {{ session('success') }}
    </div>
@endif

{{-- Table --}}
<div class="bg-white shadow-lg rounded-xl overflow-hidden m-5">

    <table class="w-full text-sm text-left">
        
        {{-- Head --}}
        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
            <tr>
                <th class="p-4">Title</th>
                <th class="p-4 text-center">Images</th>
                <th class="p-4 text-center">Action</th>
            </tr>
        </thead>

        {{-- Body --}}
        <tbody>

            @forelse($posts as $post)
                <tr class="border-t hover:bg-gray-50 transition">

                    {{-- Title --}}
                    <td class="p-4 font-medium text-gray-800">
                        {{ $post->title }}
                    </td>

                    {{-- Images --}}
                    <td class="p-4">
                        <div class="flex justify-center gap-2 flex-wrap">
                            
                            @foreach($post->getMedia('images')->take(3) as $img)
                                <img src="{{ $img->getUrl() }}" 
                                     class="w-12 h-12 object-cover rounded-lg border">
                            @endforeach

                            {{-- Extra count --}}
                            @if($post->getMedia('images')->count() > 3)
                                <span class="bg-gray-200 text-xs px-2 py-1 rounded">
                                    +{{ $post->getMedia('images')->count() - 3 }}
                                </span>
                            @endif

                        </div>
                    </td>

                    {{-- Actions --}}
                    <td class="p-4">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('admin.posts.edit',$post->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs shadow">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('admin.posts.destroy',$post->id) }}">
                                @csrf 
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs shadow">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty

                {{-- Empty State --}}
                <tr>
                    <td colspan="3" class="text-center p-6 text-gray-500">
                        No posts found 🚫
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>
</div>

@endsection