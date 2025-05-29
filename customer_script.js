
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

    


