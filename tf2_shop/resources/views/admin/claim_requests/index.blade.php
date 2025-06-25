<x-admin-layout>
    <div class="w-full py-8">
        <h1 class="text-3xl font-bold mb-6">Claim Requests Management</h1>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto w-full">
            <table class="w-full border-collapse bg-[var(--color-bg-secondary)] border border-[var(--color-border)]">
                <thead>
                    <tr>
                        <th class="p-2 border border-[var(--color-border)]">ID</th>
                        <th class="p-2 border border-[var(--color-border)]">User</th>
                        <th class="p-2 border border-[var(--color-border)]">PayPal.me Link</th>
                        <th class="p-2 border border-[var(--color-border)]">Amount</th>
                        <th class="p-2 border border-[var(--color-border)]">Status</th>
                        <th class="p-2 border border-[var(--color-border)]">Created</th>
                        <th class="p-2 border border-[var(--color-border)]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($claimRequests as $request)
                        <tr>
                            <td class="p-2 border border-[var(--color-border)]">{{ $request->id }}</td>
                            <td class="p-2 border border-[var(--color-border)]">{{ $request->user->name ?? '-' }}</td>
                            <td class="p-2 border border-[var(--color-border)]">
                                @if ($request->user && $request->user->paypal_username)
                                    <a href="https://www.paypal.com/paypalme/{{ $request->user->paypal_username }}/{{ $request->amount }}"
                                        target="_blank"
                                        class=" underline">PayPal.me/{{ $request->user->paypal_username }}/{{ $request->amount }}</a>
                                @else
                                    <span class="text-gray-500">No PayPal username</span>
                                @endif
                            </td>
                            <td class="p-2 border border-[var(--color-border)]">${{ number_format($request->amount, 2) }}</td>
                            <td class="p-2 border border-[var(--color-border)]">{{ ucfirst($request->status) }}</td>
                            <td class="p-2 border border-[var(--color-border)]">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td class="border border-[var(--color-border)] p-0">
                                @if ($request->status === 'pending')
                                    <div class="flex w-full h-full">
                                        <form action="{{ route('admin.claim_requests.complete', $request) }}"
                                            method="POST" class="flex-1 h-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full h-full bg-green-600 text-white px-3 py-2">Complete</button>
                                        </form>
                                        <form action="{{ route('admin.claim_requests.reject', $request) }}"
                                            method="POST" class="flex-1 h-full">
                                            @csrf
                                            <button type="submit"
                                                class="w-full h-full bg-red-600 text-white px-3 py-2">Reject</button>
                                        </form>
                                    </div>
                                @elseif($request->status === 'completed')
                                    <span class="text-green-700 font-bold">Completed</span>
                                @else
                                    <span class="text-red-700 font-bold">Rejected</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Mobile Card View -->
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @foreach ($claimRequests as $request)
                <div class="bg-[var(--color-bg-secondary)] p-4 r shadow space-y-3">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">Request #{{ $request->id }}</h2>
                        <span
                            class="px-2 py-1 text-sm 
                        @if ($request->status === 'pending') bg-yellow-500 text-black
                        @elseif($request->status === 'completed') bg-green-600 text-white
                        @else bg-red-600 text-white @endif">
                            {{ ucfirst($request->status) }}
                        </span>
                    </div>
                    <div class="text-sm space-y-1 break-words">
                        <p><strong>User:</strong> {{ $request->user->name ?? '-' }}</p>
                        <p><strong>Amount:</strong> ${{ number_format($request->amount, 2) }}</p>
                        <p><strong>PayPal.me:</strong>
                            @if ($request->user && $request->user->paypal_username)
                                <a href="https://www.paypal.com/paypalme/{{ $request->user->paypal_username }}/{{ $request->amount }}"
                                    target="_blank"
                                    class="underline">paypal.me/{{ $request->user->paypal_username }}/{{ $request->amount }}</a>
                            @else
                                <span class="text-gray-500">No PayPal username</span>
                            @endif
                        </p>
                        <p><strong>Created:</strong> {{ $request->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    @if ($request->status === 'pending')
                        <div class="flex w-full h-full pt-2 space-x-2">
                            <form action="{{ route('admin.claim_requests.complete', $request) }}"
                                method="POST" class="flex-1 h-full">
                                @csrf
                                <button type="submit"
                                    class="w-full h-full bg-green-600 text-white px-3 py-2 ">Complete</button>
                            </form>
                            <form action="{{ route('admin.claim_requests.reject', $request) }}"
                                method="POST" class="flex-1 h-full">
                                @csrf
                                <button type="submit"
                                    class="w-full h-full bg-red-600 text-white px-3 py-2 ">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $claimRequests->links() }}
        </div>
    </div>
</x-admin-layout> 