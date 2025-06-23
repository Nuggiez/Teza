<div>
@if($products->isEmpty())
    <div class="col-span-full w-full text-center text-xl text-gray-400 py-12">There are no products yet</div>
@else
    <div class="grid xl:grid-cols-[repeat(5,1fr)] lg:grid-cols-[repeat(4,1fr)] md:grid-cols-[repeat(3,1fr)] sm:grid-cols-[repeat(2,1fr)] grid-cols-[repeat(1,1fr)] gap-6 place-items-center">
        @foreach ($products as $product)
            <div
                class="border-[var(--color-border)] border-[0.175rem] max-w-[18rem] max-h-[25rem] bg-[var(--color-bg-secondary)]">
                <a href="{{ route('products.single.show', $product->id) }}" class="block transition" style="text-decoration: none; color: inherit;">
                    <div class="bg-[var(--color-bg-primary)]"><img src="{{ asset('uploads/product/' . $product->image) }}"
                            class="h-[12rem] mx-auto" /></div>
                    <div class="py-3">
                        <span class="w-full flex justify-center text-2xl">{{ $product->name }}</span>
                        <span class="w-full flex justify-center text-lg text-[var(--color-text-primary)]">{{ $product->price }} $</span>
                    </div>
                </a>
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <x-primary-button class="rounded-none w-full">
                        {{ __('Add to cart') }}
                    </x-primary-button>
                </form>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
@endif
</div>
