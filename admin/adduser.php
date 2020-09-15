<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
					
    $username = $password = $role = $msg = '';
    $error = array('username' => '', 'password' => '', 'role' => '');
    $errorFlag = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $username = $fm->sanitaization($_POST['username']);
        $password = $_POST['password'];
        $role     = $_POST['role'];

        $username = mysqli_real_escape_string($db->link, $username);
        $password = mysqli_real_escape_string($db->link, $password);
        $role     = mysqli_real_escape_string($db->link, $role);

        
        if (empty($username)) {
            $error['username'] = 'Username must not be empty.';
            $errorFlag = true;
        }
        
        if (empty($password)) {
            $error['password'] = 'Password must not be empty.';
            $errorFlag = true;
        }
        
        if ($role == 'Select Role') {
            $error['role'] = 'Select a role for the user.';
            $errorFlag = true;
        }
        
        if (!$errorFlag) {
            $query = "INSERT INTO tbl_users(username, password, role) VALUES('$username', '$password', '$role')";
            
            if ($db->insert($query)) {
                $msg = "<span style='color: green; font-size: 18px;'>User created successfully</span>";
                $username = $password = $role = '';
            } else {
                $msg = "<span style='color: green; font-size: 18px;'>Failed to create user</span>";
            }
        }

    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <?= $msg ?>
        <div class="block copyblock"> 
            <form action="" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Username: </label>
                    </td>
                    <td>
                        <input type="text" name="username" class="medium" <?= $username ? 'value="' . $username . '"' : 'placeholder="Enter Username"'; ?>/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><span style="color: red; font-size: normal;"><?= $error['username'] ? $error['username'] : ''; ?></span></td>
                </tr>
                <tr>
                    <td>
                        <label>Password: </label>
                    </td>
                    <td>
                        <input type="text" name="password" class="medium" <?= $password ? 'value="' . $password . '"' : 'placeholder="Enter Password"'; ?>/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><span style="color: red; font-size: normal;"><?= $error['password'] ? $error['password'] : ''; ?></span></td>
                </tr>
                <tr>
                    <td>
                        <label>Role: </label>
                    </td>
                    <td>
                        <select name="role">
                            <option>Select Role</option>
                            <option value="1">Admin</option>
                            <option value="2">Author</option>
                            <option value="3">Editor</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><span style="color: red; font-size: normal;"><?= $error['role'] ? $error['role'] : ''; ?></span></td>
                </tr>
                <tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>