
<?php foreach($chapters as $post):
    ?>
    <div class="post">
        <h2><?php echo $post->getTitle();?></h2>
        <div class="postContent" ><?php echo $post->getContent();?></div>
        <button>
            <a class ="commentLink" href="">Commentaire</a>
        </button>
    </div>
<?php endforeach;?>



