<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AHK Auto Care</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    /* Modal Styles */
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

    .close-btn {
      float: right;
      font-size: 24px;
      cursor: pointer;
      color: #999;
    }
    .close-btn:hover {
      color: #dc3545;
    }

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

    .modal.show {
      animation: fadeIn 0.3s;
      display: flex !important;
    }
    .modal.hide {
      animation: fadeOut 0.3s forwards;
    }
    @keyframes fadeOut {
      from {opacity: 1;}
      to {opacity: 0;}
    }
    /* view-customer-modal */
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
  
</head>
<body>
  <div class="sidebar">
    <img src="ahk_logo.png"/>
    <h2>Admin Menu</h2>
    <ul class="menu-top">
      <li><a href="dashboard_admin.html"><i class="fas fa-home"></i> Dashboard</a></li>
      <li style="margin-left: 2px;"><a href="#"><i class="fas fa-toolbox" style="margin-right: 12px;"></i> Inventory</a></li>
      <li class="active"><a href="customer.php"><i class="fas fa-users"></i> Customers</a></li>
      <li style="margin-left: 3px;"><a href="#"><i class="fas fa-file-alt" style="margin-right: 12px;"></i> Job Cards</a></li>
      <li><a href="#"><i class="fas fa-credit-card"></i> Payment</a></li>
      <li><a href="analytics.html"><i class="fas fa-chart-line"></i> Analytics</a></li>
      <li><a href="supplier.php"><i class="fas fa-boxes"></i> Suppliers</a></li>
      <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
    </ul>
    <ul class="menu-bottom">
      <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a></li>
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
  <script>
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

  
  const modal = document.getElementById("addCustomerModal");

  function openModal() {
    modal.style.display = "flex";
    modal.classList.add("show");
    modal.classList.remove("hide");
  }

  function closeModal() {
    modal.classList.add("hide");
    modal.classList.remove("show");
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }

    window.onclick = function(event) {
      if (event.target == modal) {
        closeModal();
      }
    }

    document.getElementById("customerForm").addEventListener("submit", function(event) {
      const contact = this.contact.value;
      const phoneRegex = /^\d{10,15}$/;
      if (!phoneRegex.test(contact)) {
        alert("Please enter a valid phone number (10-15 digits only).");
        event.preventDefault();
      }
    });

  function viewCustomer(data) {
    document.getElementById("viewName").textContent = data.name;
    document.getElementById("viewContact").textContent = data.contact;
    document.getElementById("viewContact").href = "tel:" + data.contact;
    document.getElementById("viewVehicle").textContent = data.vehicle;
    document.getElementById("viewPlate").textContent = data.plate_number;
    document.getElementById("viewService").textContent = data.service;
    document.getElementById("viewLastVisit").textContent = new Date(data.last_visit).toLocaleDateString();

    const modal = document.getElementById("viewCustomerModal");
    modal.style.display = "flex";
    modal.classList.add("show");
    modal.classList.remove("hide");
  }

  function closeViewModal() {
    const modal = document.getElementById("viewCustomerModal");
    modal.classList.add("hide");
    modal.classList.remove("show");
    setTimeout(() => {
      modal.style.display = "none";
    }, 300);
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      closeModal();
    }
    if (event.target == document.getElementById("viewCustomerModal")) {
      closeViewModal();
    }
  }

  let currentCustomerData = null;

function viewCustomer(data) {
  currentCustomerData = data; // store current customer data globally

  document.getElementById("viewName").textContent = data.name;
  document.getElementById("viewContact").textContent = data.contact;
  document.getElementById("viewContact").href = "tel:" + data.contact;
  document.getElementById("viewVehicle").textContent = data.vehicle;
  document.getElementById("viewPlate").textContent = data.plate_number;
  document.getElementById("viewService").textContent = data.service;
  document.getElementById("viewLastVisit").textContent = new Date(data.last_visit).toLocaleDateString();

  // Show the modal
  const modal = document.getElementById("viewCustomerModal");
  modal.style.display = "flex";
  modal.classList.add("show");
  modal.classList.remove("hide");

  // Update Edit button to pass current customer data
  document.getElementById("viewEditBtn").onclick = function () {
    editCustomer(currentCustomerData);
  };
}

    const editModal = document.getElementById("editCustomerModal");

    // Open edit modal and fill with customer data
    function editCustomer(data) { 
      document.getElementById("editCustomerId").value = data.customer_id; // to identify the record in DB
      document.getElementById("editName").value = data.name;
      document.getElementById("editContact").value = data.contact;
      document.getElementById("editVehicle").value = data.vehicle;
      document.getElementById("editPlateNumber").value = data.plate_number;
      document.getElementById("editService").value = data.service;

      // Format date to yyyy-mm-dd for date input
      const lastVisitDate = new Date(data.last_visit);
      const yyyy = lastVisitDate.getFullYear();
      const mm = String(lastVisitDate.getMonth() + 1).padStart(2, '0');
      const dd = String(lastVisitDate.getDate()).padStart(2, '0');
      document.getElementById("editLastVisit").value = `${yyyy}-${mm}-${dd}`;

      editModal.style.display = "flex";
      editModal.classList.add("show");
      editModal.classList.remove("hide");
    }

    // Close edit modal
    function closeEditModal() {
      editModal.classList.add("hide");
      editModal.classList.remove("show");
      setTimeout(() => {
        editModal.style.display = "none";
      }, 300);
    }

    // Close modal when clicking outside of content area
    window.addEventListener('click', function(event) {
      if (event.target === editModal) {
        closeEditModal();
      }
    });

    // Optional: validate phone input on edit form submission
    document.getElementById("editCustomerForm").addEventListener("submit", function(event) {
      const contact = this.contact.value;
      const phoneRegex = /^\d{10,15}$/;
      if (!phoneRegex.test(contact)) {
        alert("Please enter a valid phone number (10-15 digits only).");
        event.preventDefault();
      }
    });

    // Delete customer details
    function confirmDelete(customerId) {
    document.getElementById('deleteCustomerId').value = customerId;
    const modal = document.getElementById('deleteConfirmModal');
    modal.classList.add('show');
    }

    function closeDeleteModal() {
    const modal = document.getElementById('deleteConfirmModal');
    modal.classList.remove('show');
    }

    // Close modal when clicking outside of content area
    document.getElementById('deleteConfirmModal').addEventListener('click', function(event) {
    // Kalau klik area overlay , bukan dalam content
    if (event.target === this) {
        closeDeleteModal();
    }
    });
  </script>
</body>
</html>

