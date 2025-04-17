<div class="row simple-box extra-padding">
    <h2>Рекомендуемые статьи от Mom space</h2>
    <div class="articles-box type-1">
        <div class="articles-box__search">
            <button class="btn radius-76">Больше статей для тебя</button>
            <label class="box search-box">
                <svg width="23" height="24" viewBox="0 0 23 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M21.127 21.375L19.252 19.5M11.2832 20.4375C12.4528 20.4375 13.6109 20.2071 14.6915 19.7596C15.772 19.312 16.7539 18.6559 17.5809 17.8289C18.4079 17.0019 19.0639 16.0201 19.5115 14.9395C19.9591 13.859 20.1895 12.7008 20.1895 11.5312C20.1895 10.3617 19.9591 9.20353 19.5115 8.12298C19.0639 7.04242 18.4079 6.0606 17.5809 5.23358C16.7539 4.40656 15.772 3.75053 14.6915 3.30295C13.6109 2.85537 12.4528 2.625 11.2832 2.625C8.92112 2.625 6.65578 3.56333 4.98553 5.23358C3.31529 6.90383 2.37695 9.16917 2.37695 11.5312C2.37695 13.8933 3.31529 16.1587 4.98553 17.8289C6.65578 19.4992 8.92112 20.4375 11.2832 20.4375Z"
                          stroke="#FF56AD" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                <input type="text" placeholder="Календарь береме...">
            </label>
        </div>

        <div class="article-box__colmn sidebar">
            <?php
                query_posts(array(
                    'posts_per_page' => 3,
                    'paged' => $_GET['paged'] ?? 1,
                    'category_id' => $_GET['category_id'] ?? -1,
                ));

                get_template_part('template-parts/sidebar-new-posts-2');
            ?>
        </div>

        <?php
        $posts_per_page = 4;
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $offset = ($paged - 1) * $posts_per_page;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
            'offset' => $offset,
            'orderby' => 'date',
            'order' => 'DESC',
            'category' => get_query_var('category_id') ?? -1,
        );

        $new_posts = new WP_Query($args);

        if ($new_posts->have_posts()) {
            while ($new_posts->have_posts()) {
                $new_posts->the_post();
                print_post_card();
            }
            wp_reset_postdata();
        }
        ?>

    </div>
</div>