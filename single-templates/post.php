<?php
/**
 * The template for displaying 404.
 *
 * @package AmberyTheme
 * @version 1.0.0
 */

get_header();
get_template_part('template-parts/breadcrumbs.php');
?>
    <div class="simple-box pressure">
        <?php while (have_posts()) : the_post(); ?>
            <div data-id="article-content" class="article-box type-1">
                <h1><?php the_title(); ?></h1>
                <div class="article-box__social">
                    <?php
                    $post_id = get_the_ID(); // Получаем ID текущего поста
                    $categories = get_post_categories($post_id); // Получаем категории

                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            echo '<div class="box rubric back-lpink"><a href="' . $category['link'] . '" spa>' . $category['name'] . '</a></div>'; // Выводим категории
                        }
                    }
                    ?>
                    <div class="date"><?php the_date(); ?></div>
                    <div class="social">
                        <span class="social__likes">42</span>
                        <span class="social__comments">11</span>
                        <span class="social__views">256</span>
                    </div>
                    <div class="article-box__share">Поделиться</div>
                </div>
                <?php
                if (has_post_thumbnail()) {
                    echo '<div class="article-box__main-img">';
                    the_post_thumbnail('full');
                    echo '</div>';
                }
                ?>
                <div class="article-content padding-bottom-30">
                    <?php the_content(); ?>

                    <?php
                    $dwm = get_field('display_warning_message');

                    if ($dwm) {
                     ?>
                        <div class="article-content__border-text article-content__warning">
                            <b>ВАЖНО!</b> Статья не является медицинской рекомендацией. Для получения подробной информации
                            обязательно обратитесь к врачу!
                        </div>
                            <?php
                    }
                    ?>

                </div>

                <div loadVisible="true" class="article-box__colmn sidebar" domLoader="<?php echo buildDomLoaderUrl('sidebar-for-post'); ?>"></div>

                <div loadVisible="true" class="reaction-like" domLoader="<?php echo buildDomLoaderUrl('reaction-like', 'post', []); ?>"></div>

                <?php if ( has_tag() ) : ?>
                    <div class="article-box__tags">
                        <h3>Теги</h3>
                        <div>
                            <?php
                                $tags = get_the_tags();
                                if ($tags) {

                                    foreach ($tags as $tag) {
                                        $tag_link = get_tag_link($tag->term_id); // Получаем ссылку на страницу тега
                                        $tag = mb_ucwords(esc_html($tag->name));
                                        $tag = str_replace(' ', '', $tag);
                                        echo '<a spa href="'.$tag_link.'" class="simple-tag">#' . $tag . '</a> ';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div loadVisible="true" class="article-box__list-of-references" domLoader="<?php echo buildDomLoaderUrl('article-box-list-of-references', 'post', []); ?>"></div>

                <div loadVisible="true" class="comments-box" domLoader="<?php echo buildDomLoaderUrl('comments-box'); ?>"></div>
            </div>
        <?php endwhile; ?>
    </div>
    <div class="simple-box pressure padding-bottom-69 back-lblue" loadVisible="true" domLoader="<?php echo buildDomLoaderUrl('simple-box-posts-3-read');?>"></div>

<?php get_footer();