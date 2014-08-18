//---------------------------//
// Generic input validation. //
//---------------------------//

//numeric data entry validation.
function validateInputNumber(event) {
    if (event.shiftKey) {
        return false;
    }
    var keyCode = (document.all) ? event.keyCode : event.which;
    var key = String.fromCharCode(keyCode);
    if (event.keyCode >= 96 && event.keyCode <= 105) {
        key = String.fromCharCode(keyCode - 48);
    }
    if (keyCode === 8 || keyCode === 9 || keyCode === 13 || keyCode === 35 || keyCode === 36 || keyCode === 37 || keyCode === 39 || keyCode === 46 || keyCode === 127) {
        return true;
    } else if (key.match(/^[0-9]$/)) {
        return true;
    }
    return false;
}


//length checking of the field value.
function checkLength(object, length) {
    return check(object, object.val().length === length);
}


//range checking of the field value.
function checkRange(object, min, max) {
    return check(object, object.val().length >= min && object.val().length <= max);
}


//format checking of the field value.
function checkRegexp(object, regexp) {
    return check(object, regexp.test(object.val()));
}


//check of list option selected.
function checkSelected(object) {
    if (object.prop('selectedIndex') > 0) {
        $('div > select[id="' + object.attr('id') + '"]').parent().removeClass('has-error');
        $('#alertDialog').hide();
        return true;
    } else {
        $('div > select[id="' + object.attr('id') + '"]').parent().addClass('has-error');
        $('#message').text('You must select a ' + $('label[for="' + object.attr('id') + '"]').text() + ' from the list.');
        $('#alertDialog').show();
        return false;
    }
}


//generic check to show/hide error message.
function check(object, valid) {
    if (valid) {
        $('div > input:text[id="' + object.attr('id') + '"]').parent().removeClass('has-error');
        $('#alertDialog').hide();
        return true;
    } else {
        $('div > input:text[id="' + object.attr('id') + '"]').parent().addClass('has-error');
        $('#message').text('You must enter a valid ' + $('label[for="' + object.attr('id') + '"]').text() + '.');
        $('#alertDialog').show();
        return false;
    }
}
