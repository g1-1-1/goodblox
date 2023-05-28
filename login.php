<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: /");
    exit;
}

// Include config file
require_once $_SERVER["DOCUMENT_ROOT"] . "/inc/config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = $_POST["username"];
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = $_POST["password"];
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        try {
            // Prepare a select statement
            $sql = "SELECT id, username, password FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(1, $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;

            // Execute the prepared statement
            $stmt->execute();

            // Check if username exists, if yes then verify password
            if ($stmt->rowCount() == 1) {
                // Fetch result
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $id = $row["id"];
                $hashed_password = $row["password"];

                if (password_verify($password, $hashed_password)) {
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;

                    // Redirect user to welcome page
                    header("location: /");
                } else {
                    // Password is not valid, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                // Username doesn't exist, display a generic error message
                $login_err = "Invalid username or password.";
            }

            // Close statement
            $stmt->closeCursor();
        } catch (PDOException $e) {
            echo "Oops! Something went wrong. Please try again later.";
            error_log($e->getMessage());
        }
    }

    // Close connection
    $conn = null;
}
?>
<?php
include 'inc/header.php';
include 'inc/nav.php';
?>
<center><?php if($login_err !== ''){ echo $login_err; } ?></center>
<div id="FrameLogin" style="margin: 50px auto 150px auto; width: 500px; border: black thin solid; padding: 21px; z-index: 8; background-color: white;">
    <div id="PaneNewUser">
      <h3>New User?</h3>
      <p>You need an account to play <?=$sitename?>.</p>
      <p>If you aren't a <?=$sitename?> member then <a id="ctl00_cphRoblox_HyperLink1" href="/register.aspx">register</a>. It's easy and we do <em>not</em> share your personal information with anybody.</p>
    </div>
    <div id="PaneLogin">
      <h3>Log In</h3>
      
<div class="AspNet-Login"><form method="POST" action="<?php $_SERVER["PHP_SELF"]; ?>">
  <div class="AspNet-Login-UserPanel">
    <label for="ctl00_cphRoblox_lRobloxLogin_UserName" class="TextboxLabel"><em>U</em>ser Name:</label>
    <input type="text" id="ctl00_cphRoblox_lRobloxLogin_UserName" name="username" value="" accesskey="u">&nbsp;
  </div>
  <div class="AspNet-Login-PasswordPanel">
    <label for="ctl00_cphRoblox_lRobloxLogin_Password" class="TextboxLabel"><em>P</em>assword:</label>
    <input type="password" id="ctl00_cphRoblox_lRobloxLogin_Password" name="password" value="" accesskey="p">&nbsp;
  </div>
  <div class="AspNet-Login-SubmitPanel">
    <input type="submit" value="Log In" id="ctl00_cphRoblox_lRobloxLogin_LoginButton" name="ctl00$cphRoblox$lRobloxLogin$LoginButton" onclick="WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$cphRoblox$lRobloxLogin$LoginButton&quot;, &quot;&quot;, true, &quot;ctl00$cphRoblox$lRobloxLogin&quot;, &quot;&quot;, false, false))">
  </div>
  <div class="AspNet-Login-PasswordRecoveryPanel">
    <a href="ResetPasswordRequest.aspx" title="Password recovery">Forgot your password?</a>
  </div>
  <div class="AspNet-Login-PasswordRecoveryPanel">
        <a disabled="disabled" title="Forgot your password?" onclick="return false" style="display:inline-block;">
          <img src="/images/forgotpwdspeech.png" id="img" alt="Forgot your password?" onclick="window.location.href='ResetPasswordRequest.aspx'" style="position:absolute;margin-left:200px;cursor:pointer;" border="0">
          <img src="/images/loginfig.png" id="img" alt="Figure" style="margin-left: 80px;position:absolute;z-index:-1;margin-top:-50px;" border="0">
        </a>
      </div>
  </form>
</div>
    </div>
  </div>

<?php
include 'inc/footer.php';
?>