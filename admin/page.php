<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if (!isset($_GET['pageId']) || $_GET['pageId'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
        //header("Location: index.php");
    } else {
        $pageId = $_GET['pageId'];
    }
?>
    <div class="grid_10">		
        <div class="box round first grid">
            <h2>Add New Post</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {    
                $name = $_POST['name'];
                $body = $_POST['body'];
                $name = mysqli_real_escape_string($db->link, $name);
                $body = mysqli_real_escape_string($db->link, $body);
                if (empty($name) || empty($body)) {
                    echo "<span class='error'>Field must be Empty !</span>";
                } else {
                    $query = "UPDATE tbl_page
                    SET
                    name = '$name',
                    body = '$body'
                    WHERE id = '$pageId'";
                    $update_row = $db->update($query);
                    if ($update_row) {
                        echo "<span class='success'>Page Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'>Page not Updated.</span>";
                    }
                }
            }
        ?>
            <?php
                $query = "SELECT * FROM tbl_page WHERE id='$pageId'";
                $pages = $db->select($query);
                if ($pages) {
                    while ($result = $pages->fetch_assoc()) {
            ?>
            <div class="block">
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"><?php echo $result['body']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span><a onclick="return confirm('Are you sure to Delete this page !');" href="deletepage.php?deletepageId=<?php echo $result['id']; ?>" class="delete">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php } } ?>
        </div>
    </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include "inc/footer.php"; ?>