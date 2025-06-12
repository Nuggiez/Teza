<x-app-layout>
    <div class="h-screen flex items-center justify-center">
        <div class="border border-[var(--color-border)] text-2xl max-w-[1080px] overflow-hidden w-screen">
            <div class="flex w-full">
                <div class="border border-[var(--color-border)] flex-grow p-2">Image</div>
                <div class="border border-[var(--color-border)] flex-grow p-2">Name</div>
                <div class="border border-[var(--color-border)] flex-grow p-2">Price</div>
            </div>
            <div class="border border-[var(--color-border)] text-2xl">
                <div class="flex w-full min-h-96">

                </div>
            </div>
            <div class="border border-[var(--color-border)] text-2xl">
                <div class="flex w-full">
                    <div class="border border-[var(--color-border)] flex-grow p-2">Items In Cart: 0</div>
                    <div class="border border-[var(--color-border)] flex-grow p-2">Total Price: 0</div>
                    <div class="border border-[var(--color-border)] flex-grow"> <x-primary-button class="rounded-none">
                            {{ __('Checkout') }}
                        </x-primary-button></div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
