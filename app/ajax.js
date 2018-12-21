$(document).ready(function() {
    $("btn").click(
		function() {
			sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
			return false; 
		}
    );

    function sendAjaxForm(result_form, ajax_form, url) {
        $.ajax({
            url: "app.php", 
            type: "POST", 
            dataType: "html", 
            data: $("#areaform").serialize(), 
            success: function(response) { 
                result = $.parseJSON(response);
            },
            error: function(response) { 
                $('textarea').html('Ошибка. Данные не отправлены.');
            }
         });
    }
});