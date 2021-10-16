<?php include 'inc/header.php'; ?>

<?php 
if (!isset($_GET['search']) || $_GET['search'] == NULL) {
	header("Location: 404.php");
} else {
	$search = $_GET['search'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear custom">
            <?php
                $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%'";
                $post = $db->select($query);
                if ($post) {
                    while($result = $post->fetch_assoc()){ ?>
                    
                    <div class="search-header clear"><p>Search Result for <?php echo $search; ?></p></div>
                    <div class="samepost clear">
                        <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                        <h4><?php echo $fm->formatDate($result['date']); ?> || <a href="#"><?php echo $result['author']; ?></a> || <a href="#"><?php echo $result['tags']; ?></a></h4>
                        <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                        <p>
                            <?php echo $fm->textShorten($result['body']); ?>
                        </p>
                        <div class="readmore clear">
                            <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                        </div>
                    </div>
            
                <?php } } else { ?>
                    <p style="font-size: 30px; padding: 50px;">Your Search keyword is not Found !!</p>
                <?php }?>
		</div>
			<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>