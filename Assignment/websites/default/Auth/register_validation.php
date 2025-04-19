<?php
include_once '../Includes/config.php';

//Get the field and value from the POST request
$field = $_POST['field'];
$value = $_POST['value'];

//Ensure the field is valid
if (in_array($field, ['username', 'email'])) {
    

//Building the SQL query
if($field === 'username') {
$query = "SELECT * FROM users WHERE username = ?";
} 
elseif($field === 'email') {
$query = "SELECT * FROM users WHERE email = ?";
}
    // Prepare a statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the value already exists
    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]); // Value exists
    } else {
        echo json_encode(['exists' => false]); // Value does not exist
    }

    // Close the statement
    $stmt->close();

} else {
    echo json_encode(['error' => 'Invalid field']); // Invalid field
}

// Close the connection
$conn->close();
?>