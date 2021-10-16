<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">		
        <div class="box round first grid">
            <h2>Update Site Title and Description</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title = $fm->validation($_POST['title']);
                    $sologan = $fm->validation($_POST['sologan']);

                    $title = mysqli_real_escape_string($db->link, $title);
                    $sologan = mysqli_real_escape_string($db->link, $sologan);

                    $permited = array('png');
                    $file_name = $_FILES['logo']['name'];
                    $file_size = $_FILES['logo']['size'];
                    $file_temp = $_FILES['logo']['tmp_name'];

                    $div = explode('.', $file_name);
                    $file_ext = strtolower(end($div));
                    $same_image = 'logo'.'.'.$file_ext;
                    $upload_image = "upload/".$same_image;

                    if ($title == "" || $sologan == "") {
                        echo "<span class='error'>Field must be Empty !</span>";
                    } else {
                        if (!empty($file_name)) {
                            if ($file_size > 1048567) {
                                echo "<span class='error'>Image size should be less then 1MB !</span>";
                            } elseif (in_array($file_ext, $permited) === false) {
                                echo "<span class='error'>You can Upload only-> ".implode(', ', $permited)."</span>";
                            } else {
                                move_uploaded_file($file_temp, $upload_image);
                                $query = "UPDATE tbl_sologan
                                SET
                                title   = '$title',
                                sologan = '$sologan',
                                logo    = '$upload_image'
                                WHERE id = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Description Updated Successfull.</span>";
                                } else {
                                    echo "<span class='error'>Description not Updated !</span>";
                                }
                            }
                        } else {
                            $query = "UPDATE tbl_sologan
                                SET
                                title   = '$title',
                                sologan    = '$sologan'
                                WHERE id = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Description Updated Successfull.</span>";
                                } else {
                                    echo "<span class='error'>Description not Updated !</span>";
                                }
                        }
                    }
                }
            ?>
            <div class="block sloginblock">
                <?php
                    $query = "SELECT * FROM tbl_sologan WHERE id='1'";
                    $blog_title = $db->select($query);
                    if ($blog_title) {
                        while ($result = $blog_title->fetch_assoc()) {
                ?>
                <div style="width: 70%; float: left;" class="left-side">          
                <form action="titleslogan.php" method="POST" enctype="multipart/form-data">
                        <table class="form">				
                            <tr>
                                <td>
                                    <label>Website Title</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                                </td>
                            </tr>
                                <tr>
                                <td>
                                    <label>Website Slogan</label>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $result['sologan']; ?>" name="sologan" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Upload Logo</label>
                                </td>
                                <td>
                                    <input type="file" name="logo" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div style="float: left; width: 30%;" class="right-side">
                    <img src="<?php echo $result['logo']; ?>"width="150px" height="150px" alt="logo" />
                </div>
            <?php } }?>
            </div>
        </div>
    </div>
<?php include "inc/footer.php"; ?>
