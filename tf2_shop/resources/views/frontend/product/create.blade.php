<x-app-layout>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="py-2 px-4">
        @csrf
            <div class="flex justify-between items-start">
                <h1 class="text-3xl font-bold mb-6">Adding Product</h1>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9D00]">
                    Go Back
                </a>
            </div>
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
                <x-file-input name="image" id="image" required />
            </div>
            <div class="mb-2">
                <x-input-label for="price" :value="'Price'" />
                <x-text-input name="price" id="price" required />
            </div>
            <div class="mb-2">
                <x-input-label for="category_id" :value="'Category'" />
                <select name="category_id"
                    class="border-2 border-[var(--color-border)] focus:border-[var(--color-border)] focus:ring-[var(--color-border-focus)] text-2xl bg-[var(--color-bg-secondary)] w-full">
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
