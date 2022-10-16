<div class="agent-avatar">
    <a href="<?php echo esc_url(the_permalink()); ?>"><?php esc_html(the_post_thumbnail()); ?></a>
</div>
<div class="agent-content">
    <h4 class="agent-name"><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h4>
    <p>Real Estate Agent</p>
    <ul class="agent-social">
        <li><a href="<?php esc_html(the_field('facebook')); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="<?php echo esc_html(the_field('twitter')); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
        <li><a href="<?php echo esc_html(the_field('linkedin')); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
    </ul>
    <?php
    $related_properties = new WP_Query(array(
        'post_type' => 'property',
        'meta_key' => 'related_agent',
        'meta_query' => array(
            array(
                'key' => 'related_agent',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'

            )
        )
    ));
    if (is_archive()) { ?>
        <p>Active Listings: <span><?php echo $related_properties->found_posts; ?></span></p>
    <?php } else { ?>
        <ul class="agent-contact">
            <li><a class="agent-contact-content" href="tel:<?php the_field('agent_phone'); ?>"><i class="fas fa-phone-alt"></i><span><?php esc_html(the_field('agent_phone')); ?></span></a></li>
            <li><a class="agent-contact-content" href="mailto:<?php echo the_field('agent_email'); ?>"><i class="far fa-envelope"></i><span><?php esc_html(the_field('agent_email')); ?></span></a></li>
        </ul>
    <?php } ?>
</div>