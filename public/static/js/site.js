const base = location.protocol + '//' + location.host;
const route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');
const currency = document.getElementsByName('currency')[0].getAttribute('content');
const auth = document.getElementsByName('auth')[0].getAttribute('content');
var page = 1;
var page_section = "";
var products_list_ids_temp = [];

$(document).ready(function () {
    $('.slick-slider').slick({
        dots: true,
        infinte: true,
        autoplay: true,
        autoplaySpeed: 2000
    });
});

window.onload = function () {
    loader.style.display = 'none'
}

document.addEventListener('DOMContentLoaded', function () {
    var page_route_name = document.getElementsByClassName('lk-' + route)[0];

    if (page_route_name) {
        page_route_name.classList.add('active')
    }
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
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
        btn_avatar_edit.addEventListener('click', function (e) {
            e.preventDefault();
            input_file_avatar.click();
        });
    }

    if (load_more_products) {
        load_more_products.addEventListener('click', function (e) {
            e.preventDefault();
            load_products(page_section)
        });
    }

    if (input_file_avatar) {
        input_file_avatar.addEventListener('change', function () {
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

    if (route == 'search') {
        load_products('store_category')
    }

    if (route == 'account_address') {
        var state = document.getElementById('state')
        if (state) {
            state.addEventListener('change', load_cities)
        }
        load_cities();
    }


    if (route == "product_single") {
        var inventory = document.getElementsByClassName('inventory');
        for (i = 0; i < inventory.length; i++) {
            inventory[i].addEventListener('click', function (e) {
                e.preventDefault()
                load_product_variants(this.getAttribute('data-inventory-id'))
            });
        }
        mark_user_favorites([document.getElementsByName('product_id')[0].getAttribute('content')])

        var amount_action = document.getElementsByClassName('amount_action');
        for (i = 0; i < amount_action.length; i++) {
            amount_action[i].addEventListener('click', function (e) {
                e.preventDefault()
                product_single_amount(this.getAttribute('data-action'));

            });
        }
    }
    btn_deleted = document.getElementsByClassName('btn_deleted');
    for (i = 0; i < btn_deleted.length; i++) {
        btn_deleted[i].addEventListener('click', delete_object);
    }

    var payment_method_transfer_file = document.getElementById('payment_method_transfer_file');
    if (payment_method_transfer_file) {
        payment_method_transfer_file.addEventListener('change', function (e) {
            imagePreview(this, 'payment_method_transfer_img_prew');
            document.getElementById('pay_btn_complete').classList.remove('disabled');
        })
    }

    var btn_payment_method = document.getElementsByClassName('btn_payment_method');
    if (btn_payment_method) {
        btn_payment_method_selected = null;
        for (i = 0; i < btn_payment_method.length; i++) {

            btn_payment_method[i].addEventListener('click', function (e) {
                e.preventDefault();
                if (btn_payment_method_selected) {
                    document.getElementById(btn_payment_method_selected).classList.remove('active');
                }
                //Add class active to payment method
                this.classList.add('active')
                document.getElementById('field_payment_method_id').value = this.getAttribute('data-payment-method-id')
                btn_payment_method_selected = this.getAttribute('id');

                //Method Payment = Transfer
                if (this.getAttribute('data-payment-method-id') == "1") {
                    document.getElementById('payment_method_transfer_info').style.display = "flex";
                    document.getElementById('pay_btn_complete').classList.add('disabled');
                } else {
                    payment_method_transfer_file.value = "";
                    document.getElementById('payment_method_transfer_img_prew').setAttribute('src', '');
                    document.getElementById('payment_method_transfer_info').style.display = "none";
                    document.getElementById('pay_btn_complete').classList.remove('disabled');
                }
            });
        }
    }
    var payment_method_transfer_select_file = document.getElementById('payment_method_transfer_select_file');
    if (payment_method_transfer_select_file) {
        payment_method_transfer_select_file.addEventListener('click', function (e) {
            e.preventDefault();
            document.getElementById('payment_method_transfer_file').click()
        })
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
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            page = page + 1;
            var data = this.responseText;
            data = JSON.parse(data)
            if (data.data.length == 0) {
                load_more_products.style.display = "none"
            }
            data.data.forEach(function (product, index) {
                product_image = JSON.parse(product.image)
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
                div += "<img src=\"" + base + "/uploads/" + product_image.path + "/328x328_" + product_image.finalName + "\" > ";
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
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            // console.log(data.objects)
            data = JSON.parse(data)
            console.log(data.objects);
            if (data.count > 0) {
                data.objects.forEach(function (favorite, index) {
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
    http.onreadystatechange = function () {
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
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            var data = this.responseText;
            data = JSON.parse(data)
            if (data.length > 0) {
                document.getElementById('variants_div').style.display = 'block'
                data.forEach(function (element, index) {
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

function product_single_amount(action) {
    var quantity = document.getElementById('add_to_cart_quantity')
    var new_quantity;
    if (action == 'plus') {
        new_quantity = parseInt(quantity.value) + parseInt(1);
        quantity.value = parseInt(new_quantity);
    }
    if (action == 'minus') {
        if (parseInt(quantity.value) > 1) {
            new_quantity = parseInt(quantity.value) - parseInt(1);
            quantity.value = parseInt(new_quantity);
        }
    }

}

function load_cities() {
    loader.style.display = 'flex'
    state_id = document.getElementById('state');
    var cities_select = document.getElementById('address_city');
    cities_select.innerHTML = "";
    var url = base + '/api/load/cities/' + state_id.value;
    http.open('POST', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            loader.style.display = 'none';
            var data = this.responseText;
            data = JSON.parse(data);
            if (data.length > 0) {
                data.forEach(function (element, index) {
                    cities_select.innerHTML += '<option value="' + element.id + '">' + element.name + '</option>';
                })
            }
        }
    }

    http.send();
}

function delete_object(e) {
    e.preventDefault();
    var object = this.getAttribute('data-object');
    var action = this.getAttribute('data-action');
    var path = this.getAttribute('data-path');
    var url = base + '/' + path + '/' + object + '/' + action
    var title, text, icon;

    if (action == "delete") {
        title = "Estás seguro?";
        text = "Este archivo se enviará a la papelera.";
        icon = "warning"
    }

    if (action == "restore") {
        title = "Recuerda";
        text = "Esto restaurará el elemento.";
        icon = "info"
    }

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
    }).then((result) => {
        if (result.value) {
            window.location.href = url;
        }
    })
}

function imagePreview(input, toprew) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            document.getElementById(toprew).setAttribute('src', e.target.result);

        }
        reader.readAsDataURL(input.files[0]);
    }
}