<div {{ $attributes->merge(['class' => 'flex w-full']) }}>
    <div class="border border-[var(--color-border)] flex-1 min-w-0 p-2">{{ $image }}</div>
    <div class="border border-[var(--color-border)]  flex-1 min-w-0 p-2">{{ $name }}</div>
    <div class="border border-[var(--color-border)]  flex-1 min-w-0 p-2">{{ $price }}</div>
    <div class="border border-[var(--color-border)]  flex-1 min-w-0 p-2 relative"> <button
            class="w-full h-full bg-[var(--color-error)] flex items-center justify-center text-[var(--color-bg-primary)]   absolute top-0 left-0">
            Delete
        </button></div>
</div>
