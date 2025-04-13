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
    <title>PSA Quirino</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>   
<body>
    <div class="sidebar">
        <div class="logo-details">
            <div class="logo_name">PSA Quirino</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav-list">

        <li>
           <a href="#">
            <i class='bx bx-grid-alt'></i>
            <span class="links_name">Dashboard</span>
       </a>
        <span class="tooltip">Dashboard</span>
    </li>

       <li>
            <a href="employees.php">
                <i class='bx bx-user'></i>
                <span class="links_name">Employee Lists</span>
            </a>
            <span class="tooltip">Employee Lists</span>
        </li>
             <li>
                <a href="#">
                    <i class='bx bx-edit'></i>
                    <span class="links_name">Data Entry</span>
                </a>
                <span class="tooltip">Data Entry</span>
            </li>

            <li>
                <a href="ris/ris.php">
                    <i class='bx bx-file'></i>
                    <span class="links_name">Requisition & Issuance</span>
                </a>
            </li>
            <li>

            <a href="#">
                    <i class='bx bx-printer'></i>
                    <span class="links_name">Generate Reports</span>
                </a>
                <span class="tooltip">Generate Reports</span>
            </li>

            <li>
                <a href="iar/iar.php">
                    <i class='bx bx-check-square'></i>
                    <span class="links_name">Inspection Report</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Stock Reports</span>
                </a>
            </li>

            
                <li>
                    <a href="#">
                        <i class='bx bx-spreadsheet'></i>
                        <span class="links_name">Stock Card</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-book'></i>
                        <span class="links_name">Stock Ledger Card</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-clipboard'></i>
                        <span class="links_name">Supplies/Materials Issued</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-calendar-check'></i>
                        <span class="links_name">Physical Count Report</span>
                    </a>
                </li>
         

      

        <li class="logout-item">
    <a href="#" class="logout-link">
        <i class='bx bx-log-out'></i>
        <span class="links_name">Log Out</span>
    </a>
    <span class="tooltip">Log Out</span>
    <form id="logoutForm" method="post" style="display: none;">
        <input type="hidden" name="logout" value="1">
    </form>
</li>
    </ul>
</div>
    

    <header class="header">
        <div class="header-logo">
        <img src="/psa/assets/psa.png" alt="PSA Logo">

        </div>
        <div class="header-titles">
            <div class="header-title">PHILIPPINE STATISTICS AUTHORITY</div>
            <div class="header-subtitle">QUIRINO PROVINCIAL OFFICE</div>
        </div>
        <div class="ml-auto text-light">
            Hello, Guest!
        </div>
    </header>
    



    <script>
        // Toggle Sidebar
        document.getElementById('btn').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('open');
        });

      // Update logout handler
document.querySelector('.logout-item a').addEventListener('click', (e) => {
    e.preventDefault();
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

    // Help Button Handler
    document.getElementById('helpBtn').addEventListener('click', () => {
        Swal.fire({
            title: 'Need Help?',
            html: `<p>Navigate the system using the left sidebar.<br>For issues or feedback, contact <b>admin@psa.gov.ph</b>.</p>`,
            icon: 'info',
            confirmButtonText: 'Got it!'
        });
    });
    </script>


<button id="helpBtn" class="btn btn-primary rounded-circle" title="Need help?">
    <i class="bi bi-question-lg"></i>
</button>
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
</html>

<style>
        /* Combined CSS Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #E4E9F7;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            display: flex;
            align-items: center;
            padding: 5px 20px;
            background-color: #4169e1;
            color: white;
            position: fixed;
            top: 0;
            left: 78px;
            width: calc(100% - 78px);
            height: 80px;
            transition: all 0.5s ease;
            z-index: 98;
        }

        .header-logo img {
            height: 60px;
            margin-right: 20px;
        }

        .header-titles {
            display: flex;
            flex-direction: column;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
        }

        .header-subtitle {
            font-size: 0.9rem;
            margin: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 78px;
            background: #191970;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
        }

        .sidebar.open {
            width: 250px;
        }

        .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
            margin-left: 10px;
        }

        .sidebar.open .logo_name {
            opacity: 1;
        }

        #btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            font-size: 24px;
            color: #fff;
            cursor: pointer;
            
        }
        .nav-list li:nth-child(11) a { 
    height: auto;
    min-height: 50px;
    align-items: flex-start;
    padding-top: 8px;
    padding-bottom: 8px;
}

        .nav-list {
            margin-top: 20px;
            padding-left: 0;
        }

        .nav-list li {
            list-style: none;
            margin: 8px 0;
            position: relative;
        }

        .nav-list li a {
            display: flex;
            height: 50px;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            color: #fff;
            transition: all 0.4s ease;
        }

        .nav-list li a:hover {
            background: #fff;
            color: #191970;
        }

        .nav-list li i {
            min-width: 50px;
            font-size: 24px;
            text-align: center;
        }

        .links_name {
            opacity: 0;
            transition: all 0.5s ease;
            white-space: normal;
            line-height: 1.2;
        }

        .sidebar.open .links_name {
            opacity: 1;
        }

        
        .main-content {
            position: relative;
            margin-top: 80px;
            margin-left: 78px;
            padding: 20px;
            transition: all 0.5s ease;
            min-height: calc(100vh - 80px);
        }

        .sidebar.open ~ .main-content {
            margin-left: 250px;
        }

        .sidebar.open ~ .header {
            left: 250px;
            width: calc(100% - 250px);
        }
        /* Floating Help Button */
    #helpBtn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #helpBtn i {
        font-size: 1.4rem;
    }

  
    #logout-item {
    position: fixed;
    bottom: 20px;
    left: 0;
    width: 78px;
    padding: 0 7px;
    transition: all 0.5s ease;
}

.sidebar.open #logout-item {
    width: 250px;
    padding: 0 15px;
}

/* Add margin to last menu item */
.nav-list li:not(.logout-item):last-child {
    margin-bottom: 40px; 
}

/* Tooltip adjustments */
.sidebar li .tooltip {
    left: 70px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.4s ease;
}

.sidebar li:hover .tooltip {
    opacity: 1;
    left: 80px;
}

/* Logout hover alignment */
.logout-item .tooltip {
    left: 70px !important;
}

.sidebar.open .logout-item .tooltip {
    display: none;
}

/* Hover consistency */
.nav-list li a:hover {
    background: #fff !important;
    color: #191970 !important;
}

.logout-link:hover {
    background: #fff !important;
    color: #ff4d4f !important;
}


     /* Tooltip styling */
     .sidebar li .tooltip {
    left: 85px; 
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    transition: all 0.4s ease;
    background: #fff;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
  border-radius: 4px;
  font-size: 15px;
  font-weight: 400;
  opacity: 0;
  white-space: nowrap;
  pointer-events: none;
  padding: 6px 12px;
  
}

.sidebar li:hover .tooltip {
    opacity: 1;
    left: 80px; 
}
  
    .sidebar.open li .tooltip {
        display: none;
    }
    
    </style>