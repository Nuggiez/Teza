<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-[var(--color-bg-secondary)] shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[var(--color-bg-secondary)] shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium mb-2">Account Funds</h3>
                    <div class="text-2xl font-bold mb-4">${{ number_format(auth()->user()->funds, 2) }}</div>
                    <div class="flex items-center gap-2">
                        <form id="funds-form" action="{{ url('/fund-request') }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input id="funds-amount" name="amount" type="number" min="0.01" step="0.01" placeholder="Amount" class="rounded p-2 text-black w-32" required>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Insert Funds</button>
                        </form>
                        <span id="funds-error" class="text-red-500 ml-2"></span>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[var(--color-bg-secondary)]  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <div class="flex items-center gap-2 mt-4">
                        <form id="claim-form" action="{{ url('/claim-request') }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input id="claim-amount" name="amount" type="number" min="0.01" step="0.01" max="{{ auth()->user()->funds }}" placeholder="Amount to claim" class="rounded p-2 text-black w-32" @if(auth()->user()->funds <= 0) disabled @endif required>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded" @if(auth()->user()->funds <= 0) disabled @endif>Claim Funds</button>
                        </form>
                        <span id="claim-error" class="text-red-500 ml-2"></span>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[var(--color-bg-secondary)]  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-[var(--color-bg-secondary)]  shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('funds-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        document.getElementById('funds-error').textContent = '';
        const amount = document.getElementById('funds-amount').value;
        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
            document.getElementById('funds-error').textContent = 'Please enter a valid amount.';
            return;
        }
        const form = e.target;
        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                },
                body: formData
            });
            if (!response.ok) {
                const data = await response.json();
                document.getElementById('funds-error').textContent = data.message || 'Error creating fund request.';
                return;
            }
            const data = await response.json();
            window.open(data.paypal_url, '_blank');
        } catch (err) {
            document.getElementById('funds-error').textContent = 'Error creating fund request.';
        }
    });

    document.getElementById('claim-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        document.getElementById('claim-error').textContent = '';
        const amount = document.getElementById('claim-amount').value;
        const max = parseFloat(document.getElementById('claim-amount').max);
        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
            document.getElementById('claim-error').textContent = 'Please enter a valid amount.';
            return;
        }
        if (parseFloat(amount) > max) {
            document.getElementById('claim-error').textContent = 'You cannot claim more than your available funds.';
            return;
        }
        const form = e.target;
        const formData = new FormData(form);
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('[name=_token]').value,
                },
                body: formData
            });
            if (!response.ok) {
                const data = await response.json();
                document.getElementById('claim-error').textContent = data.message || 'Error creating claim request.';
                return;
            }
            document.getElementById('claim-error').textContent = 'Claim request submitted!';
        } catch (err) {
            document.getElementById('claim-error').textContent = 'Error creating claim request.';
        }
    });
</script>
