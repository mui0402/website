<?php include ('layout/admin-header.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Item Stock Management</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Item Stock</li>
                        </ol>
                        
                        <div class="row">   
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-boxes me-1"></i>
                                            Repair Parts Inventory
                                        </div>
                                        <div>
                                            <div class="btn-group me-2" role="group">
                                                <input type="radio" class="btn-check" name="categoryFilter" id="all" autocomplete="off" checked>
                                                <label class="btn btn-outline-primary" for="all">All Items</label>

                                                <input type="radio" class="btn-check" name="categoryFilter" id="screens" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="screens">Screens</label>

                                                <input type="radio" class="btn-check" name="categoryFilter" id="batteries" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="batteries">Batteries</label>

                                                <input type="radio" class="btn-check" name="categoryFilter" id="charging" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="charging">Charging</label>

                                                <input type="radio" class="btn-check" name="categoryFilter" id="audio" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="audio">Audio</label>
                                            </div>
                                            <button class="btn btn-success" id="manageItemsBtn">
                                                <i class="fas fa-edit me-1"></i>Manage Items
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Item ID</th>
                                                        <th>Item Name</th>
                                                        <th>Category</th>
                                                        <th>Description</th>
                                                        <th>Quantity</th>
                                                        <th>Price (RM)</th>
                                                        <th>Status</th>
                                                        <th class="edit-mode d-none">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-category="screens">
                                                        <td>SCR001</td>
                                                        <td>iPhone 13 Screen</td>
                                                        <td><span class="badge bg-primary">Screens</span></td>
                                                        <td>Original quality OLED display</td>
                                                        <td>
                                                            <span class="view-mode">3</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="3" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">450.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="450.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-warning">Low Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="screens">
                                                        <td>SCR002</td>
                                                        <td>Samsung Galaxy S21 Screen</td>
                                                        <td><span class="badge bg-primary">Screens</span></td>
                                                        <td>AMOLED display with touch digitizer</td>
                                                        <td>
                                                            <span class="view-mode">7</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="7" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">380.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="380.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-success">In Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="batteries">
                                                        <td>BAT001</td>
                                                        <td>iPhone 13 Battery</td>
                                                        <td><span class="badge bg-success">Batteries</span></td>
                                                        <td>3240mAh Li-ion battery</td>
                                                        <td>
                                                            <span class="view-mode">12</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="12" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">180.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="180.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-success">In Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="batteries">
                                                        <td>BAT002</td>
                                                        <td>Samsung Galaxy Battery</td>
                                                        <td><span class="badge bg-success">Batteries</span></td>
                                                        <td>4000mAh Li-ion battery</td>
                                                        <td>
                                                            <span class="view-mode">5</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="5" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">150.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="150.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-warning">Low Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="charging">
                                                        <td>CHG001</td>
                                                        <td>iPhone Lightning Port</td>
                                                        <td><span class="badge bg-info">Charging</span></td>
                                                        <td>Lightning charging port assembly</td>
                                                        <td>
                                                            <span class="view-mode">8</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="8" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">120.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="120.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-success">In Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="charging">
                                                        <td>CHG002</td>
                                                        <td>USB-C Charging Port</td>
                                                        <td><span class="badge bg-info">Charging</span></td>
                                                        <td>USB-C port for Android devices</td>
                                                        <td>
                                                            <span class="view-mode">15</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="15" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">100.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="100.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-success">In Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <tr data-category="audio">
                                                        <td>AUD001</td>
                                                        <td>iPhone Speaker</td>
                                                        <td><span class="badge bg-warning">Audio</span></td>
                                                        <td>Bottom speaker assembly</td>
                                                        <td>
                                                            <span class="view-mode">10</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="10" style="width: 80px;">
                                                        </td>
                                                        <td>
                                                            <span class="view-mode">80.00</span>
                                                            <input type="number" class="form-control form-control-sm edit-mode d-none" value="80.00" step="0.01" style="width: 100px;">
                                                        </td>
                                                        <td><span class="badge bg-success">In Stock</span></td>
                                                        <td class="edit-mode d-none">
                                                            <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Add New Item Form (Hidden by default) -->
                                        <div id="addItemForm" class="mt-4 d-none">
                                            <hr>
                                            <h6>Add New Item</h6>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Item ID" id="newItemId">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Item Name" id="newItemName">
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-select form-select-sm" id="newItemCategory">
                                                        <option value="screens">Screens</option>
                                                        <option value="batteries">Batteries</option>
                                                        <option value="charging">Charging</option>
                                                        <option value="audio">Audio</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control form-control-sm" placeholder="Quantity" id="newItemQty">
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control form-control-sm" placeholder="Price" step="0.01" id="newItemPrice">
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-sm btn-success" onclick="addNewItem()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Save/Cancel buttons (Hidden by default) -->
                                        <div id="editControls" class="mt-3 d-none">
                                            <button class="btn btn-success me-2" onclick="saveChanges()">
                                                <i class="fas fa-save me-1"></i>Save Changes
                                            </button>
                                            <button class="btn btn-secondary" onclick="cancelEdit()">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>

            <script>
                let isEditMode = false;

                // Category filter functionality
                document.querySelectorAll('input[name="categoryFilter"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        const category = this.id;
                        const rows = document.querySelectorAll('tbody tr');
                        
                        rows.forEach(row => {
                            if (category === 'all' || row.dataset.category === category) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        });
                    });
                });

                // Manage Items functionality
                document.getElementById('manageItemsBtn').addEventListener('click', function() {
                    if (!isEditMode) {
                        enterEditMode();
                    } else {
                        exitEditMode();
                    }
                });

                function enterEditMode() {
                    isEditMode = true;
                    document.getElementById('manageItemsBtn').innerHTML = '<i class="fas fa-eye me-1"></i>View Mode';
                    document.getElementById('manageItemsBtn').className = 'btn btn-secondary';
                    
                    // Show edit elements
                    document.querySelectorAll('.edit-mode').forEach(el => el.classList.remove('d-none'));
                    document.querySelectorAll('.view-mode').forEach(el => el.classList.add('d-none'));
                    document.getElementById('addItemForm').classList.remove('d-none');
                    document.getElementById('editControls').classList.remove('d-none');
                }

                function exitEditMode() {
                    isEditMode = false;
                    document.getElementById('manageItemsBtn').innerHTML = '<i class="fas fa-edit me-1"></i>Manage Items';
                    document.getElementById('manageItemsBtn').className = 'btn btn-success';
                    
                    // Hide edit elements
                    document.querySelectorAll('.edit-mode').forEach(el => el.classList.add('d-none'));
                    document.querySelectorAll('.view-mode').forEach(el => el.classList.remove('d-none'));
                    document.getElementById('addItemForm').classList.add('d-none');
                    document.getElementById('editControls').classList.add('d-none');
                }

                function removeItem(button) {
                    if (confirm('Are you sure you want to remove this item?')) {
                        button.closest('tr').remove();
                    }
                }

                function addNewItem() {
                    const id = document.getElementById('newItemId').value;
                    const name = document.getElementById('newItemName').value;
                    const category = document.getElementById('newItemCategory').value;
                    const qty = document.getElementById('newItemQty').value;
                    const price = document.getElementById('newItemPrice').value;

                    if (!id || !name || !qty || !price) {
                        alert('Please fill in all fields');
                        return;
                    }

                    const categoryBadges = {
                        'screens': 'bg-primary',
                        'batteries': 'bg-success',
                        'charging': 'bg-info',
                        'audio': 'bg-warning'
                    };

                    const statusBadge = qty > 10 ? 'bg-success">In Stock' : 'bg-warning">Low Stock';

                    const newRow = `
                        <tr data-category="${category}">
                            <td>${id}</td>
                            <td>${name}</td>
                            <td><span class="badge ${categoryBadges[category]}">${category.charAt(0).toUpperCase() + category.slice(1)}</span></td>
                            <td>New item</td>
                            <td>
                                <span class="view-mode">${qty}</span>
                                <input type="number" class="form-control form-control-sm edit-mode" value="${qty}" style="width: 80px;">
                            </td>
                            <td>
                                <span class="view-mode">${price}</span>
                                <input type="number" class="form-control form-control-sm edit-mode" value="${price}" step="0.01" style="width: 100px;">
                            </td>
                            <td><span class="badge ${statusBadge}</span></td>
                            <td class="edit-mode">
                                <button class="btn btn-sm btn-danger" onclick="removeItem(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    document.querySelector('tbody').insertAdjacentHTML('beforeend', newRow);

                    // Clear form
                    document.getElementById('newItemId').value = '';
                    document.getElementById('newItemName').value = '';
                    document.getElementById('newItemQty').value = '';
                    document.getElementById('newItemPrice').value = '';
                }

                function saveChanges() {
                    // Update view mode values with edit mode values
                    document.querySelectorAll('tbody tr').forEach(row => {
                        const qtyInput = row.querySelector('input[type="number"]:first-of-type');
                        const priceInput = row.querySelector('input[type="number"]:last-of-type');
                        const qtySpan = row.querySelector('.view-mode');
                        const priceSpan = row.querySelectorAll('.view-mode')[1];

                        if (qtyInput && qtySpan) {
                            qtySpan.textContent = qtyInput.value;
                        }
                        if (priceInput && priceSpan) {
                            priceSpan.textContent = priceInput.value;
                        }
                    });

                    alert('Changes saved successfully!');
                    exitEditMode();
                }

                function cancelEdit() {
                    if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
                        location.reload();
                    }
                }
            </script>

<?php include ('layout/footer.php'); ?>
