<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!Session::get('userRole') == '0') {
    echo "<script>window.location = 'index.php';</script>";
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));
                $role = $fm->validation($_POST['role']);
                $email = $fm->validation($_POST['email']);

                $username = $db->link->real_escape_string($username);
                $password = $db->link->real_escape_string($password);
                $role = $db->link->real_escape_string($role);
                $email = $db->link->real_escape_string($email);

                if (empty($username) || empty($password) || empty($role) || empty($email)) {
                    echo "<span class='error'>Field must not be empty.</span>";
                } else {

                    $mailquery = "SELECT * FROM tbl_user WHERE email='$email' limit 1";
                    $mailcheck = $db->select($mailquery);

                    if ($mailcheck != false) {
                        echo "<span class='error'>Email Already Exist.</span>";
                    } else {
                        $query = "INSERT INTO tbl_user(username,password,role,email) VALUES('$username','$password','$role','$email') ";
                        $userinsert = $db->insert($query);

                        if ($userinsert) {
                            echo "<span class='success'>User Created Successfully.</span>";
                        } else {
                            echo "<span class='error'>User Not Created.</span>";
                        }
                    }
                }
            }
            ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label for="">Username</label>
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Your Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Email..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">User Role</label>
                        </td>
                        <td>
                            <select name="role" id="select">

                                <option>Select USer Role </option>
                                <option value="0">Admin</option>
                                <option value="1">Author</option>
                                <option value="2">Editor</option>

                            </select>
                        </td>
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
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>