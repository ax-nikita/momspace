<div class="sidebar">
    <?php
    query_posts(array(
        'posts_per_page' => 3,
        'paged' => $_GET['paged'] ?? 1,
        'category_id' => $_GET['category_id'] ?? -1,
    ));

    get_template_part('template-parts/sidebar-new-posts');
    get_template_part('template-parts/sidebar-popular-posts');
    ?>
</div>
