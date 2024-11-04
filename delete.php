<?php
include "connection.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // 1. Delete the desired record
        $sql = "DELETE FROM `reservations` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // 2. Create a temporary table and copy structure
        $sql = "CREATE TEMPORARY TABLE temp_reservations LIKE reservations";
        $conn->query($sql);
        
        // 3. Copy data while maintaining created_at
        $sql = "INSERT INTO temp_reservations (guest_name, check_in, check_out, room_type, status, created_at)
                SELECT guest_name, check_in, check_out, room_type, status, created_at
                FROM reservations
                ORDER BY id";
        $conn->query($sql);
        
        // 4. Truncate the original table
        $sql = "TRUNCATE TABLE reservations";
        $conn->query($sql);
        
        // 5. Copy back data with new IDs and maintained created_at
        $sql = "INSERT INTO reservations (guest_name, check_in, check_out, room_type, status, created_at)
                SELECT guest_name, check_in, check_out, room_type, status, created_at
                FROM temp_reservations
                ORDER BY created_at";
        $conn->query($sql);
        
        // 6. Drop the temporary table
        $sql = "DROP TEMPORARY TABLE IF EXISTS temp_reservations";
        $conn->query($sql);
        
        // 7. Reset AUTO_INCREMENT
        $sql = "ALTER TABLE reservations AUTO_INCREMENT = 1";
        $conn->query($sql);
        
        // Commit transaction
        $conn->commit();
        
        // Redirect to index page
        header("location: home.php");
        exit();
    } catch (Exception $e) {
        // An error occurred; rollback the transaction
        $conn->rollback();
        echo "Oops! Something went wrong. Please try again later. Error: " . $e->getMessage();
    }
    
    // Close connection
    $conn->close();
} else {
    // If id isn't set, redirect to index page
    header("location: home.php");
    exit();
}
?>
