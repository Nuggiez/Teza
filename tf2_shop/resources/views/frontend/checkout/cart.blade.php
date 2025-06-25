<x-app-layout>


    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 px-4 py-2">
        @forelse ($cartItems as $item)
            <x-cart-element :item="$item" />
        @empty
            <div class="flex items-center justify-center h-40 bg-[var(--color-bg-secondary)] shadow col-span-full">
                <p>Your cart is empty.</p>
            </div>
        @endforelse
    </div>

    <div class="flex w-full border border-[var(--color-border)] text-2xl flex-col lg:flex-row">
        <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Items In Cart: {{ $cartItems->count() }}
        </div>
        <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Total Price:
            ${{ $cartItems->sum(function ($item) {return $item->product->price;}) }}</div>
        <div class="border border-[var(--color-border)] flex-1 min-w-0">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <x-primary-button class=" w-full">
                    {{ __('Checkout') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
