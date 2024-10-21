<?php
include "connection.php";

if($_SERVER["REQUEST_METHOD"] == 'GET'){
    if(!isset($_GET['id'])){
        header("location: home.php");
        exit;
    }
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM reservations WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    if(!$row){
        header("location: home.php");
        exit;
    }
    
    $guest_name = $row["guest_name"];
    $check_in = $row["check_in"];
    $check_out = $row["check_out"];
    $room_type = $row["room_type"];
    $status = $row["status"];
}
else {
    $id = $_POST["id"];
    $guest_name = $_POST["guest_name"];
    $check_in = $_POST["check_in"];
    $check_out = $_POST["check_out"];
    $room_type = $_POST["room_type"];
    $status = $_POST["status"];
    
    $sql = "UPDATE reservations SET 
            guest_name='$guest_name', 
            check_in='$check_in', 
            check_out='$check_out', 
            room_type='$room_type', 
            status='$status' 
            WHERE id='$id'";
    
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
    <title>Edit Reservation - Hotel Management</title>
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
                    <h4 class="mb-0">Edit Reservation</h4>
                </div>
                <div class="card-body">
                    <form method="post" id="reservationForm">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Guest Name</label>
                            <input type="text" name="guest_name" value="<?php echo $guest_name; ?>" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Check-In Date</label>
                            <input type="date" name="check_in" value="<?php echo $check_in; ?>" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Check-Out Date</label>
                            <input type="date" name="check_out" value="<?php echo $check_out; ?>" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Room Type</label>
                            <select name="room_type" class="form-select" required>
                                <option value="Standard" <?php echo ($room_type == 'Standard') ? 'selected' : ''; ?>>Standard Room</option>
                                <option value="Deluxe" <?php echo ($room_type == 'Deluxe') ? 'selected' : ''; ?>>Deluxe Room</option>
                                <option value="Suite" <?php echo ($room_type == 'Suite') ? 'selected' : ''; ?>>Suite</option>
                                <option value="Presidential" <?php echo ($room_type == 'Presidential') ? 'selected' : ''; ?>>Presidential Suite</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Confirmed" <?php echo ($status == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                <option value="Checked-In" <?php echo ($status == 'Checked-In') ? 'selected' : ''; ?>>Checked-In</option>
                                <option value="Checked-Out" <?php echo ($status == 'Checked-Out') ? 'selected' : ''; ?>>Checked-Out</option>
                                <option value="Cancelled" <?php echo ($status == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Reservation
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
