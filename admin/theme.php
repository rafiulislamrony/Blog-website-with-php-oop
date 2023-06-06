<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<div class="grid_10">
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $theme = $fm->validation($_POST['theme']);
        $theme = $db->link->real_escape_string($theme);

        $query = "UPDATE tbl_theme
            SET theme='$theme'
            WHERE id='1'";

        $updated_row = $db->update($query);

        if ($updated_row) {
            echo "<span class='success'>Theme Updated Successfully.</span>";

        } else {
            echo "<span class='error'>Theme Not Updated.</span>";
        }
    }
    ?>
    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock">
            <?php
            $query = "SELECT * FROM tbl_theme WHERE id = '1'";
            $themes = $db->select($query);

            while ($result = $themes->fetch_assoc()) { ?>

                <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input <?php if($result['theme'] == 'default' ){echo "checked";} ?> type="radio" name="theme" value="default"> Default
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input  <?php if($result['theme'] == 'green' ){echo "checked";} ?>  type="radio" name="theme" value="green"> Green
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input  <?php if($result['theme'] == 'red' ){echo "checked";} ?>  type="radio" name="theme" value="red"> Red
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" name="submit" Value="Change" />
                            </td>
                        </tr>
                    </table>
                </form>

            <?php } ?>
        </div>
    </div>
</div>
<div class="clear">
</div>
</div>
<?php include 'inc/footer.php'; ?>