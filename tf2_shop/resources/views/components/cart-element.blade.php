@props(['item'])

<div class="bg-[var(--color-bg-secondary)] px-4 py-2 shadow flex flex-col h-full">
    <div class="">
        <img src="{{ asset('uploads/product/' . $item->product->image) }}" class="h-20 w-auto mx-auto" />

        <h2 class="font-bold text-lg">{{ $item->product->name }}</h2>
        <span class="text-xs bg-[var(--color-accent)] text-[var(--color-bg-primary)] px-2 py-1">
            {{ $item->product->category ? $item->product->category->name : 'N/A' }}
        </span>

        <p><strong>Price:</strong> ${{ $item->product->price }}</p>
    </div>

    <div class="flex w-full">
        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="w-full">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full px-4 py-2 bg-[var(--color-error)] text-[var(--color-bg-primary)] hover:bg-red-700 transition font-semibold">Remove</button>
        </form>
    </div>
</div>
