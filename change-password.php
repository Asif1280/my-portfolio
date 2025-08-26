<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 
</head>

<body>
    <?php
    include("./includes/header.php");
    include("./includes/sidebar.php");
    ?>

    <main id="main" class="main">
        <div class="main-content">
            <div class="container">
                <!-- Back Button -->
                <a href="index.php" class="btn btn-primary mb-3" title="Back">
                    <i class="bi bi-arrow-left"></i> <strong>Back to Profile</strong>
                </a>

                <!-- Change Password Heading -->
                <h2>Change Password</h2>

                <!-- Change Password Form -->
                <form action="changepass-action.php" method="post">
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" id="currentPassword" name="currentPassword" class="form-control" placeholder="Enter current password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="Enter new password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
                        <input type="password" id="confirmNewPassword" name="confirmNewPassword" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </form>
            </div>
        </div>
    </main>
    <?php
    include("./includes/footer.php");
    ?>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>