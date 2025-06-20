<x-app-layout>
    <form action="{{ url('admin/category/' . $category->id) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl border-[var(--color-accent)] bg-[var(--color-bg-secondary)] border-[0.25rem] p-[1.5rem] border-solid mx-auto shadow-[var(--color-highlight)] shadow">
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
</x-app-layout>