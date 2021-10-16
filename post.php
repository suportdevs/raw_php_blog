<?php include 'inc/header.php'; ?>

<?php 
if (!isset($_GET['id']) || $_GET['id'] == NULL) {
	header("Location: 404.php");
} else {
	$id = $_GET['id'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "select * from tbl_post where id=$id";
					$post = $db->select($query);
					if ($post) {
						while($result = $post->fetch_assoc()){ ?>
						<h2><?php echo $result['title']; ?></h2>
						<h4><?php echo $fm->formatDate($result['date']); ?> || <a href="#"><?php echo $result['author']; ?></a> || <a href=""><?php echo $result['tags']; ?></a></h4>
						<img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
						<p><?php echo $result['body']; ?></p>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
						$catId = $result['cat'];
						$relatedquery = "select * from tbl_post where cat='$catId' order by rand() limit 6";
						$relatedpost = $db->select($relatedquery);
						if ($relatedpost) {
							while($relatedresult = $relatedpost->fetch_assoc()){							
					?>
					<a href="post.php?id=<?php echo $relatedresult['id']; ?>"><img src="admin/<?php echo $relatedresult['image']; ?>" alt="post image"/></a>
					<?php } } else { echo "Related Post not Found !!"; } ?>
				</div>
				<?php } } else { header("Location: 404.php"); } ?>
			</div>
		</div>
			<?php include 'inc/sidebar.php'; ?>
	</div>

<?php include 'inc/footer.php'; ?>