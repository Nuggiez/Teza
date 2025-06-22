@props(['item'])

<div {{ $attributes->merge(['class' => 'flex w-full']) }}>
    <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">
        <img class="w-full h-24 object-contain" src="{{ asset('uploads/product/' . $item->product->image) }}"
            alt="{{ $item->product->name }}">
    </div>
    <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">{{ $item->product->name }}</div>
    <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">${{ $item->product->price }}</div>
    <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2 relative">
        <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="w-full h-full">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="w-full h-full bg-[var(--color-error)] flex items-center justify-center text-[var(--color-bg-primary)] absolute top-0 left-0">
                Delete
            </button>
        </form>
    </div>
</div>
