<?php
require('../../connection.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitize input

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
        echo json_encode($product);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>