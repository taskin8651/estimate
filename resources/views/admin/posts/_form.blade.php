<div class="space-y-4">

    {{-- 🔴 Validation Errors --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 📝 Title --}}
    <div>
        <label class="block mb-1 font-medium">Title</label>
        <input type="text" name="title"
               value="{{ old('title', $post->title ?? '') }}"
               class="w-full border p-2 rounded"
               required>
    </div>

    {{-- 📄 Description --}}
    <div>
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="content" id="editor"
                  class="w-full border p-2 rounded h-32">{{ old('content', $post->content ?? '') }}</textarea>
    </div>

    {{-- 🖼️ Upload Images --}}
    <div>
        <label class="block mb-1 font-medium">Upload Images</label>
        <input type="file" name="images[]" multiple
               class="w-full border p-2 rounded">
        <small class="text-gray-500">You can select multiple images</small>
    </div>

    {{-- 🖼️ Existing Images --}}
    @if(isset($post) && $post->getMedia('images')->count())
        <div>
            <label class="block mb-2 font-medium">Existing Images</label>

            <div class="flex gap-4 flex-wrap">
                @foreach($post->getMedia('images') as $img)
                    <div class="relative group">

                        {{-- Image --}}
                        <img src="{{ $img->getUrl() }}"
                             class="w-24 h-24 object-cover rounded shadow">

                        {{-- Hidden checkbox --}}
                        <input type="checkbox"
                               name="delete_images[]"
                               value="{{ $img->id }}"
                               class="hidden delete-checkbox">

                        {{-- ❌ Delete Button --}}
                        <button type="button"
                                onclick="deleteImage(this)"
                                class="absolute top-1 right-1 bg-red-500 text-white text-xs px-2 py-1 rounded opacity-80 hover:opacity-100">
                            ✕
                        </button>

                    </div>
                @endforeach
            </div>

            <small class="text-gray-500">Click ❌ to remove image</small>
        </div>
    @endif

</div>

{{-- 🧠 JS for delete --}}
<script>
    function deleteImage(btn) {
        let container = btn.parentElement;
        let checkbox = container.querySelector('.delete-checkbox');

        checkbox.checked = true;
        container.style.display = 'none';
    }
</script>