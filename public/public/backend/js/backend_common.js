"use strict";

var url = $("#url").val();
var _token = $('meta[name="csrf-token"]').attr("content");

//document ready function
$(document).ready(function () {
  let bdhc = $("body").hasClass("sidebar-collapse"); //check if sidebar is collapsed

  let break_time = $("#break_time").val();
  let break_time_show = $("#break_time_show").val();
  var today = new Date();
  var current_date =
    today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
  let current_server_time = showCurrentTime();

  calculateTime(current_date, break_time, current_date, current_server_time);

  //Other leave Information
  $("input[name=sandwich]").on("change", function () {
    let checked = $(this).prop("checked");
    if (checked) {
      $(this).val(1);
    } else {
      $(this).val(0);
    }
  });


  $("#language_setup_country").on("change", function () {
   let selected=$("#language_setup_country").find(':selected');
   let id = $('#id').val();
   let country_code = selected.val();
   var country_name = selected.text();
   console.log(name);
   let _token = $('meta[name="csrf-token"]').attr("content");
   $.ajax({
     url: $("#setCountry").val(),
     type: "POST",
     data: {
       id: id,
       country_code: country_code,
       country_name: country_name,
     },
     success: function (data) {
       console.log(data);
       if (data.success) {
         toastr.success(data.message, "Success");
       } else {
         toastr.error(data.message, "Error");
       }
     },
   });
  });



  $("input[name=prorate]").on("change", function () {
    let checked = $(this).prop("checked");
    if (checked) {
      $(this).val(1);
    } else {
      $(this).val(0);
    }
  });

  //App Screen Setup
  $(".setup_switch").on("change", function () {
    var id = $(this).data("id");
    var name = $(this).data("name");
    var status = $(this).is(":checked");
    var _token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
      url: $("#appScreenSetupUpdate").val(),
      type: "POST",
      data: {
        id: id,
        name: name,
        status: status,
      },
      success: function (data) {
        console.log(data.status);
        if (data.status == 200) {
          toastr.success(data.message, "Success");
        } else {
          toastr.error(data.message, "Error");
        }
      },
    });
  });

  //user profile create
  $(".change-role").on("change", function (e) {
    e.preventDefault();
    var url = $("#url").val();
    var role_id = $(this).val();

    var formData = {
      role_id: role_id,
    };
    $.ajax({
      type: "POST",
      dataType: "html",
      data: formData,
      url: url + "/" + "hrm/roles/change-role",
      success: function (data) {
        $("#permissions-table").html(data);
      },
      error: function (data) {},
    });
  });
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip("show");
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

//get data by id
function showScheduleModal(url) {
  $("#holidayModal").trigger("reset");
  $("#scheduleEditModal").trigger("reset");
  $("#bruh").attr("src");
  $.ajax({
    type: "GET", //THIS NEEDS TO BE GET
    url: url,
    success: function (data) {
      $(".scheduleEditModal").modal("show");
      $("#holiday_id").val(data.id);
      $("#title").val(data.title);
      $("#start_date").val(data.start_date);
      $("#end_date").val(data.end_date);
      $("#description").val(data.description);
      $("#status_id").val(data.status_id);
    },
    error: function (data) {
      console.log(data);
    },
  });
}

//get sticker data by id
function showWeekendModal(url) {
  $("#stickerEditModal").trigger("reset");
  $.ajax({
    type: "GET", //THIS NEEDS TO BE GET
    url: url,
    success: function (data) {
      $(".weekendEditModal").modal("show");
      $("#weekend_id").val(data.id);
      $("#name").val(data.name);
      $("#is_weekend").val(data.is_weekend);
      $("#sticker_status_id").val(data.status_id);
    },
    error: function (data) {
      console.log(data);
    },
  });
}

//show cuurent time
function showCurrentTime() {
  let currentTime = new Date();
  let hours = currentTime.getHours();
  let minutes = currentTime.getMinutes();
  let seconds = currentTime.getSeconds();
  let ampm = hours >= 12 ? "PM" : "AM";
  // hours = hours % 12;
  // hours = hours ? hours : 12; // the hour '0' should be '12'
  // minutes = minutes < 10 ? '0' + minutes : minutes;
  // seconds = seconds < 10 ? '0' + seconds : seconds;
  let strTime = hours + ":" + minutes + ":" + seconds;
  return strTime;
}

function calculateTime(start_date, start_time, end_date, end_time) {
  //get values
  var valuestart = start_time;
  var valuestop = end_time;
  //create date format
  var start = new Date(start_date + " " + valuestart);
  var timeStart =
    start_date +
    " " +
    start.getHours() +
    ":" +
    start.getMinutes() +
    ":" +
    start.getSeconds();
  var timeStart = Date.parse(timeStart) / 1000;

  var end = new Date(end_date + " " + valuestop);
  var timeEnd =
    end_date +
    " " +
    end.getHours() +
    ":" +
    end.getMinutes() +
    ":" +
    end.getSeconds();
  var timeEnd = Date.parse(timeEnd) / 1000;

  var hourDiff = timeEnd - timeStart;
  return "diff :" + hourDiff;
}

//get sticker data by id
function showDesignationEditModal(url) {
  $("#designationModal").trigger("reset");
  $("#designationEditModal").trigger("reset");
  $.ajax({
    type: "GET", //THIS NEEDS TO BE GET
    url: url,
    success: function (data) {
      $(".designationEditModal").modal("show");
      $("#designation_id").val(data.id);
      $("#title").val(data.title);
      $("#status_id").val(data.status_id);
    },
    error: function (data) {
      console.log(data);
    },
  });
}

let baseUrl = $("#url").val();
//get sticker data by id
function paymentModal(url) {
  $("#paymentModal").attr("action", "");
  $("#paymentModal").trigger("reset");
  $.ajax({
    type: "GET", //THIS NEEDS TO BE GET
    url: url,
    success: function (data) {
      $(".paymentModal").modal("show");
      $("#amount").val(data.payable_amount);
      $("#paymentModal").attr(
        "action",
        baseUrl + "/hrm/expense/claim/claim-amount-payment/" + data.id
      );
    },
    error: function (data) {},
  });
}

$("#select_currency_symbol").on("change", function () {
  let currency_id = $(this).val();
  let currency_symbol = $("#currency_symbol");
  let currency_code = $("#currency_code");

  $.ajax({
    url: $("#currencyInfo").val(),
    type: "POST",
    data: {
      currency_id: currency_id,
    },
    success: function (data) {
      if (data.status == "success") {
        currency_symbol.val(data.currency.symbol);
        currency_code.val(data.currency.code);
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
});

$('input[name="location_api"]').on("change", function () {
  let location_api = $(this).val();
  let barikoi_section = $("#barikoi_section");
  let google_section = $("#google_section");

  if (location_api == "google") {
    barikoi_section.addClass("d-none");
    google_section.removeClass("d-none");
  } else {
    google_section.addClass("d-none");
    barikoi_section.removeClass("d-none");
  }
});

// attendance report index page
function onchangeDepartmentWiseuserLoad() {
  let url = $("#get_all_user_by_dep_des").val();
  let department_id = $("#department").select2("val");
  $("#selected_department").val(department_id);
  console.log(url);
  $("#__user_id").select2({
    placeholder: "Choose User",
    ajax: {
      url: url,
      data: {
        department_id: department_id,
        _token: $("#token").val(),
      },
      type: "POST",
      delay: 250,
      processResults: function (data) {
        console.log(data);
        let users = data.data.users;
        return {
          results: $.map(users, function (item) {
            return {
              text: item.name,
              id: item.id,
            };
          }),
        };
      },
      cache: false,
    },
  });
}
//get depatment wise user
function departmentUsers() {
  let department_id = $("#department").select2("val");
  $("#selected_department").val(department_id);
  $("#__user_id").select2({
    placeholder: "Choose User",
    ajax: {
      url: url + "/dashboard/user/get-all-user-by-dep-des",
      data: {
        department_id: department_id,
        _token: $("#token").val(),
      },
      type: "POST",
      delay: 250,
      processResults: function (data) {
        let users = data.data.users;
        return {
          results: $.map(users, function (item) {
            return {
              text: item.name,
              id: item.id,
            };
          }),
        };
      },
      cache: false,
    },
  });
}
let company_department_id;
const department = (value) => {
  company_department_id = value;
};
$("#company_employee").select2({
  placeholder: "Choose Employee",
  ajax: {
    url: $("#get_user_url").val(),
    type: "POST",
    data: function (params) {
      return {
        term: params.term, // search term
        department_id: company_department_id,
        _token: $("#token").val(),
      };
    },
    delay: 250,
    processResults: function (data) {
      return {
        results: $.map(data, function (item) {
          return {
            text: item.name,
            id: item.id,
          };
        }),
      };
    },
    cache: false,
  },
});
//notification index page
$(".unread_notification_from_all").on("click", function () {
  let id = $(this).data("notification_id");
  $.ajax({
    url: $("#readNotification").val(),
    type: "POST",
    data: {
      id: id,
      _token: $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      let element = $('[data-notification_row_id="' + id + '"]').remove();
    },
  });
});

$("#select_storage").on("change", function () {
  let selected_storage = $(this).val();
  let s3_section = $(".s3_section");
  if (selected_storage == "local") {
    s3_section.addClass("d-none");
  } else {
    s3_section.removeClass("d-none");
  }
});
$(".clockpicker").clockpicker({
  placement: "bottom",
  align: "left",
  donetext: "Done",
});

const options = {
  margin: 1,
  filename: "invoice.pdf",
  image: {
    type: "jpeg",
    quality: 0.98,
  },
  html2canvas: {
    scale: 2,
    logging: true,
    dpi: 192,
    letterRendering: true,
  },
  jsPDF: {
    unit: "in",
    format: "letter",
    orientation: "portrait",
  },
};

$("#downloadPDF").click(function (e) {
  e.preventDefault();
  const invoice = document.getElementById("invoice");
  html2pdf().from(invoice).set(options).save();
});
$("#select-user-lang").on("change", function () {
  var selected_lang = $('option:selected', this).attr('data-value');
  $.ajax({
    url: $("#change_lang_url").val(),
    type: "POST",
    data: {
      lang: selected_lang,
      _token: $("meta[name='csrf-token']").attr("content"),
    },
    success: function (data) {
      console.log(data.success);
      if (data.success) {
        //page reload
        location.reload();
        toastr.success(data.message, "Success");
      } else {
        toastr.error(data.message, "Error");
      }
    },
  });
});
$("#department").on("change", function () {
  let employee_required = $("#visit_employee");
  employee_required.removeClass("d-none");
});
$("#__user_id").on("change", function () {
  let employee_select_msg = $("#employee_select_msg");
  if (this.value != null) {
    employee_select_msg.addClass("d-none");
  }
});
function printDiv(printable_div) {
  var divToPrint = document.getElementById(printable_div);

  var newWin = window.open("", "Print-Window");

  newWin.document.open();

  newWin.document.write(
    '<html><body onload="window.print()">' +
      divToPrint.innerHTML +
      "</body></html>"
  );

  newWin.document.close();

  setTimeout(function () {
    newWin.close();
  }, 10);
}

$('input[name="notification_type"]').on("change", function () {
  let selected_value = $('input[name="notification_type"]:checked').val();
  let sepcific_user_section = $("#sepcific_user_section");
  if (selected_value == "0") {
    sepcific_user_section.hide();
  } else {
    sepcific_user_section.show();
  }
});
$(document).on("change", ".hrm_switch_btn", function () {
  var table_name = $(this).data("table_name");
  var change = $(this).data("change");
  var column_name = $(this).data("column_name");
  var id = $(this).attr("id");
  var chengeStatus_url = $("#chengeStatus_url").val();
  var value = $(this).is(":checked") ? 1 : 0;
  $.ajax({
    url: chengeStatus_url,
    type: "GET",
    data: {
      table_name: table_name,
      column_name: column_name,
      change: change,
      id: id,
      value: value,
    },
    success: function (data) {
      let element = $("#" + id);
      element.val(data.update_status);
      element.attr("data-change", data.change);
      // console.log(data);
      if (data.update_status == "1") {
        element.prop("checked", true);
      } else {
        element.prop("checked", false);
      }
      toastr.success(data.msg, data.status);
    },
    error: function (data) {
      toastr.error(error_msg, error_title);
    },
  });
});
function manageIpSetup(user_id, type) {
  let showIp = $("#show_ip_" + user_id);
  let ip_edit_field_ = $("#ip_edit_field_" + user_id);
  let ip_edit_btn_ = $("#ip_edit_btn_" + user_id);
  let ip_save_btn_ = $("#ip_save_btn_" + user_id);
  let updateUserIp = $("#updateUserIp").val();
  if (type == 1) {
    showIp.hide();
    ip_edit_btn_.hide();
    ip_edit_field_.show();
    ip_save_btn_.show();
  }
  if (type == 2) {
    let ip_address = ip_edit_field_.val();
    $.ajax({
      url: updateUserIp,
      type: "GET",
      data: {
        user_id: user_id,
        ip_address: ip_address,
      },
      success: function (data) {
        showIp.text(data.ip_address);
        toastr.success(data.msg, data.status);
      },
      error: function (data) {
        toastr.error("Something went wrong", "Error");
      },
    });
    showIp.show();
    ip_edit_btn_.show();
    ip_edit_field_.hide();
    ip_save_btn_.hide();
  }
}

$('.module_all_check').on('change', function () {
  console.log('module_all_check');
  let attr = $(this).attr('data-target_div');
  let id = $(this).attr('data-id');
  if($(this).is(":checked")){
    $('.permission_check'+id).prop('checked', true);
  }else{
    $('.permission_check'+id).prop('checked', false);
  } 
});

//select all checkbox by class
jQuery('.child_permission').each(function() {
  var currentElement = $(this);
  var parent_id = currentElement.attr('data-parent_id');
  var parentElement = $('#module'+parent_id);
  if(currentElement.is(":checked")){
    parentElement.prop('checked', true);
  }else{
    parentElement.prop('checked', false);
  } 
});
$('.child_permission').on('change',function() {
  var currentElement = $(this);
  var parent_id = currentElement.attr('data-parent_id');
  var parentElement = $('#module'+parent_id);
  if(currentElement.is(":checked")){
    parentElement.prop('checked', true);
  }else{
    parentElement.prop('checked', false);
  } 
  console.log(currentElement);
});
function validURL(str) {
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return !!pattern.test(str);
}
function RemoveHTMLTags(html) {
  var regX = /(<([^>]+)>)/ig;
  // var html = document.getElementById("txtHTML").value;
  return html.replace(regX, "");
}
$(document).ready(function () {
  let nav_accordion = $("#nav_accordion");
  let nav_link  = $("#nav_accordion a.nav-link ");
  let link_array = [];

  nav_link.each(function (index) {
    let nav_link = $(this);
    let nav_link_href = nav_link.attr("href");
    let text = nav_link.html();
    let nav_link_text = RemoveHTMLTags(text).trim();
    let current_url = window.location.href;
    if (current_url.includes(nav_link_href)) {
      nav_link.addClass("active");
      nav_link.parent().addClass("active");
      nav_link.parent().parent().parent().addClass("show");
      nav_link.parent().parent().parent().parent().addClass("active");
    }
    var single_link=[];
    if (validURL(nav_link_href)) {
      if (nav_link_text!="") {
        // single_link=[
        //   'link' = $nav_link_href,
        //   'text' = $nav_link_text,
        // ]
        single_link['link'] = nav_link_href;
        single_link['text'] = nav_link_text;
        // link_array.push(nav_link_text);
        // console.log(index+" "+ nav_link_text);
        // console.log(single_link);
      }
    }
  });

});

// $(function() {  
//   $( "#app_screen_sortable" ).sortable();  
// });
$('#app_screen_sortable').sortable({
    stop: function(e, ui) {
      var result=$.map($(this).find('li'), function(el) {
        var new_position=$(el).index();
        $('#show_position'+el.id).html(++new_position);
          return el.id + ' = ' + new_position;
      })
      $.ajax({
        url: $('#AppScreenSortable').val(),
        type: "POST",
        data: {
          result: result,
        },
        success: function (response) {
          toastr.success(response.message);
        },error: function (data) {
          toastr.error("Something went wrong", "Error");
        }
      });

  }
});

$('#is_free_location').on('change', function() {
  if(this.value == 1){
    $('#location_list').hide();
  }else{
    $('#location_list').show();
  }
});