<?php
/*
Template Name: Поиск имен
*/

$letters = [];

foreach (range(chr(0xC0), chr(0xDF)) as $b) {
    $letter = iconv('CP1251', 'UTF-8', $b);
    $key = transliterate($letter);

    if (empty($key) || in_array($letter, ['ъ', 'Ъ', 'ь', 'Ь', 'Ы', 'ы'])) {
        continue;
    }

    while (isset($letters[$key])) {
        $key .= 'o';
    }

    $letters[$key] = $letter;
}

global $wpdb;
$all_origins = $wpdb->get_results("SELECT DISTINCT origin FROM names");
$origins = [];

foreach ($all_origins as $origin) {
    $key = transliterate($origin->origin);

    $origins[$key] = $origin->origin;
}

$filtervar = get_query_var('filtervar');
$origin = get_query_var('origin');
$first_letter = get_query_var('first_letter');

if (!empty($filtervar)) {
    if (key_exists($filtervar, $letters)) {
        set_query_var( 'first_letter', $letters[$filtervar] );
    } else {
        set_query_var( 'origin', $origins[$filtervar]);
    }
} else {
    if(!empty($origin)) {
        set_query_var( 'origin', $origins[$origin]);
    }

    if(!empty($first_letter)) {
        set_query_var( 'first_letter', $letters[$first_letter]);
    }
}

if(empty(get_query_var('gender'))) {
    set_query_var('gender', 'any');
}

// Обработка запроса
$gender = (get_query_var('gender')) ? get_query_var('gender') : '';
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$origin = (get_query_var('origin')) ? get_query_var('origin') : '';
$simple_search = [];

if (!empty($origin)) {
    $simple_search[] = [
        'key' => 'origin',
        'value' => $origin,
        'compare' => '='
    ];
}

if (!empty($gender) && $gender !== 'any') {
    $simple_search[] = [
        'key' => 'gender',
        'value' => $gender,
        'compare' => '='
    ];
}

define("DOWNLOAD_XLS_URLS", isset($_GET['download']) && $_GET['download'] == 126 && current_user_can('administrator'));

$args = array(
    'post_type' => 'baby_name',
    'posts_per_page' => DOWNLOAD_XLS_URLS ? 9000 : 48,
    'paged' => $paged,
    'orderby' => [ 'post_title'=>'ASC' ],
    'meta_query' => [
        'relation' => 'AND',
        ...$simple_search
    ],
);

$first_letter = (get_query_var('first_letter')) ? get_query_var('first_letter') : '';

// Если выбрана буква, добавляем условие
if (!empty($first_letter)) {
    add_filter('posts_where', function ($where) use ($first_letter) {
        global $wpdb;
        // Добавляем условие для поиска заголовков, начинающихся с выбранной буквы
        $where .= $wpdb->prepare(" AND post_title LIKE %s", $wpdb->esc_like($first_letter) . '%');
        return $where;
    });
}

$query = new WP_Query($args);

if (DOWNLOAD_XLS_URLS) {
    require_once("SimpleXLSXGen.php");

    $urls = [
        ['url', 'baby_name', 'gender', 'origin', 'first_letter', 'meaning', 'title', 'content'],
    ];

    $filters = [];

    if (empty($gender) || $gender == 'any') {
        $filters['gender'] = [
            'male',
            'any',
            'female',
            'unisex'
        ];
    } else {
        $filters['gender'] = [
            $gender
        ];
    }

    if (empty($origin)) {
        $filters['origin'] = $origins;
    } else {
        $filters['origin'] = [
            array_search($origin, $origins) => $origin
        ];
    }

    if (empty($first_letter)) {
        $filters['first_letter'] = $letters;
    } else {
        $filters['first_letter'] = [
            array_search($first_letter, $letters) => $first_letter
        ];
    }

    foreach ($filters['gender'] as $f_gender) {
        $url_data = array_fill(0, 7, '');

        $gender_url = 'https://momspace.ru/names/' . $f_gender . '/';

        if ($f_gender == 'any') {
            $url_data[0] = 'https://momspace.ru/names/';

            $f_gender = '';
        } else {
            $url_data[0] = 'https://momspace.ru/names/' . $f_gender . '/';
        }

        $url_data[2] = $f_gender;

        $url_data[6] = 'Подобрать имя ребенку';

        $urls[] = $url_data;

        foreach ($filters['origin'] as $f_trans_origin => $f_origin) {
            $url_data = array_fill(0, 7, '');

            $url_data[0] = $gender_url . $f_trans_origin . '/';

            $url_data[2] = $f_gender;

            $url_data[3] = $f_origin;

            $url_data[6] = 'Подобрать имя ребенку';

            $urls[] = $url_data;
        }

        foreach ($filters['first_letter'] as $f_trans_first_letter => $f_first_letter) {
            $url_data = array_fill(0, 7, '');

            $url_data[0] = $gender_url . $f_trans_first_letter . '/';

            $url_data[2] = $f_gender;

            $url_data[4] = $f_first_letter;

            $url_data[6] = 'Подобрать имя ребенку';

            $urls[] = $url_data;
        }

        foreach ($filters['origin'] as $f_trans_origin => $f_origin) {
            foreach ($filters['first_letter'] as $f_trans_first_letter => $f_first_letter) {
                $url_data = array_fill(0, 7, '');

                $url_data[0] = $gender_url . $f_trans_origin . '/' . $f_trans_first_letter . '/';

                $url_data[2] = $f_gender;

                $url_data[3] = $f_origin;

                $url_data[4] = $f_first_letter;

                $url_data[6] = 'Подобрать имя ребенку';

                $urls[] = $url_data;
            }
        }
    }

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_post_meta(get_the_ID(), 'post_id', true);
            $title = get_the_title();

            $url_data = [
                get_permalink($post_id),
                $title,
                get_post_meta(get_the_ID(), 'gender', true),
                get_post_meta(get_the_ID(), 'origin', true),
                mb_substr($title, 0, 1), // Получаем первую букву заголовка
                get_post_meta(get_the_ID(), 'meaning', true),
                $title,
            ];

            $urls[] = $url_data;
        }
    }

    $xlsx = Shuchkin\SimpleXLSXGen::fromArray($urls);
    $xlsx->downloadAs('urls.xlsx');
    exit();
}

get_header();

?>
    <div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="theme-breacrumb-title"> <?php the_title(); ?></h1>
                    <div class="breaccrumb-inner">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="main-container" class="main-container">
        <div class="container name-search">
            <form class="widget row row-cols-2 row-cols-lg-5 g-2 g-lg-3" id="name-search-form" method="GET" onsubmit="return false;" action="<?php echo esc_url(home_url('/names/')); ?>">
                <div class="col">
                    <label for="gender">Пол ребенка:</label>
                    <select class="form-control" name="gender" id="gender">
                        <option value="any">Любой</option>
                        <option value="unisex">Для всех</option>
                        <option value="male">Для мальчика</option>
                        <option value="female">Для девочки</option>
                    </select>
                    <script>
                        document.getElementById('gender').value = '<?php echo get_query_var('gender')?>';
                    </script>
                </div>


                <div class="col">
                    <label for="first_letter">Первая буква:</label>
                    <select class="form-control" name="first_letter" id="first_letter">
                        <option value="">А-Я</option>
                        <?php
                        foreach ($letters as $enl => $b) {
                            echo "<option value='".$enl."'>".$b."</option>";
                        }
                        ?>
                    </select>
                    <script>
                        document.getElementById('first_letter').value = '<?php echo array_search(get_query_var('first_letter'), $letters)?>';
                    </script>
                </div>

                <div class="col">
                    <label for="origin">Происхождение:</label>
                    <select class="form-control" name="origin" id="origin">
                        <option value="">Любые</option>
                        <?php
                        global $wpdb;
                        foreach ($origins as $origin_en => $origin) {
                            echo "<option value='{$origin_en}'>{$origin}</option>";
                        }
                        ?>
                    </select>
                    <script>
                        document.getElementById('origin').value = '<?php echo array_search(get_query_var('origin'), $origins); ?>';
                    </script>
                </div>

                <div class="col">
                    <label for="submit-btn">Найдем лучшие!</label>
                    <button class="input-group-btn btn" id="submit-btn" type="submit">Поиск</button>
                </div>

                <?php
                if (current_user_can( 'administrator' )){
                    ?>
                    <div class="col">
                        <label for="download_urls">Скачать выборку url:</label>
                        <input type="checkbox" id="download_urls" name="download_urls">
                    </div>
                    <?php
                }
                ?>
            </form>
            <script>
                let
                    form = document.getElementById('name-search-form');

                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    let
                        origin = form.querySelector('select[name="origin"]').value,
                        first_letter = form.querySelector('select[name="first_letter"]').value,
                        gender = form.querySelector('select[name="gender"]').value,
                        get = '';

                    let
                        data = [];

                    if (origin !== '') {
                        data.push(origin);
                    }

                    if (first_letter !== '') {
                        data.push(first_letter);
                    }

                    <?php if (current_user_can( 'administrator' )){ ?>
                    let
                        download_urls = form.querySelector('input[name="download_urls"]');

                    if (download_urls.checked) {
                        get = '?download=126';
                    }
                    <?php } ?>

                    if(data.length === 0 && gender === 'any') {
                        document.location.href = '<?php echo esc_url(home_url('/names/')); ?>' + get;
                    } else {
                        data.push('');

                        document.location.href = '<?php echo esc_url(home_url('/names/')); ?>' + gender + '/' + data.join('/') + get;
                    }
                })
            </script>

            <div id="name-results">
                <?php
                if ($query->have_posts()) {
                    echo "<div class='row name-cards row-cols-2 row-cols-lg-5 g-2 g-lg-3'>";

                    while ($query->have_posts()) {
                        $query->the_post();
                        $post_id = get_post_meta(get_the_ID(), 'post_id', true);
                        echo '<div class="name-card col-lg-4 col-sm-4 post-wrapper post-list-medium-content col">';
                        echo '<label>';
                        echo '      <a href="' . get_permalink($post_id) . '">' . get_the_title() . '</a>';
                        echo '      <span>' . get_post_meta(get_the_ID(), 'meaning', true) . '</span>';
                        echo '</label>';
                        echo '</div>';
                    }
                    echo "</div>";

                    ?>
                    <script>
                        Array.from(document.querySelectorAll('.name-card')).forEach((el) => {
                            el.addEventListener('click', (e) => {
                                el.querySelector('a').click();
                            })
                        });
                    </script>
                <?
                // Пагинация
                $big = 999999999; // уникальное число
                ?>
                    <div class="theme-pagination-style">
                        <?php
                        echo paginate_links(array(
                            'next_text' => '<i class="fa fa-long-arrow-right"></i>',
                            'prev_text' => '<i class="fa fa-long-arrow-left"></i>',
                            'screen_reader_text' => ' ',
                            'type'                => 'list',
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages
                        ));
                        ?>
                    </div>
                    <?php
                } else {
                    echo '<p>Имена не найдены.</p>';
                }

                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>