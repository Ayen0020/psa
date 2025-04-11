<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Philippine Statistics Authority</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container-fluid p-0">
    <!-- Header -->
    <div class="psa-header d-flex align-items-center border-bottom px-4 py-3">
        <img src="assets/psa.png" alt="PSA Logo" class="psa-logo mr-3">
        <div>
            <div class="psa-small">REPUBLIC OF THE PHILIPPINES</div>
            <div class="psa-main">PHILIPPINE STATISTICS AUTHORITY - QUIRINO PROVINCIAL OFFICE</div>
        </div>
    </div>

    <!-- Body -->
    <div class="d-flex" style="height: 90vh;">
        <!-- Sidebar -->
        <div class="sidebar border-right p-3">
            <h5 class="text-center border mb-3 p-1">Data Entry</h5>
            <button class="btn btn-block mb-3" onclick="location.href='ris/ris.html'">Requisition and Issuance Slip</button>
            <button class="btn btn-block mb-4" onclick="location.href='iar/iar.html'">Inspection and Acceptance Report</button>

            <h5 class="text-center border mb-3 p-1">Generate Report</h5>
            <button class="btn btn-block mb-2">Stock Card</button>
            <button class="btn btn-block mb-2">Stock Ledger Card</button>
            <button class="btn btn-block mb-2">Report of Supplies and Materials Issued</button>
            <button class="btn btn-block mb-2">Report of Supplies and Materials Issued</button>
            <button class="btn btn-block mb-4">Report on the Physical Count of Inventories</button>

            <h5 class="text-center border mb-3 p-1">Utilities</h5>
            <button class="btn btn-block mb-4">Manage Employee List</button>

            <!-- Logout -->
            <form id="logoutForm" method="post" class="d-flex justify-content-center mt-5">
                <input type="hidden" name="logout" value="1">
                <button type="button" class="btn logout-btn rounded-pill px-4">LOGOUT</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4 main-content">
            <img src="assets/tr.png" alt="Main Logo" class="main-logo">
        </div>
    </div>
</div>

<!-- Floating Help Icon -->
<button id="helpBtn" class="btn btn-primary rounded-circle" title="Need help?">
    <i class="bi bi-question-lg"></i>
</button>

<!-- SweetAlert Logic -->
<script>
    document.querySelector('.logout-btn').addEventListener('click', () => {
        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, logout',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });

    document.getElementById('helpBtn').addEventListener('click', () => {
        Swal.fire({
            title: 'Need Help?',
            html: `<p>Navigate the system using the left sidebar.<br>For issues or feedback, contact <b>admin@psa.gov.ph</b>.</p>`,
            icon: 'info',
            confirmButtonText: 'Got it!'
        });
    });
</script>

<?php
if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Logged out!',
            text: 'You have been logged out successfully.',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = 'index.html';
        });
    </script>";
    exit();
}
?>

</body>

<style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }

        .psa-header {
            background-color:rgb(21, 83, 150);
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-family: 'Times New Roman', Times, serif;
            }

        .psa-small, .psa-main {
            font-family: 'Times New Roman', Times, serif;
        }

        .psa-logo {
            height: 60px;
            width: auto;
        }

        .psa-small {
            font-size: 1rem;
            font-weight: 500;
            text-transform: uppercase;
            color: #dbeafe;
        }

        .psa-main {
            font-size: 2.1rem;
            font-weight: 700;
            color: #fff;
        }

        .sidebar {
            width: 280px;
            background-color: #dee2e6;
            height: 100%;
            padding: 20px;
            box-shadow: inset -1px 0 0 rgba(0,0,0,0.1);
        }

        .sidebar h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #343a40;
        }

        .sidebar .btn {
            background-color: transparent;
            color: #343a40;
            border: 1px solid #adb5bd;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .btn:hover {
            background-color:rgb(0, 109, 218);
            color: white;
        }

        .logout-btn {
            background-color: transparent;
            border: 1px solid #ff4d4f;
            color: #ff4d4f;
            transition: all 0.2s ease-in-out;
        }

        .logout-btn:hover {
            background-color: #ff4d4f;
            color: white;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
            border-radius: 8px;
            margin: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .main-logo {
            max-width: 800px;
            width: 100%;
            opacity: 0.6;
            filter: grayscale(30%);
        }

        /* Floating Help Button */
        #helpBtn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            z-index: 1000;
        }
    </style>
</html>
