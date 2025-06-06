// MODAL HANDLING
const modal = document.getElementById("addInventoryModal");
const editModal = document.getElementById("editInventoryModal");
const deleteModal = document.getElementById("deleteConfirmModal");
const viewModal = document.getElementById("viewInventoryModal");

function openModal() {
  showModal(modal);
}

function closeModal() {
  hideModal(modal);
}

function closeEditModal() {
  hideModal(editModal);
}

function closeViewModal() {
  hideModal(viewModal);
}

function closeDeleteModal() {
const modalElement = document.getElementById("deleteConfirmModal");
  modalElement.classList.add("hide");
  modalElement.classList.remove("show");
  setTimeout(() => {
    modalElement.style.display = "none";
  }, 300);
}

function showModal(modalElement) {
  modalElement.style.display = "flex";
  modalElement.classList.add("show");
  modalElement.classList.remove("hide");
}

function hideModal(modalElement) {
  modalElement.classList.add("hide");
  modalElement.classList.remove("show");
  setTimeout(() => {
    modalElement.style.display = "none";
  }, 300);
}

// CLOSE MODALS WHEN CLICKING OUTSIDE
window.onclick = function(event) {
  if (event.target === modal) closeModal();
  if (event.target === editModal) closeEditModal();
  if (event.target === viewModal) closeViewModal();
  if (event.target === deleteModal) closeDeleteModal();
};

// DELETE INVENTORY
function confirmDelete(inventory_Id) {
  document.getElementById('deleteInventoryId').value = inventory_Id;
  showModal(deleteModal);
}

// GLOBAL STORAGE FOR CURRENT DATA
let currentInventoryData = null;

// VIEW INVENTORY
function viewInventory(data) {
  currentInventoryData = data;
  document.getElementById("viewInventoryName").textContent = data.inventory_name;
  document.getElementById("viewCategory").textContent = data.category;
  document.getElementById("viewSKU").textContent = data.sku;
  document.getElementById("viewPrice").textContent = "RM " + parseFloat(data.price).toFixed(2);
  document.getElementById("viewStock").textContent = data.stock;
  document.getElementById("viewStatus").textContent = data.status;
  showModal(viewModal);
}

// EDIT INVENTORY
function editInventory(data) {
  document.getElementById("editInventoryId").value = data.inventory_id;
  document.getElementById("editInventoryName").value = data.inventory_name;
  document.getElementById("editCategory").value = data.category;
  document.getElementById("editSKU").value = data.sku;
  document.getElementById("editPrice").value = data.price;
  document.getElementById("editStock").value = data.stock;
  document.getElementById("editStatus").value = data.status;
  showModal(editModal);
}

// LINK VIEW MODAL EDIT BUTTON TO OPEN EDIT MODAL
document.getElementById("viewEditBtn").addEventListener("click", function () {
  if (currentInventoryData) {
    closeViewModal();
    editInventory(currentInventoryData);
  }
});

// UPDATE TABLE ROW AFTER EDIT (call this after successful update from server)
function updateTableRow(item) {
  const row = document.querySelector(`tr[data-id="${item.inventory_id}"]`);
  if (!row) return;

  row.querySelector('.col-name').textContent = item.inventory_name;
  row.querySelector('.col-category').textContent = item.category;
  row.querySelector('.col-sku').textContent = item.sku;
  row.querySelector('.col-price').textContent = "RM " + parseFloat(item.price).toFixed(2);
  row.querySelector('.col-stock').textContent = item.stock;
  row.querySelector('.col-status').textContent = item.status;
}

// REMOVE TABLE ROW AFTER DELETE (call this after successful delete from server)
function removeTableRow(id) {
  const row = document.querySelector(`tr[data-id="${id}"]`);
  if (row) row.remove();
}

// (Optional) FORM VALIDATION EXAMPLE
// document.getElementById("inventoryForm").addEventListener("submit", function(event) {
//   const sku = this.sku.value;
//   const skuRegex = /^\d{3,6}$/;
//   if (!skuRegex.test(sku)) {
//     alert("Please enter a valid SKU number (3-6 digits only).");
//     event.preventDefault();
//   }
// });
