<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="customer_styles.css" />
  <link rel="stylesheet" href="sidenavbar_styles.css" />
  
</head>
<body>
  <div class="sidebar">
    <img src="ahk_logo.png"/>
    <h2>Admin Menu</h2>
    <ul class="menu-top">
      <li><i class="fas fa-home"></i> Dashboard</li>
      <li style="margin-left: 2px;"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</li>
      <li><a href="customer.php"><i class="fas fa-users"></i> Customers</a></li>
      <li style="margin-left: 3px;"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</li>
      <li><i class="fas fa-credit-card"></i> Payment</li>
      <li><i class="fas fa-chart-line"></i> Analytics</li>
      <li><i class="fas fa-boxes"></i> Suppliers</li>
      <li><i class="fas fa-cog"></i> Settings</li>
    </ul>
    <ul class="menu-bottom">
      <li><i class="fas fa-sign-out-alt"></i> Sign Out</li>
    </ul>
  </div>

  <div class="main">
    <div class="navbar">
      <div class="page-info">
        <h1>Customer Management</h1>
        <p>Manage your customer details</p>
      </div>
      <div style="display: flex; align-items: center;">
        <div class="notification-icon">
          <i class="fas fa-bell"></i>
        </div>
        <div class="user-profile-container" style="position: relative;">
          <div class="user-info" style="cursor:pointer;">
            <div class="user-label">
              <span class="user-name">Boss</span>
              <span class="user-role">Admin</span>
            </div>
            <div class="user-icon">
              <i class="fas fa-user"></i>
            </div>
            <span class="dropdown-icon"><i class="fas fa-chevron-down"></i></span>
          </div>
          <ul class="profile-dropdown-menu" hidden>
            <li><a href="profile.html">My Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="top-bar">
        <form method="GET" action="" style="display: flex; gap: 10px;">
          <input type="text" name="search" placeholder="Search name ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          <button type="submit"><i class="fas fa-search"></i> Search</button>
          <button type="button" style="margin-left: 810px;" onclick="openModal()"><i class="fas fa-plus"></i> Add Customer</button>
        </form>
      </div>
      <div class="table-pagination-wrapper">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Vehicle</th>
            <th>Plate Number</th>
            <th>Service</th>
            <th>Last Visit</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'config.php';

          $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

          // Tetapkan berapa rekod per halaman
          $records_per_page = 8;

          // Dapatkan nombor halaman dari URL, default 1
          $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

          // Kira OFFSET untuk SQL
          $offset = ($page - 1) * $records_per_page;

          // Query kira jumlah rekod dulu (untuk pagination)
          $count_sql = "SELECT COUNT(*) AS total FROM customer";
          if (!empty($search)) {
              $count_sql .= " WHERE name LIKE '%$search%'";
          }
          $count_result = $conn->query($count_sql);
          $total_records = $count_result->fetch_assoc()['total'];

          // Kira jumlah halaman
          $total_pages = ceil($total_records / $records_per_page);

          // Query data customer dengan LIMIT dan OFFSET
          $sql = "SELECT customer_id, name, contact, vehicle, plate_number, service, last_visit FROM customer";
          if (!empty($search)) {
              $sql .= " WHERE name LIKE '%$search%'";
          }
          $sql .= " LIMIT $records_per_page OFFSET $offset";

          $result = $conn->query($sql);

          if (!empty($search)) {
            echo "<p>Showing results for \"<strong>" . htmlspecialchars($search) . "</strong>\"</p>";
          }

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['vehicle']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['plate_number']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['service']) . "</td>";
                  echo "<td><strong>" . date("d F Y", strtotime($row['last_visit'])) . "</strong></td>";
                  echo "<td class='actions'>
                          <i class='fas fa-eye' onclick='viewCustomer(" . json_encode($row) . ")'></i>
                          <i class='fas fa-pen' onclick='editCustomer(" . json_encode($row) . ")'></i>
                          <i class='fas fa-trash' onclick='confirmDelete(" . $row['customer_id'] . ")'></i>
                        </td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='7'>No customers found.</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>

      <div class="pagination" style="margin-bottom: 20px;">
        <!-- Prev button -->
        <a href="<?php echo ($page > 1) ? "?search=".urlencode($search)."&page=".($page - 1) : '#'; ?>"
          class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-left"></i>
        </a>

        <!-- Page numbers -->
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
          <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>"
            class="<?php echo ($i == $page) ? 'active' : ''; ?>">
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <!-- Next button -->
        <a href="<?php echo ($page < $total_pages) ? "?search=".urlencode($search)."&page=".($page + 1) : '#'; ?>"
          class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
          <i class="fas fa-chevron-right"></i>
        </a>
      </div>
      </div>
  
      <!-- Modal Add Customer -->
    <div id="addCustomerModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h2>Add New Customer</h2>
        <form method="POST" action="add_customer.php" id="customerForm">
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" required>
          </div>
          <div class="form-group">
            <label>Contact</label>
            <input type="text" name="contact" required>
          </div>
          <div class="form-group">
            <label>Vehicle</label>
            <input type="text" name="vehicle" required>
          </div>
          <div class="form-group">
            <label>Plate Number</label>
            <input type="text" name="plate_number" required>
          </div>
          <div class="form-group">
            <label>Service</label>
            <input type="text" name="service" required>
          </div>
          <div class="form-group">
            <label>Last Visit</label>
            <input type="date" name="last_visit" required>
          </div>
          <button type="submit" class="submit-btn">Add Customer</button>
        </form>
      </div>
    </div>

    <!-- View Customer Modal -->
    <div id="viewCustomerModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeViewModal()">&times;</span>
        <h2 style="margin-bottom: 20px;">Customer Details</h2>
        <div id="customerDetails" class="customer-info-grid">
          <div class="info-box">
            <i class="fas fa-user"></i>
            <div><strong>Name:</strong><br><span id="viewName"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-phone"></i>
            <div><strong>Contact:</strong><br><a id="viewContact" href="#"></a></div>
          </div>
          <div class="info-box">
            <i class="fas fa-car"></i>
            <div><strong>Vehicle:</strong><br><span id="viewVehicle"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-id-card"></i>
            <div><strong>Plate Number:</strong><br><span id="viewPlate"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-wrench"></i>
            <div><strong>Service:</strong><br><span id="viewService"></span></div>
          </div>
          <div class="info-box">
            <i class="fas fa-calendar-check"></i>
            <div><strong>Last Visit:</strong><br><span id="viewLastVisit"></span></div>
          </div>
        </div>
        <div style="margin-top: 20px; text-align: right;">
          <button id="viewEditBtn" class="submit-btn">Edit</button>
          <button class="submit-btn" style="background-color: #6c757d;" onclick="closeViewModal()">Close</button>
        </div>
      </div>
    </div>

    <!-- Edit Customer Modal -->
    <div id="editCustomerModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeEditModal()">&times;</span>
        <h2>Edit Customer Details</h2>
        <form method="POST" action="update_customer.php" id="editCustomerForm">
          <input type="hidden" id="editCustomerId" name="customer_id">

          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="editName" required>
          </div>
          <div class="form-group">
            <label>Contact</label>
            <input type="text" name="contact" id="editContact" required>
          </div>
          <div class="form-group">
            <label>Vehicle</label>
            <input type="text" name="vehicle" id="editVehicle" required>
          </div>
          <div class="form-group">
            <label>Plate Number</label>
            <input type="text" name="plate_number" id="editPlateNumber" required>
          </div>
          <div class="form-group">
            <label>Service</label>
            <input type="text" name="service" id="editService" required>
          </div>
          <div class="form-group">
            <label>Last Visit</label>
            <input type="date" name="last_visit" id="editLastVisit" required>
          </div>
          <button type="submit" class="submit-btn">Save Changes</button>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteConfirmModal" class="modal">
      <div class="modal-content">
        <span class="close-btn" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this customer?</p>
        <form method="POST" action="delete_customer.php">
          <input type="hidden" name="customer_id" id="deleteCustomerId" />
            <div style="margin-top: 20px; text-align: right;">
              <button type="submit" class="submit-btn" style="background-color: #dc3545;">Delete</button>
              <button type="button" class="submit-btn" style="background-color: #6c757d;" onclick="closeDeleteModal()">Close</button>

            </div>
        </form>
      </div>
    </div>
    </div> <!-- content -->
  </div>
  <script src="sidenavbar_script.js"></script>
  <script src="customer_script.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const paginationLinks = document.querySelectorAll('.pagination a');
    
    paginationLinks.forEach(link => {
      if (link.classList.contains('active')) {
        // Already handled by PHP for active page
      }
    });
  
    // Disable prev/next if needed
    const prev = document.querySelector('.pagination a[href*="page=' + (<?php echo $page ?> - 1) + '"]');
    const next = document.querySelector('.pagination a[href*="page=' + (<?php echo $page ?> + 1) + '"]');

    if (!prev) {
      const leftArrow = document.querySelector('.pagination a i.fa-chevron-left');
      if (leftArrow) leftArrow.parentElement.classList.add('disabled');
    }
    if (!next) {
      const rightArrow = document.querySelector('.pagination a i.fa-chevron-right');
      if (rightArrow) rightArrow.parentElement.classList.add('disabled');
    }
  });

  document.querySelectorAll('.pagination a.disabled').forEach(el => {
    el.addEventListener('click', e => {
      e.preventDefault(); // prevent click action
    });
  });
  </script>
</body>
</html>

