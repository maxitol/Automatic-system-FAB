import './bootstrap';
import Alpine from 'alpinejs';
import 'select2';
window.Alpine = Alpine;

Alpine.start();


$('.addButtonOrder').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#orderForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let id = window.location.href.split("/addOrders/")[1];
    let customer = $('#customer').val();
    let date = $('#date').val();
    let sum = $('#sum').val();
    let object = $('#object').val();


    let array = {
        'customer': customer,
        'date': date,
        'id': id,
        'sum': sum,
        'object': object
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'addOrders',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Заказ сохранен');
            window.location.replace('/database/orders');
        }
    });
});

$('.addButtonCustomer').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#customerForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let name = $('#name').val();
    let type = $('#type').val();
    let contacts = $('#contacts').val();
    let fio = $('#fio').val();

    let array = {
        'name': name,
        'type': type,
        'contacts': contacts,
        'fio': fio,
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'addCustomers',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Заказчик добавлен');
            window.location.replace('customers');
        }
    });
});



$('.addButtonNews').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#newForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let text = $('#text').val();

    let array = {
        'text': text,
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'addNewNews',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Новость добавлена');
            window.location.replace('/home');
        }
    });
});

$('.editButtonOrder').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#orderEditForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let customer = $('#customer').val();
    let date = $('#date').val();
    let id = window.location.href.split("/editOrders/")[1];
    let sum = $('#sum').val();
    let status = $('#status').val();
    let object = $('#object').val();
    console.log(customer);
    let array = {
        'id' : id,
        'customer': customer,
        'date': date,
        'sum': sum,
        'status': status,
        'object': object,
    };
    console.log(array);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'editOrders',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Заказ сохранен');
            window.location.replace('/database/orders');
        }
    });
});


$('.deleteOrder').on('click', function(e) {
    e.preventDefault();

    let idOrder = $(this).attr('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'deleteOrder',
        type: 'post',
        data: {
            id : idOrder,
        },
        success: function (result){
           alert('Заказ удален!');
           window.location.replace('orders');
        },
        error: function (result) {
            alert('Ошибка при удалении заказа!');
            window.location.replace('orders');
        }
    });

    console.log($(this).attr('id'));

});
$('.deleteCustomer').on('click', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'deleteCustomer',
        type: 'post',
        data: {
            id : id,
        },
        success: function (result){
            alert('Заказ удален!');
            window.location.replace('customers');
        },
        error: function (result) {
            alert('Ошибка при удалении заказа!');
            window.location.replace('customers');
        }
    });

    console.log($(this).attr('id'));

});
$('.editButtonCustomer').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#customerEditForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let name = $('#name').val();
    let type = $('#type').val();
    let contacts = $('#contacts').val();
    let id = window.location.href.split("/editCustomers/")[1];

    let array = {
        'id' : id,
        'name': name,
        'type': type,
        'contacts': contacts
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'editCustomers',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Заказ сохранен');
            window.location.replace('/database/customers');
        }
    });
});
$('.deleteUser').on('click', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'deleteUser',
        type: 'post',
        data: {
            id : id,
        },
        success: function (result){
            alert('Пользователь удален!');
            window.location.replace('userPanel');
        },
        error: function (result) {
            alert('Ошибка при удалении пользователя!');
            window.location.replace('userPanel');
        }
    });

    console.log($(this).attr('id'));

});
$('.deleteNew').on('click', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'deleteNew',
        type: 'post',
        data: {
            id : id,
        },
        success: function (result){
            alert('Публикация удалена!');
            window.location.replace('home');
        },
        error: function (result) {
            alert('Ошибка при удалении публикации!');
            window.location.replace('home');
        }
    });

    console.log($(this).attr('id'));

});


$('.addButtonContract').on('click', function(e) {
    let form = document.querySelector("#contractForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    e.preventDefault();
    let customer = $('#customer').val();
    let objects = $('#objects').val();
    let fio = $('#fio').val();
    let sum = $('#sum').val();
    let contact = $('#contacts').val();
    let date = $('#date').val();

    let array = {
        'customer': customer,
        'objects': objects,
        'fio': fio,
        'sum': sum,
        'contact': contact,
        'date': date,
        'idContract': null,
        'idCustomer': null
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/database/addContracts',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            array['idContract'] = result.idContract;
            array['idCustomer'] = result.idCustomer;
            console.log(array['idContract']);
            alert('Договор добавлен');
            if (document.querySelector('#checkb').checked != true) {

                window.location.replace('contracts');

            }else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/database/addContract',
                    type: 'POST',
                    data: array,
                    success: function (response){
                        console.log("Data sent to controller");
                        console.log(response);

                        let url = response.url;
                        var link = document.createElement("a");

                        link.href = url;
                        link.download = "dogovor" + result.idContract + ".docx";

                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                        window.location.replace('contracts');
                    },
                    error: function(error) {
                        // Если запрос неудачен, выводим ошибку в консоль
                        console.error("Error sending data to controller");
                        console.error(error);
                    }

                });

            }
        }
    });
});
$('.editButtonContract').on('click', function(e) {
    e.preventDefault();
    let form = document.querySelector("#contractEditForm");
    let inputs = form.querySelectorAll("input");
    inputs.forEach(input => {

        if (!(input.checkValidity())) {
            // Если элемент не валиден, показать сообщение об ошибке
            alert(input.validationMessage);
            throw input;
        }
    });
    let customer = $('#customer').val();
    let objects = $('#objects').val();
    let fio = $('#fio').val();
    let date = $('#date').val();
    let id = window.location.href.split("/editContracts/")[1];

    let array = {
        'id' : id,
        'customer' : customer,
        'objects': objects,
        'fio': fio,
        'date': date
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'editContracts',
        type: 'post',
        data: array,
        success: function (result){
            console.log(result);
            alert('Контракт сохранен');
            window.location.replace('/database/contracts');
        }
    });
});
$('.deleteContract').on('click', function(e) {
    e.preventDefault();

    let id = $(this).attr('id');

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'deleteContract',
        type: 'post',
        data: {
            id: id,
        },
        success: function (result) {
            alert('Договор удален!');
            window.location.replace('contracts');
        },
        error: function (result) {
            alert('Ошибка при удалении договора!');
            window.location.replace('contracts');
        }
    });
});
let button = document.getElementById("search-button");
// Добавляем обработчик события click к кнопке
$('#search-button').on('click', function(e) {
    // Получаем значение введенного текста
    let query = document.getElementById("search-input").value;
    // Проверяем, что текст не пустой
    if (query) {
        // Вызываем функцию поиска и подсветки текста
        highlightText(query);
    }else {
        hideMatchCount();
        resetHighlights();
    }
});

// Функция для поиска и подсветки текста на странице
function highlightText(query) {
    // Проверяем, не пустой ли инпут
    if (query) {
        // Сбрасываем все старые подсветки
        resetHighlights();
        // Создаем регулярное выражение из текста, экранируя специальные символы
        let regex = new RegExp(escapeRegExp(query), "gi");
        // Получаем все текстовые узлы на странице
        let textNodes = getTextNodes();
        // Создаем переменную для хранения первого подсвеченного элемента
        let firstMatch = null;
        // Создаем переменную для хранения количества подсвеченных элементов
        let matchCount = 0;
        // Проходим по всем текстовым узлам
        for (let i = 0; i < textNodes.length; i++) {
            let node = textNodes[i];
            // Получаем текст узла
            let text = node.nodeValue;
            // Проверяем, есть ли в тексте совпадения с регулярным выражением
            let match = regex.exec(text);
            // Если есть совпадения, то создаем элемент span для подсветки
            if (match) {
                let span = document.createElement("span");
                span.className = "highlight";
                // Создаем три фрагмента текста: до, во время и после совпадения
                let before = text.slice(0, match.index);
                let inside = text.slice(match.index, regex.lastIndex);
                let after = text.slice(regex.lastIndex);
                // Добавляем фрагменты в span элемент
                span.appendChild(document.createTextNode(before));
                span.appendChild(createSpan(inside));
                span.appendChild(document.createTextNode(after));
                // Заменяем текстовый узел на span элемент
                node.parentNode.replaceChild(span, node);
                // Если это первое совпадение, то запоминаем его
                if (!firstMatch) {
                    firstMatch = span;
                }
                // Увеличиваем количество подсвеченных элементов на один
                matchCount++;
            }
        }
        // Если есть хотя бы одно совпадение, то перемещаемся к нему
        if (firstMatch) {
            // Вычисляем высоту окна браузера
            let windowHeight = window.innerHeight || document.documentElement.clientHeight;
            // Вычисляем высоту подсвеченного элемента
            let elementHeight = firstMatch.offsetHeight;
            // Вычисляем расстояние от верхнего края окна до центра подсвеченного элемента
            let offset = (windowHeight - elementHeight) / 2;
            // Перемещаемся к подсвеченному элементу с учетом смещения
            firstMatch.scrollIntoView(false);
            window.scrollBy(0, -offset);
        }
        // Выводим количество подсвеченных элементов в специальный элемент
        showMatchCount(matchCount);
    } else {
        // Если инпут пустой, то скрываем элемент output
        hideMatchCount();
    }
}

// Функция для скрытия элемента output
function hideMatchCount() {
    // Получаем элемент для вывода количества по id
    let output = document.getElementById("output");
    // Если такой элемент есть, то удаляем его из DOM-дерева
    if (output) {
        output.parentNode.removeChild(output);
    }
}

// Функция для вывода количества подсвеченных элементов в специальный элемент
function showMatchCount(count) {
    // Получаем элемент для вывода количества по id
    let output = document.getElementById("output");
    // Если такого элемента нет, то создаем его и добавляем его после инпута
    if (!output) {
        output = document.createElement("div");
        output.id = "output";
        output.style.marginLeft = "15px";
        output.style.color = "black";
        output.style.position = "absolute";
        let input = document.getElementById("search-input");
        input.parentNode.insertBefore(output, input.nextSibling);
    }
    // Если количество больше нуля, то формируем сообщение в зависимости от числа и падежа слова "совпадение"
    if (count > 0) {
        let message;
        if (count % 10 == 1 && count % 100 != 11) {
            message = "Найдено " + count + " совпадение";
        } else if (count % 10 >= 2 && count % 10 <= 4 && (count % 100 < 10 || count % 100 >= 20)) {
            message = "Найдено " + count + " совпадения";
        } else {
            message = "Найдено " + count + " совпадений";
        }
        // Выводим сообщение в элемент output
        output.textContent = message;
    } else {
        // Если количество равно нулю, то выводим сообщение об отсутствии совпадений
        output.textContent = "Совпадений не найдено";
    }
}

// Функция для сброса всех подсветок на странице
function resetHighlights() {
    // Получаем все элементы span с классом highlight или highlighted
    let spans = document.querySelectorAll("span.highlight, span.highlighted");
    // Проходим по всем элементам span
    for (let i = 0; i < spans.length; i++) {
        let span = spans[i];
        // Получаем родительский элемент span
        let parent = span.parentNode;
        // Проходим по всем дочерним узлам span и добавляем их к родительскому элементу
        while (span.firstChild) {
            parent.insertBefore(span.firstChild, span);
        }
        // Удаляем элемент span из родительского элемента
        parent.removeChild(span);
    }
}

// Функция для создания span элемента с подсвеченным текстом
function createSpan(text) {
    let span = document.createElement("span");
    span.className = "highlighted";
    span.textContent = text;
    return span;
}

// Функция для получения всех текстовых узлов на странице
// Функция для получения всех текстовых узлов внутри таблицы
function getTextNodes() {
    // Создаем пустой массив для хранения узлов
    let nodes = [];
    // Создаем функцию для рекурсивного обхода дерева элементов
    function walk(node) {
        // Если узел является текстовым и не пустым, то добавляем его в массив
        if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim()) {
            nodes.push(node);
        }
        // Если узел имеет дочерние узлы, то проходим по ним рекурсивно
        if (node.hasChildNodes()) {
            for (let i = 0; i < node.childNodes.length; i++) {
                walk(node.childNodes[i]);
            }
        }
    }
    // Получаем элемент таблицы по id
    let table = document.getElementById("table");
    // Вызываем функцию обхода для элемента таблицы
    walk(table);
    // Возвращаем массив узлов
    return nodes;
}

// Функция для экранирования специальных символов в регулярных выражениях
function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
}
//<input id="search-input" type="text" name="search" placeholder="Поиск..." />

/* Добавляем стили для элемента span с символом крестика */

// Получаем элементы input и span по id
var input = document.getElementById("search-input");
var clear = document.getElementById("clear-input");

// Добавляем обработчик события input для элемента input
$('#search-input').on('input', function(e) {

    // Если значение инпута не пустое, то показываем элемент span
    if (input.value) {
        clear.style.display = "inline";
    } else {
        // Иначе скрываем его
        resetHighlights();
        hideMatchCount();
        clear.style.display = "none";
    }
});

// Добавляем обработчик события click для элемента span
$('#clear-input').on('click', function(e) {
    // Очищаем значение инпута
    input.value = "";
    // Скрываем элемент span
    clear.style.display = "none";
    // Скрываем элемент output
    hideMatchCount();
    // Сбрасываем все подсветки
    resetHighlights();
});

$(document).ready(function() {

    // Применяем к нему плагин Select2 с настройками
    $(".search-select").select2({
        // Задаем текст-подсказку
        // Задаем язык интерфейса
        language: "ru"
    });

    $('.select2-container--default .select2-selection--single').css('border', '1px solid #d1d5db');
    $('.select2-container--default .select2-selection--single').css('height', '41.6px');
    $('.select2-selection__arrow').css('margin-right', '10px');
    $('.select2-selection__arrow').css('margin-top', '7px');
    $('.select2-container--default .select2-selection--single .select2-selection__rendered').css('line-height', '41.6px');


});
$('.uploadFiles').on('click', function(e) {
    // Имитируем клик по скрытому элементу input
    document.querySelector('.defaultbtn').click();
});
var input = document.querySelector('.defaultbtn');
var span = document.querySelector('.file-count');
// Добавляем обработчик события change на элемент input
$('.defaultbtn').on('change', function(e) {
    // Получаем количество выбранных файлов
    var count = input.files.length;
    // Изменяем текст элемента span в зависимости от количества файлов
    if (count === 0) {
        span.textContent = 'Нет выбранных файлов';
    } else if (count === 1) {
        span.textContent = 'Выбран 1 файл';
    } else {
        span.textContent = 'Выбрано ' + count + ' файла';
    }
});
