<?php include('./handle-enquiry.php'); // Include PHP logic 
?>

<main id="main" class="main">
    <div class="container-fluid">
        <h3 class="mb-4 text-center text-primary">Contant</h3>

        <!-- Search Form -->
        <form method="POST" class="mb-3" style="text-align: right;">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="input-group" style="align-items: center; width: 70%;">
                        <input type="text" name="search" class="form-control" placeholder="Search by Name"
                            value="<?php echo htmlspecialchars($searchQuery); ?>"
                            style="padding: 5px; font-size: 1rem; height: 45px; border-radius: 10px;">

                        <button class="btn btn-primary" type="submit"
                            style="padding: 5px 15px; font-size: 1rem; height: 45px; border-radius: 10px; margin-left: 2px;">Search</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card mb-5">
            <div class="card-header text-center">
                <h4 class="m-0 mt-1">Contact Details</h4>
            </div>
            <div class="card-body ">
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Phone</th>
                               <th>Email</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $sl = ($page - 1) * $limit + 1; // Start serial number based on the current page
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$sl}</td> <!-- Display serial number -->
                                        <td>{$row['name']}</td>
                                        <td>{$row['mobile']}</td>
                                        <td>{$row['email']}</td>
                                        <td>{$row['message']}</td>
                                        <td>
                                            <a href='?delete={$row['id']}' class='text-danger' onclick='return confirm(\"Are you sure you want to delete this contact?\");'>
                                                <i class='bi bi-trash' style='font-size: 1.5rem;'></i>
                                            </a>
                                        </td>
                                    </tr>";
                                    $sl++; // Increment serial number
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center' style='font-size: 1.2rem;'>No enquiries found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($searchQuery); ?>">Previous</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php if ($i === $page) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchQuery); ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($searchQuery); ?>">Next</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</main>
<?php
ob_end_flush(); // Flush the output buffer
?>
<?php
$conn->close();
include('./includes/footer.php');
?>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>