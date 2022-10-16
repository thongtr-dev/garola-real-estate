<div class="property-item">
    <div class="property-item-thumbnail">
        <a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_post_thumbnail('propertySquare')); ?></a>
    </div>
    <div class="property-item-content overflow-auto">
        <h5><a href="<?php esc_url(the_permalink()); ?>"><?php esc_html(the_title()); ?></a></h5>
        <div class="dot-hr"></div>
        <span class="float-start"><b>Area :</b> <?php esc_html(the_field('property_area')); ?><b class="property-info-unit">m<sup>2</sup></b></span>
        <span class="property-price float-end">$<?php esc_html(the_field('property_price'));
                                                if (get_field('rent_sale') == 'For Rent') {
                                                    echo ' / Month';
                                                }
                                                ?></span>
    </div>
</div>