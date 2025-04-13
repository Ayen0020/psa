<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/psa/home.php';
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
  <style>
    
  </style>
</head>
<body>

  
  
   
      <!-- Main Content -->
      <div class="flex-grow-1 p-4">
        <h2 class="center mb-4">INSPECTION AND ACCEPTANCE REPORT</h2>
  
        <form id="iarForm">
          <table class="noborder">
            <tr>
              <td colspan="2"><strong>Entity Name :</strong> Philippine Statistics Authority</td>
              <td colspan="2"><strong>Fund Cluster :</strong> <input type="text" name="fund_cluster"></td>
            </tr>
            <tr>
              <td colspan="2"><strong>Supplier :</strong> <input type="text" name="supplier" required></td>
              <td><strong>IAR No. :</strong> <input type="text" name="iar_no" required></td>
              <td><strong>Date :</strong> <input type="date" name="date" required></td>
            </tr>
            <tr>
              <td colspan="2"><strong>PO No./Date :</strong> <input type="text" name="pr_no" required></td>
              <td><strong>Invoice No. :</strong> <input type="text" name="invoice_no"></td>
              <td><strong>Date :</strong> <input type="date" name="invoice_date"></td>
            </tr>
            <tr>
              <td colspan="4"><strong>Requisitioning Office/Dept. :</strong> <input type="text" name="requisitioning_office"></td>
            </tr>
            <tr>
              <td colspan="4"><strong>Responsibility Center Code :</strong> <input type="text" name="responsibility_center"></td>
            </tr>
          </table>
  
          <table id="itemsTable">
            <tr class="section-title">
              <th>Stock/Property No.</th>
              <th>Description</th>
              <th>Unit</th>
              <th>Quantity</th>
            </tr>
            <tr>
              <td><input type="text" name="property_no[]"></td>
              <td><input type="text" name="descd[]"></td>
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
              <td><input type="number" name="quantity[]" min="0"></td>
            </tr>
          </table>
  
          <button type="button" onclick="addRow()">Add Row</button>
  
          <br><strong class="mt-4 d-block">INSPECTION</strong>
          <table>
            <tr>
              <td>
                <strong>Date Inspected :</strong>
                <input type="date" name="date_inspected" required><br><br>
                Inspected, verified and found in order as to quantity and specifications.<br><br>
                <strong>Inspection Officer :</strong><br>
                <input type="text" name="i_officer" placeholder="Enter name" required>
              </td>
              <td>
                <strong>Date Received :</strong>
                <input type="date" name="final_date_received" required><br><br>
                <strong>Custodian :</strong><br>
                <input type="text" name="custodian" placeholder="Enter name" required>
              </td>
            </tr>
          </table>
  
          <button type="button" onclick="confirmSubmit()">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function addRow() {
      const table = document.getElementById("itemsTable");
      const row = table.insertRow();

      // Property No.
      let cell1 = row.insertCell();
      cell1.innerHTML = '<input type="text" name="property_no[]">';

      // Description
      let cell2 = row.insertCell();
      cell2.innerHTML = '<input type="text" name="descd[]">';

      // Unit (Dropdown)
      let cell3 = row.insertCell();
      cell3.innerHTML = `
        <select name="unit[]" required>
          <option value="">--Select--</option>
          <option value="pcs">pcs</option>
          <option value="box">box</option>
          <option value="set">set</option>
          <option value="ream">ream</option>
          <option value="pack">pack</option>
          option value="pack">liter</option>
          <option value="pack">bottle</option>
          <option value="pack">kg</option>
          <option value="pack">roll</option>
        </select>
      `;

      // Quantity
      let cell4 = row.insertCell();
      cell4.innerHTML = '<input type="number" name="quantity[]" min="0">';
    }

    function confirmSubmit() {
      Swal.fire({
        title: 'Submit IAR?',
        text: "Are you sure you want to submit this report?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, submit it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          submitFormAJAX();
        }
      });
    }

    function submitFormAJAX() {
      const form = document.getElementById('iarForm');
      const formData = new FormData(form);

      fetch('submit.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire('Success!', data.message, 'success');
          form.reset();
        } else {
          Swal.fire('Error!', data.message, 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        Swal.fire('Oops!', 'Something went wrong.', 'error');
      });
    }
  </script>

</body>

<style>
  body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }


        .psa-main {
            font-size: 2.1rem;
            font-weight: 700;
            color: #fff;
        }

      

        .center {
          text-align: center;
        }

        .flex-grow-1 {
          flex-grow: 1;
          background-color: #f8f9fa;
        }

        

        body { font-family: 'Segoe UI', sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    td, th { border: 1px solid black; padding: 6px; text-align: left; }
    .center { text-align: center; }
    .noborder td { border: none; }
    input[type="text"], input[type="date"], input[type="number"], select {
      width: 100%; border: none; outline: none; font-size: 14px;
    }
    .section-title { font-weight: bold; background: #eee; text-align: center; }
    button, input[type="submit"] {
      margin-top: 20px; padding: 10px 20px; font-size: 16px;
    }
</style>
</html>
