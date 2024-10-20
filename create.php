<?php
include "connection.php";

if(isset($_POST['submit'])){
    $guest_name = $_POST['guest_name'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $room_type = $_POST['room_type'];
    $status = $_POST['status'];
    
    $sql = "INSERT INTO reservations (guest_name, check_in, check_out, room_type, status) 
            VALUES ('$guest_name', '$check_in', '$check_out', '$room_type', '$status')";
    
    if($conn->query($sql)){
        header("Location: home.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Reservation - Hotel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-hotel me-2"></i>Hotel Reservation System
            </a>
        </div>
    </nav>

    <div class="container my-4">
        <div class="form-container">
            <div class="card">
                <div class="card-header bg-white">
                    <h4 class="mb-0">New Reservation</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="reservationForm">
                        <div class="mb-3">
                            <label class="form-label">Guest Name</label>
                            <input type="text" name="guest_name" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Check-In Date</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Check-Out Date</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <select name="room_type" class="form-select" required>
                                <option value="">Select Room Type</option>
                                <option value="Standard">Standard Room</option>
                                <option value="Deluxe">Deluxe Room</option>
                                <option value="Suite">Suite</option>
                                <option value="Presidential">Presidential Suite</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Checked-In">Checked-In</option>
                                <option value="Checked-Out">Checked-Out</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Reservation
                            </button>
                            <a href="home.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to List
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>