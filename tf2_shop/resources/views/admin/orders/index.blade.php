<x-app-layout>
    <div class="w-full py-8">
        <h1 class="text-3xl font-bold mb-6">Orders Management</h1>
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif
        <div class="overflow-x-auto w-full">
            <table class="w-full bg-[var(--color-bg-secondary)] border border-[var(--color-border)]">
                <thead>
                    <tr>
                        <th class="p-2 border">ID</th>
                        <th class="p-2 border">User</th>
                        <th class="p-2 border">Steam URL</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Total</th>
                        <th class="p-2 border">Created</th>
                        <th class="p-2 border">Items</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="p-2 border">{{ $order->id }}</td>
                            <td class="p-2 border">{{ $order->user->name ?? '-' }}</td>
                            <td class="p-2 border">{{ $order->user->steam_url ?? '-' }}</td>
                            <td class="p-2 border">{{ ucfirst($order->status) }}</td>
                            <td class="p-2 border">${{ number_format($order->total_price, 2) }}</td>
                            <td class="p-2 border">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 border">
                                <ul>
                                    @foreach($order->items as $item)
                                        <li>{{ $item->product->name ?? 'Deleted Product' }} (${{ number_format($item->price, 2) }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-2 border">
                                @if($order->status === 'pending')
                                    <form action="{{ route('admin.orders.complete', $order) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded">Mark as Completed</button>
                                    </form>
                                @else
                                    <span class="text-green-700 font-bold">Completed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout> 