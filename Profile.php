<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

include 'conf.php';

$email = $_SESSION['email'];

$sql = "SELECT * FROM UserProfile WHERE Email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['userName'] = $row['Username'];
    $_SESSION['fullName'] = $row['FullName'];
    $_SESSION['phone'] = $row['PhoneNo'];
    $_SESSION['address'] = $row['Address'];
    $_SESSION['profileImage'] = $row['ProfilePicture'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hydrate</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@400..700&family=Spicy+Rice&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link:hover {
            color: #1887fe !important;
        }
        .card {
            border-radius: 10px;
            border: none;
            margin-bottom: 15px;
        }
        .card-header {
            background-color: #1887fe;
            color: white;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        .card-body {
            background-color: white;
            border-radius: 0 0 10px 10px;
            padding: 15px;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .wishlist-item, .review-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .wishlist-item img, .review-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 10px;
        }
        .rating-star {
            color: #f8b400;
        }
        .order-history-table th, .order-history-table td {
            padding: 8px;
            text-align: center;
        }
        .order-history-table th {
            background-color: #bebdba;
            color: white;
        }
        .section {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
     <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-fluid">
      <!-- Left Dropdown Menu -->
      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./assets/images/solar--user-broken.png" alt="" height="30px" width="26px">
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="./login.html">Sign In</a></li>
          <li><a class="dropdown-item" href="./Profile.html">Profile</a></li>
          <li><a class="dropdown-item" href="#">Sign Out</a></li>
        </ul>
      </div>

      <!-- Center Logo -->
      <a class="navbar-brand" href="./index.html">
        <img src="./assets/images/hydrate-high-resolution-logo.png" alt="Hydrate Logo">
      </a>

      <!-- Toggle Button for Smaller Screens -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Right Navbar Links (collapsible) -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <div class="navbar-nav">
          <a class="nav-link" href="./index.html#about">About Us</a>
          <a class="nav-link" href="./flavours.html">Flavours</a>
          <a class="nav-link" href="./products.html">Products</a>
          <a class="nav-link" href="./contact_us.html">Contact Us</a>
          <a class="nav-link" href="./products.html">Cart</a>
        </div>
      </div>
    </div>
  </nav>
    <!-- Profile Page -->
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-4">
                <!-- Profile Card -->
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="User Profile Picture">
                    <div class="card-body text-center" id="profile-card-body">
                        <img src="<?php echo $_SESSION['profileImage']; ?>" alt="Profile Picture" class="profile-pic mb-3" id="profile-pic-display">
                        <h5 class="card-title" id="profile-name"><?php echo $_SESSION['fullName']; ?></h5>
                        <p class="card-text" id="profile-email">Email: <?php echo $_SESSION['email']; ?></p>
                        <p class="card-text" id="profile-phone">Phone: <?php echo $_SESSION['phone']; ?></p>
                        <p class="card-text" id="profile-address">Shipping Address: <?php echo $_SESSION['address']; ?></p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                    </div>
                </div>
                <!-- Wishlist -->
                <div class="card">
                    <div class="card-header">
                        Wishlist
                    </div>
                    <div class="card-body">
                        <div class="wishlist-item">
                            <img src="https://via.placeholder.com/50" alt="Beverage">
                            <span>Beverage 1</span>
                            <button class="btn btn-danger btn-custom">Remove</button>
                        </div>
                        <div class="wishlist-item">
                            <img src="https://via.placeholder.com/50" alt="Beverage">
                            <span>Beverage 2</span>
                            <button class="btn btn-danger btn-custom">Remove</button>
                        </div>
                    </div>
                </div>
                <!-- Reviews -->
                <div class="card">
                    <div class="card-header">
                        Reviews
                    </div>
                    <div class="card-body">
                        <div class="review-item">
                            <div>
                                <span class="rating-star">★★★★★</span>
                                <span>Beverage 1</span>
                            </div>
                            <button class="btn btn-warning btn-custom">Edit</button>
                        </div>
                        <div class="review-item">
                            <div>
                                <span class="rating-star">★★★★☆</span>
                                <span>Beverage 2</span>
                            </div>
                            <button class="btn btn-warning btn-custom">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <!-- Order History -->
                <div class="card">
                    <div class="card-header">
                        Order History
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered order-history-table">
                            <thead>
                                <tr>
                                    <th>Order Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>Beverage 1</td>
                                    <td>$10</td>
                                    <td>Delivered</td>
                                </tr>
                                <tr>
                                    <td>#12346</td>
                                    <td>Beverage 2</td>
                                    <td>$15</td>
                                    <td>Pending</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="account-form" action="updateProfile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="new-profile-pic" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="new-profile-pic" name="profileImage">
                        </div>
                        <div class="mb-3">
                            <label for="new-name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="new-name" placeholder="Enter full name" name="fullName" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="new-email" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="new-phone" placeholder="Enter phone number" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="new-address" class="form-label">Shipping Address</label>
                            <textarea class="form-control" id="new-address" rows="3" name="address" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" id="save-profile-button">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center" style="bottom: 0; position:fixed;">
        <small>&copy; 2025 | Hydrate</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('save-profile-button').addEventListener('click', function(event) {
            const fullName = document.getElementById('new-name').value;
            const email = document.getElementById('new-email').value;
            const phone = document.getElementById('new-phone').value;
            const address = document.getElementById('new-address').value;

            if (!fullName || !email || !phone || !address) {
                alert('Please fill in all fields.');
                event.preventDefault();
                return;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email.');
                event.preventDefault();
                return;
            }

            const phonePattern = /^\d{10}$/;
            if (!phonePattern.test(phone)) {
                alert('Please enter a valid 10-digit phone number.');
                event.preventDefault();
                return;
            }

            document.getElementById('account-form').submit();
        });
    </script>
</body>
</html>
