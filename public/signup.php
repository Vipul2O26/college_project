<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup Form</title>
  <link rel="icon" type="image/x-icon" href="fav.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap" />

 
  <style>
  .centered-wrapper {
  min-height: 100vh; /* Full height of the viewport */
  display: flex;
  justify-content: center; /* Center horizontally */
  align-items: center;     /* Center vertically */
  background-color: #f8f9fa;
}

  </style>
</head>

<body>
<div class="centered-wrapper">

  <div class="container">
    <h2 class="text-center mt-4">Signup</h2>
    <div class="row justify-content-center mt-4">
      <div class="col-md-6 signup-container">
        <form action="../includes/Signup_action.php" method="POST">
          <!-- Username -->
          <div class="form-group">
            <label for="username">Username</label>
            <input
              type="text"
              class="form-control"
              id="username"
              name="username"
              placeholder="Enter username"
              required />
          </div>

          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="pass"
              placeholder="Enter password"
              required />
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              name="con_pass"
              placeholder="Re-enter password"
              required />
          </div>

          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              placeholder="Enter email"
              required />
          </div>

          <!-- User Type -->
          <div class="form-group">
            <label for="usertype">User Type</label>
            <select class="form-control" id="usertype" name="type" required>
              <option value="" disabled selected>Select user type</option>
              <option value="user">User</option>
              <option value="client">Client</option>
            </select>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary btn-block mt-4">Signup</button>

          <!-- Login Link -->
          <div class="text-center mt-3">
            <p>Already have an account? <a href="login.html">Login here</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Bootstrap JS + dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
