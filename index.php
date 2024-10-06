<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeepney Fare Calculator</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: Arial, sans-serif;
            background: url('https://storage.googleapis.com/bukas-website-v3-prd/website_v3/images/Bukas_x_SDCA_Article_Image.original.png') no-repeat center center;
            background-size: cover;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); /* White background with slight transparency */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #333;
        }
        label {
            font-size: 14px;
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="number"], select {
            width: calc(100% - 24px);
            padding: 8px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: maroon;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: darkred;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Jeepney Fare Calculator</h2>

        <form method="POST" action="">
            <label for="distance">Enter distance in kilometers:</label>
            <input type="number" id="distance" name="distance" step="0.1" required>

            <label for="passengerType">Passenger Type:</label>
            <select id="passengerType" name="passengerType" required>
                <option value="regular">Regular</option>
                <option value="student/elderly">Student/Elderly</option>
            </select>

            <input type="submit" value="Calculate Fare">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $distance = floatval($_POST['distance']);
            $passengerType = $_POST['passengerType'];

            // Fare calculation
            $baseFare = 13.00;
            $additionalFarePerKm = 1.75;
            $baseDistance = 5;  // 5 km base fare
            
            if ($distance > $baseDistance) {
                $additionalDistance = $distance - $baseDistance;
                $totalFare = $baseFare + ($additionalDistance * $additionalFarePerKm);
            } else {
                $totalFare = $baseFare;
            }

            // Apply 20% discount for student/elderly
            if ($passengerType === 'student/elderly') {
                $totalFare *= 0.80;  // Apply 20% discount
            }

            // Output the calculated fare
            echo "<div class='result'><h3>Total Fare: Php " . number_format($totalFare, 2) . "</h3></div>";
        }
        ?>
    </div>

</body>
</html>
