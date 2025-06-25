<x-app-layout>
    <!-- Mobile Menu -->
    <div class="lg:hidden  mb-4">
        <button id="mobile-menu-button"
            class="w-full bg-[var(--color-accent)] text-[var(--color-bg-primary)] p-4 r shadow-lg text-center font-bold text-xl">
            Admin Menu
        </button>
        <div id="mobile-menu" class="hidden">
            <x-admin-sidebar class="w-full static" />
        </div>
    </div>
    <div class="flex border-2  border-[var(--color-border)]">
        <!-- Desktop Sidebar -->
        <div class="hidden lg:block">
            <x-admin-sidebar />
        </div>
        <!-- Main Content -->
        <div class="flex-1 lg:py-2 lg:px-4">
            {{ $slot }}
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function() {
                    document.getElementById('mobile-menu').classList.toggle('hidden');
                    document.getElementById('mobile-menu').classList.toggle('shadow-lg');
                });
            }
        });
    </script>
</x-app-layout>
