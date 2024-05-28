
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $homeAddress = $_POST['homeAddress'];
    $workAddress = $_POST['workAddress'];

    // Database connection
    $servername = "your_servername";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_dbname";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO addresses (home_address, work_address) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $homeAddress, $workAddress);

    if ($stmt->execute()) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Address Autocomplete in Kathmandu</title>
    <script>
        function initAutocomplete() {
            document.getElementById('homeAddress').addEventListener('input', function() {
                autocomplete('homeAddress');
            });

            document.getElementById('workAddress').addEventListener('input', function() {
                autocomplete('workAddress');
            });
        }

        function autocomplete(inputId) {
            var input = document.getElementById(inputId).value;

            if (input.length < 3) {
                document.getElementById(inputId + 'List').innerHTML = '';
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(input) + '&format=json&addressdetails=1&limit=5&bounded=1&viewbox=85.2791,27.6663,85.3708,27.7668', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var results = JSON.parse(xhr.responseText);
                    var list = document.getElementById(inputId + 'List');
                    list.innerHTML = '';

                    results.forEach(function(result) {
                        var option = document.createElement('div');
                        option.className = 'autocomplete-item';
                        option.innerHTML = result.display_name;
                        option.addEventListener('click', function() {
                            document.getElementById(inputId).value = result.display_name;
                            list.innerHTML = '';
                        });
                        list.appendChild(option);
                    });
                }
            };
            xhr.send();
        }
    </script>
    <style>
        .autocomplete-item {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body onload="initAutocomplete()">
    <form id="addressForm">
        <label for="homeAddress">Home Address:</label>
        <input id="homeAddress" type="text" name="homeAddress" placeholder="Enter your home address">
        <div id="homeAddressList" class="autocomplete-list"></div>
        <br>
        <label for="workAddress">Work Address:</label>
        <input id="workAddress" type="text" name="workAddress" placeholder="Enter your work address">
        <div id="workAddressList" class="autocomplete-list"></div>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
<script>
    document.getElementById('addressForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form from submitting the traditional way

        var homeAddress = document.getElementById('homeAddress').value;
        var workAddress = document.getElementById('workAddress').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'save_address.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert('Addresses saved successfully!');
            }
        };
        xhr.send('homeAddress=' + encodeURIComponent(homeAddress) + '&workAddress=' + encodeURIComponent(workAddress));
    });
</script>

</html>
