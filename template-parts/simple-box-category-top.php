<div class="simple-box pressure back-lblue">
    <?php
        $title = single_cat_title('', false);

        if (empty($title)) {
            $title = get_the_title();
        }
    ?>
    <h1><?php echo  $title; ?></h1>
    <?php get_template_part('template-parts/simple-box-category-flex-list'); ?>
</div>