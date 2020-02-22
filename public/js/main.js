$(document).ready(function()
{
    $(".js-remove-user").click(function()
    {
        let address = '/removeUser/' + $(this).attr('id');
        var item = $(this);
        $.ajax(address,
            {
                dataType: 'json',
                type: 'DELETE',
                success: function (data,status,xhr) {   // success callback function
                    item.parent().parent().remove();
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    alert("Something wrong...");
                }
            });
    });

    $(".js-add-role-user").click(function()
    {
        let address = '/addUserRole';
        let id = $(this).parent().children(".js-remove-user").attr('id');
        $.ajax(address,
            {
                dataType: 'json',
                type: 'POST',
                data: {
                    'user_id': id,
                    'role_name': "ROLE_ADMIN"
                },
                success: function (data,status,xhr) {   // success callback function
                    alert("Success");
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    alert("Something wrong...");
                }
            });
    });

    $(".js-activate-offer").click(function()
    {
        let address = '/offer/activation/' + $(this).attr('id');
        $.ajax(address,
            {
                dataType: 'json',
                type: 'PUT',
                success: function (data,status,xhr) {   // success callback function
                    alert("Success");
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback
                    alert("Something wrong...");
                }
            });
    });
});