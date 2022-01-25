<?php include "inc/header.php"; ?>
<?php
if (!isset($_GET['search']) || $_GET['search'] == NULL) {
    header("location: 404.php");
} else {
    $search = $_GET['search'];
}
?>
<div class="contentsections container">
    <div class="row">
        <div class="maincontent col-md-8">

            <?php
            $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' OR body LIKE '%$search%' ";
            $post = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
            ?>
                    <div class="samepost clear">
                        <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                        <h6><?php echo $fm->formatdate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a>
                        </h6>
                        <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></a>

                        <?php echo $fm->textshorten($result['body']); ?>

                        <div class="readmore clear">
                            <a href="post.php?id=<?php echo $result['id']; ?>"> Read More </a>
                        </div>
                    </div>
                <?php
                }
            } else { ?>
                <p> your search query not found</p>
            <?php } ?>
        </div>
        <?php
        include "inc/sidebar.php";
        ?>
    </div>
</div>
</div>
<?php
include "inc/footer.php";
?>