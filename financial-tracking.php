<?php include ('layout/admin-header.php'); ?>
<?php
include("dbconnection.php");

// Fetch distinct months
$month_result = $conn->query("SELECT DISTINCT DATE_FORMAT(transaction_date, '%Y-%m') as month FROM transactions ORDER BY month DESC");
$months = [];
$latestMonth = "";
if ($month_result && $month_result->num_rows > 0) {
    while ($row = $month_result->fetch_assoc()) {
        $months[] = $row['month'];
    }
    $latestMonth = $months[0];
}

$selectedMonth = $_GET['month'] ?? $latestMonth;

$startDate = $selectedMonth . '-01';
$endDate = date("Y-m-t", strtotime($startDate));
$query = "SELECT * FROM transactions WHERE transaction_date BETWEEN '$startDate' AND '$endDate' ORDER BY transaction_date DESC";
$transactions = $conn->query($query);

// Calculate totals
$income = 0;
$expense = 0;
$balance = 100000;
if ($transactions && $transactions->num_rows > 0) {
    while ($row = $transactions->fetch_assoc()) {
        if ($row['type'] === 'income') $income += $row['amount'];
        if ($row['type'] === 'expense') $expense += $row['amount'];
    }
}
$netProfit = $income - $expense;
$totalBalance = $balance + $netProfit;
$transactions->data_seek(0);
?>

<div id="layoutSidenav_content">
<main>
<div class="container-fluid px-4">
    <h1 class="mt-4">Financial Tracking</h1>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <form method="get">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label for="monthFilter" class="form-label">Select Month</label>
                                <select class="form-select" name="month" id="monthFilter">
                                    <?php foreach ($months as $month): ?>
                                        <option value="<?= $month ?>" <?= $month === $selectedMonth ? 'selected' : '' ?>>
                                            <?= date("F Y", strtotime($month . "-01")) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-sync me-1"></i>Update Report
                                </button>
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success" onclick="exportReport()" type="button">
                                    <i class="fas fa-download me-1"></i>Export PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Net Profit -->
        <div class="col-lg-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Net Profit (<?= date("F Y", strtotime($selectedMonth)) ?>)</h6>
                        <h3 class="mb-0">RM <?= number_format($netProfit, 2) ?></h3>
                    </div>
                    <i class="fas fa-chart-line fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Totals -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-success text-white mb-3">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6>Total Income</h6>
                        <h4 class="mb-0">RM <?= number_format($income, 2) ?></h4>
                    </div>
                    <i class="fas fa-arrow-up fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white mb-3">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6>Total Expenses</h6>
                        <h4 class="mb-0">RM <?= number_format($expense, 2) ?></h4>
                    </div>
                    <i class="fas fa-arrow-down fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white mb-3">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h6>Total Balance</h6>
                        <h4 class="mb-0">RM <?= number_format($totalBalance, 2) ?></h4>
                    </div>
                    <i class="fas fa-wallet fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial History -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="fas fa-history me-1"></i> Financial History - <?= date("F Y", strtotime($selectedMonth)) ?></span>
            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                <i class="fas fa-plus me-1"></i> Add Expense
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="financialTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Type</th>
                            <th>Money In (RM)</th>
                            <th>Money Out (RM)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $transactions->fetch_assoc()): ?>
                            <tr>
                                <td><?= date("M d, Y", strtotime($row['transaction_date'])) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td><span class="badge bg-<?= $row['type'] === 'income' ? 'success' : 'danger' ?>">
                                    <?= ucfirst($row['type']) ?></span></td>
                                <td class="text-success fw-bold">
                                    <?= $row['type'] === 'income' ? number_format($row['amount'], 2) : '-' ?>
                                </td>
                                <td class="text-danger fw-bold">
                                    <?= $row['type'] === 'expense' ? number_format($row['amount'], 2) : '-' ?>
                                </td>
                                <td><span class="badge bg-info"><?= $row['status'] ?></span></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
</main>
</div>

<!-- Add Expense Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="add-expense.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addExpenseModalLabel">Add Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" required>
          </div>
          <div class="mb-3">
            <label for="amount" class="form-label">Amount (RM)</label>
            <input type="number" class="form-control" name="amount" step="0.01" required>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" required>
              <option value="Paid">Paid</option>
              <option value="Pending">Pending</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Expense</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script>
function exportReport() {
    const month = document.getElementById('monthFilter').value;
    alert(`Financial report for ${month} exported successfully!`);
}

document.addEventListener('DOMContentLoaded', function () {
    $('#financialTable').DataTable({
        "order": [[0, "desc"]]
    });
});
</script>

<!-- Bootstrap & DataTables Scripts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<?php include ('layout/footer.php'); ?>
