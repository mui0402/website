<?php include ('layout/admin-header.php'); 
// ===== DATABASE CONNECTION =====
$host = 'localhost';
$dbname = 'website1';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ===== HANDLE FORM SUBMISSION =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $prefix = $_POST['item_category'];
            $nextId = getNextItemId($pdo, $prefix);
            $itemId = $prefix . str_pad($nextId, 3, '0', STR_PAD_LEFT);

            $stmt = $pdo->prepare("INSERT INTO ITEM (ITEM_ID, ITEM_NAME, ITEM_DESCRIPTION, ITEM_QUANTITY, ITEM_PRICE) 
                                  VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $itemId,
                $_POST['item_name'],
                $_POST['item_desc'],
                $_POST['item_qty'],
                $_POST['item_price']
            ]);
            break;

        case 'update':
            if (empty($_POST['items']) || !is_array($_POST['items'])) {
                header("Location: inventory.php"); // Treat as cancel
                exit();
            }
            foreach ($_POST['items'] as $item) {
                if (
                    isset($item['id'], $item['quantity'], $item['price']) &&
                    is_numeric($item['quantity']) &&
                    is_numeric($item['price'])
                ) {
                    $stmt = $pdo->prepare("UPDATE ITEM SET ITEM_QUANTITY = ?, ITEM_PRICE = ? WHERE ITEM_ID = ?");
                    $stmt->execute([$item['quantity'], $item['price'], $item['id']]);
                }
            }
            break;

        case 'delete':
            if (!empty($_POST['item_id'])) {
                $stmt = $pdo->prepare("DELETE FROM ITEM WHERE ITEM_ID = ?");
                $stmt->execute([$_POST['item_id']]);
            }
            break;
    }
    header("Location: inventory.php");
    exit();
}

// ===== HELPER FUNCTIONS =====
function getNextItemId($pdo, $prefix) {
    $stmt = $pdo->prepare("SELECT MAX(CAST(SUBSTRING(ITEM_ID, 4) AS UNSIGNED)) FROM ITEM WHERE ITEM_ID LIKE ?");
    $stmt->execute([$prefix . '%']);
    $maxNum = $stmt->fetchColumn();
    return $maxNum ? $maxNum + 1 : 1;
}

function getCategory($itemId) {
    $prefix = substr($itemId, 0, 3);
    $categories = [
        'SCR' => ['name' => 'Screen', 'class' => 'bg-primary'],
        'BAT' => ['name' => 'Battery', 'class' => 'bg-success'],
        'CHG' => ['name' => 'Charging', 'class' => 'bg-info'],
        'AUD' => ['name' => 'Audio', 'class' => 'bg-warning']
    ];
    return $categories[$prefix] ?? ['name' => 'Other', 'class' => 'bg-secondary'];
}

function getStatusBadge($qty) {
    if ($qty == 0) return '<span class="badge bg-danger">Out of Stock</span>';
    elseif ($qty < 5) return '<span class="badge bg-warning">Low Stock</span>';
    else return '<span class="badge bg-success">In Stock</span>';
}

// ===== FETCH ALL ITEMS =====
$stmt = $pdo->query("SELECT * FROM ITEM ORDER BY ITEM_ID");
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Item Stock Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
<div id="layoutSidenav_content">
    <main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Item Stock Management</h1>
        
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
                        <!-- Add New Item Form (Hidden by default) -->
                        <div id="addItemForm" class="mb-4 d-none">
                            <form method="POST" class="row g-2 align-items-end">
                                <input type="hidden" name="action" value="add" />
                                <div class="col-md-2">
                                    <select class="form-select form-select-sm" name="item_category" required>
                                        <option value="">Select Category</option>
                                        <option value="SCR">Screen</option>
                                        <option value="BAT">Battery</option>
                                        <option value="CHG">Charging</option>
                                        <option value="AUD">Audio</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="item_name" class="form-control form-control-sm" placeholder="Item Name" required />
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="item_desc" class="form-control form-control-sm" placeholder="Description" required />
                                </div>
                                <div class="col-md-1">
                                    <input type="number" name="item_qty" class="form-control form-control-sm" placeholder="Qty" min="0" required />
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="item_price" step="0.01" class="form-control form-control-sm" placeholder="Price" min="0" required />
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus me-1"></i>Add Item
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Delete Form (hidden) -->
                        <form id="deleteForm" method="POST" class="d-none">
                            <input type="hidden" name="action" value="delete" />
                            <input type="hidden" name="item_id" id="deleteItemId" />
                        </form>

                        <div class="table-responsive">
                            <form method="POST" id="updateForm">
                                <input type="hidden" name="action" value="update" />
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price (RM)</th>
                                            <th>Status</th>
                                            <th class="edit-mode d-none">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item):
                                            $cat = getCategory($item['ITEM_ID']);
                                            $status = getStatusBadge($item['ITEM_QUANTITY']);
                                        ?>
                                        <tr data-category="<?= htmlspecialchars(substr($item['ITEM_ID'], 0, 3)) ?>">
                                            <td><?= htmlspecialchars($item['ITEM_ID']) ?></td>
                                            <td><span class="badge <?= $cat['class'] ?>"><?= $cat['name'] ?></span></td>
                                            <td><?= htmlspecialchars($item['ITEM_NAME']) ?></td>
                                            <td><?= htmlspecialchars($item['ITEM_DESCRIPTION']) ?></td>
                                            <td>
                                                <span class="view-mode"><?= (int)$item['ITEM_QUANTITY'] ?></span>
                                                <input type="number" 
                                                       min="0" 
                                                       name="items[<?= htmlspecialchars($item['ITEM_ID']) ?>][quantity]" 
                                                       value="<?= (int)$item['ITEM_QUANTITY'] ?>" 
                                                       class="form-control form-control-sm edit-mode d-none" 
                                                       required />
                                            </td>
                                            <td>
                                                <span class="view-mode"><?= number_format($item['ITEM_PRICE'], 2) ?></span>
                                                <input type="number" 
                                                       min="0" 
                                                       step="0.01" 
                                                       name="items[<?= htmlspecialchars($item['ITEM_ID']) ?>][price]" 
                                                       value="<?= number_format($item['ITEM_PRICE'], 2, '.', '') ?>" 
                                                       class="form-control form-control-sm edit-mode d-none" 
                                                       required />
                                                <input type="hidden" name="items[<?= htmlspecialchars($item['ITEM_ID']) ?>][id]" value="<?= htmlspecialchars($item['ITEM_ID']) ?>" />
                                            </td>
                                            <td><?= $status ?></td>
                                            <td class="edit-mode d-none">
                                                <button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('<?= htmlspecialchars($item['ITEM_ID']) ?>')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php if (empty($items)): ?>
                                        <tr><td colspan="8" class="text-center">No items found.</td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <!-- Save/Cancel buttons (Hidden by default) -->
                        <div id="editControls" class="mt-3 d-none">
                            <button type="submit" form="updateForm" class="btn btn-success me-2">
                                <i class="fas fa-save me-1"></i>Save Changes
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
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
    // Toggle Manage Items mode
    document.getElementById('manageItemsBtn').addEventListener('click', function () {
        const editModeEls = document.querySelectorAll('.edit-mode');
        const viewModeEls = document.querySelectorAll('.view-mode');
        const editControls = document.getElementById('editControls');
        const addItemForm = document.getElementById('addItemForm');

        editModeEls.forEach(el => el.classList.toggle('d-none'));
        viewModeEls.forEach(el => el.classList.toggle('d-none'));
        editControls.classList.toggle('d-none');
        addItemForm.classList.toggle('d-none');
    });

    // Cancel Edit
    function cancelEdit() {
        if (confirm("Are you sure you want to cancel? Unsaved changes will be lost.")) {
            window.location.reload();
        }
    }

    // Delete Item
    function deleteItem(itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            document.getElementById('deleteItemId').value = itemId;
            document.getElementById('deleteForm').submit();
        }
    }

    // Filter Items by Category
    const categoryRadios = document.getElementsByName('categoryFilter');
    categoryRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const selected = this.id;
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const cat = row.getAttribute('data-category');
                if (selected === 'all') {
                    row.style.display = '';
                } else {
                    const map = {
                        'screens': 'SCR',
                        'batteries': 'BAT',
                        'charging': 'CHG',
                        'audio': 'AUD'
                    };
                    row.style.display = cat === map[selected] ? '' : 'none';
                }
            });
        });
    });
</script>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!-- Scripts -->
<script>
    let isEditMode = false;

    document.getElementById('manageItemsBtn').addEventListener('click', () => {
        isEditMode ? exitEditMode() : enterEditMode();
    });

    document.getElementById('categoryFilter').addEventListener('change', function () {
        const category = this.value;
        document.querySelectorAll('tbody tr').forEach(row => {
            row.style.display = category === 'all' || row.dataset.category === category ? '' : 'none';
        });
    });

    function enterEditMode() {
        isEditMode = true;
        document.getElementById('manageItemsBtn').innerHTML = '<i class="fas fa-eye me-1"></i>View Mode';
        document.getElementById('manageItemsBtn').className = 'btn btn-secondary btn-sm';
        document.querySelectorAll('.edit-mode').forEach(el => el.classList.remove('d-none'));
        document.querySelectorAll('.view-mode').forEach(el => el.classList.add('d-none'));
        document.getElementById('addItemForm').classList.remove('d-none');
        document.getElementById('editControls').classList.remove('d-none');
    }

    function exitEditMode() {
        isEditMode = false;
        document.getElementById('manageItemsBtn').innerHTML = '<i class="fas fa-edit me-1"></i>Manage Items';
        document.getElementById('manageItemsBtn').className = 'btn btn-success btn-sm';
        document.querySelectorAll('.edit-mode').forEach(el => el.classList.add('d-none'));
        document.querySelectorAll('.view-mode').forEach(el => el.classList.remove('d-none'));
        document.getElementById('addItemForm').classList.add('d-none');
        document.getElementById('editControls').classList.add('d-none');
    }

    function cancelEdit() {
        if (confirm('Are you sure you want to cancel? Unsaved changes will be lost.')) {
            location.reload();
        }
    }

    function deleteItem(id) {
        if (confirm('Delete this item?')) {
            document.getElementById('deleteItemId').value = id;
            document.getElementById('deleteForm').submit();
        }
    }
</script>
</body>
</html>
<?php include ('layout/footer.php'); ?>
