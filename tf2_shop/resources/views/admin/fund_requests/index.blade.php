<x-app-layout>
    <div class="w-full py-8">
        <h1 class="text-3xl font-bold mb-6">Fund Requests Management</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif
        <div class="overflow-x-auto w-full">
            <table class="w-full bg-[var(--color-bg-secondary)] border border-[var(--color-border)]">
                <thead>
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">User</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Created</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fundRequests as $request)
                        <tr>
                            <td class="p-2 border">{{ $request->id }}</td>
                            <td class="p-2 border">{{ $request->user->name ?? '-' }}</td>
                            <td class="p-2 border">${{ number_format($request->amount, 2) }}</td>
                            <td class="p-2 border">{{ ucfirst($request->status) }}</td>
                            <td class="p-2 border">{{ $request->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 border">
                                @if($request->status === 'pending')
                                    <form action="{{ route('admin.fund_requests.complete', $request) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Complete</button>
                                    </form>
                                    <form action="{{ route('admin.fund_requests.reject', $request) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                                    </form>
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
        <div class="mt-4">
            {{ $fundRequests->links() }}
        </div>
    </div>
</x-app-layout> 