<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .user-info {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Invoice</h1>

    <div class="user-info">
        <p>User ID: {{ $invoice->user_id }}</p>

        @if ($invoice->user)
            <p>User Name: {{ $invoice->user->name }}</p>
        @else
            <p>User: Unknown User</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tutor Name</td>
                <td>{{ $invoice->tutor_name }}</td>
            </tr>
            <tr>
                <td>Advance date</td>
                <td>{{ $invoice->advance_date }}</td>
            </tr>
            <tr>
                <td>Pay date</td>
                <td>{{ $invoice->pay_date }}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{{ $invoice->amount }}</td>
            </tr>
            <!-- Add other invoice details here -->
        </tbody>
    </table>

</body>
</html>
