<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cool Registration App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div style="width: 100vw; height: 100vh;" class="container d-flex justify-content-center align-items-center" id="loginContainer">
    <h1 class="mx-4">Cool Registration App</h1>
    <?php
      if (isset($_POST['username']) && isset($_POST['email'])) {
        $conn = new mysqli('mariadb', 'username', 'userpwd', 'app', '3306');
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql = "INSERT INTO users (username, email) VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "')";
        if ($conn->query($sql) === true) {
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            echo "<div>";
            echo "<h1>Registered Users</h1><br/>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>Username</th><th>Email</th><th>Registered</th></tr></thead>";
            while($row = $result->fetch_assoc()) {
              echo "<tbody><tr><td>" . $row["username"] . "</td><td>" . $row["email"] . "</td><td>" . $row["created_at"] . "</td></tr></tbody>";
            }
            echo "</table>";
            echo "<a href='index.php'>Back</a>";
            echo "</div>";
          }
        }
      } else {
    ?>
    <form class="border border-2 p-4 mx-4" action="" method="post">
      <div class="form-group my-4">
        <label for="username">Username</label>
        <input type="username" class="form-control" name="username" placeholder="Username..." />
      </div>
      <div class="form-group my-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" placeholder="Email..." />
      </div>
      <div class="my-4">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    <?php } ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>