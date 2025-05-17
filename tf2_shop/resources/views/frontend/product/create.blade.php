<x-app-layout>
    <form action="{{ url('frontend/product') }}" method="POST" enctype="multipart/form-data"
        class="max-w-2xl border-[var(--color-accent)] bg-[var(--color-bg-secondary)] border-[0.25rem] p-[1.5rem] border-solid mx-auto shadow-[var(--color-highlight)] shadow">
        @csrf
        <div class="mb-2">
            <x-input-label for="name" :value="'Name'" />
            <x-text-input name="name" id="name" required />
        </div>
        <div class="mb-2">
            <x-input-label for="description" :value="'Description'" />
            <x-text-input name="description" id="description" required />
        </div>
        <div class="mb-2">
            <x-input-label for="dropzone-file" :value="'Image'" />
            <x-file-input name="dropzone-file" id="dropzone-file" required />
        </div>
        <div class="mb-2">
            <x-input-label for="price" :value="'Price'" />
            <x-text-input name="price" id="price" required />
        </div>
        <div class="mb-2">
            <x-input-label for="category_id" :value="'Category'" />
            <!-- <x-text-input name="category_id" id="category_id" required /> -->
            <select name="category_id" class="border-[0.125rem] border-[var(--color-border)] focus:border-[var(--color-border)] focus:ring-[var(--color-border-focus)] rounded-md bg-transparent w-full text-2xl">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}"</option>
                @endforeach
            </select>
        </div>
        <div>
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
