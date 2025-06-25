<aside {{ $attributes->merge(['class' => 'w-64 bg-[var(--color-accent)] text-[var(--color-bg-primary)] p-1 pt-0 shadow-lg h-fit sticky self-start lg:h-full']) }}>
    <h2 class="text-2xl font-bold mb-8 pt-6 text-center hidden lg:block">Admin Menu</h2>

    <nav class="flex flex-col gap-2">
        <a href="/admin/dashboard" class="py-2 px-4 hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Dashboard</a>
        <hr class="border-[var(--color-bg-primary)] border-2">
        <a href="{{ route('admin.categories.index') }}" class="py-2 px-4 hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Manage Categories</a>
        <hr class="border-[var(--color-bg-primary)] border-2">
        <a href="/admin/orders" class="py-2 px-4 hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">View Orders</a>
         <hr class="border-[var(--color-bg-primary)] border-2">
        <a href="/admin/fund-requests" class="py-2 px-4 hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Fund Requests</a>
         <hr class="border-[var(--color-bg-primary)] border-2">
        <a href="/admin/claim-requests" class="py-2 px-4 hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Claim Requests</a>
    </nav>
</aside> 