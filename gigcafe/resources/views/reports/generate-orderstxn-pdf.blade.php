<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Transaction</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa; /* Light Gray */
            color: #343a40; /* Dark Gray */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff; /* White */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #dc3545; /* Red */
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #6c757d; /* Gray */
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            color: #343a40; /* Dark Gray */
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #dee2e6; /* Light Gray */
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa; /* Light Gray */
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa; /* Light Gray */
        }

        tbody tr:hover {
            background-color: #f4f4f4; /* Lighter Gray */
        }
    </style>
</head>
<body>

<div class="container">
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <!--th>Customer</th-->
                <th>Discount ID</th>
                <th>Final Amount</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalFinalAmount = 0;
            @endphp
            @foreach($orderstxn as $ordertxn)
            <tr>
                <td>{{ $ordertxn->order_id }}</td>
                <!--td>{{ $ordertxn->order->user->name }}</td-->
                <td>{{ $ordertxn->discount_id }}</td>
                <td>{{ $ordertxn->final_amount }}</td>
                <td>{{ $ordertxn->created_at->toDateString() }}</td> <!-- Display date -->
                <td>{{ $ordertxn->created_at->toTimeString() }}</td> <!-- Display time -->
            </tr>
            @php
                $totalFinalAmount += $ordertxn->final_amount;
            @endphp
            @endforeach
            <tr>
                <td colspan="2"></td>
                <th>Total Amount:</th><td> {{ $totalFinalAmount }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>

    
</body>
</html>
