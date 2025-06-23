<x-app-layout>
    <div class="flex justify-center">
        <div class="border border-[var(--color-border)] text-2xl max-w-[1080px] overflow-hidden w-screen">
            <div class="flex w-full">
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Image</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Name</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Price</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Action</div>
            </div>

            <div class="flex flex-col w-full min-h-96 border border-[var(--color-border)] text-2xl">
                @forelse ($cartItems as $item)
                    <x-cart-element :item="$item" />
                @empty
                    <div class="flex items-center justify-center h-full">
                        <p>Your cart is empty.</p>
                    </div>
                @endforelse
            </div>

            <div class="flex w-full border border-[var(--color-border)] text-2xl">
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Items In Cart: {{ $cartItems->count() }}</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Total Price:
                    ${{ $cartItems->sum(function($item) { return $item->product->price; }) }}</div>
                <div class="border border-[var(--color-border)] flex-[2] min-w-0 p-4 relative">
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <x-primary-button class="rounded-none absolute top-0 left-0 w-full">
                            {{ __('Checkout') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
