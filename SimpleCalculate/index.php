<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Calculator</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">My Calculator</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Form untuk kalkulator -->
                <form action="" method="post" class="border p-4 shadow-sm rounded bg-light">
                    <div class="form-group">
                        <label for="num1">Number 1:</label>
                        <input type="number" name="num1" id="num1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="operator">Operator:</label>
                        <select name="operator" id="operator" class="form-control" required>
                            <option value="+">+</option>
                            <option value="-">-</option>
                            <option value="*">*</option>
                            <option value="/">/</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num2">Number 2:</label>
                        <input type="number" name="num2" id="num2" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Calculate</button>
                </form>
            </div>
        </div>

        <!-- PHP Block -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <?php
                // Include file AbstractPort.php
                require_once 'AbstractPort.php';

                // Check if form is submitted
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Get the input values from the form
                    $num1 = $_POST['num1'];
                    $operator = $_POST['operator'];
                    $num2 = $_POST['num2'];

                    // Create an instance of AbstractPort
                    $calculator = new \Cowglow\SoapCalculator\Infrastructure\AbstractPort('http://www.dneonline.com/calculator.asmx?WSDL');

                    // Prepare the inputs for SOAP request
                    $inputs = [$num1, $num2];

                    // Call the SoapRequest method and get the result
                    try {
                        $result = $calculator->SoapRequest($inputs, $operator);

                        // Display the result
                        echo "<div class='alert alert-success'>Result: $result</div>";
                    } catch (Exception $e) {
                        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
