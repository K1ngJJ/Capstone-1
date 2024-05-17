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
        .details, .cart-items {
            margin-bottom: 20px;
        }
        .details th, .details td, .cart-items th, .cart-items td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details th, .cart-items th {
            background-color: #f2f2f2;
        }
        /* New style for Final Amount */
        .final-amount {
            color: white;
            background-color: red;
            font-weight: bold;
            text-align: center;
        }
        .amount {
            color: white;
            background-color: black;
            font-weight: bold;
            text-align: center;
        }
        .warning {
            background-color: orange; 
            color: white;
            border: gray;
            font-weight: bold;
            text-align: center; 
        } 
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Date: {{ $date }}</p>
    </div>

    <div class="details">
        <h2>Transaction Details</h2>
        <table width="100%">
            <!--tr>
                <th>ID</th>
                <td>{{ $transactions->id }}</td>
            </tr-->
            <tr>
                <td class="warning">Order ID</td>
                <td>{{ $transactions->order_id }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{ $transactions->created_at->toDateString() }}</td> <!-- Display date -->
            </tr>
            <tr>
                <th>Time</th>
                <td>{{ $transactions->created_at->toTimeString() }}</td> <!-- Display time -->
            </tr>
             <!-- Check if order and user exist before accessing attributes -->
             @if(isset($transactions->order) && isset($transactions->order->user))
            <tr>
                <th>Customer</th>
                <td>{{ $transactions->order->user->name }}</td>
            </tr>
            @endif
            <!-- Apply the new style to Final Amount -->
            <tr>
                <td class="amount">Final Amount</td>
                <td class="final-amount">{{ $transactions->final_amount }}</td>
            </tr>
        </table>
    </div>

</body>
</html>
