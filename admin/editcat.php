<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">
<?php
    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location = 'catlist.php'</script>";
        // header("Location: catlist.php");
    } else {
        $catId = $_GET['catId'];
    }
?>
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
                            $query = "UPDATE tbl_cetagory
                            SET
                            name = '$name'
                            WHERE id = '$catId'";
                            $cetUpdate = $db->update($query);
                            if ($cetUpdate) {
                                echo "<span class='success'>Cetagory Updated Successfully. </span>";
                            } else {
                                echo "<span class='error'>Cetagory not Updated.</span>";
                            }
                        }
                    }
                ?>
                <?php
                    $query = "SELECT * FROM tbl_cetagory WHERE id='$catId' ORDER BY id DESC";
                    $cetagory = $db->select($query);
                    while ($result = $cetagory->fetch_assoc()) {
                ?>
                <form action="" method="POST">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="name" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                </form>
                    <?php }?>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>