<div class="article-box__colmn sidebar">
    <div data-id="table-of-contents" hidden="hidden" class="box radius-30 back-lpink article-box__table-of-contents pressure">
        <h3>Содержание</h3>
    </div>
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