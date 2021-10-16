<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Add New Category</h2>
            <div class="block copyblock">
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
                        $name = $_POST['name'];
                        $name = mysqli_real_escape_string($db->link, $name);
                        if (empty($name)) {
                            echo "<span class='error'>Field must be Empty !</span>";
                        } else {
                            $query = "INSERT INTO tbl_cetagory(name) VALUES('$name')";
                            $cetInsert = $db->insert($query);
                            if ($cetInsert) {
                                echo "<span class='success'>Cetagory Inserted Successfully. </span>";
                            } else {
                                echo "<span class='error'>Cetagory not Inserted.</span>";
                            }
                        }
                    }
                ?>
                <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="name" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>