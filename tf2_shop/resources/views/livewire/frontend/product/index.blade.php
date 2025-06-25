<div x-data="{ showDeleteModal: false }">
    @if (session()->has('message'))
        <div class="bg-[var(--color-success)] text-[var(--color-bg-primary)] px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div>
        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9D00]">Add Product</a>
    </div>

    <br>

    <!-- Desktop Table View -->
    <div class="hidden md:block">
        <table class="w-full border-[var(--color-border)] border-[0.25rem]">
            <thead>
                <tr>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Name</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Image</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Description</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Price</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Category</th>
                    <th class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">
                            {{ $product->name }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">
                            <img src="{{ asset('uploads/product/' . $product->image) }}" class="h-20" />
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">{{ $product->description }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">
                            {{ $product->price }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] px-3 py-2">
                            {{ $product->category ? $product->category->name : 'N/A' }}
                        </td>
                        <td class="border-[var(--color-border)] border-[0.25rem] h-20 p-0">
                            <a href="{{ route('products.edit', $product->id) }}" class="w-full h-1/2 bg-[var(--color-accent)] flex items-center justify-center text-[var(--color-bg-primary)]">
                                Edit
                            </a>
                            <hr class="border-t-[0.25rem] border-[var(--color-border)]" />
                            <button wire:click="confirmDelete({{ $product->id }})" @click="showDeleteModal = true" class="w-full h-1/2 bg-[var(--color-error)] flex items-center justify-center text-[var(--color-bg-primary)]">
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
        @foreach ($products as $product)
            <div class="bg-[var(--color-bg-secondary)] p-4 rounded-lg shadow space-y-3">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                    <span class="text-xs bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-2 py-1 rounded">{{ $product->category ? $product->category->name : 'N/A' }}</span>
                </div>
                <div>
                    <img src="{{ asset('uploads/product/' . $product->image) }}" class="h-20 w-auto rounded mx-auto" />
                </div>
                <div class="text-sm space-y-1">
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> ${{ $product->price }}</p>
                </div>
                <div class="flex w-full space-x-2 pt-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="flex-1 bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-3 py-2 rounded text-center">Edit</a>
                    <button wire:click="confirmDelete({{ $product->id }})" @click="showDeleteModal = true" class="flex-1 bg-[var(--color-error)] text-[var(--color-bg-primary)] px-3 py-2 rounded">Delete</button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>

    <div x-show="showDeleteModal" x-cloak
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class=" bg-[var(--color-bg-secondary)] rounded-lg p-6 w-full max-w-xl">
            <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this product?</p>
            <div class="flex justify-end space-x-2">
                <div class="flex justify-end space-x-2 w-full">
                    <x-primary-button @click="showDeleteModal = false" class="w-1/2">
                        Cancel
                    </x-primary-button>
                
                    <x-danger-button wire:click="destroyProduct" @click="showDeleteModal = false" class="w-1/2">
                        Confirm
                    </x-danger-button>
                </div>
                
            </div>
        </div>
    </div>
</div>
