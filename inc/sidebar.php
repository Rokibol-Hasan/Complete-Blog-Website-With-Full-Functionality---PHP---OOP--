<div class="col-md-4">
    <div class="samesidebar  card ml-2 p-2">
        <h2>Categories</h2>
        <ul>
            <?php
            $query = "select * from tbl_cat";
            $category = $db->select($query);
            if ($category) {
                while ($result = $category->fetch_assoc()) { ?>
                    <li> <a href="posts.php?category=<?php echo $result['id']; ?>"><?php echo $result['name'] ?></a></li>
                <?php }
            } else { ?>
                <li>No category created!!</li>
            <?php } ?>
        </ul>
    </div>

    <div class="samesidebar card ml-2 p-2">
        <h2>Latest articles</h2>

        <?php
        $query = "select * from tbl_post limit 5";
        $post = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
        ?>
                <div class="popular">
                    <div class="inner-popular mt-3">
                        <h3><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
                        <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>
                        <?php echo $fm->textshorten($result['body'], 120); ?>
                    </div>
                </div>
        <?php
            }
        } else {
            header("location:404.php");
        } ?>

    </div>
</div>