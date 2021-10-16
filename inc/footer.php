<div class="footersection templete clear">
	<div class="footermenu clear">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About</a></li>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="policy.php">Privacy Policy</a></li>
		</ul>
	</div>
	<?php
		$query = "SELECT * FROM tbl_footer WHERE id='1'";
		$copyright = $db->select($query);
		if ($copyright) {
			while ($result = $copyright->fetch_assoc()) {
	?>
	<p>&copy; <?php echo date('Y'); ?> <?php echo $result['copyright']; ?></p>
	<?php } } ?>
	</div>
	<div class="fixedicon clear">
	<?php
		$query = "SELECT * FROM tbl_social WHERE id='1'";
		$social_link = $db->select($query);
		if ($social_link) {
			while ($result = $social_link->fetch_assoc()) {
	?>
		<a href="<?php echo $result['facebook']; ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $result['twitter']; ?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $result['linkedin']; ?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $result['googleplus']; ?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
	<?php } } ?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>