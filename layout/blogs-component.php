<?php
while($infor_blogs = mysqli_fetch_assoc($allblogs)){
    ?>
    <div class="blog">
        <div class="blog-image">
            <a href="./fashion-blogs.php?<?php echo $infor_blogs['keyword']; ?>=<?php $title = $infor_blogs['title']; $fix_title = explode(' ', $title); $newtitle = implode('-', $fix_title); echo $newtitle; ?>&id=<?php echo $infor_blogs['id'];?>"><img src="<?php echo $infor_blogs['image']; ?>" alt="Blogs New Style"></a>
        </div>
        <div class="blog-information">
            <div class="blog-category-date">
                <a href="./fashion-blogs.php?<?php echo $infor_blogs['keyword']; ?>=<?php $title = $infor_blogs['title']; $fix_title = explode(' ', $title); $newtitle = implode('-', $fix_title); echo $newtitle; ?>&id=<?php echo $infor_blogs['id'];?>"><span><?php echo $infor_blogs['categoryblog'];?></span></a>
                <a href="./fashion-blogs.php?<?php echo $infor_blogs['keyword']; ?>=<?php $title = $infor_blogs['title']; $fix_title = explode(' ', $title); $newtitle = implode('-', $fix_title); echo $newtitle; ?>&id=<?php echo $infor_blogs['id'];?>"><span><?php echo $infor_blogs['createdate'];?></span></a>
            </div>
            <div class="blog-title">
                <a href="./fashion-blogs.php?<?php echo $infor_blogs['keyword']; ?>=<?php $title = $infor_blogs['title']; $fix_title = explode(' ', $title); $newtitle = implode('-', $fix_title); echo $newtitle; ?>&id=<?php echo $infor_blogs['id'];?>"><span><?php echo $infor_blogs['title'];?></span></a>
            </div>
            <div class="blog-description">
                <a href="./fashion-blogs.php?<?php echo $infor_blogs['keyword']; ?>=<?php $title = $infor_blogs['title']; $fix_title = explode(' ', $title); $newtitle = implode('-', $fix_title); echo $newtitle; ?>&id=<?php echo $infor_blogs['id'];?>"><span><?php echo $infor_blogs['description'];?></span></a>
            </div>
        </div>
    </div>
    <?php
}
?>