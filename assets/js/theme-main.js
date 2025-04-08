function hide_all_dropdown () {
    Array.from(document.querySelectorAll('.nav-item.active')).forEach((old_el) => {
        old_el.classList.remove('active');
    });
}
document.addEventListener("DOMContentLoaded", function() {
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
        if(!e.target || !['nav-item', 'nav-link'].includes(e.target.classList[0])) {
            hide_all_dropdown();
        }
    })

    document.querySelector(".extra-menu").addEventListener("mouseleave", function() {
        document.getElementById('open-nav-menu').checked = false;
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
