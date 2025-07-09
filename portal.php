<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Login Hammy</title>
     <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" href="css/portal.css" />
  </head>
  <body>
    <div class="container">
      <h1>Portal Login Hammy</h1>

      <div class="login-options">
        <a href="login_admin.php" class="btn">
          <div class="btn-content">
            <div class="btn-icon admin-icon">
              <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
              </svg>
            </div>
            <span>Admin</span>
          </div>
        </a>

        <a href="login_user.php" class="btn">
          <div class="btn-content">
            <img src="image/portal.png" alt="userham" class="icon" />
            <span>Pemilik Hammy</span>
          </div>
        </a>
      </div>

      <p>Silakan pilih kategori login terlebih dahulu</p>
    </div>
  </body>
</html>
