<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">		
        <div class="box round first grid">
            <h2>Update Social Media</h2>
            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $facebook = $fm->validation($_POST['facebook']);
                    $twitter = $fm->validation($_POST['twitter']);
                    $linkedin = $fm->validation($_POST['linkedin']);
                    $googleplus = $fm->validation($_POST['googleplus']);

                    $facebook = mysqli_real_escape_string($db->link, $facebook);
                    $twitter = mysqli_real_escape_string($db->link, $twitter);
                    $linkedin = mysqli_real_escape_string($db->link, $linkedin);
                    $googleplus = mysqli_real_escape_string($db->link, $googleplus);

                    if ($facebook == "" || $twitter == "" || $linkedin == "" || $googleplus == "") {
                        echo "<span class='error'>Field must be Empty !.</span>";
                    } else {
                        $query = "UPDATE tbl_social
                                SET
                                facebook    = '$facebook',
                                twitter     = '$twitter',
                                linkedin    = '$linkedin',
                                googleplus  = '$googleplus'
                                WHERE id    = '1'";
                                $update_row = $db->update($query);
                                if ($update_row) {
                                    echo "<span class='success'>Social Link Updated Successfull.</span>";
                                } else {
                                    echo "<span class='error'>Social Link not Updated !</span>";
                                }
                    }
                }
            ?>
            <div class="block">
            <?php
                $query = "SELECT * FROM tbl_social WHERE id='1'";
                $social_link = $db->select($query);
                if ($social_link) {
                    while ($result = $social_link->fetch_assoc()) {
            ?>               
                <form action="social.php" method="POST" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Facebook</label>
                            </td>
                            <td>
                                <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Twitter</label>
                            </td>
                            <td>
                                <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" class="medium" />
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>LinkedIn</label>
                            </td>
                            <td>
                                <input type="text" name="linkedin" value="<?php echo $result['linkedin']; ?>" class="medium" />
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                <label>Google Plus</label>
                            </td>
                            <td>
                                <input type="text" name="googleplus" value="<?php echo $result['googleplus']; ?>" class="medium" />
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
                <?php } } ?>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include "inc/footer.php"; ?>
