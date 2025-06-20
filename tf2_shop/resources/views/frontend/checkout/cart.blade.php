<x-app-layout>
    <div class="h-screen flex items-center justify-center">
        <div class="border border-[var(--color-border)] text-2xl max-w-[1080px] overflow-hidden w-screen">
            <div class="flex w-full">
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Image</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Name</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Price</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Action</div>
            </div>

            <div class="flex flex-col w-full min-h-96 border border-[var(--color-border)] text-2xl">
                @for ($i = 0; $i < 5; $i++)
                    <x-cart-element image="imahhuhuge" name="jj" price="2$"></x-cart-element>
                @endfor
            </div>

            <div class="flex w-full border border-[var(--color-border)] text-2xl">
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Items In Cart: 0</div>
                <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">Total Price: 0</div>
                <div class="border border-[var(--color-border)] flex-[2] min-w-0 p-4 relative"> <x-primary-button
                        class="rounded-none absolute top-0 left-0">
                        {{ __('Checkout') }}
                    </x-primary-button></div>
            </div>
        </div>
    </div>
</x-app-layout>
