<x-app-layout>
    <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl border-[var(--color-accent)] bg-[var(--color-bg-secondary)] border-[0.25rem] p-[1.5rem] border-solid mx-auto shadow-[var(--color-highlight)] shadow">
        @csrf
        <div class="mb-2">
            <x-input-label for="name" :value="('Name')" />
            <x-text-input name="name" id="name" required/>
        </div>
        <div  class="mb-2">
            <x-input-label for="description" :value="('Description')" />
            <x-text-input name="description" id="description" required/>
        </div>
        <div  class="mb-2">
            <x-input-label for="dropzone-file" :value="('Image')" />
            <x-file-input name="dropzone-file" id="dropzone-file" required/>
        </div>
        <div>
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>