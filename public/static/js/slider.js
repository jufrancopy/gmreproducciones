class MainSlider {
    constructor() {
        this.slider_active = 0;
        this.elements = 0;
        this.items = document.getElementsByClassName('slider-item');
        this.elements = this.items.length - 1;
        this.init();
    }
    init() {
        var slider_nav_prev = document.getElementById('slider_nav_prev');
        var slider_nav_next = document.getElementById('slider_nav_next');

        slider_nav_prev ? slider_nav_prev.addEventListener('click', function() { this.navigation('prev') }.bind(this)) : null;
        slider_nav_next ? slider_nav_next.addEventListener('click', function() { this.navigation('next') }.bind(this)) : null;
    }
    show() {
        var pos, i;

        for (i = 0; i < this.items.length; i++) {
            pos = i * 100;
            this.items[i].style.left = pos + '%';
            this.items[i].style.display = "flex";

        }
    }

    navigation(action) {
        if (action == "prev") {
            if (this.slider_active > 0) {
                this.slider_active = this.slider_active - 1;
                var i, pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) + 100;
                    console.log(pos);
                    this.items[i].style.left = pos + '%'
                }
            }
        }

        if (action == "next") {
            if (this.slider_active < this.elements) {
                this.slider_active = this.slider_active + 1;
                var i, pos;
                for (i = 0; i < this.items.length; i++) {
                    pos = parseInt(this.items[i].style.left) - 100;
                    console.log(pos);
                    this.items[i].style.left = pos + '%'
                }
            }
        }
        console.log(this.slider_active);
    }
}