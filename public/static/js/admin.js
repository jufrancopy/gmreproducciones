var base = location.protocol + '//' + location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
const http = new XMLHttpRequest();
const csrfToken = document.getElementsByName('csrf-token')[0].getAttribute('content');


document.addEventListener('DOMContentLoaded', function() {
    var btn_search = document.getElementById('btn_search');
    var form_search = document.getElementById('form_search');
    var category = document.getElementById('category');

    if (btn_search) {
        btn_search.addEventListener('click', function(e) {
            e.preventDefault();
            if (form_search.style.display === 'block') {
                form_search.style.display = 'none';

            } else {
                form_search.style.display = 'block';
            }
        });
    }
    if (route == "product_add") {
        setSubCategoriesToProducts();
    }
    if (route == "product_edit") {
        setSubCategoriesToProducts();
        var btn_product_file_image = document.getElementById('btn_product_file_image');
        var subCategoryNow = document.getElementById('subCategoryNow');
        var product_file_image = document.getElementById('product_file_image');
        btn_product_file_image.addEventListener('click', function() {
            product_file_image.click();
        }, false);

        product_file_image.addEventListener('change', function() {
            document.getElementById('form_product_gallery').submit();
        });
    }

    route_active = document.getElementsByClassName('lk-' + route)[0].classList.add('active');
    btn_deleted = document.getElementsByClassName('btn_deleted');
    for (i = 0; i < btn_deleted.length; i++) {
        btn_deleted[i].addEventListener('click', delete_object);
    }
    if (category) {
        category.addEventListener('change', setSubCategoriesToProducts);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    if (route == "timeline_edit") {
        var btn_timeline_file_image = document.getElementById('btn_timeline_file_image');
        var timeline_file_image = document.getElementById('timeline_file_image');
        btn_timeline_file_image.addEventListener('click', function() {
            timeline_file_image.click();
        }, false);

        timeline_file_image.addEventListener('change', function() {
            document.getElementById('form_timeline_gallery').submit();
        });
    }
    document.getElementsByClassName('lk-' + route)[0].classList.add('active')
});

$(document).ready(function() {
    editor_init('editor');
});

function editor_init(field) {
    // ckeditor.plugins.addExternal('codesnippet', base + '/static/libs/ckeditor/plugins/codesnippet/', 'plugin.js');
    CKEDITOR.replace(field, {
        // skin: 'moon',
        // extraPlugins: 'codesnippet,ajax,xml,textmatch,autocomplete,textwatcher,emoji,panelbutton,preview,wordcount',
        toolbar: [{
                name: 'clipboard',
                items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']
            },
            {
                name: 'basicstyles',
                items: ['Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'Unlink', 'Blockuote']
            },
            {
                name: 'document',
                items: ['Codesnippet', 'EmojiPanel', 'Preview', 'Source']
            }
        ]
    });
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

function setSubCategoriesToProducts() {
    var parentId = category.value;
    var select = document.getElementById('subCategory')
    select.innerHTML = "";
    var url = base + '/admin/api/load/subCategories/' + parentId;
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            data = JSON.parse(data)
            data.forEach(function(element, index) {
                if (subCategoryNow == element.id) {
                    select.innerHTML += "<option value=\"" + element.id + "\" selected>" + element.name + "</option>"
                } else {
                    select.innerHTML += "<option value=\"" + element.id + "\">" + element.name + "</option>"
                }
            });
        }
    }
}