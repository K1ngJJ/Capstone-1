<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>
<body>
    <form action="{{ url('charge') }}" method="post">
        @csrf
        <label for="reservation_id">Reservation ID:</label>
        <select name="reservation_id" id="reservation_id">
            @foreach($reservations as $reservation)
                <option value="{{ $reservation->id }}">{{ $reservation->id }}</option>
            @endforeach
        </select>
        <br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" value="10.00" />
        
        <input type="submit" name="submit" value="Pay Now" />
    </form>
</body>
</html>
