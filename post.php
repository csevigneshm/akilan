<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_POST['action'] == "onload") {
    $sql = "SELECT * FROM fabric_items";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table class='ajax-table'>";
        echo "<thead>
                <tr>
                    <th>Roll No</th>
                    <th>Shade</th>
                    <th>Length</th>
                    <th>Width</th>
                    <th>Sh Length</th>
                    <th>Sh Width</th>
                </tr>
              </thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['roll_no'] . "</td>";
            echo "<td>" . $row['shade'] . "</td>";
            echo "<td>" . $row['length'] . "</td>";
            echo "<td>" . $row['width'] . "</td>";
            echo "<td>" . $row['sh_length'] . "</td>";
            echo "<td>" . $row['sh_width'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No Results Found</p>";
    }
}else if ($_POST['action'] == "docalc") {
    $input_value = isset($_POST['val']) ? (int)$_POST['val'] : 0;
    if ($input_value <= 0) {
        echo "Please provide a valid number";
        exit;
    }
    $result = $conn->query("SELECT * FROM fabric_items");

    if ($result->num_rows == 0) {
        echo "No fabric items found in the database.";
        exit;
    }
    $fabric_items = [];
    while ($row = $result->fetch_assoc()) {
        $fabric_items[] = $row;
    }
    $min_width = min(array_column($fabric_items, 'width'));
    $range_groups = [];
    foreach ($fabric_items as $item) {
        $min_range = floor(($item['width'] - $min_width) / $input_value) * $input_value + $min_width;
        $max_range = $min_range + $input_value;
        $range_key = $min_range . '-' . $max_range;
        if (!isset($range_groups[$range_key])) {
            $range_groups[$range_key] = ['count' => 0, 'total_length' => 0];
        }
        $range_groups[$range_key]['count']++;
        $range_groups[$range_key]['total_length'] += $item['length'];
    }
    if (empty($range_groups)) {
        echo "No fabric rolls match the given range.";
        exit;
    }
    ksort($range_groups, SORT_NATURAL);
    echo '<h2>Output Table</h2>';
    echo '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
    echo '<tr><th>Range</th><th>No of Rolls</th><th>Total Length</th></tr>';
    foreach ($range_groups as $range => $data) {
        echo "<tr>";
        echo "<td>$range</td>";
        echo "<td>{$data['count']}</td>";
        echo "<td>{$data['total_length']}</td>";
        echo "</tr>";
    }
    echo '</table>';
}
$conn->close();
?>
