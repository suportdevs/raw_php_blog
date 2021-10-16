<div class="sidebar clear">
    <div class="samesidebar clear">
        <h2>Categories</h2>
            <ul>
                <?php
					$query = "select * from tbl_cetagory";
					$cetagory = $db->select($query);
					if ($cetagory) {
						while($result = $cetagory->fetch_assoc()){ ?>
                    <li><a href="posts.php?cetagory=<?php echo $result['id']; ?>"><?php echo $result['name']; ?></a></li>
                <?php } } else { ?>
                    <li>No cetarogy Created !</li>
                <?php } ?> <!--End if loop-->						
            </ul>
    </div>
    
    <div class="samesidebar clear">
        <h2>Latest articles</h2>
            <?php
                $query = "select * from tbl_post limit 5";
                $post = $db->select($query);
                if ($post) {
                    while($result = $post->fetch_assoc()){ ?>
            <div class="popular clear">                       
                <h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
                <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                <p><?php echo $fm->textShorten($result['body'], 80); ?></p>	
            </div>
                    <?php } } else { header("Loaction: 404.php");} ?>
    </div>			
</div>