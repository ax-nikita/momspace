<?php
/**
 * The template for displaying 404.
 *
 * @package AmberyTheme
 * @version 1.0.0
 */

get_header();
get_template_part('template-parts/breadcrumbs');
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
                    <div class="social">
                        <span class="social__likes">42</span>
                        <span class="social__comments">11</span>
                        <span class="social__views">256</span>
                    </div>
                    <div class="article-box__share">Поделиться</div>
                </div>
                <div class="article-box__main-img">
                    <?php the_post_thumbnail('full'); ?>
                </div>
                <div class="article-content padding-bottom-30">
                    <?php the_content(); ?>

                    <div class="article-content__border-text article-content__warning">
                        <b>ВАЖНО!</b> Статья не является медицинской рекомендацией. Для получения подробной информации
                        обязательно обратитесь к врачу!
                    </div>
                </div>

                <div class="article-box__colmn right-colmn">
                    <div class="box radius-30 back-lpink article-box__table-of-contents pressure">
                        <h3>Содержание</h3>
                    </div>
                    <?php
                    get_template_part('template-parts/right-colomn-new-posts');
                    get_template_part('template-parts/right-colomn-popular-posts');
                    ?>
                </div>

                <div class="reaction-like">
                    <h3>Поделиться в соц.сетях</h3>
                    <div class="reaction-like__list">
                        <div class="box number like">42</div>
                        <div>
                            <img src="/assets/images/tg.png" alt="tg">
                        </div>
                        <div>
                            <img src="/assets/images/vk.png" alt="vk">
                        </div>
                        <div>
                            <img src="/assets/images/ya.png" alt="ya">
                        </div>
                        <div>
                            <img src="/assets/images/ok.png" alt="ok">
                        </div>
                        <div>
                            <img src="/assets/images/watsapp.png" alt="watsapp">
                        </div>
                        <div>
                            <img src="/assets/images/mailru.png" alt="mailru">
                        </div>
                        <div>
                            <img src="/assets/images/link.png" alt="link">
                        </div>
                    </div>
                </div>
                <div class="article-box__tags">
                    <h3>Теги</h3>
                    <div>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>

                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                        <span class="simple-tag">#Беременность</span>
                    </div>
                </div>
                <div class="article-box__list-of-references">
                    <h3>Список литературы и авторитетных источников</h3>
                    <div>
                        <input type="checkbox" class="open">
                        <ul>
                            <li><b>Завьялова С.А.</b> - Питание Беременных и кормящих женьщин. - M.:ACT. 2020. (о
                                составе рациона, полезных продуктах, контроле веса)
                            </li>
                            <li><b>Завьялова С.А.</b> - Питание Беременных и кормящих женьщин. - M.:ACT. 2020. (о
                                составе рациона, полезных продуктах, контроле веса)
                            </li>
                            <li><b>Завьялова С.А.</b> - Питание Беременных и кормящих женьщин. - M.:ACT. 2020. (о
                                составе рациона, полезных продуктах, контроле веса)
                            </li>
                            <li><b>Завьялова С.А.</b> - Питание Беременных и кормящих женьщин. - M.:ACT. 2020. (о
                                составе рациона, полезных продуктах, контроле веса)
                            </li>
                        </ul>
                        <div class="article-box__list-of-references__filter"></div>
                    </div>
                    <button data-id="custom-label" for=".open" class="box btn back-white">Показать еще</button>
                </div>
                <div class="comments-box">
                    <h3>Поделитесь своим опытом или задайте вопрос</h3>

                    <p>Ваши мысли и рекомедации могут быть полезны другим</p>
                    <div class="comments-box__text-area" contenteditable="true">
                        Ваш комментарий к статье
                    </div>
                    <button class="box btn">Оставьте ваш комментарий</button>

                    <h3 class="comments-box__coments-header">Комментарии <span
                                class="comments-box__coments-counter">2</span></h3>

                    <div class="comments-box__list">
                        <div class="comment">
                            <span class="comment__author">Климова Дарья</span>
                            <span class="comment__date">03.04.2025</span>
                            <p>Секрет вкусных и красивых кексов — форма Гроя. Так уж получилось, что ко мне в руки не
                                так давно попала эта форма, мне сестра мужа ее с отдыха привезла в качестве сувенира.
                                Узор красивый и необычный, на готовых кексах он четко виден. Пропекается все отлично,
                                ничего не пригорает, а по остывании выпечка буквально выпрыгивает к вам в тарелочку.
                                Вкус всегда получается отменный, тесто поднимается отлично и получается воздушным и на
                                удивление не сухим. Муж сказал, что у меня действительно лучше стало получаться и
                                поэтому чаще просит готовить кексы)</p>
                        </div>
                        <div class="comment">
                            <span class="comment__author">Климова Дарья</span>
                            <span class="comment__date">03.04.2025</span>
                            <p>Секрет вкусных и красивых кексов — форма Гроя. Так уж получилось, что ко мне в руки не
                                так давно попала эта форма, мне сестра мужа ее с отдыха привезла в качестве сувенира.
                                Узор красивый и необычный, на готовых кексах он четко виден. Пропекается все отлично,
                                ничего не пригорает, а по остывании выпечка буквально выпрыгивает к вам в тарелочку.
                                Вкус всегда получается отменный, тесто поднимается отлично и получается воздушным и на
                                удивление не сухим. Муж сказал, что у меня действительно лучше стало получаться и
                                поэтому чаще просит готовить кексы)</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php
$current_category = get_queried_object();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'comment_count', // Сортировка по количеству комментариев
    'order' => 'DESC',
    'cat' => $current_category->term_id,
);
$new_posts = new WP_Query($args);

if ($new_posts->have_posts()) {
    ?>
    <div class="simple-box pressure padding-bottom-69 back-lblue">
        <h2 class="font-size-1-5 padding-bottom-30"><b>Сегодня читают</b></h2>
        <div class="simple-box__wrapper articles-box type-3">
            <?php

            while ($new_posts->have_posts()) {
                $new_posts->the_post();
                print_post_card('green border-0 color-tag');
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
    <?php
}
?>
    <img src="/assets/images/design-singe.png" class="test" alt="Пост 1">
<?php get_footer();