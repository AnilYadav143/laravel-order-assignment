<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <h2>Order Create</h2>
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('order.store') }}">
        @csrf
        <button type="submit"> Order Create</button>
    </form>

    <hr>

    <h2>Orders List</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Status</th>
                <th>Assigned Delivery Boy</th>
                <th>Assigned At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order_items)
                <tr>
                    <td>{{ $order_items->order_number }}</td>
                    <td>{{ $order_items->status }}</td>
                  <td>{{ optional(optional($order_items->deliveryAssignment)->deliveryBoy)->name ?? '-' }}</td>
                    <td>{{ optional($order_items->deliveryAssignment)->assigned_at ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
