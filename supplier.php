<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }
    body {
      display: flex;
      background-color: #f0f2f5;
      color: #333
    }
    .sidebar {
      width: 240px;
      height: auto; 
      min-height: 100vh; 
      background-color: #5a5a59;
      color: white;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
    }
    .sidebar img {
      margin-top: 10px;
      margin-bottom: -50px;
    }
    .sidebar h2 {
      font-size: 20px;
      margin-bottom: -50px;
    }
    .sidebar ul {
      list-style: none;
      width: 100%;
    }
    .sidebar .menu-top,
    .sidebar .menu-bottom {
      list-style: none;
      width: 100%;
    }
    .sidebar ul li {
      display: flex;
      align-items: center;
      padding: 15px 30px;
      cursor: pointer;
      transition: background 0.2s;
    }
    .sidebar ul li:hover {
      background-color: #dc3545;
    }
    .sidebar ul li.active {
      background-color: #dc3545;
    }
    .sidebar ul li i {
      margin-right: 10px;
      flex-shrink: 0;
    }
    .sidebar ul li a {
      display: flex;
      align-items: center;
      width: 100%;
      height: 100%;
      text-decoration: none;
      color: white;
    }
    .sidebar ul li a:hover {
      text-decoration: none;
      color: white;
    }
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .navbar {
      height: 120px;
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
      border-bottom: 1px solid #ccc;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .navbar .page-info h1 {
      font-size: 20px;
      margin-bottom: 5px;
      color: #212B36;
    }
    .navbar .page-info p {
      font-size: 14px;
      color: #637381;
    }
    .navbar .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .navbar .user-label {
      display: flex;
      flex-direction: column;
      align-items: flex-end;
      margin-right: 15px;
    }
    .navbar .user-name {
      font-weight: 600;
      font-size: 14px;
      color: #212B36;
    }
    .navbar .user-role {
      font-size: 12px;
      color: #637381;
    }
    .navbar .user-icon {
      width: 32px;
      height: 32px;
      background-color: #EFF4FB;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
      font-size: 14px;
      border: 1px solid #E2E8F0;
      cursor: pointer;
    }
    .navbar .dropdown-icon i {
      font-size: 12px;
      color: #555;
      margin-right: 10px;
    }
    .navbar .notification-icon {
      width: 32px;
      height: 32px;
      background-color: #EFF4FB;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 40px;
      cursor: pointer;
      border: 1px solid #E2E8F0;
    }
    .navbar .notification-icon i {
      color: #333;
      font-size: 14px;
    }
    .profile-dropdown-menu {
      position: absolute;
      top: 100%;
      right: 0;
      background-color: #fff;
      border: 1px solid #E2E8F0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      list-style: none;
      padding: 5px 0;
      margin-top: 10px;
      z-index: 1000;
      min-width: 160px;
      border-radius: 8px;
      overflow: hidden;
    }
    .profile-dropdown-menu li a {
      display: block;
      padding: 10px 20px;
      text-decoration: none;
      color: #212B36;
      font-size: 14px;
      transition: background-color 0.2s;
    }
    .profile-dropdown-menu li a:hover {
      background-color: #EFF4FB;
      color: #dc3545;
    }
    .profile-dropdown-menu[hidden] {
      display: none;
    }
    .user-profile-container.active {
      background-color: rgba(157, 157, 157, 0.1);
      border-radius: 8px;
    }
    /* Layout & General Elements */
.content {
  padding: 30px;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.top-bar input[type="text"] {
  padding: 10px;
  width: 300px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.top-bar button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

/* 2.Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  background-color: white;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

table th, table td {
  padding: 15px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

table th {
  background-color: #dadada;
  font-weight: bold;
}

.actions i {
  margin-right: 10px;
  cursor: pointer;
  color: #333;
}

/* 3.Modal (Popup) Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4); /* gelap di belakang */
}

.modal-content {
  background-color: #fff;
  margin: auto;
  padding: 20px;
  border-radius: 10px;
  width: 500px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* center betul-betul */
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

@keyframes slideIn {
  from {transform: translateY(-30px); opacity: 0;}
  to {transform: translateY(0); opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeOut {
  from {opacity: 1;}
  to {opacity: 0;}
}

.close-btn {
  float: right;
  font-size: 24px;
  cursor: pointer;
  color: #999;
}

.close-btn:hover {
  color: #dc3545;
}

.modal.show {
  animation: fadeIn 0.3s;
  display: flex !important;
}

.modal.hide {
  animation: fadeOut 0.3s forwards;
}

/* 4.Forms (Inside Modal) */
.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: 600;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.submit-btn {
  background-color: #dc3545;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.submit-btn:hover {
  background-color: #c82333;
}

/* 5.View-Customer Modal (Specific Component) */
.customer-info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.info-box {
  display: flex;
  align-items: flex-start;
  gap: 15px;
  background-color: #f9f9f9;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.info-box i {
  font-size: 20px;
  color: #dc3545;
  min-width: 25px;
}

#viewContact {
  text-decoration: none;
  color: #007bff;
}

#viewContact:hover {
  text-decoration: underline;
}

/* 6.Pagination Styles */
.table-pagination-wrapper {
  display: flex;
  flex-direction: column;
  justify-content: flex-end; /* letak pagination bawah container */
  min-height: 100px; 
  gap: 10px;
}

.pagination {
  margin-top: 20px;
  text-align: right; 
}

.pagination a {
  border: none;
  background-color: #eee;
  padding: 6px 12px;
  margin: 0 3px;
  color: #333;
  text-decoration: none;
  border-radius: 4px;
  display: inline-block;
  cursor: pointer;
  box-shadow: 0 1px 2px rgba(0,0,0,0.1);
  transition: background-color 0.3s ease, color 0.3s ease;
  user-select: none;
}

.pagination a.active {
  background-color: #dc3545;
  color: white;
  font-weight: bold;
  cursor: default;
  pointer-events: none; /* Disable clicks on active */
}

.pagination a:hover:not(.active) {
  background-color: #e44858;
  color: white;
}

.pagination a.disabled {
  background-color: #ccc;
  color: #888;
  cursor: not-allowed;
  pointer-events: auto; /* biar boleh klik walaupun disabled */
}
</style>
<body>
    <div class="sidebar">
        <img src="ahk_logo.png"/>
        <h2>Admin Menu</h2>
        <ul class="menu-top">
            <li><a href="dashboard_admin.html"><i class="fas fa-home"></i> Dashboard</a></li>
            <li style="margin-left: 2px;"><a href="#"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</a></li>
            <li><a href="customer.php"><i class="fas fa-users"></i> Customers</a></li>
            <li style="margin-left: 3px;"><a href="#"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</a></li>
            <li><a href="#"><i class="fas fa-credit-card"></i> Payment</a></li>
            <li><a href="analytics.html"><i class="fas fa-chart-line"></i> Analytics</a></li>
            <li class="active"><a href="supplier.php"><i class="fas fa-boxes"></i> Suppliers</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
        <ul class="menu-bottom">
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
        </ul>
    </div>

    <div class="main">
        <div class="navbar">
            <div class="page-info">
                <h1>Suppliers Management</h1>
                <p>Suppliers Management allows the admin to manage and track supplier details.</p>
            </div>
            <div style="display: flex; align-items: center;">
                <div class="notification-icon">
                    <i class="fas fa-bell"></i> <!-- functional -->
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
                        <li><a href="#">Settings</a></li> <!-- a href -->
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="top-bar">
            <form method="GET" action="" style="display: flex; gap: 10px;">
                <input type="text" name="search" placeholder="Search ..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button> 
                <button type="button" onclick="openAddModal()"><i class="fas fa-plus"></i> Add Supplier</button>
            </form>
            </div>
            <div class="table-pagination-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Contact Person</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'config.php';

                    // Get search keyword
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                    // Pagination setup
                    $records_per_page = 8;
                    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $records_per_page;

                    // Count total records
                    $count_sql = "SELECT COUNT(*) AS total FROM supplier";
                    if (!empty($search)) {
                        $count_sql .= " WHERE name LIKE '%$search%'";
                    }
                    $count_result = $conn->query($count_sql);
                    $total_records = $count_result->fetch_assoc()['total'];
                    $total_pages = ceil($total_records / $records_per_page);

                    // Fetch suppliers with pagination
                    $sql = "SELECT supplier_id, name, contact_person, email, phone, category, created_at, updated_at FROM supplier";
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
                            echo "<td>" . htmlspecialchars($row['supplier_id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['contact_person']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                            echo "<td class='actions'>
                                    <i class='fas fa-eye' onclick='viewSupplier(" . json_encode($row) . ")'></i>
                                    <i class='fas fa-pen' onclick='editSupplier(" . json_encode($row) . ")'></i>
                                    <i class='fas fa-trash' onclick='confirmDelete(" . $row['supplier_id'] . ")'></i>
                                    </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No supplier found.</td></tr>";
                    }

                    $conn->close();
                    ?>
                    </tbody>
                </table>
                <div class="pagination" style="margin-bottom: 20px;">
                    <!-- Prev button -->
                    <a href="<?php echo ($page > 1) ? "?search=" . urlencode($search) . "&page=" . ($page - 1) : '#'; ?>" class="<?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                    <i class="fas fa-chevron-left"></i>
                    </a>

                    <!-- Page numbers -->
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?search=<?php echo urlencode($search); ?>&page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                    <?php endfor; ?>

                    <!-- Next button -->
                    <a href="<?php echo ($page < $total_pages) ? "?search=" . urlencode($search) . "&page=" . ($page + 1) : '#'; ?>" class="<?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                    <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
    
            <!-- Modal Add Supplier -->
            <div id="addSupplierModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeAddModal()">&times;</span>
                    <h2>Add New Supplier</h2>
                    <form method="POST" action="supplier_add.php" id="supplierForm">
                        <div class="form-group">
                            <label style="margin-top: 20px;">Supplier ID</label>
                            <input type="text" name="supplier_id" placeholder="Auto-generated" readonly style="background-color: #e0e0e0; cursor: not-allowed;">
                            </div>
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <input type="text" name="name" required>
                        </div>
                        <div class="form-group">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" required>
                        </div>
                        <button type="submit" class="submit-btn">Add Supplier</button>
                    </form>
                </div>
            </div>

            <!-- View Supplier Modal -->
            <div id="viewSupplierModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeViewModal()">&times;</span>
                    <h2>Supplier Details</h2>
                    <div id="supplierDetails" class="supplier-info-grid">
                        <div class="info-box" style="margin-top: 20px;">
                            <i class="fas fa-building"></i>
                            <div><strong>Supplier Name:</strong><br><span id="viewSupplierName"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-user-tie"></i>
                            <div><strong>Contact Person:</strong><br><span id="viewContactPerson"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-envelope"></i>
                            <div><strong>Email:</strong><br><span id="viewEmail"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-phone"></i>
                            <div><strong>Phone:</strong><br><span id="viewPhone"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-tags"></i>
                            <div><strong>Category:</strong><br><span id="viewCategory"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-calendar-plus"></i>
                            <div><strong>Created At:</strong><br><span id="viewCreatedAt"></span></div>
                        </div>
                        <div class="info-box">
                            <i class="fas fa-calendar-check"></i>
                            <div><strong>Updated At:</strong><br><span id="viewUpdatedAt"></span></div>
                        </div>
                    </div>
                    <div style="margin-top: 20px; text-align: right;">
                        <button class="submit-btn" style="background-color: #6c757d;" onclick="closeViewModal()">Close</button>
                    </div>
                </div>
            </div>

            <!-- Edit Supplier Modal -->
            <div id="editSupplierModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn" onclick="closeEditModal()">&times;</span>
                    <h2>Edit Supplier Details</h2>
                    <form method="POST" action="supplier_update.php" id="editSupplierForm">
                    <input type="hidden" id="editSupplierId" name="supplier_id">

                    <div class="form-group" style="margin-top: 20px;">
                        <label >Supplier Name</label>
                        <input type="text" name="name" id="editSupplierName" required>
                    </div>
                    <div class="form-group">
                        <label>Contact Person</label>
                        <input type="text" name="contact_person" id="editContactPerson" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" id="editPhone" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" id="editCategory" required>
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
                    <p style="margin-top: 15px;">Are you sure you want to delete this supplier?</p>
                    <form method="POST" action="supplier_delete.php">
                    <input type="hidden" name="supplier_id" id="deleteSupplierId" />
                    <div style="margin-top: 20px; text-align: right;">
                        <button type="submit" class="submit-btn" style="background-color: #dc3545;">Delete</button>
                        <button type="button" class="submit-btn" style="background-color: #6c757d;" onclick="closeDeleteModal()">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const paginationLinks = document.querySelectorAll('.pagination a');
    const currentPage = <?php echo $page; ?>;

    // Disable Prev/Next based on page boundaries
    const prevLink = document.querySelector('.pagination a[href*="page=' + (currentPage - 1) + '"]');
    const nextLink = document.querySelector('.pagination a[href*="page=' + (currentPage + 1) + '"]');

    if (!prevLink) {
      const prevButton = document.querySelector('.pagination a .fa-chevron-left');
      if (prevButton) prevButton.parentElement.classList.add('disabled');
    }

    if (!nextLink) {
      const nextButton = document.querySelector('.pagination a .fa-chevron-right');
      if (nextButton) nextButton.parentElement.classList.add('disabled');
    }

    // Prevent clicks on disabled links
    document.querySelectorAll('.pagination a.disabled').forEach(el => {
      el.addEventListener('click', function(e) {
        e.preventDefault();
      });
    });
  });

  // Add Supplier Modal (Global)
    const addModal = document.getElementById("addSupplierModal");

    // Open Add Modal
    function openAddModal() {
    addModal.style.display = "flex";
    addModal.classList.add("show");
    addModal.classList.remove("hide");
    }

    // Close Add Modal
    function closeAddModal() {
    addModal.classList.add("hide");
    addModal.classList.remove("show");
    setTimeout(() => {
        addModal.style.display = "none";
    }, 300);
    }

    // View Supplier Modal (Global)
    const viewModal = document.getElementById("viewSupplierModal");

    // Edit Supplier Modal (Global)
    const editModal = document.getElementById("editSupplierModal");

    // Delete Confirmation Modal (Global)
    const deleteModal = document.getElementById("deleteConfirmModal");

    // validate alert success error
    document.addEventListener("DOMContentLoaded", function() {
    const params = new URLSearchParams(window.location.search);
    const action = params.get("action");
    const status = params.get("status");

    if (!action || !status) return;

    let message = "";

    if (status === "success") {
        switch(action) {
        case "create":
            message = "Record created successfully!";
            break;
        case "update":
            message = "Record updated successfully!";
            break;
        case "delete":
            message = "Record deleted successfully!";
            break;
        default:
            message = "Operation completed successfully!";
        }
    } else if (status === "error") {
        switch(action) {
        case "create":
            message = "Error: Failed to create record.";
            break;
        case "update":
            message = "Error: Failed to update record.";
            break;
        case "delete":
            message = "Error: Failed to delete record.";
            break;
        default:
            message = "Error: Operation failed.";
        }
    }

    if (message) alert(message);
    });

    // Reusable validation function
    function validateSupplierForm(email, phone, contactPerson) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^01\d{8,9}$/; // Malaysia phone format
    const contactRegex = /^[A-Za-z\s.\-]+$/; // Letters, spaces, dots, hyphens

    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }
    if (!phoneRegex.test(phone)) {
        alert("Please enter a valid Malaysian phone number (e.g., 0123456789).");
        return false;
    }
    if (!contactRegex.test(contactPerson)) {
        alert("Contact person name can only contain letters, spaces, dots, and hyphens.");
        return false;
    }
    return true;
    }

    // Add Supplier form validation
    document.getElementById("supplierForm").addEventListener("submit", function (event) {
    const email = this.email.value.trim();
    const phone = this.phone.value.trim();
    const contactPerson = this.contact_person.value.trim();

    if (!validateSupplierForm(email, phone, contactPerson)) {
        event.preventDefault();
    }
    });

    let currentSupplierData = null;

    function viewSupplier(data) {
    currentSupplierData = data;

    document.getElementById("viewSupplierName").textContent = data.name;
    document.getElementById("viewContactPerson").textContent = data.contact_person;
    document.getElementById("viewEmail").textContent = data.email;
    document.getElementById("viewPhone").textContent = data.phone;
    document.getElementById("viewCategory").textContent = data.category;
    document.getElementById("viewCreatedAt").textContent = new Date(data.created_at).toLocaleString();
    document.getElementById("viewUpdatedAt").textContent = new Date(data.updated_at).toLocaleString();


    viewModal.style.display = "flex";
    viewModal.classList.add("show");
    viewModal.classList.remove("hide");

    // Link Edit Button to Edit Modal
    document.getElementById("viewEditBtn").onclick = function () {
        editSupplier(currentSupplierData);
    };
    }

    function closeViewModal() {
    viewModal.classList.add("hide");
    viewModal.classList.remove("show");
    setTimeout(() => {
        viewModal.style.display = "none";
    }, 300);
    }

    function editSupplier(data) {
    document.getElementById("editSupplierId").value = data.supplier_id;
    document.getElementById("editSupplierName").value = data.name;
    document.getElementById("editContactPerson").value = data.contact_person;
    document.getElementById("editEmail").value = data.email;
    document.getElementById("editPhone").value = data.phone;
    document.getElementById("editCategory").value = data.category;

    editModal.style.display = "flex";
    editModal.classList.add("show");
    editModal.classList.remove("hide");
    }

    function closeEditModal() {
    editModal.classList.add("hide");
    editModal.classList.remove("show");
    setTimeout(() => {
        editModal.style.display = "none";
    }, 300);
    }

    // Edit Supplier form validation
    document.getElementById("editSupplierForm").addEventListener("submit", function (event) {
    const email = document.getElementById("editEmail").value.trim();
    const phone = document.getElementById("editPhone").value.trim();
    const contactPerson = document.getElementById("editContactPerson").value.trim();

    if (!validateSupplierForm(email, phone, contactPerson)) {
        event.preventDefault();
    }
    });

    function confirmDelete(supplierId) {
    document.getElementById("deleteSupplierId").value = supplierId;
    deleteModal.classList.add("show");
    }

    function closeDeleteModal() {
    deleteModal.classList.remove("show");
    }

    document.addEventListener('DOMContentLoaded', () => {
    const userProfile = document.querySelector('.user-profile-container');
    const dropdown = document.querySelector('.profile-dropdown-menu');
    const icon = userProfile.querySelector('.dropdown-icon i');

    userProfile.addEventListener('click', e => {
      e.stopPropagation();
      const isHidden = dropdown.hasAttribute('hidden');
      dropdown.toggleAttribute('hidden');
      icon.classList.toggle('fa-chevron-down', !isHidden);
      icon.classList.toggle('fa-chevron-up', isHidden);

      // Toggle background opacity
      userProfile.classList.toggle('active', isHidden);
    });

    document.addEventListener('click', () => {
      if (!dropdown.hasAttribute('hidden')) {
        dropdown.setAttribute('hidden', '');
        icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
        userProfile.classList.remove('active');
      }
    });
  });
  </script>

</body>
</html>

