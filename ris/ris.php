<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/psa/home.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Requisition and Issue Slip</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="container">
        <h2>REQUISITION AND ISSUE SLIP</h2>
<form id="risForm">

    <div class="form-section">
        <div>
            <label>Division:</label>
            <input type="text" name="division" required>

            <label>Office:</label>
            <input type="text" name="office" value="PSA-Quirino" required>

            <label>Responsibility Center Code:</label>
            <input type="text" name="rcc" required>
        </div>
        <div>
            <label>RIS No.:</label>
            <input type="text" name="ris_no" required>

            <label>Purpose:</label>
            <textarea name="purpose" rows="3" required></textarea>
        </div>
    </div>

    <table class="styled-table" id="itemsTable">
        <thead>
            <tr>
                <th>Stock No</th>
                <th>Unit</th>
                <th>Description</th>
                <th>Requested Quantity</th>
                <th>Issued Quantity</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" name="stock_no[]" required></td>
                <td>
                    <select name="unit[]" required>
                        <option value="">--Select--</option>
                        <option value="pcs">pcs</option>
                        <option value="box">box</option>
                        <option value="set">set</option>
                        <option value="ream">ream</option>
                        <option value="pack">pack</option>
                        <option value="liter">liter</option>
                        <option value="bottle">bottle</option>
                        <option value="kg">kg</option>
                        <option value="roll">roll</option>
                    </select>
                </td>
                <td><input type="text" name="description[]"></td>
                <td><input type="number" name="qty[]" required></td>
                <td><input type="number" name="i_qty[]" required></td>
                <td><input type="text" name="remarks[]"></td>
            </tr>
        </tbody>
    </table>

  
<div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
    <button type="button" onclick="addRow()">Add Row</button>
    <button type="button" class="submit-btn" onclick="confirmSubmit()">Submit</button>
</div>

</form>

<script>
    function addRow() {
        const table = document.getElementById("itemsTable").getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        
        newRow.innerHTML = `
            <td><input type="text" name="stock_no[]" required></td>
            <td>
                <select name="unit[]" required>
                    <option value="">--Select--</option>
                    <option value="pcs">pcs</option>
                    <option value="box">box</option>
                    <option value="set">set</option>
                    <option value="ream">ream</option>
                    <option value="pack">pack</option>
                    <option value="liter">liter</option>
                    <option value="bottle">bottle</option>
                    <option value="kg">kg</option>
                    <option value="roll">roll</option>
                </select>
            </td>
            <td><input type="text" name="description[]"></td>
            <td><input type="number" name="qty[]" required></td>
            <td><input type="number" name="i_qty[]" required></td>
            <td><input type="text" name="remarks[]"></td>
        `;
    }

    // Rest of the JavaScript remains the same
    function confirmSubmit() { /* ... */ }
    function submitFormAJAX() { /* ... */ }
    document.addEventListener("DOMContentLoaded", function () {
    const container = document.querySelector('.container');

});

document.addEventListener("DOMContentLoaded", function () {
        const sidebar = document.querySelector(".sidebar");
        const toggleBtn = document.getElementById("btn");

        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("active");
            document.body.classList.toggle("sidebar-closed");
        });
    });

</script>

<style>

.container {
    width: 100%;
    max-width: 1200px;
    margin: 60px auto 20px auto; 
    padding: 0 20px;
    position: relative;
    margin: 60px 0 20px 250px; 
    transition: margin-left 0.3s ease; 
    left: 78px;
    width: calc(100% - 78px);
    margin-left: 20px; 
    margin-right: 40px; 
    z-index: 2;

   
}
body {
    margin: 0;
    padding: 0;
    display: flex;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center; 
    background-color: #e9ecf4; 
}


body.sidebar-closed .container {
    margin-left: 60px; 
    
}

    /* Header styling */
    h2 {
        text-align: center;
        margin: 30px 0;
        padding-bottom: 20px;
        border-bottom: 2px solid #333;
    }

  
    .styled-table {
        width: 100%; 
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .styled-table th,
    .styled-table td {
        border: 1px solid #ddd;
        padding: 6px;
        text-align: center;
        font-size: 16px;
    }

    .styled-table th {
        background-color: #f2f2f2;
        font-weight: bold;
        padding: 5px;
    }
    .form-section {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin: 25px 0;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        flex-wrap: wrap;
    }

    .form-section div {
        flex: 1 1 45%;
    }

    input[type="text"],
input[type="number"],
textarea,
select {
    width: 100%;
    padding: 10px;
    font-size: 15px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

    button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin: 10px 0;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

   
    button[onclick="addRow()"] {
        background-color: #28a745;
    }

    button[onclick="addRow()"]:hover {
        background-color: #1e7e34;
    }
</style>

</body>
</html>