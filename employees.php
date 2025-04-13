<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/psa/home.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
 
</head>
<<body class="container mt-4"> 

<div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Employee Management</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#employeeModal">
            <i class="bx bx-plus"></i> Add Employee
        </button>
    </div>


    <div class="row mb-3 search-row">
        <div class="col-md-4 offset-md-8 d-flex justify-content-end">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="searchInput" class="form-control search-input" placeholder="Search by name or position" oninput="applyFilters()">
            </div>
        </div>
    </div>

    <div class="table-container">
    <table class="table table-striped table-hover ">
        <thead class="table-dark">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Access</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="employeeTable"></tbody>
    </table>
    </div>

    <!-- Pagination Controls -->
    <nav class="mt-3">
        <ul class="pagination" id="paginationControls"></ul>
    </nav>

    <!-- Employee Modal -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="employeeForm" onsubmit="return handleSubmit(event)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="employeeModalLabel">Add New Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="First Name" id="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Last Name" id="lastName" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" id="email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" placeholder="Password" id="password" required>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" id="position" required>
                                    <option value="">Select Position</option>
                                    <option>Accountant</option>
                                    <option>RO1</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" id="access" required>
                                    <option value="">Select Access Level</option>
                                    <option>Admin</option>
                                    <option>User</option>
                                    <option>Guest</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="editIndex" value="-1">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submitBtn">Add Employee</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let employees = [
            { firstName: "Elgin Adrian", lastName: "Ugot", email: "adrian@gmail.com", position: "RO1", access: "Admin" }
        ];
        let currentPage = 1;
        const rowsPerPage = 5;

        function handleSubmit(e) {
            e.preventDefault();
            const employee = {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                position: document.getElementById('position').value,
                access: document.getElementById('access').value
            };

            const editIndex = parseInt(document.getElementById('editIndex').value);
            if (editIndex > -1) {
                employees[editIndex] = employee;
                document.getElementById('submitBtn').textContent = "Add Employee";
            } else {
                employees.push(employee);
            }

            document.getElementById('employeeForm').reset();
            document.getElementById('editIndex').value = "-1";
            const modal = bootstrap.Modal.getInstance(document.getElementById('employeeModal'));
            modal.hide();
            applyFilters();
            return false;
        }

        function editEmployee(index) {
            const employee = employees[index];
            document.getElementById('firstName').value = employee.firstName;
            document.getElementById('lastName').value = employee.lastName;
            document.getElementById('email').value = employee.email;
            document.getElementById('position').value = employee.position;
            document.getElementById('access').value = employee.access;
            document.getElementById('editIndex').value = index;
            document.getElementById('submitBtn').textContent = "Update Employee";
            const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
            modal.show();
        }

        function deleteEmployee(index) {
            employees.splice(index, 1);
            applyFilters();
        }

        function applyFilters() {
            const search = document.getElementById('searchInput').value.toLowerCase();

            const filtered = employees.filter(emp => {
                const matchesSearch = emp.firstName.toLowerCase().includes(search) ||
                                      emp.lastName.toLowerCase().includes(search) ||
                                      emp.position.toLowerCase().includes(search);
                return matchesSearch;
            });

            renderTable(filtered);
        }

        function renderTable(data) {
    const tbody = document.getElementById('employeeTable');
    const start = (currentPage - 1) * rowsPerPage;
    const paginatedData = data.slice(start, start + rowsPerPage);

    // Clear the existing table
    tbody.innerHTML = '';

    if (paginatedData.length === 0) {
       
        tbody.innerHTML = '<tr><td colspan="6" class="text-center">No records found</td></tr>';
    } else {
       
        tbody.innerHTML = paginatedData.map((employee, index) => `
            <tr>
                <td>${employee.firstName}</td>
                <td>${employee.lastName}</td>
                <td>${employee.email}</td>
                <td>${employee.position}</td>
                <td>${employee.access}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editEmployee(${employees.indexOf(employee)})">Edit</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteEmployee(${employees.indexOf(employee)})">Delete</button>
                </td>
            </tr>
        `).join('');
    }

    renderPagination(data.length);
}


        function renderPagination(totalItems) {
            const totalPages = Math.ceil(totalItems / rowsPerPage);
            const pagination = document.getElementById('paginationControls');
            pagination.innerHTML = '';

            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
                pagination.appendChild(li);
            }
        }

        function changePage(page) {
            currentPage = page;
            applyFilters();
        }

       
        window.onload = () => applyFilters();

        
    </script>
</body>
</html>

<style>
      
      .search-input {
          border-radius: 25px;
          padding-left: 35px; 
      }
      .search-icon {
          position: absolute;
          left: 10px;
          top: 50%;
          transform: translateY(-50%);
      }
      .search-wrapper {
          position: relative;
          width: 300px; 
      }
      .table-container {
        margin-top: 2rem; /* Adds space above the table */
        margin-bottom: 2rem; /* Adds space below the table */
    }
    .search-row {
        margin-bottom: 1.5rem !important;
    }
    .table thead th {
        padding-top: 1.5rem;
        padding-bottom: 1rem;
    }

    /* Ensure body content doesn't stick to container edges */
    .container {
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    .pagination {
        margin-top: 1.5rem !important;
    }

  </style>
