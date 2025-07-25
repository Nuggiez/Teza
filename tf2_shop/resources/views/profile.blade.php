<x-app-layout>
    <div class="py-2 px-4">
        <h1 class="text-3xl font-bold mb-6">Profie</h1>

        <div class="gap-4 flex flex-col">
            @if (auth()->user()->is_admin ?? false)
                <div
                    class="px-4 py-2 bg-[var(--color-accent)] text-[var(--color-bg-primary)] shadow  flex items-center justify-between w-full">
                    <span class="text-xl font-bold">Admin Zone</span>
                    <a href="/admin/dashboard"
                        class="bg-[var(--color-bg-primary)] text-[var(--color-accent)] px-4 py-2 font-semibold text-lg hover:bg-[var(--color-bg-secondary)] hover:text-[var(--color-accent)] transition">Go
                        to Admin Panel</a>
                </div>
            @endif

            <div class="px-4 py-2 bg-[var(--color-bg-secondary)] shadow ">
                <livewire:profile.update-profile-information-form />
            </div>

            <div class="px-4 py-2 bg-[var(--color-bg-secondary)] shadow ">
                <h3 class="text-lg font-medium mb-2">Account Funds</h3>
                <div class="text-2xl font-bold mb-4">${{ number_format(auth()->user()->funds, 2) }}</div>
                <div class="flex gap-4 mt-4 w-full">
                    <button id="open-insert-modal"
                        class="flex-1 bg-[var(--color-accent)] text-white px-4 py-2 text-xl">Insert
                        Funds</button>
                    <button id="open-claim-modal"
                        class="flex-1 bg-[var(--color-accent)] text-white px-4 py-2 text-xl">Claim
                        Funds</button>
                </div>
                <span id="funds-error" class="text-red-500 ml-2"></span>
                <span id="claim-error" class="text-red-500 ml-2"></span>

                <!-- Insert Funds Modal -->
                <div id="insert-modal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-[var(--color-bg-secondary)] px-4 py-2 shadow-lg w-full max-w-md">
                        <h2 class="text-2xl">Insert Funds</h2>
                        <input id="insert-amount" type="number" min="0.01" step="0.01" placeholder="Amount"
                            class=" p-2 text-black w-full">
                        <div class="flex gap-4 mt-4 w-full">
                            <button id="close-insert-modal"
                                class="flex-1 bg-[var(--color-error)] text-white px-4 py-2 text-xl">Cancel</button>
                            <button id="continue-insert"
                                class="flex-1 bg-[var(--color-accent)] text-white px-4 py-2 text-xl">Continue</button>
                        </div>
                        <span id="insert-modal-error" class="text-red-500 mt-2 block"></span>
                    </div>
                </div>

                <!-- Claim Funds Modal -->
                <div id="claim-modal"
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                    <div class="bg-[var(--color-bg-secondary)] px-4 py-2 shadow-lg w-full max-w-md">
                        <h2 class="text-2xl">Claim Funds</h2>
                        <input id="claim-amount-modal" type="number" min="0.01" step="0.01"
                            max="{{ auth()->user()->funds }}" placeholder="Amount to claim"
                            class=" p-2 text-black w-full">

                        <div class="flex gap-4 mt-4 w-full">
                            <button id="close-claim-modal"
                                class="flex-1 bg-[var(--color-error)] text-white px-4 py-2 text-xl">Cancel</button>
                            <button id="continue-claim"
                                class="flex-1 bg-[var(--color-accent)] text-white px-4 py-2 text-xl">Continue</button>
                        </div>
                        <span id="claim-modal-error" class="text-red-500 mt-2 block"></span>
                    </div>
                </div>
            </div>



            <div class="px-4 py-2 bg-[var(--color-bg-secondary)] shadow">
                <livewire:profile.update-password-form />
            </div>



            <div class="px-4 py-2 bg-[var(--color-bg-secondary)] shadow">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Modal logic
    const insertModal = document.getElementById('insert-modal');
    const claimModal = document.getElementById('claim-modal');
    document.getElementById('open-insert-modal').onclick = () => {
        insertModal.classList.remove('hidden');
    };
    document.getElementById('open-claim-modal').onclick = () => {
        claimModal.classList.remove('hidden');
    };
    document.getElementById('close-insert-modal').onclick = () => {
        insertModal.classList.add('hidden');
        document.getElementById('insert-modal-error').textContent = '';
    };
    document.getElementById('close-claim-modal').onclick = () => {
        claimModal.classList.add('hidden');
        document.getElementById('claim-modal-error').textContent = '';
    };

    // Insert Funds AJAX
    const insertContinue = document.getElementById('continue-insert');
    insertContinue.onclick = async function() {
        const amount = document.getElementById('insert-amount').value;
        document.getElementById('insert-modal-error').textContent = '';
        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
            document.getElementById('insert-modal-error').textContent = 'Please enter a valid amount.';
            return;
        }
        try {
            const response = await fetch("{{ url('/fund-request') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: new URLSearchParams({
                    amount
                })
            });
            if (!response.ok) {
                const data = await response.json();
                document.getElementById('insert-modal-error').textContent = data.message ||
                    'Error creating fund request.';
                return;
            }
            const data = await response.json();
            insertModal.classList.add('hidden');
            window.open(data.paypal_url, '_blank');
        } catch (err) {
            document.getElementById('insert-modal-error').textContent = 'Error creating fund request.';
        }
    };

    // Claim Funds AJAX
    const claimContinue = document.getElementById('continue-claim');
    claimContinue.onclick = async function() {
        const amount = document.getElementById('claim-amount-modal').value;
        const max = parseFloat(document.getElementById('claim-amount-modal').max);
        document.getElementById('claim-modal-error').textContent = '';
        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
            document.getElementById('claim-modal-error').textContent = 'Please enter a valid amount.';
            return;
        }
        if (parseFloat(amount) > max) {
            document.getElementById('claim-modal-error').textContent =
                'You cannot claim more than your available funds.';
            return;
        }
        try {
            const response = await fetch("{{ url('/claim-request') }}", {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: new URLSearchParams({
                    amount
                })
            });
            if (!response.ok) {
                const data = await response.json();
                document.getElementById('claim-modal-error').textContent = data.message ||
                    'Error creating claim request.';
                return;
            }
            claimModal.classList.add('hidden');
            document.getElementById('claim-modal-error').textContent = '';
            document.getElementById('claim-error').textContent = 'Claim request submitted!';
        } catch (err) {
            document.getElementById('claim-modal-error').textContent = 'Error creating claim request.';
        }
    };
</script>
