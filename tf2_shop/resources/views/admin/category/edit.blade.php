<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Editing Category</h1>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <x-input-label for="name" :value="('Name')" />
            <x-text-input name="name" id="name" value="{{ $category->name }}" required />
        </div>
        <div  class="mb-2">
            <x-input-label for="description" :value="('Description')" />
            <x-text-input name="description" id="description" value="{{ $category->description }}" required />
        </div>
        <div  class="mb-2">
            <x-input-label for="image" :value="('Image')" />
            <x-file-input name="image" id="image" required/>
        </div>
        <div>
            <x-primary-button>
                {{ __('Update') }}
            </x-primary-button>
        </div>
    </form>
</x-admin-layout>