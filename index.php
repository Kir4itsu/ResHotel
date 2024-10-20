<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel Reservation Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #1a237e !important;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 2px solid #1a237e;
        }
        .btn-primary {
            background-color: #1a237e;
            border-color: #1a237e;
        }
        .btn-primary:hover {
            background-color: #0e1442;
            border-color: #0e1442;
        }
        .table th {
            background-color: #e8eaf6;
        }
        .status-badge {
            font-size: 0.8rem;
        }
        .hero-section {
            background: url('https://source.unsplash.com/1600x900/?hotel') no-repeat center center;
            background-size: cover;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            padding: 100px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-hotel me-2"></i>Luxury Hotel Reservations
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
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

    <div class="hero-section mb-4">
        <div class="container text-center">
            <h1 class="display-4">Welcome to Luxury Hotel</h1>
            <p class="lead">Manage your reservations with ease and elegance</p>
        </div>
    </div>

    <div class="container my-4">
        <div class="card">
            <div class="card-header bg-white">
                <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Current Reservations</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                <th><i class="fas fa-user me-2"></i>Guest Name</th>
                                <th><i class="fas fa-calendar-alt me-2"></i>Check-In</th>
                                <th><i class="fas fa-calendar-alt me-2"></i>Check-Out</th>
                                <th><i class="fas fa-bed me-2"></i>Room Type</th>
                                <th><i class="fas fa-info-circle me-2"></i>Status</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
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
                                    <td>
                                        <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-primary me-1' title='Edit'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this reservation?\")' title='Delete'>
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

    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2023 Luxury Hotel Reservations. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>