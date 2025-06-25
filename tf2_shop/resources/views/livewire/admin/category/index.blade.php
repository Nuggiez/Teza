<div x-data="{ showDeleteModal: false }">
    <div class='flex justify-between items-start'>
        <h1 class="text-3xl font-bold mb-6">Categories Management</h1>
        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9D00]">
            Add Category
        </a>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-stretch">
        @foreach ($categories as $category)
            <div class="bg-[var(--color-bg-secondary)] p-4 shadow flex flex-col justify-between h-full">
                <div class="flex-1 space-y-3">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">{{ $category->name }}</h2>
                        <span class="text-xs bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-2 py-1">
                            ID: {{ $category->id }}
                        </span>
                    </div>
                    <div>
                        <img src="{{ asset('uploads/category/' . $category->image) }}" class="  " />
                    </div>
                    <div class="text-sm">
                        <p><strong>Description:</strong> {{ $category->description }}</p>
                    </div>
                </div>

                <div class="flex w-full space-x-2 pt-2">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="flex-1 bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-3 py-2 text-center">
                        Edit
                    </a>
                    <button wire:click="confirmDelete({{ $category->id }})" @click="showDeleteModal = true"
                            class="flex-1 bg-[var(--color-error)] text-[var(--color-bg-primary)] px-3 py-2">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-[var(--color-bg-secondary)] p-6 w-full max-w-xl rounded">
            <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this category?</p>
            <div class="flex justify-end space-x-2 w-full">
                <x-primary-button @click="showDeleteModal = false" class="w-1/2">
                    Cancel
                </x-primary-button>
                <x-danger-button wire:click="destroyCategory" @click="showDeleteModal = false" class="w-1/2">
                    Confirm
                </x-danger-button>
            </div>
        </div>
    </div>
</div>
