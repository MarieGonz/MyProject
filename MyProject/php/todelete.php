<?php
// Establish a database connection
$db = Mysql::getInstance();

// Check if the connection was successful
if (!$db) {
    echo "Failed to connect to MySQL.";
    exit;
}

// Rest of the code remains the same
$currentDate = date('Y-m-d');
$oneYearAgo = date('Y-m-d', strtotime('-12 months', strtotime($currentDate)));
$query = "DELETE FROM products WHERE inactive_date <= '{$oneYearAgo}'";

if ($db->query($query)) {
    echo "Old products deleted successfully.";
} else {
    echo "Error deleting old products: " . $db->error;
}

$db->close();
?>
