
    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <h3><?php echo $chapter->getTitle();?> </h3>
              <p><?php echo $chapter->getContent();?> </p>
          </div>
        </div>

      </div>
    </article>

    <hr>

    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <h3>Commentaires</h3>
                <?php foreach ($comments as $comment => $value):?>
                    <?php  $PostId=$value->getPostId()?>
                    <h6>  <?php echo 'Auteur : <span>'.$value->getAuthor() .'</span>';?></h6>
                    <div class="comment">
                        <?php echo $value->getCommentContent();?>
                </div>
                <?php endforeach ;?>
        </div>
      </div>
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">

                <form action="<?php echo HOST.'addComment.html'?>?postId=<?php echo $PostId?> " method="post">

                    <div>
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" />
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div>
                        <input type="submit" />
                    </div>
                </form>

        </div>
    </div>

    <hr>

