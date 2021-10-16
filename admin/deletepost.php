<?php 
	include '../lib/Session.php';
    Session::checkSession();
?>
<?php include '../config/config.php'; ?>
<?php include '../lib/Database.php'; ?>
<?php include '../helpers/Format.php'; ?>
<?php
	$db = new Database();
	$fm = new Format();
?>
<?php
    if (!isset($_GET['deletepostId']) || $_GET['deletepostId'] == NULL) {
        echo "<script>window.location = 'postlist.php'; </script>";
    } else {
        $deleteId = $_GET['deletepostId'];
        $query = "SELECT * FROM tbl_post WHERE id='$deleteId'";
        $getData = $db->select($query);
        if ($getData) {
            while ($deleteimg = $getData->fetch_assoc()) {
                $dellink = $deleteimg['image'];
                unlink($dellink);
            }
        }
        $delquery = "DELETE FROM tbl_post WHERE id='$deleteId'";
        $delPost = $db->delete($delquery);
        if ($delPost) {
            echo "<script>alert('Post Deleted Successfully.');</script>";
            echo "<script>window.location = 'postlist.php'; </script>";
        } else {
            echo "<script>alert('Post not Deleted.');</script>";
            echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>