<?php
global $post;

?>
<div class="mnc-item-weitere-stories">
    <a href="<?= get_permalink( $post->ID ) ?>" title="Kompletten lesen für <?= get_the_title( $post->ID ) ?>">
        <div class="mnc-terms">
            [wpbb post:terms_list taxonomy='category' separator=', ' linked='no']
        </div>
        <h4 class="uppercase"><?= get_the_title(); ?></h4>
        <div class="mnc-excerpt"><?= get_the_excerpt( $post ); ?></div>
    </a>

</div>
