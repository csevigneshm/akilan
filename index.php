<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Akil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f4f4f4;
        }
        input[type="text"] {
            padding: 5px;
            width: 150px;
        }
        .ajax-table {
            margin: 20px auto;
            width: 80%;
            border-collapse: collapse;
        }
        .ajax-table th, .ajax-table td {
            padding: 5px;
            border: 1px solid #ccc;
        }

        .ajax-table th {
            background-color: #e2e2e2;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            text-align: left;
        }

        .form-container input {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Welcome</h1>
    <h2>Reference Table</h2>
    <div id="ajax-content"></div>
    <h2>Input Table</h2>
    <table>
        <thead>
            <tr>
                <th style="width: 150px;">Name</th>
                <th style="width: 200px;">Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Width</td>
                <td><input id='wval' type="text" id="value" placeholder="Enter a value" oninput='calcul()'></td>
            </tr>
        </tbody>
    </table>
    <div id="res"></div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "post.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("action=onload");
            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById("ajax-content").innerHTML = xhr.responseText;
                }
            };
        });
        function calcul(){
            var val = document.getElementById("wval").value;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "post.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("action=docalc&val="+val);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById("res").innerHTML = xhr.responseText;
                }
            };
        }
    </script>
</body>
</html>
