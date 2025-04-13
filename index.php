<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - PSA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

  <div class="login-container d-flex flex-column flex-md-row align-items-center gap-4">
    
    <!-- Image Section -->
    <div class="col-md-6 text-center">
      <img src="assets/psa.png" alt="PSA Logo" class="login-image">
    </div>

    <!-- Form Section -->
    <div class="col-md-6">
      <h4 class="fw-bold mb-1">Welcome back User!</h4>
      <p class="mb-4 text-muted">Log in your account</p>
      <form id="loginForm">
        <div class="mb-3">
          <label for="username" class="form-label">Email</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your email" required>
          </div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
    </div>
  </div>

  <!-- Optional: Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const form = e.target;
      const formData = new FormData(form);

      fetch('login.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          Swal.fire({
            icon: 'success',
            title: 'Login Successful!',
            text: data.message,
            timer: 1500,
            showConfirmButton: false
          }).then(() => {
            window.location.href = 'home.php';
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: data.message
          });
        }
      })
      .catch(() => {
        Swal.fire('Error', 'An error occurred. Please try again.', 'error');
      });
    });
  </script>

</body>

<style>
  
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
    font-family: "Poppins" , sans-serif;
}


  body {
  background: linear-gradient(135deg, #ffffff, #7ce5ff, #4726ff);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  
}



.login-container {
  background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 850px;
    width: 100%;
    margin: auto;
    height: auto; 
  }


  .login-image {
    max-width: 280px;
    width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
  }


  .form-control:focus {
    box-shadow: none;
    border-color: #007bff;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    border-radius: 8px;
    transition: all 0.3s ease;
    width: 90%;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .form-label {
    font-weight: 500;
  }

  .forgot-link {
    font-size: 0.9rem;
    color: #007bff;
    text-decoration: none;
  }

  .forgot-link:hover {
    text-decoration: underline;
  }

 
  @media (max-width: 768px) {
    body {
      padding: 15px;
      height: auto;
      min-height: 100vh;
      align-items: flex-start;
    }

    .login-container {
      flex-direction: column;
      padding: 25px;
      margin: 10px;
      width: calc(100% - 20px);
    }

    .login-image {
      max-width: 180px;
      margin: 10px 0;
    }


    .col-md-6 {
      width: 100%;
      padding: 0 10px;
    }

    h4 {
      font-size: 1.5rem !important;
    }

    .form-label {
      font-size: 0.9rem;
    }

    .form-control {
      font-size: 0.9rem;
      padding: 12px 15px;
    }

    .btn-primary {
      font-size: 1rem;
      padding: 12px;
    }

    .forgot-link {
      font-size: 0.85rem;
    }
  }

 
  @media (max-width: 480px) {
    .login-container {
      padding: 20px;
    }

    h4 {
      font-size: 1.3rem !important;
    }

    .form-control {
      padding: 10px 12px;
    }

    .btn-primary {
      font-size: 0.95rem;
    }
  }
</style>
</html>
