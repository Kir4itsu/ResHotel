<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="home.php">
                <i class="fas fa-hotel me-2"></i>Hotel Reservation System
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-light" href="create.php">
                            <i class="fas fa-plus me-2"></i>New Reservation
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="mb-0">Current Reservations</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Guest Name</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Room Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "connection.php";
                            $sql = "SELECT * FROM reservations ORDER BY check_in DESC";
                            $result = $conn->query($sql);
                            
                            while($row = $result->fetch_assoc()) {
                                $statusClass = match($row['status']) {
                                    'Confirmed' => 'success',
                                    'Pending' => 'warning',
                                    'Checked-In' => 'info',
                                    'Checked-Out' => 'secondary',
                                    'Cancelled' => 'danger',
                                    default => 'primary'
                                };
                                
                                echo "
                                <tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['guest_name']}</td>
                                    <td>" . date('M d, Y', strtotime($row['check_in'])) . "</td>
                                    <td>" . date('M d, Y', strtotime($row['check_out'])) . "</td>
                                    <td>{$row['room_type']}</td>
                                    <td><span class='badge bg-{$statusClass} status-badge'>{$row['status']}</span></td>
                                    <td class='action-buttons'>
                                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-primary'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>