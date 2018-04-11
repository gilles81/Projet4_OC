
<div class="container">
    <?php foreach ($chapters as $chapter):?>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <a href="<?php echo HOST;?>post.html?idPost=<?php echo $chapter->getPostId();?>"

                    <h2 class="post-title">
                        <?php echo $chapter->getTitle() ;?>
                    </h2>
                    <h3 class="post-subtitle">
                        <?php echo substr( $chapter->getContent(),0,120) ;?>
                        <span>  ...</span>
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Jean Forteroche</a>
                    <?php echo $chapter->getCreationDate();?></p>
            </div>
            <hr>


        </div>
    </div>
    <?php endforeach ;?>
    <!-- Pager -->
    <div class="clearfix">
        <a class="btn btn-primary float-right" href="#">Ancien Post &rarr;</a>
    </div>

</div>
<hr>




