<x-app-layout>
    <div class="flex min-h-[70vh]">
        <x-admin-sidebar />
        <main class="flex-1 p-8">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl border-[var(--color-accent)] bg-[var(--color-bg-secondary)] border-[0.25rem] p-[1.5rem] border-solid mx-auto shadow-[var(--color-highlight)] shadow">
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
                    <x-input-label for="image" :value="('Image')" />
                    <x-file-input name="image" id="image" required/>
                </div>
                <div>
                    <x-primary-button>
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </main>
    </div>
</x-app-layout>