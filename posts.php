<?php include 'inc/header.php'; ?>

<?php 
if (!isset($_GET['cetagory']) || $_GET['cetagory'] == NULL) {
	header("Location: 404.php");
} else {
	$cetagory = $_GET['cetagory'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "select * from tbl_post where cat=$cetagory";
					$post = $db->select($query);
					if ($post) {
                        while($result = $post->fetch_assoc()){ ?>
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
				
				    <?php } } else { 
						echo "No post avaiable in this cetagory ";
					} ?>
			</div>
		</div>
			<?php include 'inc/sidebar.php'; ?>
	</div>
<?php include 'inc/footer.php'; ?>