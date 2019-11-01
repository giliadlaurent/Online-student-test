$(document).ready(function() {
    var max_fields      = 8;
    var min_fields      = 2;
    var $element = $(".option-wrap");
    var field = $element.children().length;

    $(".add-option").click(function() {
        if (field < max_fields) {
            field++;
            $(".option-wrap").append('<div class="option-field-' +
             field + ' form-group"><label>Option #' + field + 
             '</label><input class="pull-right" type="checkbox" name="options[' + field +
              '][correct_answer]" value="1"><span class="pull-right">Correct Answer</span><input type="text" class="form-control" name="options[' + field + '][option]" required maxlength="255"></div>');
        }
    });
   
    $(".remove-option").click(function () {
        if (field > min_fields) {
            $(".option-field-" + field).remove();
            field--;
        }
    });
});

$('.delete-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var delete_url = button.data('url'); // Extract info from data-* attributes
    var delete_id = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    var admin_path = modal.find('#modal-button-delete').attr("formaction");
    modal.find('#modal-button-delete').attr("formaction", admin_path + delete_url + "/" + delete_id + "/delete");
})

$('.reset-password-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var reset_password_id = button.data('id'); // Extract info from data-* attributes
    var modal = $(this);
    var admin_path = modal.find('#modal-button-reset-password').attr("formaction");
    modal.find('#modal-button-reset-password').attr("formaction", admin_path + "users/" + reset_password_id + "/reset-password");
})

$('#manual-password-check').click(function(){
    if (this.checked) {
        $("#manual-password-field").removeAttr("disabled");
    } else {
        $("#manual-password-field").attr("disabled", "disabled");
    }
})


