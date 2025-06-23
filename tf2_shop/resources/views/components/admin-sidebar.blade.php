<aside class="w-64 bg-[var(--color-accent)] text-[var(--color-bg-primary)] flex-shrink-0 p-6 rounded-xl shadow-lg h-fit sticky top-8 self-start min-h-[60vh]">
    <h2 class="text-2xl font-bold mb-8 text-center">Admin Menu</h2>
    <nav class="flex flex-col gap-4">
        <a href="/admin/dashboard" class="py-2 px-4 rounded hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}" class="py-2 px-4 rounded hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Manage Categories</a>
        <a href="/admin/orders" class="py-2 px-4 rounded hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">View Orders</a>
        <a href="/admin/fund-requests" class="py-2 px-4 rounded hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Fund Requests</a>
        <a href="/admin/claim-requests" class="py-2 px-4 rounded hover:bg-[var(--color-bg-primary)] hover:text-[var(--color-accent)] transition font-semibold text-lg text-center">Claim Requests</a>
    </nav>
</aside> 