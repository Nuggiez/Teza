<x-admin-layout>
    <h1 class="text-3xl font-bold mb-6">Orders Management</h1>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($orders as $order)
            <div class="bg-[var(--color-bg-secondary)] p-4 r shadow space-y-3">
                <div class="flex justify-between items-center">
                    <h2 class="font-bold text-lg">Order #{{ $order->id }}</h2>
                    <span
                        class="px-2 py-1 text-sm  
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
                                    (${{ number_format($item->price, 2) }})
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if ($order->status === 'pending')
                    <form action="{{ route('admin.orders.complete', $order) }}" method="POST" class="w-full pt-2">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white px-3 py-2">Mark as
                            Completed</button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</x-admin-layout>
