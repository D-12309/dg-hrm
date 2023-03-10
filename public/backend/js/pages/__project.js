"use strict";

var url = $('#url').val();
var _token = $('meta[name="csrf-token"]').attr('content');

//Get Users
$('#members').select2({
    placeholder: $('#select_members').val(),
    placement: 'bottom',
    multiple: true,
    ajax: {
        url: $('#get_user_url').val(),
        dataType: 'json',
        type: 'POST',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id,
                    }
                })
            }
        },
        cache: true
    }
});

let oldMembers = $('#members').select2('val');

const newMembers = () => {
    let newMembers = $('#members').select2('val');
    let remove = oldMembers.filter(function(item) { return newMembers.indexOf(item) < 0; });
    let add = newMembers.filter(function(item) { return oldMembers.indexOf(item) < 0; });
    $('#remove_members').val(remove);
    $('#new_members').val(add);
    
}

const progressValue = (val) => {
    $('#progress_percentage').html(val + '%');
}
const billingType = (val) => {
    $('#per_rate').attr('required', false);
    $('#total_rate').attr('required', false);
    if (val == 'hourly') {
        $('#per_rate').attr('required', true);
        $('.per_rate').removeClass('d-none');
        $('.total_rate').addClass('d-none');
    }else{
        $('#total_rate').attr('required', true);
        $('.per_rate').addClass('d-none');
        $('.total_rate').removeClass('d-none');
    }
}
const calculateAmount = () => {
    $('#amount').attr('readonly', true);
    if ($('#billing_type').val() == 'hourly') {
        $('#amount').val(parseFloat($('#per_rate').val() ? $('#per_rate').val() : 0) * parseFloat($('#estimated_hour').val() ? $('#estimated_hour').val() : 0));
    }else{
        $('#amount').val(parseFloat($('#total_rate').val() ? $('#total_rate').val() : 0));
    }
}

function discussionValidate() {
   let subject      = $('#subject').val();
   let description  = $('#description').val();
   let isReturned   = true;

    if (subject == '') {
       $('#subject').addClass('is-invalid');
       $('.error_show_subject').addClass('invalid-feedback');
        $('.error_show_subject').html($('#error_subject').val());
        isReturned = false;    
    }else{
         $('#subject').removeClass('is-invalid');
         $('.error_show_subject').html('');
         isReturned = true;
    }
    if (description == '') {
        $('#description').addClass('is-invalid');
        $('.error_show_description').addClass('invalid-feedback');
        $('.error_show_description').html($('#error_description').val());
        isReturned = false;
    }else{
        $('#description').removeClass('is-invalid');
        $('.error_show_description').html('');
        isReturned = true;
    }
    return isReturned;

}

const submit_discussion = () => {

    let isValid = discussionValidate();
    if (isValid) {
       
        $.ajax({
            url: $('#form_url').val(),
            type: "POST",
            data: { 
                subject          : $('#subject').val(),
                description      : $('#description').val(),
                show_to_customer : $('#show_to_customer').val(),
                _token           : _token
             },
            success: function (response) {
                // console.log(response);
                if (response.result) {
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                }
            },
            error: function (error) {
                console.log(error.responseJSON.message);
                if (error) {
                    if (error.responseJSON.error?.subject) {
                        $('.error_show_subject').addClass('invalid-feedback');
                        $(".error_show_subject").html(error.responseJSON.error.subject[0]);
                    }
                    if (error.responseJSON.error?.description) {
                        $('.error_show_description').addClass('invalid-feedback');
                        $(".error_show_description").html(error.responseJSON.error.description[0]);
                    }
                }
                if (error.responseJSON.message) {                    
                    Swal.fire({
                        title: error.responseJSON.message,
                        type: 'error',
                        icon: 'error',
                        timer: 3000
                    });
                };
            },
        });

        
    }


}
const showComments = (id) => {
    $('.dis-'+id).toggle('d-none');
    $('.dis-'+id).css('display', 'flow-root');
}
const commentReply = (id = null, form_url) => {
    $.ajax({
        url: form_url,
        type: "POST",
        data: { 
            comment          : id ? $('#comment-'+id).val() : $('#comment-').val(),
            comment_id       : id,
            _token           : _token
            },
        success: function (response) {
            if (response.result) {
                Swal.fire({
                    position: 'top-end',
                    title: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function () {
                    window.location.reload();
                }, 3000);
            }
        },
        error: function (error) {
            if (error) {
                let err = id ? 'error-message-'+id : 'error-message-';
                if (error.responseJSON.error?.comment) {
                    $('.'+err).addClass('invalid-feedback');
                    $("."+err).html(error.responseJSON.error.comment[0]);
                }
            }
            if (error.responseJSON.message) {                    
                Swal.fire({
                    title: error.responseJSON.message,
                    type: 'error',
                    icon: 'error',
                    timer: 3000
                });
            };
        },
    });
}
$('.summernote').summernote()

// files table show 


function fileTable() {
    let data = [];
    data["url"] = $("#file_table_url").val();
    data["value"] = {
        _token: _token,
        limit: 10,
    };
    data["column"] = [
        "id",
        "subject",
        "last_activity",
        "comments",
        "date",
        "action",
    ];

    data["order"] = [[1, "id"]];
    data["table_id"] = "file_table_data";
    table(data);
}
$('#file_table_url').val() ? fileTable() : '';

  






