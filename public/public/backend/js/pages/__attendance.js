
var url = $('#url').val();
var _token = $('meta[name="csrf-token"]').attr('content');


function btnHold(){
    let duration = 600,
        success = button => {
            //Success function
            $('.progress').hide();
            button.classList.add('success');
            checkIn($('#form_url').val());
        };
    document.querySelectorAll('.button-hold').forEach(button => {
        button.style.setProperty('--duration', duration + 'ms');
        ['mousedown', 'touchstart', 'keypress'].forEach(e => {
            button.addEventListener(e, ev => {
                if (e != 'keypress' || (e == 'keypress' && ev.which == 32 && !button
                        .classList.contains('process'))) {
                    button.classList.add('process');
                    button.timeout = setTimeout(success, duration, button);
                }
            });
        });
        ['mouseup', 'mouseout', 'touchend', 'keyup'].forEach(e => {
            button.addEventListener(e, ev => {
                if (e != 'keyup' || (e == 'keyup' && ev.which == 32)) {
                    button.classList.remove('process');
                    clearTimeout(button.timeout);
                }
            }, false);
        });
    });

}
btnHold();
var checkUrl;
var checkIn = (url) => {
    checkUrl = url;
    if (navigator?.geolocation) {
            navigator.geolocation.getCurrentPosition(attendanceStore, positionError, {timeout:10000});
      } else { 
         console.log("Geolocation is not supported by this browser.");
      }


     
}

function positionError(error) {
    var errorCode = error.code;
    var message = error.message;
    // toastr.error(message, 'Error!', {
    //     timeOut: 3000
    // });

    attendanceStore();
}

function attendanceStore(position = null){
    // console.log(position);
    var reason = $('#reason').val();

    $('#reason').val()
    if ($('#reason').length > 0 && (reason == '' || reason == null) ) {
        $('#reason').focus();
        $('#reason').css('border-color', 'red');
        $('.error_show_reason').html('Please enter reason');
        $('.progress').show();
        $('#button-hold').removeClass('success');
        return false;
    }
    $.ajax({
        type: 'GET',
        url: checkUrl,
        data: {
            latitude          : position?.coords?.latitude ?? '23.7909811' ,
            longitude         : position?.coords?.longitude ?? '90.4067015' ,
            remote_mode_in    : parseInt($('input[name="place_mode"]:checked').val() ?? 0) ,
            reason            : reason ?? '',
        },
        success: function (data) {
            if (data?.result) {
                toastr.success(data.message, "Success",{
                    timeOut: 3000
                })
                setTimeout(function () {
                    window.location.href = data?.data; 
                }, 3000)
            }else{
                toastr.error('Something went wrong!', 'Error!', {
                    timeOut: 2000
                });
                }
        },
        error: function (data) {
            console.log(data);
            // console.log(data.responseJSON);
            if(data?.responseJSON?.message){
                toastr.error(data.responseJSON.message, "Error", {
                    timeOut: 2000
                });
                $('.progress').show();
                $('#button-hold').removeClass('success');
                // if (data?.responseJSON?.error) {                    
                //     setTimeout(function () {
                //         window.location.href = data?.responseJSON?.error; 
                //     }, 2000)
                // }
            }
        }
    });
}

textAreaValidate = (value,className) => {
    if (value == '' || value == null) {
        $('.'+className).html('Please enter reason');
        $('.'+className).css('color', 'red');
        return false;
    }else{
        $('.'+className).html('');
        return true;
    }
}

//Working hours 

function append(dl, dtTxt, ddTxt) {
    var dt = document.createElement("dt");
    var dd = document.createElement("dd");
    dt.textContent = dtTxt;
    dd.textContent = ddTxt;
    dl.appendChild(dt);
    dl.appendChild(dd);
  }
  

  

  $(document).ready(function () {
    function workingDuration() {
        var dl = document.getElementById("diff");
        while (dl.hasChildNodes()) {
          dl.removeChild(dl.lastChild);
        }
      let date = new Date();
  
      let year= date.getFullYear();
      let month = date.getMonth();
      let day = date.getDate();
  
      let hh = date.getHours();
      let mm = date.getMinutes();
      let ss = date.getSeconds();
    let working_hours_txt = $('#working_hours').val();
      
      let currentTime = new Date(year, month, day, hh, mm, ss);
        var date1 = new Date($('#in_time').val()).getTime();
        var date2 = currentTime.getTime();
        var msec = date2 - date1;
        var sec = (msec / 1000) % 60;
        var mins = Math.floor(msec / 60000);
        var hrs = Math.floor(mins / 60);
        var days = Math.floor(hrs / 24);
        var yrs = Math.floor(days / 365);
        if (hrs < 10) {
            hrs = "0"+ hrs;
        }
        if (sec < 10) {
            sec = "0"+ sec;
        }
        if (mins < 10) {
            mins = "0"+ mins;
        }


        mins = mins % 60;
        append(dl, working_hours_txt+": ", hrs + ":" + mins + ":" + sec);
        hrs = hrs % 24;
        days = days % 365;
    
      $('#d1').change();
        let t = setTimeout(function () {
            workingDuration()
        }, 1000);
    }
    workingDuration();


    //button hold 

  
});



