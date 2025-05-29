<main id="container">
    <div class="news-cont">
        <ul class="slider">
            <li class="slider-item slider-item01"></li>
            <li class="slider-item slider-item02"></li>
            <li class="slider-item slider-item03"></li>
        </ul>
        <div class="news-box">
            <h1 class="news-title pop-3">What's New.</h1>
            <div class="news-link pop-3 news-open">all view</div>
            <?php global $news_array; ?>
            <?php if(isset($news_array)): ?>
            <?php for($i=0;$i<2;$i++) : ?>
            <a href="" class="news-list">
                <span
                    class="news-day"><?php echo $news_array[$i]['newsDay']; ?></span><?php echo $news_array[$i]['newsTitle']; ?>
            </a>
            <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>
    <section class="news">
        <h1 class="pop-3 all-news">What's all News</h1>
        <div class="news-area">
            <?php if(isset($news_array)): ?>
            <?php foreach($news_array as $news) : ?>
            <a href="" class="news-list">
                <span class="news-day"><?php echo $news['newsDay']; ?></span>
                <p class="news-name">
                    <?php echo $news['newsTitle']; ?>
                </p>
            </a>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <section id="me" class="about-me">
        <h1 class="pop-3 title-me">About Me</h1>
        <div class="pop-2 back">My Profile</div>
        <div class="prof-content">
            <div class="my-img">
                <img src="img/img-me.png" alt="" />
            </div>
            <div class="my-prof">
                <div class="my-disc">
                    <p>
                        三重県在住のそーすけです!
                    </p>
                    <p>
                        コーヒーが好きなので自分のメモとしてブログ更新してきます
                    </p>
                    <p>
                        おすすめの店とかも教えてくれると嬉しいです！！
                    </p>
                </div>
                <a href="" class="my-sns pop-3">Follow Me</a>
            </div>
        </div>
        <a href="" class="prof-link pop-3">My Profile</a>
    </section>
    <section id="blog" class="about-blog">
        <h1 class="title-blog pop-3">My Blog</h1>
        <p class="sub-blog pop-3">気まぐれ更新日記</p>
        <div class="pop-2 back2">My Blog</div>
        <div class="blog-container flex">
            <?php if(isset($blog_array)):?>
            <?php foreach($blog_array as $blog):?>
            <div class="blog-box">
                <div class="blog-img" style="background-image: url(blog/img/<?=$blog['imgLink'];?>);"></div>
                <time class="pop-3 blog-day"><?=$blog['create_at'];?></time>
                <a href="./blog/<?=$blog['urlLink'];?>" class="blog-name"><?=$blog['title'];?>
                </a>
            </div>
            <?php endforeach;?>
            <?php else:?>
            <?php require 'blog.php';?>
            <?php endif;?>
        </div>

        <a href="./blog/" class="blog-link pop-3">Read More</a>
    </section>
</main>