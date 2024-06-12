<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Statistics</title>
    <style>
        /* Define your CSS styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .statistic {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
        }
        .statistic:last-child {
            border-bottom: none;
        }
        .statistic .name {
            font-weight: bold;
            color: #555;
        }
        .statistic .value {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">Dashboard Statistics</div>
        <div class="statistic">
            <span class="name">Total Users:</span>
            <span class="value">{{ $totalUsers }}</span>
        </div>
        <div class="statistic">
            <span class="name">Total Comments:</span>
            <span class="value">{{ $totalComments }}</span>
        </div>
        <div class="statistic">
            <span class="name">Total Posts:</span>
            <span class="value">{{ $totalPosts }}</span>
        </div>
        <div class="statistic">
            <span class="name">New Users (Last 30 Days):</span>
            <span class="value">{{ $newUsers }}</span>
        </div>
        <div class="statistic">
            <span class="name">Active Users (Last 30 Days):</span>
            <span class="value">{{ $activeUsers }}</span>
        </div>
        <div class="statistic">
            <span class="name">Total Messages:</span>
            <span class="value">{{ $totalMessages }}</span>
        </div>
    </div>
</body>
</html>
