var url = $("#url").val();
// tokens
var _token = $('meta[name="csrf-token"]').attr("content");
// global delete method where we try to use this for every delete
__globalDelete = (id, ur) => {
  Swal.fire({
    title: "Are you sure?",
    text: "",
    icon: "error",
    showCancelButton: true,
    confirmButtonText: "Yes",
    cancelButtonText: "Cancel!",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `${url + "/" + ur + id}`;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // Swal.fire(
      //     'Cancelled',
      //     'Your file is safe :)',
      //     'error'
      // )
    }
  });
};

GlobalApproveId = (id, ur, title) => {
  Swal.fire({
    title: "Are you sure?",
    icon: "success",
    showCancelButton: true,
    confirmButtonText: title,
    cancelButtonText: "Cancel",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `${url + "/" + ur + id}`;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire("Cancelled");
    }
  });
};
GlobalApprove = (ur, title) => {
  Swal.fire({
    title: "Are you sure?",
    icon: "success",
    showCancelButton: true,
    confirmButtonText: title,
    cancelButtonText: "Cancel",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = ur;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire("Cancelled");
    }
  });
};

ApproveOrReject = (id, status, ur, title) => {
  Swal.fire({
    title: "Are you sure?",
    icon: "success",
    showCancelButton: true,
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    reverseButtons: true,
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = `${url + "/" + ur + id + "/" + status}`;
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      // Swal.fire(
      //     'Cancelled',
      // )
    }
  });
};
MakeHrByAdmin = (id, status, ur, title) => {
    let new_url=`${url + '/' + status +id}`;

    Swal.fire({
        title: 'Are you sure?',
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = new_url;
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            // Swal.fire(
            //     'Cancelled',
            // )
        }
    })
}
delete_item = (url) => {
    let new_url=url;

    Swal.fire({
        title: 'Are you sure?',
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = new_url;
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            // Swal.fire(
            //     'Cancelled',
            // )
        }
    })
}

viewModal = (ur) => {
  $.get(ur, function (data) {
    if (data == "fail") {
      setTimeout(function () {
        toastr.error("Something went wrong!", "Error!", {
          timeOut: 2000,
        });
      }, 500);
    } else {
      $(data).appendTo("body").modal({
        backdrop: "static",
        keyboard: false,
      });
    }
  });
};

Reject = (id, ur) => {
  var html = `<div class="modal modal-blur fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
               <div class="modal-content">
                 <div class="modal-body">
                   <div class="modal-title">
                   <h1 class="text-center danger"><i class="fas fa-exclamation-circle"></i></h1>
                   <br>
                   <h3 class="text-center">Are you sure?</h3> </div>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-link btn-default mr-auto" data-dismiss="modal">Cancel</button>
                   <a href="${
                     url + "/" + ur + id
                   }" class="btn btn-danger">Reject</a>
                 </div>
               </div>
           </div>
         </div>`;
  $(html).appendTo("body").modal();
};
Approve = (id, ur) => {
  var html = `<div class="modal modal-blur fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
               <div class="modal-content">
                 <div class="modal-body">
                   <div class="modal-title">
                   <h1 class="text-center text-success"><i class="far fa-check-circle"></i></h1>
                   <br>
                   <h3 class="text-center">Are you sure?</h3> </div>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-link btn-default mr-auto" data-dismiss="modal">Cancel</button>
                   <a href="${
                     url + "/" + ur + id
                   }" class="btn btn-primary">Approve</a>
                 </div>
               </div>
           </div>
         </div>`;
  $(html).appendTo("body").modal();
};
Complete = (id, ur) => {
  var html = `<div class="modal modal-blur fade" id="delete" tabindex="-1" role="dialog" aria-hidden="true">
           <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
               <div class="modal-content">
                 <div class="modal-body">
                   <div class="modal-title">
                   <h1 class="text-center text-success"><i class="far fa-check-circle"></i></h1>
                   <br>
                   <h3 class="text-center">Are you sure?</h3> </div>
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-link btn-default mr-auto" data-dismiss="modal">Cancel</button>
                   <a href="${
                     url + "/" + ur + id
                   }" class="btn btn-primary">Complete</a>
                 </div>
               </div>
           </div>
         </div>`;
  $(html).appendTo("body").modal();
};
$(".select2").select2({
  placeholder: "Choose one",
});
$("select").select2({
  placeholder: "Choose one",
});
$(document).ready(function () {
  var t = $("#summernote").summernote({
    height: 200,
    focus: true,
  });
  $("#btn").on("click", function () {
    $("div.note-editable").height(150);
  });
});
$(document).ready(function () {
  var t = $(".summernote").summernote({
    height: 200,
    focus: true,
  });
  $("#btn").on("click", function () {
    $("div.note-editable").height(150);
  });
});

$(".main_image").spartanMultiImagePicker({
  fieldName: "file",
  maxCount: 1,
  rowHeight: "200px",
  groupClassName: "col-lg-12",
  loaderIcon: '<i class="fa fa-close"></i>',
  maxFileSize: "2598308",
  dropFileLabel: "Drop Here",
  onAddRow: function (index) {},
  onRenderedPreview: function (index) {},
  onRemoveRow: function (index) {
    // console.log(index);
  },
  onExtensionErr: function (index, file) {
    toastr.error("Please only input png or jpg type file");
  },
  onSizeErr: function (index, file) {
    toastr.error("File size too big");
  },
});
// favicon
$(".icon_image").spartanMultiImagePicker({
  fieldName: "favicon",
  maxCount: 1,
  rowHeight: "200px",
  groupClassName: "col-lg-12",
  loaderIcon: '<i class="fa fa-close"></i>',
  maxFileSize: "2598308",
  dropFileLabel: "Drop Here",
  onAddRow: function (index) {},
  onRenderedPreview: function (index) {},
  onRemoveRow: function (index) {},
  onExtensionErr: function (index, file) {
    toastr.error("Please only input png or jpg type file");
  },
  onSizeErr: function (index, file) {
    toastr.error("File size too big");
  },
});

$("#terms_check_make_parent").on("click", function () {
  if ($(this).prop("checked")) {
    $("#terms_check_make_button").prop("disabled", false);
  } else {
    $("#terms_check_make_button").attr("disabled", true);
  }
});

accountStatement = () => {
  $.ajax({
    type: "POST",
    dataType: "html",
    data: {
      start_date: $("#start_date").val(),
      end_date: $("#end_date").val(),
      _token: _token,
    },
    url: url + "/" + "dashboard/reports/ajax-account-statement",
    success: function (data) {
      $("#__account_statement").html(data);
    },
    error: function (data) {},
  });
};

$("#__account_statement").length > 0 && accountStatement();

//show leave type modal

//status updating for vehicle
$("body").on("click", ".statusActionBtn", function () {
  let id = $(this).attr("item-id");
  let url = `vehicle/update-status/${id}`;
  console.log(url);
  $.ajax({
    type: "GET",
    url: url,
    success: function (data) {
      window.location.reload();
    },
    error: function (data) {
      console.log(data);
    },
  });
});

$(".upload_file").length > 0
  ? (upload_file.onchange = (evt) => {
      const [file] = upload_file.files;
      if (file) {
        bruh.src = URL.createObjectURL(file);
      }
    })
  : "";

//Get Users
let get_user_url = $("#get_user_url").val();

$("#user_id").select2({
  placeholder: "Choose Employee",
  placement: "bottom",
  ajax: {
    url: get_user_url,
    dataType: "json",
    type: "POST",
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

breakBack = (ur) => {
  $.get(ur, function (data) {
    if (data == "fail") {
      setTimeout(function () {
        toastr.error("Something went wrong!", "Error!", {
          timeOut: 2000,
        });
      }, 500);
    } else {
      $(".break_back_button").html("");
      $(".break_back_button")
        .html(`<button  data-toggle="modal" data-target="#exampleModal"
                class="ml-2 btn btn-info box-shadow d-flex align-items-center sm-btn-with-radius">
                <img class="zoom-in-zoom-out" src="${$(
                  "#break_icon"
                ).val()}" alt=""
                    style=" width: 19px; height: 19px; padding:0px !important">
            </button>`);
      $(data).appendTo("body").modal({
        backdrop: "static",
        keyboard: false,
      });
    }
  });
};

mainModalOpen = (ur) => {
  $.get(ur, function (data) {
    if (data == "fail") {
      setTimeout(function () {
        toastr.error("Something went wrong!", "Error!", {
          timeOut: 2000,
        });
      }, 500);
    } else {
      $(".break_back_button").html("");
      $(data).appendTo("body").modal({
        backdrop: "static",
        keyboard: false,
      });
    }
  });
};

$("#__date_range").daterangepicker();

$(document).ready(function () {
  setTimeout(function () {
    $('[data-toggle="tooltip"]').tooltip("hide", {
      animated: "fade",
      placement: "bottom",
      html: true,
    });
  }, 100);
});

////Get Users
$("#custom_user").select2({
  placeholder: $("#select_custom_members").val(),
  placement: "bottom",
  ajax: {
    url: $("#get_custom_user_url").val(),
    dataType: "json",
    type: "POST",
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
    cache: true,
  },
});

////Get goals
$("#goal_id").select2({
  placeholder: $("#select_goals").val(),
  placement: "bottom",
  ajax: {
    url: url + "/admin/performance/goal/get-goal",
    dataType: "json",
    type: "POST",
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
    cache: true,
  },
});

// if ("webkitSpeechRecognition" in window) {

//     // Speech Recognition Stuff goes here
//    try {
//         let speechRecognition = new webkitSpeechRecognition();
//         speechRecognition.continuous = true;
//         speechRecognition.interimResults = true;
//         speechRecognition.lang = 'en-US';
//         speechRecognition.start();
//         speechRecognition.onresult = function (event) {
//             for (let i = event.resultIndex; i < event.results.length; i++) {
//                 let transcript = event.results[i][0].transcript;
//                 if (event.results[i].isFinal) {
//                     if (transcript != '' && ( transcript == 'check in' ||  transcript == 'check-in' ||  transcript == 'checking')) {
//                         viewModal(url+'/dashboard/ajax-checkin-modal');
//                     }

//                     if (transcript != '' && ( transcript == 'check out' ||  transcript == 'check-out')) {
//                         viewModal(url+'/dashboard/ajax-checkout-modal');
//                     }
//                     console.log(transcript);

//                 }
//             }
//         }
//    } catch (error) {
//     console.log(error);
//    }
//   } else {
//     console.log("Speech Recognition Not Available")
//   }

modalClose = (event) => {
  $(".modal").remove();
  $(".modal-barkdrop").remove();
  $(".modal-backdrop").remove();
  $(".modal-open").removeClass("modal-open");
  $(".modal-backdrop").removeClass("modal-backdrop");
  $(".modal-backdrop").removeClass("modal-backdrop-open");
  $(".modal-backdrop").removeClass("show");
};
