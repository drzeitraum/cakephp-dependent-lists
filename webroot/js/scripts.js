/**
 * dependentsLists() - infinite dependents lists in CakePHP

 * @author Vyacheslav K. <vyach.kotlyarov@gmail.com>
 * @link https://github.com/drzeitraum/cakephp-dependents-lists
 */

function dependentsLists(_this) {

    var elem = $('#dependents-lists');

    $.ajax({
        beforeSend: function () {
            elem.css({'opacity': '0.7'});
        },
        url: '/cakephp-dependents-lists/dependents/', //change this path to the name of your Dependents controller
        data: ({
            product_id: $('#classifier-product-id').val(),
            depend_id: $(_this).val(),
            entity: $(_this).attr('entity')
        }),
        success: function (responce) {
            elem.html(responce);
        },
        complete: function () {
            elem.css({'opacity': '1'});
        }
    });

}
