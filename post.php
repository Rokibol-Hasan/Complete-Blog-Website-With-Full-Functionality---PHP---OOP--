<?php
include "inc/header.php";
?>
<?php
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header("location: 404.php");
} else {
    $id = $_GET['id'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="maincontent">
                <div class="about">
                    <?php
                    $query = "select * from tbl_post where id = $id ";
                    $post = $db->select($query);
                    if ($post) {
                        while ($result = $post->fetch_assoc()) {
                    ?>
                            <h2><?php echo $result['title']; ?></h2>
                            <h6><?php echo $fm->formatdate($result['date']); ?>, By <a href="#"><?php echo $result['author']; ?></a></h6>
                            <div class="post-image"><img src="admin/<?php echo $result['image']; ?>" alt="post image" /></div>
                            <div class="post-body"><?php echo$result['body']; ?></div> 



                            <div class="relatedposts">
                                <h2>Related articles</h2>
                                <?php
                                $catid = $result['cat'];
                                $queryrelated = "select * from tbl_post where cat = '$catid' limit 6 ";
                                $relatedpost = $db->select($queryrelated);
                                if ($relatedpost) {
                                    while ($rresult = $relatedpost->fetch_assoc()) {
                                ?>
                                        <ul>
                                            <li>
                                                <a href="post.php?id=<?php echo $rresult['id']; ?> "><img src="admin/<?php echo $rresult['image']; ?>" alt="post image" /></a>
                                            </li>
                                        </ul>
                                <?php
                                    }
                                } else {
                                    echo "No related post available!!";
                                } ?>
                            </div>
                    <?php }
                    } else {
                        header("Location:404.php");
                    } ?>
                </div>
            </div>
        </div>
        <?php
        include "inc/sidebar.php";
        ?>
    </div>
</div>

<?php
include "inc/footer.php";
?>