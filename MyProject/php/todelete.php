<?php

// Retrieve the products that have been inactive for 12 months or more
$sql = "SELECT * FROM product WHERE inactive_from <= DATE_SUB(NOW(), INTERVAL 12 MONTH)";
$result = $db->query($sql);

if ($result->num_rows > 0) {
        // Perform the deletion for each inactive product
    while ($row = $result->fetch_assoc()) {
        $productId = $row['id'];
        // Perform the deletion operation based on $productId
    }
}
?>
