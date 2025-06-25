<div x-data="{ showDeleteModal: false }" class="py-2 px-4">
    @if (session()->has('message'))
        <div class="bg-[var(--color-success)] text-[var(--color-bg-primary)] px-4 py-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-start">
        <h1 class="text-3xl font-bold mb-6">Products Management</h1>
        <a href="{{ route('products.create') }}"
           class="inline-flex items-center px-4 py-2 bg-[#FF9D00] border border-transparent font-semibold text-white uppercase tracking-widest hover:bg-[#8b4f17] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FF9D00]">
            Add Product
        </a>
    </div>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-stretch">
        @foreach ($products as $product)
            <div class="bg-[var(--color-bg-secondary)] p-4 shadow flex flex-col justify-between h-full">
                <div class="flex-1 space-y-3">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">{{ $product->name }}</h2>
                        <span class="text-xs bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-2 py-1">
                            {{ $product->category ? $product->category->name : 'N/A' }}
                        </span>
                    </div>
                    <div>
                        <img src="{{ asset('uploads/product/' . $product->image) }}" class="h-20 w-auto mx-auto" />
                    </div>
                    <div class="text-sm space-y-1">
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Price:</strong> ${{ $product->price }}</p>
                    </div>
                </div>

                <div class="flex w-full space-x-2 pt-2">
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="flex-1 bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-3 py-2 text-center">
                        Edit
                    </a>
                    <button wire:click="confirmDelete({{ $product->id }})" @click="showDeleteModal = true"
                            class="flex-1 bg-[var(--color-error)] text-[var(--color-bg-primary)] px-3 py-2">
                        Delete
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>

    <!-- Delete Modal -->
    <div x-show="showDeleteModal" x-cloak
         class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-[var(--color-bg-secondary)] p-6 w-full max-w-xl rounded">
            <h2 class="text-lg font-semibold mb-4">Confirm Deletion</h2>
            <p class="mb-6">Are you sure you want to delete this product?</p>
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
