"use strict";

//Get Users
$('#members').select2({
    placeholder: $('#select_members').val(),
    placement: 'bottom',
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

//award type table show
function awardTypeTable() {
    let data = [];
    data["url"] = $("#award_type_table_url").val();
    data["value"] = {
        _token: _token,
        limit: 10,
    };
    data["column"] = [
        "id",
        "name",
        "status",
        "action",
    ];

    data["order"] = [[1, "id"]];
    data["table_id"] = "award_type_table_class";
    table(data);
}

$(".award_type_table_class").length > 0 && awardTypeTable();

//award table show
function awardTable() {
    let data = [];
    data["url"] = $("#award_table_url").val();
    data["value"] = {
        _token: _token,
        limit: 10,
    };
    data["column"] = [
        "id",
        "name",
        "type",
        "gift",
        "amount",
        "date",
        "action",
    ];

    data["order"] = [[1, "id"]];
    data["table_id"] = "award_table_class";
    table(data);
}

$(".award_table_class").length > 0 && awardTable();


// image tooltip


$('[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});

