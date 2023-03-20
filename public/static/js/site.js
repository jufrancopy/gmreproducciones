const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');
var page = 1;
var page_section = "";
var products_list_ids_temp = [];

$(document).ready(function() {
    $('.slick-slider').slick({
        dots: true,
        infinte: true,
        autoplay: true,
        autoplaySpeed: 2000
    });
});

window.onload = function() {
    loader.style.display = 'none'
}

document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    var loader = document.getElementById('loader')
    var slider = new MainSlider;
    var form_avatar_change = document.getElementById('form_avatar_change');
    var btn_avatar_edit = document.getElementById('btn_avatar_edit');
    var input_file_avatar = document.getElementById('input_file_avatar');
    var avatar_change_overlay = document.getElementById('avatar_change_overlay');
    var products_list = document.getElementById('products_list');
    var load_more_products = document.getElementById('load_more_products');

    if (btn_avatar_edit) {
        btn_avatar_edit.addEventListener('click', function(e) {
            e.preventDefault();
            input_file_avatar.click();
        });
    }

    if (load_more_products) {
        load_more_products.addEventListener('click', function(e) {
            e.preventDefault();
            load_products(page_section)
        });
    }

    if (input_file_avatar) {
        input_file_avatar.addEventListener('change', function() {
            var load_img = '<img src="' + base + '/static/images/load.svg" />';
            avatar_change_overlay.innerHTML = load_img;
            avatar_change_overlay.style.display = 'flex';
            form_avatar_change.submit()
        });
    }
    slider.show();

    if (route == 'home') {
        load_products('home')
    }

    if (route == 'store') {
        load_products('store')
    }

    if (route == 'store_category') {
        load_products('store_category')
    }


    if (route == "product_single") {
        var inventory = document.getElementsByClassName('inventory');
        for (i = 0; i < inventory.length; i++) {
            inventory[i].addEventListener('click', function(e) {
                e.preventDefault()
                load_product_variants(this.getAttribute('data-inventory-id'))
            });
        }
        mark_user_favorites([document.getElementsByName('product_id')[0].getAttribute('content')])
    }
});

function load_products(section) {
    loader.style.display = 'flex';
    page_section = section;
    if (section == 'store_category') {
        var object_id = document.getElementsByName('category_id')[0].getAttribute('content');
        var url = base + '/api/load/products/' + page_section + '?page=' + page + '&object_id=' + object_id;
    } else {
        var url = base + '/api/load/products/' + page_section + '?page=' + page;
    }
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            page = page + 1;
            var data = this.responseText;
            data = JSON.parse(data)
            if (data.data.length == 0) {
                load_more_products.style.display = "none"
            }
            data.data.forEach(function(product, index) {
                products_list_ids_temp.push(product.id)
                var div = "";
                div += "<div class= \"product\">";
                div += "<div class= \"image\">";
                div += "<div class= \"overlay\">";
                div += "<div class= \"btns\">";
                div += "<a href=\"" + base + "/product/" + product.id + "/" + product.slug + "\"><i class=\"fas fa-eye\"></i></a>";
                div += "<a href=\"\"><i class=\"fas fa-cart-plus\"></i></a>";

                if (auth == 1) {
                    div += "<a href=\"\" id=\"favorite_1_" + product.id + "\" onclick=\"add_to_favorites('" + product.id + "','1'); return false\"><i class=\"fas fa-heart\"></i></a>";
                } else {
                    div += "<a href=\"\" id=\"favorite_1_" + product.id + "\" onclick=\"loginPlease(); return false\"><i class=\"fas fa-heart\"></i></a>";
                }

                div += "</div>";
                div += "</div>";
                div += "<img src=\"" + base + "/uploads/" + product.file_path + "/t_" + product.image + "\" > ";
                div += "</div>";
                div += "<a href=\"" + base + "/product/" + product.id + "/" + product.slug + "\" title=\"" + product.name + "\">"
                div += "<div class= \"title\">" + product.name + "</div>";
                div += "<div class= \"price\">" + currency + " " + product.price + " </div>";
                div += "<div class= \"options\"> </div>";
                div += "</a>";
                div += "</div>";
                products_list.innerHTML += div;
            });
            mark_user_favorites(products_list_ids_temp);
            products_list_ids_temp = [];
        } else {
            // Mensaje de error
        }
    }
}

function mark_user_favorites(objects) {
    var url = base + '/api/load/user/favorites';
    var params = 'module=1&objects=' + objects;
    console.log(objects)
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(params);
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            // console.log(data.objects)
            data = JSON.parse(data)
            console.log(data.objects);
            if (data.count > 0) {
                data.objects.forEach(function(favorite, index) {
                    document.getElementById('favorite_1_' + favorite).removeAttribute('onclick');
                    document.getElementById('favorite_1_' + favorite).classList.add('favorite_active');
                });
            }
        }
    }
}

function loginPlease() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
    })

    swalWithBootstrapButtons.fire({
        title: 'Disculpe!',
        text: "Debes estar registrado para realizar esta acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Registrarme',
        cancelButtonText: 'No, gracias!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = base + '/register';
        }
    })
}

function add_to_favorites(object, module) {
    url = base + '/api/favorites/add/' + object + '/' + module;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            data = JSON.parse(data);
            if (data.status == "success") {
                console.log(data.status)
                document.getElementById('favorite_' + module + '_' + object).removeAttribute('onclick');
                document.getElementById('favorite_' + module + '_' + object).classList.add('favorite_active')
            }
        }
    }
}

function load_product_variants(inventory_id) {
    document.getElementById('variants_div').style.display = 'none'
    document.getElementById('variants').innerHTML = "";
    document.getElementById('field_variant').value = null;
    loader.style.display = 'flex';
    var inventory_list = document.getElementsByClassName('inventory');
    for (i = 0; i < inventory_list.length; i++) {
        inventory_list[i].classList.remove('active')
    }
    var product_id = document.getElementsByName('product_id')[0].getAttribute('content');
    var inv = inventory_id
    document.getElementById('field_inventory').value = inv;
    document.getElementById('inventory_' + inv).classList.add('active')

    var url = base + '/api/load/product/inventory/' + inv + '/variants';
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            var data = this.responseText;
            data = JSON.parse(data)
            if (data.length > 0) {
                document.getElementById('variants_div').style.display = 'block'
                data.forEach(function(element, index) {
                    variant = "";
                    variant += '<li>';
                    variant += '<a href="#" class="variant" onclick="variants_active_remove(); document.getElementById(\'field_variant\').value = ' + element.id + '; this.classList.add(\'active\'); return false;">';
                    variant += element.name;
                    variant += '</a>';
                    variant += '</li>';
                    document.getElementById('variants').innerHTML += variant;
                });
            }

            console.log(data);

        }
    }

}

function variants_active_remove() {
    var li_variants = document.getElementsByClassName('variant')
    for (i = 0; i < li_variants.length; i++) {
        li_variants[i].classList.remove('active');
    }
}