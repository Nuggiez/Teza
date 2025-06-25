<div x-data="{ showDeleteModal: false }">


    <div>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9D00]">Add Category</a>
    </div>

    <br>

    <!-- Desktop Table View -->
    <div class="hidden md:block">
        <table class="w-full border-[var(--color-border)] border-[0.25rem]">
            <thead>
                <tr>
                    <th class="border-[var(--color-border)] border-[0.25rem] p-2">Id</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] p-2">Name</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] p-2">Image</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] p-2">Description</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td class="border-[var(--color-border)] border-[0.25rem] p-2 text-center">
                            {{ $category->id }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] p-2">
                            {{ $category->name }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] p-2">
                            <img src="{{ asset('uploads/category/' . $category->image) }}" class=" h-12 aspect-auto" />
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] p-2">{{ $category->description }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] h-20 p-0">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="w-full h-1/2 bg-[var(--color-accent)] flex items-center justify-center text-[var(--color-bg-primary)]">
                                Edit
                            </a>
                            <hr class="border-t-[0.25rem] border-[var(--color-border)]" />
                            <button wire:click="confirmDelete({{ $category->id }})" @click="showDeleteModal = true" class="w-full h-1/2 bg-[var(--color-error)] flex items-center justify-center text-[var(--color-bg-primary)]">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Mobile Card View -->
    <div class="grid grid-cols-1 gap-4 md:hidden">
        @foreach ($categories as $category)
            <div class="bg-[var(--color-bg-secondary)] p-4 rounded-lg shadow space-y-3">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-lg">{{ $category->name }}</h2>
                    <span class="text-xs bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-2 py-1 rounded">ID: {{ $category->id }}</span>
                </div>
                <div>
                    <img src="{{ asset('uploads/category/' . $category->image) }}" class="h-16 w-auto rounded" />
                </div>
                <div class="text-sm space-y-1">
                    <p><strong>Description:</strong> {{ $category->description }}</p>
                </div>
                <div class="flex w-full space-x-2 pt-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="flex-1 bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-3 py-2 rounded text-center">Edit</a>
                    <button wire:click="confirmDelete({{ $category->id }})" @click="showDeleteModal = true" class="flex-1 bg-[var(--color-error)] text-[var(--color-bg-primary)] px-3 py-2 rounded">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <div x-show="showDeleteModal" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class=" bg-[var(--color-bg-secondary)] rounded-lg p-6 w-full max-w-xl">
            <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this category?</p>
            <div class="flex justify-end space-x-2">
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
</div>
