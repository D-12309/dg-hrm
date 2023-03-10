"use strict";

$(".select_file_upload").on("change", function () {
    //get the file url
    var file_url = $(this).val();
    //get the file name
    var file_name = file_url.split("\\").pop();
    //get the file size
    var file_size = this.files[0].size;
    //get the file type
    var file_type = this.files[0].type;
    //get the file extension
    var file_extension = file_name.split(".").pop();
    //get the file name without extension
    var file_name_without_extension = file_name.split(".")[0];

    //Select HTML elements
    var accepted_fileType = $("#accepted_fileType").val();
    var no_image = $("#no_image").val();
    var randon_number = $(this).attr("data-random_number");
    let file_label = $("#custom-file-label" + randon_number);
    let file_img = $("#preview_image" + randon_number);

    //start check image file type
    if (
        accepted_fileType == "image" &&
        file_type != "image/jpeg" &&
        file_type != "image/png" &&
        file_type != "image/jpg"
    ) {
        file_label.text("Invalid Image");
        file_label.css("color", "red");
        file_img.attr("src", no_image);
        $(this).val("");
    } else {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                file_img.attr("src", e.target.result);
            };
            file_label.text(file_name);
            file_label.css("color", "green");
            reader.readAsDataURL(this.files[0]);
        }
    }
    //end check image file type
});

function editShow(current_page, next_page) {
    $("#" + current_page).addClass("d-none");
    $("#" + next_page).removeClass("d-none");
}

$(".layout-mode-dark").on("click", function () {
    $("body").addClass("dark-mode");
    $(".layout-mode-light").show();
    $(".layout-mode-dark").hide();
});
$(".layout-mode-light").on("click", function () {
    $("body").removeClass("dark-mode");
    $(".layout-mode-dark").show();
    $(".layout-mode-light").hide();
});
// document ready function
$(document).ready(function () {
    $(".layout-mode-light").hide();
    $(".layout-mode-dark").show();
});

$(".showHideLoader").on("click", function () {
    $(".show_loader_section").toggleClass("display_none");
});

//document ready function
$(document).ready(function () {
    // $(".show_loader_section").addClass("display_none");
//   systemLoader();
//   customLoader();
});
function systemLoader() {
    $(".system_loader_list").removeClass("display_none");
    $(".custom_loader_upload").addClass("display_none");
}
function customLoader() {
    $(".system_loader_list").addClass("display_none");
    $(".custom_loader_upload").removeClass("display_none");
}

