<?php
/*
Template Name: Календарь овуляции
*/

get_header();
?>
    <style>
        /* Стили для календаря */
        /* Стили для календаря в 7 столбцов */

        /* Стили для календаря */
        .calendar {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .month h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .month {
            margin-bottom: 30px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .month h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .days {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }

        .day {
            height: 30px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            border-radius: 10px;
            width: 30px;
            color: #333;
        }

        .day.empty {
            border: none;
        }

        .day.today {
            background-color: #f5f5f5;
        }

        .day.weekend {
            background-color: #ffe0e0;
        }

        .day.menstruation {
            background-color: #e85757;
            color: #4f4e4e;
        }

        .day.fertile {
            background-color: #34f5f5;
            color: #2f332f;
        }

        .day.ovulation {
            background-color: #42fa90;
            color: #343438;
        }


    </style>
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

                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-md-0">
                            <div class="card">
                                <div class="card-body">
                                    <form id="ovulation-calendar-form">
                                        <label for="planning" class="form-label">Вы планируете забеременеть в ближайшие
                                            12 месяцев?</label>
                                        <select class="form-select form-control" id="planning">
                                            <option value="да">Да</option>
                                            <option value="нет">Нет</option>
                                        </select>

                                        <label for="cycle-length" class="form-label">Средняя продолжительность цикла (в
                                            днях)</label>
                                        <select class="form-select form-control" id="cycle-length">
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>

                                        <label for="bleed-days" class="form-label">Средняя продолжительность
                                            менструального кровотечения (в днях)</label>
                                        <select class="form-select form-control" id="bleed-days">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="3">4</option>
                                            <option value="3">5</option>
                                        </select>

                                        <label for="first-day" class="form-label">Первый день последней менструации
                                            (ЛМП)</label>
                                        <input type="date" id="first-day" class="form-control"
                                               placeholder="Выберите дату">

                                        <button type="submit" class="btn btn-primary mt-3">Рассчитать</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Правая часть страницы -->
                            <div class="calendar" id="ovulation-calendar">
                                <!-- Календарь будет вставлен здесь -->
                            </div>
                        </div>
                    </div>

                    <script>
                        jQuery(document).ready(function () {
                            jQuery('#ovulation-calendar-form').on('submit', function (event) {
                                event.preventDefault();

                                // Получаем данные из полей ввода
                                var planning = jQuery('#planning').val();
                                var cycleLength = parseInt(jQuery('#cycle-length').val());
                                var bleedDays = parseInt(jQuery('#bleed-days').val());
                                var firstDay = new Date(jQuery('#first-day').val());

                                // Рассчитываем даты менструации, овуляции и фертильного окна
                                var menstruationStart = new Date(firstDay);
                                var menstruationEnd = new Date(menstruationStart.getTime() + (bleedDays) * 86400000);
                                var ovulation = new Date(menstruationStart.getTime() + (cycleLength - 14) * 86400000);
                                var fertileWindowStart = new Date(ovulation.getTime() - 2 * 86400000);
                                var fertileWindowEnd = new Date(ovulation.getTime() + 2 * 86400000);

                                // Обновляем календарь
                                updateCalendar(menstruationStart, menstruationEnd, ovulation, fertileWindowStart, fertileWindowEnd);
                            });

                            function updateCalendar(menstruationStart, menstruationEnd, ovulation, fertileWindowStart, fertileWindowEnd) {
                                var now = new Date();
                                var today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
                                var calendarHTML = '';

                                for (var month = 0; month < 12; month++) {
                                    var monthName = getMonthName(month);
                                    var daysInMonth = new Date(now.getFullYear(), month + 1, 0).getDate();
                                    var firstDayOfMonth = new Date(now.getFullYear(), month, 1).getDay() - 1;
                                    console.log(menstruationStart);
                                    console.log(menstruationEnd);
                                    var calendar = getDaysHTML(firstDayOfMonth, daysInMonth, today, menstruationStart, menstruationEnd, ovulation, fertileWindowStart, fertileWindowEnd, now.getFullYear(), month);



                                    calendarHTML += `
                                        <div class="month">
                                        <h2>${monthName} ${now.getFullYear()}</h2>
                                        ${calendar}
                                        </div>
                                        `;
                                }

                                jQuery('#ovulation-calendar').html(calendarHTML);
                            }

                            function getMonthName(month) {
                                var months = [
                                    'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
                                ];
                                return months[month];
                            }

                            function getDaysHTML(firstDayOfMonth, daysInMonth, today, menstruationStart, menstruationEnd, ovulation, fertileWindowStart, fertileWindowEnd, year, month) {
                                var html = '';
                                var day = 1;

                                for (var i = 0; i < firstDayOfMonth; i++) {
                                    html += '<div class="day empty"></div>';
                                }

                                for (var i = 1; i <= daysInMonth; i++) {
                                    var dayDate = new Date(year, month, day);
                                    var isToday = isSameDay(dayDate, today);
                                    var isWeekend = dayDate.getDay() === 0 || dayDate.getDay() === 6;
                                    var isMenstruation = isBetweenDates(dayDate, menstruationStart, menstruationEnd);
                                    var isOvulation = isSameDay(dayDate, ovulation);
                                    var isFertileWindow = isBetweenDates(dayDate, fertileWindowStart, fertileWindowEnd);

                                    html += `
<div class="day ${getDayClass(isToday, isWeekend, isMenstruation, isOvulation, isFertileWindow)}">${i}</div>
`;


                                    day++;
                                }

                                html = `<div class='days'>${html}</div>`;

                                return html;
                            }

                            function isSameDay(date1, date2) {
                                return date1.getFullYear() === date2.getFullYear() && date1.getMonth() === date2.getMonth() && date1.getDate() === date2.getDate();
                            }

                            function isBetweenDates(date, startDate, endDate) {
                                return date >= startDate && date <= endDate;
                            }

                            function getDayClass(isToday, isWeekend, isMenstruation, isOvulation, isFertileWindow) {
                                var classes = '';

                                if (isToday) {
                                    classes += 'today ';
                                }

                                if (isWeekend) {
                                    classes += 'weekend ';
                                }

                                if (isMenstruation) {
                                    classes += 'menstruation ';
                                }

                                if (isFertileWindow) {
                                    classes += 'fertile ';
                                }

                                if (isOvulation) {
                                    classes += 'ovulation ';
                                }

                                return classes.trim();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>