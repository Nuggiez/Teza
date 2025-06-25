<x-app-layout>
    <!-- Mobile Menu -->
    <div class="lg:hidden">
        <button id="mobile-menu-button"
            class="w-full bg-[var(--color-accent)] text-[var(--color-bg-primary)] p-4 rounded-lg shadow-lg text-center font-bold text-xl mb-4">
            Admin Menu
        </button>
        <div id="mobile-menu" class="hidden mb-4">
            <x-admin-sidebar class="w-full static" />
        </div>
    </div>
    <div class="flex min-h-[70vh]">
        <!-- Desktop Sidebar -->
        <div class="hidden lg:block">
            <x-admin-sidebar />
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-8">
            {{ $slot }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.toggle('hidden');
                });
            }
        });
    </script>
</x-app-layout>