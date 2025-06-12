<x-app-layout>
    <div class="h-screen flex items-center justify-center">
        <div class="border border-[var(--color-border)] text-2xl">
            <div class="flex w-full">
                <div class="border border-[var(--color-border)] flex-1 p-2">
                    <img src="{{ asset('uploads/placeholder.jpg') }}">
                </div>

                <div class="border border-[var(--color-border)] flex-1 p-2 ">
                    <p>Description</p>
                    <br>
                    <p class="text-lg"> 
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
            </div>

            <div class="flex w-full">
                <div class="border border-[var(--color-border)] flex-grow p-2">Product Name</div>
                <div class="border border-[var(--color-border)] flex-grow p-2">Price: 100$</div>
                <div class="border border-[var(--color-border)] flex-grow"> <x-primary-button class="rounded-none">
                        {{ __('Add to cart') }}
                    </x-primary-button></div>
            </div>
        </div>
    </div>
</x-app-layout>
