var base = location.protocol + '//' + location.host + location.pathname;
document.addEventListener('DOMContentLoaded', function () {
    var je_alert_dom = document.getElementById('je_alert_dom');
    var je_alert_inside = document.getElementById('je_alert_inside')
    var je_alert_content = document.getElementById('je_alert_content')
    var je_alert_footer_other_btns = document.getElementById('je_alert_footer_other_btns')

    var je_alert_btn_close = document.getElementById('je_alert_btn_close');
    if (je_alert_btn_close) {
        je_alert_btn_close.addEventListener('click', function (e) {
            e.preventDefault();
            je_alert_status('hide');
        })
    }
});

function jealert(data) {
    je_alert_content.innerHTML = "";
    if (data) {
        if (data.title) {
            title = data.title;
        } else {
            title = 'JE - Alert'
        }
        content = '';
        content += '<h2>' + title + '</h2>'
        if (data.type) {
            content += '<div class="icon"><img src="' + base + '/static/libs/jeAlert/images/' + data.type + '.png"></div>'
        }
        if (data.msg) {
            msg = data.msg;
        }
        content += '<h5>' + msg + '</h5>';

        if (data.msgs) {
            messages = JSON.parse(data.msgs);
            if (messages.length > 0) {
                content += '<ul>';
                messages.forEach(function (element, index) {
                    content += '<li><i class="bi bi-bullseye"></i>' + element + '</li>';
                })
                content += '</ul>'
            }
        }

        actions_btns = '';
        if (data.actions) {
            actions = JSON.parse(data.actions);
            if (actions.length > 0) {
                actions.forEach(function (element, index) {
                    if (element.url) {
                        actions_btns += '<a href="' + element.url + '" class="btn btn-' + element.type + '" >' + element.name + '</a>'
                    } else {
                        actions_btns += '<a href="#" onclick="' + element.callback + '(' + element.params + '); return false;" class="btn btn-' + element.type + '">' + element.name + '</a>'
                    }
                });
            }
        }
        if (data.additional) {
            additionals = JSON.parse(data.additional);
            if (additionals.hideclose) {
                document.getElementById('je_alert_btn_close').style.display = 'none';
            } else {
                document.getElementById('je_alert_btn_close').style.display = 'block';
            }
        }

        je_alert_footer_other_btns.innerHTML = actions_btns;
        je_alert_content.innerHTML = content;
        je_alert_status('show');
    }
}

function je_alert_status(status) {
    if (status == "show") {
        document.getElementsByTagName('body')[0].style.overflow = 'hidden';
        // document.getElementsByClassName('.wrapper')[0].classList.add('blur');
        je_alert_dom.style.display = "flex";
        je_alert_dom.classList.remove('je_alert_animation_hide');
        je_alert_dom.classList.add('je_alert_animation_show');
        je_alert_inside.classList.add('scale_animation');
    }

    if (status == "hide") {
        document.getElementsByTagName('body')[0].style.removeProperty("overflow");
        // document.getElementsByClassName('.wrapper')[0].classList.remove('blur');
        je_alert_dom.style.display = "none"
        je_alert_dom.classList.add('je_alert_animation_hide')
        je_alert_dom.classList.remove('je_alert_animation_show')
        je_alert_inside.classList.remove('scale_animation')
    }
}

