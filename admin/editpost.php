<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if (!isset($_GET['editpostId']) || $_GET['editpostId'] == NULL) {
        echo "<script>window.location = postlist.php</script>";
        // echo header("Location: postlist.php");
    } else {
        $editId = $_GET['editpostId'];
    }
?>
    <div class="grid_10">		
        <div class="box round first grid">
            <h2>Add New Post</h2>
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $cet = mysqli_real_escape_string($db->link, $_POST['cet']);
                $body = mysqli_real_escape_string($db->link, $_POST['body']);
                $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
                $author = mysqli_real_escape_string($db->link, $_POST['author']);

                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $upload_image = "upload/".$unique_image;

                if ($title == "" || $cet == "" || $body == "" || $tags == "" || $author == "") {
                    echo "<span class='error'>Field must be Empty !</span>";
                } else {
                    if (!empty($file_name)) {
                        if ($file_size > 1048567) {
                            echo "<span class='error'>Image size should be less then 1MB !</span>";
                        } elseif (in_array($file_ext, $permited) === false) {
                            echo "<span class='error'>You can Upload only-> ".implode(', ', $permited)."</span>";
                        } else {
                            move_uploaded_file($file_temp, $upload_image);
                            $query = "UPDATE tbl_post
                            SET
                            cat     = '$cet',
                            title   = '$title',
                            body    = '$body',
                            image   = '$upload_image',
                            author  = '$author',
                            tags    = '$tags'
                            WHERE id = '$editId'";
                            $update_row = $db->update($query);
                            if ($update_row) {
                                echo "<span class='success'>Post Updated Successfull.</span>";
                            } else {
                                echo "<span class='error'>Post not Updated !</span>";
                            }
                        }
                    } else {
                        $query = "UPDATE tbl_post
                            SET
                            cat     = '$cet',
                            title   = '$title',
                            body    = '$body',
                            author  = '$author',
                            tags    = '$tags'
                            WHERE id = '$editId'";
                            $update_row = $db->update($query);
                            if ($update_row) {
                                echo "<span class='success'>Post Updated Successfull.</span>";
                            } else {
                                echo "<span class='error'>Post not Updated !</span>";
                            }
                    }
                }
            }
        ?>
            <div class="block">
            <?php
                $query = "SELECT * FROM tbl_post WHERE id='$editId' ORDER By id DESC";
                $getpost = $db->select($query);
                    while ($postResult = $getpost->fetch_assoc()) {
            ?>            
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postResult['title']; ?>" class="medium" />
                            </td>
                        </tr>                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cet">
                                    <option> Select One</option>
                                <?php
                                    $query = "SELECT * FROM tbl_cetagory";
                                    $cetagory = $db->select($query);
                                    if ($cetagory) {
                                        while ($result = $cetagory->fetch_assoc()) {
                                ?>
                                    <option 
                                    <?php
                                        if ($postResult['cat'] == $result['id']) { ?>
                                            selected="selected"
                                    <?php } ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postResult['image']; ?>" width="200px" height="100px" alt=""></br>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    <?php echo $postResult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postResult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postResult['author']; ?>" class="medium" />
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
                <?php } ?>
            </div>
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