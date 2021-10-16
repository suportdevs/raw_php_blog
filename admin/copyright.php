<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
        <div class="grid_10">		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $copyright = $fm->validation($_POST['copyright']);
                    $copyright = mysqli_real_escape_string($db->link, $copyright);
                    if ($copyright == "") {
                        echo "<span class='error'>Field must be Empty !.</span>";
                    } else {
                        $query = "UPDATE tbl_footer
                                SET
                                copyright = '$copyright'
                                WHERE id    = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Copyright text Updated Successfull.</span>";
                                } else {
                                    echo "<span class='error'>Copyright text not Updated.</span>";
                                }
                        }
                    }
                ?>
                <div class="block copyblock"> 
                <?php
                    $query = "SELECT * FROM tbl_footer WHERE id='1'";
                    $copyright = $db->select($query);
                    if ($copyright) {
                        while ($result = $copyright->fetch_assoc()) {
                ?>
                <form action="copyright.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['copyright']; ?>" name="copyright" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php } } ?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php"; ?>