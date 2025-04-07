<?php
/*
Template Name: Тест на беременость
*/

$test_na_beremenost = [
    'Задержка менструации' => [
        'a' => ['description' => 'Более 1 недели', 'points' => 3],
        'b' => ['description' => 'Менее 1 недели', 'points' => 2],
        'c' => ['description' => 'Нет, у меня регулярный цикл', 'points' => 0],
    ],
    'Изменения в груди' => [
        'a' => ['description' => 'Боль и отечность', 'points' => 3],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Ничего не изменилось', 'points' => 0],
    ],
    'Усталость' => [
        'a' => ['description' => 'Чувствую себя значительно более усталой', 'points' => 2],
        'b' => ['description' => 'Иногда, но не критично', 'points' => 1],
        'c' => ['description' => 'Уровень энергии нормальный', 'points' => 0],
    ],
    'Тошнота или рвота' => [
        'a' => ['description' => 'Часто, особенно утром', 'points' => 3],
        'b' => ['description' => 'Иногда, но не сильно', 'points' => 1],
        'c' => ['description' => 'Не испытываю', 'points' => 0],
    ],
    'Частые мочеиспускания' => [
        'a' => ['description' => 'Да, это стало заметно', 'points' => 2],
        'b' => ['description' => 'Иногда, но не слишком часто', 'points' => 1],
        'c' => ['description' => 'У меня обычная частота', 'points' => 0],
    ],
    'Изменения в аппетите' => [
        'a' => ['description' => 'Странные желания или отвращения к еде', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Аппетит как обычно', 'points' => 0],
    ],
    'Изменения в весе' => [
        'a' => ['description' => 'Значительное увеличение веса', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Вес остался прежним', 'points' => 0],
    ],
    'Чувствительность к запахам' => [
        'a' => ['description' => 'Некоторые запахи вызывают отвращение', 'points' => 2],
        'b' => ['description' => 'Иногда, но не критично', 'points' => 1],
        'c' => ['description' => 'Запахи не изменились', 'points' => 0],
    ],
    'Изменения в настроении' => [
        'a' => ['description' => 'Стала более эмоциональной или раздражительной', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Настроение в норме', 'points' => 0],
    ],
    'Боли внизу живота' => [
        'a' => ['description' => 'Часто, иногда сильные', 'points' => 2],
        'b' => ['description' => 'Небольшие спазмы', 'points' => 1],
        'c' => ['description' => 'Ничего не беспокоит', 'points' => 0],
    ],
    'Сонливость' => [
        'a' => ['description' => 'Часто хочу спать', 'points' => 2],
        'b' => ['description' => 'Иногда, но это не мешает', 'points' => 1],
        'c' => ['description' => 'Уровень энергии в норме', 'points' => 0],
    ],
    'Изменения в коже' => [
        'a' => ['description' => 'Появились высыпания или изменения', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Кожа как обычно', 'points' => 0],
    ],
    'Чувство тяжести внизу живота' => [
        'a' => ['description' => 'Это стало заметно', 'points' => 2],
        'b' => ['description' => 'Иногда, но не сильно', 'points' => 1],
        'c' => ['description' => 'Ничего не ощущаю', 'points' => 0],
    ],
    'Частые головные боли' => [
        'a' => ['description' => 'Это стало происходить чаще', 'points' => 1],
        'b' => ['description' => 'Иногда, но не критично', 'points' => 0],
        'c' => ['description' => 'Головные боли не беспокоят', 'points' => 0],
    ],
    'Изменения в либидо' => [
        'a' => ['description' => 'Значительно изменилось', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Все как обычно', 'points' => 0],
    ],
    'Проблемы с пищеварением' => [
        'a' => ['description' => 'Да, возникли проблемы', 'points' => 2],
        'b' => ['description' => 'Небольшие изменения', 'points' => 1],
        'c' => ['description' => 'Пищеварение в норме', 'points' => 0],
    ],
];

$test_na_beremenost_result = [
    10 => 'Вероятность беременности низка. Обратитесь к врачу при наличии сомнений.',
    20 => 'Существует вероятность беременности. Рекомендуем сделать тест или проконсультироваться с врачом.',
    36 => 'Большая вероятность беременности. Сделайте тест и обратитесь к врачу для подтверждения.',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalPoints = 0;
    $is_test = false;

    foreach ($test_na_beremenost as $question => $answers) {
        $question = str_replace(' ', '_', $question);
        if (isset($_POST[$question])) {
            $selectedAnswer = $_POST[$question];
            $totalPoints += $answers[$selectedAnswer]['points']; // Суммируем баллы за выбранные ответы
            $is_test = true;
        }
    }

    if ($is_test) {
        $result = null;
        $result_p = 0; // Инициализируем переменную для процента вероятности

        // Определяем результат на основе набранных баллов
        foreach ($test_na_beremenost_result as $points => $t_result) {
            if ($totalPoints <= $points) {
                $result = $t_result; // Получаем результат

                // Рассчитываем процент вероятности
                if ($points > 8) {
                    $result_p = (int) (25 + (($totalPoints - 10) / (36 - 10)) * 70); // Процент
                } else {
                    $result_p = 0; // Если баллы меньше или равны 8, вероятность 0%
                }

                break;
            }
        }

        // Если результат не найден, устанавливаем значение по умолчанию
        if ($result === null) {
            $result = 'Результат не определен. Пожалуйста, проверьте ваши ответы.';
        }

        // Формируем ответ для JSON
        $response = [
            'error' => false,
            'result' => $result,
            'result_p' => $result_p, // Процент вероятности
            'totalPoints' => $totalPoints
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    } else {
        // Если тест не был пройден, возвращаем ошибку
        echo json_encode(['error' => true, 'message' => 'Тест не был пройден.'], JSON_UNESCAPED_UNICODE);
    }

    exit();
}

get_header();
?>

    <div class="theme-breadcrumb__Wrapper theme-breacrumb-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="theme-breacrumb-title"><?php the_title(); ?></h1>
                    <div class="breaccrumb-inner"></div>
                </div>
            </div>
        </div>
    </div>

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="content-area mb-4">
                        <?php the_content(); ?>
                    </div>

                    <form method="POST" class="mt-4" id="main-form" onsubmit="return:false;">
                        <?php foreach ($test_na_beremenost as $question => $answers): ?>
                            <fieldset class="border p-3 mb-3">
                                <legend class="w-auto"><?php echo $question; ?></legend>
                                <?php foreach ($answers as $key => $answer): ?>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="<?php echo str_replace(' ', '_', $question); ?>"
                                                   value="<?php echo $key; ?>" required>
                                            <?php echo $answer['description']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </fieldset>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>

                    <!-- Модальное окно для отображения результатов -->
                    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document"> <!-- Добавлено modal-dialog-centered -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="resultModalLabel">Результаты теста</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p id="resultText"></p>
                                    <p id="resultProbability"></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        let form = jQuery('#main-form');

                        form.submit(function (e) {
                            e.preventDefault();

                            jQuery.ajax({
                                type: "POST",
                                url: '',
                                data: form.serialize(), // сериализует элементы формы
                                success: function (data) {
                                    if (!data.error) {
                                        data = JSON.parse(data);

                                        // Устанавливаем текст результата и вероятность
                                        jQuery('#resultText').text(data.result);
                                        jQuery('#resultProbability').text('Вероятность беременности: ' + data.result_p + '%');

                                        // Показываем модальное окно
                                        jQuery('#resultModal').modal('show');
                                    } else {
                                        alert(data.message); // Показываем сообщение об ошибке
                                    }
                                }
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>