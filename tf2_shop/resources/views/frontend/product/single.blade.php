<x-app-layout>
    <div class="h-screen flex text-2xl flex-col">
        <div class="flex w-full">
            <div class="border border-[var(--color-border)] flex-1 p-2">
                <img class="w-full object-cover" src="{{ asset('uploads/product/' . $product->image) }}"
                    alt="{{ $product->name }}">
            </div>

            <div class="border border-[var(--color-border)] flex-1 p-2 ">
                <p>Description</p>
                <br>
                <p class="text-lg">
                    {{ $product->description }}
                </p>
            </div>
        </div>

        <div class="flex w-full">
            <div class="border border-[var(--color-border)] flex-grow p-2">{{ $product->name }}</div>
            <div class="border border-[var(--color-border)] flex-grow p-2">Price: {{ $product->price }}$</div>
            <div class="border border-[var(--color-border)] flex-grow">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full h-full">
                    @csrf
                    <x-primary-button class="rounded-none w-full h-full flex items-center justify-center">
                        {{ __('Add to cart') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
