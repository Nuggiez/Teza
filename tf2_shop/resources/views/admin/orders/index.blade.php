<x-admin-layout>
    <div class="w-full py-8">
        <h1 class="text-3xl font-bold mb-6">Orders Management</h1>
        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto w-full">
            <table class="w-full bg-[var(--color-bg-secondary)] border border-[var(--color-border)]">
                <thead>
                    <tr>
                        <th class="p-2 border border-[var(--color-border)]">ID</th>
                        <th class="p-2 border border-[var(--color-border)]">User</th>
                        <th class="p-2 border border-[var(--color-border)]">Steam URL</th>
                        <th class="p-2 border border-[var(--color-border)]">Status</th>
                        <th class="p-2 border border-[var(--color-border)]">Total</th>
                        <th class="p-2 border border-[var(--color-border)]">Created</th>
                        <th class="p-2 border border-[var(--color-border)]">Items</th>
                        <th class="p-2 border border-[var(--color-border)]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="p-2 border border-[var(--color-border)]">{{ $order->id }}</td>
                            <td class="p-2 border border-[var(--color-border)]">{{ $order->user->name ?? '-' }}</td>
                            <td class="p-2 border border-[var(--color-border)]">
                                {{ $order->user->steam_url ?? '-' }}</td>
                            <td class="p-2 border border-[var(--color-border)]">{{ ucfirst($order->status) }}
                            </td>
                            <td class="p-2 border border-[var(--color-border)]">
                                ${{ number_format($order->total_price, 2) }}</td>
                            <td class="p-2 border border-[var(--color-border)]">
                                {{ $order->created_at->format('Y-m-d H:i') }}</td>
                            <td class="p-2 border border-[var(--color-border)]">
                                <ul>
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->product->name ?? 'Deleted Product' }}
                                            (${{ number_format($item->price, 2) }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-2 border border-[var(--color-border)]">
                                @if ($order->status === 'pending')
                                    <form action="{{ route('admin.orders.complete', $order) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        <button type="submit"
                                            class="w-full bg-green-600 text-white px-3 py-2 rounded">Mark as
                                            Completed</button>
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
        <!-- Mobile Card View -->
        <div class="grid grid-cols-1 gap-4 md:hidden">
            @foreach ($orders as $order)
                <div class="bg-[var(--color-bg-secondary)] p-4 rounded-lg shadow space-y-3">
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-lg">Order #{{ $order->id }}</h2>
                        <span
                            class="px-2 py-1 text-sm rounded-full 
                            @if ($order->status === 'pending') bg-yellow-500 text-black @else bg-green-600 text-white @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="text-sm space-y-1">
                        <p><strong>User:</strong> {{ $order->user->name ?? '-' }}</p>
                        <p><strong>Steam URL:</strong> {{ $order->user->steam_url ?? '-' }}</p>
                        <p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
                        <p><strong>Created:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
                        <div>
                            <strong>Items:</strong>
                            <ul class="list-disc list-inside ml-4">
                                @foreach ($order->items as $item)
                                    <li>{{ $item->product->name ?? 'Deleted Product' }}
                                        (${{ number_format($item->price, 2) }})</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if ($order->status === 'pending')
                        <form action="{{ route('admin.orders.complete', $order) }}" method="POST"
                            class="w-full pt-2">
                            @csrf
                            <button type="submit"
                                class="w-full bg-green-600 text-white px-3 py-2 rounded">Mark as
                                Completed</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout> 