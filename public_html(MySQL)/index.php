<html>
 <head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>CapstoneAdmin - Login</title>
 </head>
 <body>
   <?php include 'connect.php'; ?>
   <!-- form for login -->
   <form class="form1" method="post" action="" id="form1">
      <fieldset>
        <ul>
                <div class="container">
                  <form class="form-horizontal" role="form" method="POST" action="/login">
                      <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                              <h2>CapstoneAdmin Login</h2>
                              <hr>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                              <div class="form-group has-danger">
                                  <label class="sr-only" for="email">E-Mail Address</label>
                                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                      <input type="text" name="email" class="form-control" id="email"
                                             placeholder="you@example.com" required autofocus>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-3"></div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label class="sr-only" for="password">Password</label>
                                  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                      <input type="password" name="password" class="form-control" id="password"
                                             placeholder="Password" required>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row" style="padding-top: 1rem">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                    <button name="Submit" type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Login</button>
                    <a class="btn btn-link" href="create-user.php">Create Account</a>
                    </div>
                  </div>
                  </form>
                </div>
        </ul>
        <br/>
      </fieldset>
    </form>
    <?php
      if (isset($_POST['Submit'])) {
        // Check validity of login credentials using the supplied email and password
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $stid=$conn->prepare("SELECT valid_user(?,?)") or die($conn->error);
        $stid->bind_param('ss', $email, $password) or die($stid->error);
        $stid->execute() or die($stid->error);
        $stid->bind_result($result);
        $stid->fetch();
        $stid->close();
        // // If valid login credentials, create session (login) and determine if the user is an admin
        if ($result === "1"){
          session_start();
          $_SESSION["email"] = $_POST['email'];
          $email = $conn->real_escape_string($_POST['email']);
          $perm=$conn->prepare("SELECT user_id, email, is_admin from `APP_USERS` where email = UPPER(?)");
          $perm->bind_param('s', $email);
          $perm->execute() or die($perm->error);
          $fields = $perm->get_result();
          $is_admin = 0;
          $user_id = -1;
          // Check if user is an admin
          while ($row = $fields->fetch_assoc()) {
              $is_admin = $row["is_admin"];
              $user_id = $row["user_id"];
          }

          $_SESSION["IS_ADMIN"] = $is_admin;
          $_SESSION["USER_ID"] = $user_id;

          //Redirect to the correct page depending on user permissions
          if ($is_admin === 1){
           header('Location: /admin/index.php');
          }
          else {
            header('Location: /user/index.php');
          }

        }
        else {
          ?><div class="row" style="padding-top: 1rem"><div class="col-md-6"></div><div class="col-md-6"><?php print 'Invalid email/password. Please try again.';?></div></div><?php
        }
    }


    ?>
 </body>
</html>
