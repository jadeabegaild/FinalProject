<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Rent Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }
        strong {
            color: #333;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Rent Request</h1>
        <p><strong>Customer Name:</strong> {{ $customerName }}</p>
        <p><strong>Vehicle Rented:</strong> {{ $vehicleName }}</p>
        <p><strong>Rented Date:</strong> {{ \Carbon\Carbon::parse($rentedDate)->format('F d, Y') }}</p>
        <br>
        <p style="text-align:center;">Please log in to the admin panel to review the request.</p>
        <div class="footer">
            <p>JRM Rental Management INC.</p>
        </div>
    </div>
</body>
</html>