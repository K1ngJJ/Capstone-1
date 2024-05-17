<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin-bottom: 20px;
        }
        .details th, .details td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details th {
            background-color: #f2f2f2;
        }
        .inventory {
            margin-top: 20px;
        }
        .inventory th, .inventory td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .inventory th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Date: {{ $date }}</p>
    </div>

    <div class="details">
        <h2>Reservation Details</h2>
        <table width="100%">
            <tr>
                <th>ID</th>
                <td>{{ $reservation->id }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
            </tr>
            <tr>
                <th>Telephone</th>
                <td>{{ $reservation->tel_number }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $reservation->email }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $reservation->status }}</td>
            </tr>
            <tr>
                <th>Reservation Date</th>
                <td>{{ $reservation->res_date->format('m/d/Y') }}</td>
            </tr>
            <tr>
                <th>Guest Number</th>
                <td>{{ $reservation->guest_number }}</td>
            </tr>
            <tr>
                <th>Package</th>
                <td>{{ $reservation->package->name }}</td>
            </tr>
            <tr>
                <th>Service</th>
                <td>{{ $reservation->service->name }}</td>
            </tr>
            <tr>
                <th>Supplies</th>
                <td>{{ $reservation->inventory_supplies }}</td>
            </tr>
        </table>
    </div>

    <!--div class="inventory">
    <h2>Inventory Supplies</h2>
    <table width="100%">
        <tr>
            <th>Item</th>
            <th>Quantity Reserved</th>
            <th>Price</th>
            <th>Total Price</th>
        </tr>
        @foreach ($inventorySupplies as $inventory)
            <tr>
                <td>{{ $inventory->name }}</td>
                <td>{{ $inventory->pivot->quantity }}</td>
                <td>{{ $inventory->price }}</td>
                <td>{{ $inventory->price * $inventory->pivot->quantity }}</td>
            </tr>
        @endforeach
    </table>
</div-->



</body>
</html>
