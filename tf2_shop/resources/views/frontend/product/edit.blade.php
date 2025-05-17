<x-app-layout>
    <form action="{{ url('frontend/product/' . $product->id) }}" method="POST" enctype="multipart/form-data"
        class="max-w-2xl border-[var(--color-accent)] bg-[var(--color-bg-secondary)] border-[0.25rem] p-[1.5rem] border-solid mx-auto shadow-[var(--color-highlight)] shadow">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <x-input-label for="name" :value="'Name'" />
            <x-text-input name="name" id="name" value="{{ $product->name }}" required />
        </div>
        <div class="mb-2">
            <x-input-label for="description" :value="'Description'" />
            <x-text-input name="description" id="description" value="{{ $product->description }}" required />
        </div>
        <div class="mb-2">
            <x-input-label for="dropzone-file" :value="'Image'" />
            <x-file-input name="dropzone-file" id="dropzone-file" required />
        </div>
        <div class="mb-2">
            <x-input-label for="price" :value="'Price'" />
            <x-text-input name="price" id="price" value="{{ $product->price }}" required />
        </div>
        <div class="mb-2">
            <x-input-label for="category_id" :value="'Category'" />
            <!--<x-text-input name="category_id" id="category_id" value="{{ $product->category_id }}" required/>-->
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}"</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-primary-button>
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
