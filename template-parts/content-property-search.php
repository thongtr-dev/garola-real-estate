<form class="property-search-form my-5 px-4 py-5" action="<?php echo esc_url(site_url('/')); ?>" method="GET">
    <?php
    function getMinMaxPrice($property_type, $meta_value)
    {
        $property_type = new WP_Query(array(
            'post_type' => 'property',
            'posts_per_page' => -1,
            'meta_key' => 'rent_sale',
            'meta_value' => $meta_value
        ));
        $prices = [];

        while ($property_type->have_posts()) {
            $property_type->the_post();
            array_push($prices, get_field('property_price'));
        }
        wp_reset_postdata();
        sort($prices);
        return $prices;
    }

    $rent_prices = getMinMaxPrice($rent_properties, 'For Rent');
    $sale_prices = getMinMaxPrice($sale_properties, 'For Sale');

    ?>

    <h4 class="fw-bold">Search Properties</h4>

    <div>
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="For Rent">For Rent</option>
            <option value="For Sale">For Sale</option>
        </select>
    </div>

    <div class="price-range-slider mb-3" data-min_rent_price="<?php echo $rent_prices[0]; ?>" data-max_rent_price="<?php echo $rent_prices[count($rent_prices) - 1]; ?>" data-min_sale_price="<?php echo $sale_prices[0]; ?>" data-max_sale_price="<?php echo $sale_prices[count($sale_prices) - 1]; ?>">
    </div>
    <!-- <div class="min-max-price mb-3 row"> -->
    <input hidden class="form-control" type="number" name="min_price" id="min_price">
    <input hidden class="form-control" type="number" name="max_price" id="max_price">
    <!-- </div> -->

    <div class="row mb-3">
        <div class="col">
            <label for="bed" class="form-label">Bedrooms</label>
            <select name="bed" id="bed" class="form-select">
                <option value="1">1+</option>
                <option value="2">2+</option>
                <option value="3">3+</option>
                <option value="4">4+</option>
                <option value="5">5+</option>
            </select>
        </div>

        <div class="col">
            <label for="bath" class="form-label">Bathrooms</label>
            <select name="bath" id="bath" class="form-select">
                <option value="1">1+</option>
                <option value="2">2+</option>
                <option value="3">3+</option>
                <option value="4">4+</option>
                <option value="5">5+</option>
            </select>
        </div>

    </div>

    <div class="mb-3">
        <?php $features = get_terms(array(
            'taxonomy' => 'property_feature',
            'hide_empty' => true
        ));
        if (!empty($features)) { ?>
            <h5>Property Features</h5>
            <?php
            $features_first_half = array_slice($features, 0, round(count($features) / 2));
            $features_second_half = array_slice($features, round(count($features) / 2));
            ?>
            <div class="row">
                <div class="col">
                    <?php
                    foreach ($features_first_half as $feature) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="feature[]" id="<?php echo $feature->slug; ?>" value="<?php echo $feature->slug; ?>">
                            <label class="form-check-label" for="<?php echo $feature->slug; ?>"><?php echo $feature->name; ?></label>
                        </div>
                    <?php }
                    ?>
                </div>
                <div class="col">
                    <?php
                    foreach ($features_second_half as $feature) { ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="feature[]" id="<?php echo $feature->slug; ?>" value="<?php echo $feature->slug; ?>">
                            <label class="form-check-label" for="<?php echo $feature->slug; ?>"><?php echo $feature->name; ?></label>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
        <?php }
        ?>
    </div>

    <button class="btn btn-primary" type="submit">Search</button>
</form>