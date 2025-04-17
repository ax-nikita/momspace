function hide_all_dropdown() {
    Array.from(document.querySelectorAll('.nav-item.active')).forEach((old_el) => {
        old_el.classList.remove('active');
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let
        ul = document.querySelector('#navbarNav > ul'),
        listItems = document.querySelectorAll('#navbarNav > ul > li');

    Array.from(listItems).forEach((item, index) => {
        if (index > 0) { // Пропускаем первый элемент
            const separator = document.createElement('li');
            separator.classList.add('separator');
            ul.insertBefore(separator, item); // Добавляем сепаратор перед элементом
        }
    });

    Array.from(document.querySelectorAll('.nav-link.dropdown-toggle')).forEach(el => {
        let parent = el.parentNode;

        el.addEventListener('click', () => {
            if (parent.classList.contains('active')) {
                hide_all_dropdown();
            } else {
                hide_all_dropdown();
                el.parentNode.classList.add('active');
            }
        });

        parent.querySelector('.dropdown-menu').addEventListener('mouseleave', () => {
            if (parent.classList.contains('active')) {
                hide_all_dropdown();
            }
        });
    });

    document.addEventListener('click', (e) => {
        if (!e.target || !['nav-item', 'nav-link'].includes(e.target.classList[0])) {
            hide_all_dropdown();
        }
    })

    document.querySelector(".extra-menu").addEventListener("mouseleave", function () {
        document.getElementById('open-nav-menu').checked = false;
    });


    new axModularFunction('article-content', (article) => {


        let
            tags = article.axQS('.article-content__tags');

        if (tags) {
            tags.remove();
        }

        article.axQSA('.box.number.like,.social__likes').forEach(el => el.addEventListener('click', function () {
            this.classList.add('active');
        }), true)


    });

    new axModularFunction('pagination', (el) => {
        let
            pagination = el.axQS('.theme-pagination-style'),
            btn = el.axQS('.theme-pagination-style__more .btn');

        if (btn) {
            let
                link = pagination.axQS('.current').parentNode.nextSibling.axQS('a').axAttribute('href') + '?domLoader=';

            let
                loader = new axLoader(link);

            loader.setSelector('.content');
            loader.content;

            btn.addEventListener('click', () => {
                loader.setSelector('.content');
                el.parentNode.insertBefore(loader.content, el);

                loader.setSelector('[data-id="pagination"]');
                let
                    new_pagination = loader.content;

                new_pagination.classList = el.classList;
                el.replaceWith(new_pagination);
            });
        }
    });

    new axModularFunction('list-of-references', (el) => {
        let
            f = () => {
                let
                    article = el.parentNode;

                if (!article.classList.contains('article-box')) {
                    setTimeout(f, 20);
                    return;
                }

                let
                    list = article.axQS('.article-content__list-of-references');

                if (list) {
                    let
                        ul = el.axQS('ul');

                    ul.replaceWith(list);
                } else {
                    el.remove();
                }
            };
        f();
    });

    new axModularFunction('table-of-contents', (el) => {
        let
            f = () => {
                let
                    article = el.parentNode.parentNode;

                if (!article.classList.contains('article-box')) {
                    setTimeout(f, 20);
                    return;
                }

                let
                    table_of_contents = article.axQS('.article-box__table-of-contents');


                if (table_of_contents) {
                    let
                        id_counter = 1;
                    article.axQSA('.article-content h3, .article-content h2').forEach(header => {
                        let
                            id = 'h-' + id_counter++,
                            header_link = new axNode('a'),
                            header_h = new axNode('h4');

                        header_link.axClass('h2');
                        header_h.axVal(header.axVal());

                        header_link.axAttribute('href', '#' + id);
                        header.axAttribute('id', id);

                        header_link.append(header_h);

                        table_of_contents.append(header_link);
                    });

                    if (id_counter == 1) {
                        table_of_contents.remove();
                    } else {
                        table_of_contents.removeAttribute('hidden');
                    }
                }
            };
        f();
    });

    new axModularFunction('custom-label', (el) => {
        el.addEventListener('click', () => {
            el.offsetParent.offsetParent.axQSA(el.axAttribute('for')).forEach((input) => {
                input.click();
            })
        })
    });
});

axComponentLoader.appendFunction('swiper', (el) => {
    const swiper = new Swiper(el, {
        // Optional parameters
        direction: 'horizontal',
        loop: false,
        slidesPerView: 5,
        speed: 600, // Скорость переключения слайдов в миллисекундах
        breakpoints: {
            0: {
                slidesPerView: 2,
            },
            576: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 4,
            },
            1400: {
                slidesPerView: 5,
            },
        },
        scrollbar: {
            el: '.swiper-scrollbar',
            hide: false,
        },
        autoplay: {
            delay: 2500, // Время задержки между слайдами в миллисекундах
            disableOnInteraction: false, // Не отключать автопрокрутку после взаимодействия
        },
        spaceBetween: 10,
    });
});
