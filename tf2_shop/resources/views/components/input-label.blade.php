@props(['value'])

<label {{ $attributes->merge(['class' => 'text-[var(--color-accent)] text-2xl']) }}>
    {{ $value ?? $slot }}
</label>
