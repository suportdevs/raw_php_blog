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
    if (!isset($_GET['deletepageId']) || $_GET['deletepageId'] == NULL) {
        echo "<script>window.location = 'index.php'; </script>";
    } else {
        $deletepageId = $_GET['deletepageId'];
        $delquery = "DELETE FROM tbl_page WHERE id='$deletepageId'";
        $delPost = $db->delete($delquery);
        if ($delPost) {
            echo "<script>alert('Page Deleted Successfully.');</script>";
            echo "<script>window.location = 'index.php'; </script>";
        } else {
            echo "<script>alert('Page not Deleted.');</script>";
            echo "<script>window.location = 'index.php';</script>";
        }
    }
?>