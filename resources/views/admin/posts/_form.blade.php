<div>
    <label class="block mb-1 font-medium">Title</label>
    <input type="text" name="title"
           value="{{ old('title', $post->title ?? '') }}"
           class="w-full border p-2 rounded">
</div>

<div>
    <label class="block mb-1 font-medium">Description</label>
    <textarea name="content" id="editor"
              class="w-full border p-2 rounded h-32">{{ old('content', $post->content ?? '') }}</textarea>
</div>

<div>
    <label class="block mb-1 font-medium">Upload Images</label>
    <input type="file" name="images[]" multiple
           class="w-full border p-2 rounded">
</div>

@if(isset($post))
    <div>
        <label class="block mb-2 font-medium">Existing Images</label>
        <div class="flex gap-3 flex-wrap">
            @foreach($post->getMedia('images') as $img)
                <img src="{{ $img->getUrl() }}"
                     class="w-20 h-20 object-cover rounded shadow">
            @endforeach
        </div>
    </div>
@endif