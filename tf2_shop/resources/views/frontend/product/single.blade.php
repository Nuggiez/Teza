<x-app-layout>
    <div class="flex text-2xl flex-col">
        <div class="flex w-full flex-col lg:flex-row">
            <div class="lg:border border-[var(--color-border)] flex-1 px-4 py-2">
                <img class="w-full max-h-96  object-cover" src="{{ asset('uploads/product/' . $product->image) }}"
                    alt="{{ $product->name }}">
            </div>

            <div class="px-4 py-2 lg:hidden"><hr class="border-2 border-[var(--color-border)] w-full"></div>

            <div class="lg:border border-[var(--color-border)] flex-1 px-4 py-2 ">
                <p>Description</p>
                <br class="hidden lg:block">
                <p class="text-lg">
                    {{ $product->description }}
                </p>
            </div>
        </div>

        <div class="px-4 py-2 lg:hidden"><hr class="border-2 border-[var(--color-border)] w-full"></div>


        <div class="flex w-full flex-col lg:flex-row">
            <div class="lg:border border-[var(--color-border)] flex-grow px-4 py-2">{{ $product->name }}</div>
            <div class="px-4 py-2 lg:hidden"><hr class="border-2 border-[var(--color-border)] w-full"></div>
            <div class="lg:border border-[var(--color-border)] flex-grow px-4 py-2">Price: {{ $product->price }}$</div>
            <div class="lg:border border-[var(--color-border)] flex-grow ">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full h-full">
                    @csrf
                    <x-primary-button class=" w-full h-full flex items-center justify-center">
                        {{ __('Add to cart') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
