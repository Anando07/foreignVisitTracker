
<?php
require_once __DIR__."/../controllers/UserController.php";
?>

<div class="fvt-card" id="usersSection">
      <div class="fvt-page-header">
        Users
    </div>
    <!-- <h2 class="page-title">Users</h2> -->
    <!-- Search and Print -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
       <input type="text" class="table-search fvt-input" placeholder="Search users..." data-table="userTable" style="width:48%;">
       <button class="btn btn-primary fvt-action-btn" onclick="printTable('userTable')">
            🖨️ Print Users
       </button>
    </div>

    <table class="fvt-table" id="userTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Designation</th>
                <th>Username</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allUsers as $i => $user): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($user['Name']) ?></td>
                <td><?= htmlspecialchars($user['Designation']) ?></td>
                <td><?= htmlspecialchars($user['UserName']) ?></td>
                <td><?= htmlspecialchars($user['Email']) ?></td>
                <td><?= htmlspecialchars($user['Contact']) ?></td>
                <td>
                    <?= $user['Status'] == 1 
                        ? "<span class='badge badge-success'>Active</span>" 
                        : "<span class='badge badge-danger'>Inactive</span>" ?>
                </td>
                <td>
                    <?php if ($user['Role_ID'] != 1): ?>
                        <button title="Edit" class="btn btn-sm btn-warning" onclick="window.location.href='base.php?page=AddEditUser&id=<?= $user['ID'] ?>'">✏️</button>
                        <button title="Change Password" class="btn btn-sm btn-info" onclick="window.location.href='base.php?page=change_password&id=<?= $user['ID'] ?>'">🔑</button>
                        <button title="Delete" class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $user['ID'] ?>)">🗑️</button>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination container for global JS -->
    <div class="table-pagination" data-table="userTable" style="margin-top:10px; text-align:center;"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Delete confirmation (global)
function confirmDelete(userId) {
    fetch(`user/delete_user.php?id=${userId}&action=check`)
        .then(res => res.json())
        .then(data => {
            const fullName = data.name || "Unknown";

            if (!data.canDelete) {
                Swal.fire({ icon: 'error', title: 'Cannot Delete!', text: data.message });
                return;
            }

            Swal.fire({
                title: 'Are you sure?',
                text: `Do you want to delete user ${fullName}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete!',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`user/delete_user.php?id=${userId}&action=delete`)
                        .then(res => res.json())
                        .then(delData => {
                            if (delData.canDelete) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: delData.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => location.reload());
                            } else {
                                Swal.fire({ icon: 'error', title: 'Error!', text: delData.message });
                            }
                        })
                        .catch(err => console.error('Delete fetch error:', err));
                }
            });
        })
        .catch(err => console.error('Check fetch error:', err));
}
</script>
<script>
function printTable() {

    const users = <?php echo json_encode($allUsers); ?>;

    const logoUrl = "http://localhost/foreignVisitTracker/assets/images/Logo.png";

    const header = `
        <div style="text-align:center; margin-bottom:20px;">
            <img id="printLogo" src="${logoUrl}" style="height:80px; margin-bottom:10px;">
            <h2 style="margin:0;">Government's People Republic of Bangladesh</h2>
            <h2 style="margin:0;">Internal Resources Division</h2>
            <h3 style="margin:0;">Ministry of Finance</h3>
            <h2 style="margin:0;">Bangladesh Secretariat, Dhaka-1000</h2>
            <h4 style="margin:10px 0;">All Users List of FVT</h4>
        </div>
    `;

    let html = `
        <table style="width:100%; border-collapse:collapse;" border="1" cellpadding="5">
            <thead>
                <tr style="background:#f2f2f2;">
                    <th>#</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    `;

    users.forEach((user, i) => {
        html += `
            <tr>
                <td>${i + 1}</td>
                <td>${user.Name}</td>
                <td>${user.Designation}</td>
                <td>${user.UserName}</td>
                <td>${user.Email}</td>
                <td>${user.Contact}</td>
                <td>${user.Status == 1 ? 'Active' : 'Inactive'}</td>
            </tr>
        `;
    });

    html += `</tbody></table>`;

    const newWin = window.open("", "_blank");

    newWin.document.open();
    newWin.document.write(`
        <html>
        <head>
            <title>All Users List</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table, th, td {
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 5px;
                }
                th { background-color: #f2f2f2; }
                img { display: block; margin: auto; }
            </style>
        </head>
        <body>
            ${header}
            ${html}
        </body>
        </html>
    `);
    newWin.document.close();

    /*  THIS IS THE MAGIC */
    newWin.onload = function () {
        newWin.focus();
        newWin.print();
        newWin.close();
    };
}
</script>

