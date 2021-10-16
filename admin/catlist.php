<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
    <div class="grid_10">
        <div class="box round first grid">
            <h2>Category List</h2>
            <?php
                if (isset($_GET['delcat'])) {
                    $delcet = $_GET['delcat'];
                    $query = "DELETE FROM tbl_cetagory WHERE id='$delcet'";
                    $delcetagory = $db->delete($query);
                    if ($delcetagory) {
                        echo "<span class='success'>Cetagory Delected successfull.</span>";
                    } else {
                        echo "<span class='success'>Cetagory not Delected !.</span>";
                    }
                }
            ?>
            <div class="block">        
                <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT * FROM tbl_cetagory ORDER BY ID DESC";
                    $cetagory = $db->select($query);
                    if ($cetagory) {
                        $i = 0;
                        while ($result = $cetagory->fetch_assoc()) {
                            $i++;
                ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><a href="editcat.php?catId=<?php echo $result['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure Delete !')" href="?delcat=<?php echo $result['id']; ?>">Delete</a></td>
                    </tr>
                <?php } }?> 
                </tbody>
            </table>
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