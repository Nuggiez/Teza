@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-[0.125rem] border-[var(--color-border)] focus:border-[var(--color-border)] focus:ring-[var(--color-border-focus)]  bg-[var(--color-bg-secondary)] w-full text-2xl' ]) }}  type="text" />
