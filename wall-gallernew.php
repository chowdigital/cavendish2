




<div class="wall wall-empty"><div class="wrapper"></div>
<section>
  <div class="fotorama" data-width="1024" data-ratio="700/467" data-max-width="100%" data-nav="thumbs" data-allowfullscreen="true">
    <?php $images = get_field( 'gallery' );
      if( $images ):
        foreach( $images as $image ): ?>
          <img src="<?php echo $image['url']; ?>" />
        <?php
        endforeach;
      endif;
    ?>
  </div>
</section>
</div>
