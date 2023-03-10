
$(document).ready(function () {
  let latitude = parseFloat($('#latitude').val());
  let longitude = parseFloat($('#longitude').val());
  let default_zoom = parseFloat($('#default_zoom').val());
  let distance = $('#distance').val() ?? 0;
  var map;
  var marker;
  var circle;
  var auto_detect = false;

  function circleMap() {
    // remove old circle map
    if (circle) {
      circle.setMap(null);
    }
    //  radius_map = parseFloat( parseFloat(3.14159 * (parseFloat(distance) * parseFloat(distance))) / 1000 );
    circle = new google.maps.Circle({
      map: map,
      radius: parseFloat(distance),    // 10 miles in metres
      fillColor: '#36AA4A',
      strokeColor: '#36AA4A',
      strokeOpacity: 0.5,
      strokeWeight: 2,
      fillOpacity: 0.5
    });
    circle.bindTo('center', marker, 'position');
  }

  function mapInit() {
    defaultLatLong = {
      lat: parseFloat(latitude),
      lng: parseFloat(longitude)
    };

    map = new google.maps.Map(document.getElementById('map'), {
      center: defaultLatLong,
      zoom: default_zoom,
      mapTypeId: 'roadmap'
    });

    map.setOptions({
      scrollwheel: true, //
      zoomControl: true,
      mapTypeControl: true,
      scaleControl: true,
      streetViewControl: true,
      rotateControl: true,
      fullscreenControl: true,
    });

    var input = document.getElementById('pac-input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    marker = new google.maps.Marker({
      map: map,
      position: defaultLatLong,
      draggable: true,
      clickable: true,
      animation: google.maps.Animation.DROP

    });
    circleMap();
    
    google.maps.event.addListener(marker, 'dragend', function (marker) {
      var latLng = marker.latLng;
      currentLatitude = latLng.lat();
      currentLongitude = latLng.lng();
      var latlng = {
        lat: currentLatitude,
        lng: currentLongitude
      };
      latitude = currentLatitude;
      longitude = currentLongitude;
      var geocoder = new google.maps.Geocoder;
      geocoder.geocode({
        'location': latlng
      }, function (results, status) {
        if (status === 'OK') {
          console.log(results);
          if (results[0]) {
            input.value = results[0].formatted_address;
            $('input[name="location"]').attr('value',input.value);
            circleMap();
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    });

    autocomplete.addListener('place_changed', function () {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        return;
      }
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
      }

      marker.setPosition(place.geometry.location);

      currentLatitude = place.geometry.location.lat();
      currentLongitude = place.geometry.location.lng();
      latitude = currentLatitude;
      longitude = currentLongitude;
      circleMap();
    });



  }


  locationPicker = (val, ur) => {
    $.get(ur + '?q=' + val, function (data) {
      if (data == 'fail') {
        setTimeout(function () {
          toastr.error('Something went wrong!', 'Error!', {
            timeOut: 2000
          });
        }, 500);
      } else {
        $(data).appendTo('body').modal({
          backdrop: 'static',
          keyboard: false
        });
        // map();

      }
    })

  }
  mapInit();

  locationPickerStore = (ur) => {
    let is_submit = true;
    distance = $('#distance').val();
    let status_id = $('#status_id').val();
    let location = $('input[name="location"]').val();
    let is_office = $('#is_office').val();
    let user_id = $('#employee_id').val();
    if (distance == '' || distance == null || distance == undefined || distance == 0) {
      //error message
      $('#distance').next('.invalid-feedback').remove();
      $('#distance').addClass('is-invalid');
      is_submit = false;
    }
    if(user_id == '' || user_id == null || user_id == undefined){
      $('#employee_id').next('.invalid-feedback').remove();
      $('#employee_id').addClass('is-invalid');
      is_submit = false;
    }
    if (status_id == '') {
      //error message
      $('.status_error').html('');
      is_submit = false;
    }
    // console.log(location);
    if (location == '') {
      //error message
      $('.location').addClass('is-invalid');
      is_submit = false;
    }
    if (is_office == '') {
      //error message
      $('#is_office').addClass('is-invalid');
      is_submit = false;
    }
    console.log(ur);
    if (is_submit) {
      $.ajax({
        url: ur,
        type: 'POST',
        data: {
          distance: distance,
          status: status_id,
          location: location,
          latitude: latitude,
          longitude: longitude,
          user_id: user_id,
          is_office: is_office
        },
        success: function (data) {
          if (data?.result == true) {
            toastr.success(data.message, "Success", () => { timeOut: 3000 });
            setTimeout(function () {
              window.location.href = data?.data;
            }, 3000);
          }
        },
        error: function (data) {
          if (data?.responseJSON?.error?.distance) {
            $('#distance').next('.invalid-feedback').remove();
            $('#distance').addClass('is-invalid');
            $('#distance').after('<div class="invalid-feedback">' + data.responseJSON?.error?.distance + '</div>');
          }
          //user_id
          if (data?.responseJSON?.error?.user_id) {
            $('#employee_id').next('.invalid-feedback').remove();
            $('#employee_id').addClass('is-invalid');
            $('#employee_id').after('<div class="invalid-feedback">' + data.responseJSON?.error?.user_id + '</div>');
          }
          if (data?.responseJSON?.error?.status) {
            $('.status_error').html('');
            $('.status_error').append('<div class="invalid-feedback">' + data.responseJSON?.error?.status + '</div>');
          }
          if (data?.responseJSON?.error?.location) {
            $('.location').addClass('is-invalid');
          }
          if (data?.responseJSON?.message) {
            toastr.error(data.responseJSON.message, "Error", {
              timeOut: 2000
            });
          } else {
            toastr.error('Something went wrong!', 'Error!', {
              timeOut: 3000
            });
          }
        }
      });
    }

  }
  $('#distance').on('keyup', function () {
    if ($(this).val() != '') {
      $(this).removeClass('is-invalid');
      $(this).next('.invalid-feedback').remove();
    }
    distance = $('#distance').val();
    circleMap();

  });

  $('.location').on('keyup', function () {
    if ($(this).val() != '') {
      $(this).removeClass('is-invalid');
    }
  });



  function detectLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      console.log('Location is not available');
    }
  }
  function showPosition(position) {
    latitude = position.coords.latitude;
    longitude = position.coords.longitude;
    $('#latitude').val(latitude);
    $('#longitude').val(longitude);
    getReverseGeocodingData(latitude, longitude);
  }

  $('#detectLocation').on('click touchmove', function () {
    detectLocation();
    auto_detect=true;
    detectLocation();
  });

  // detectLocation();
  // auto_detect=true;
  // detectLocation();

  function getReverseGeocodingData(lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    // This is making the Geocode request
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'latLng': latlng }, (results, status) => {
      if (status !== google.maps.GeocoderStatus.OK) {
        console.log(status);
      }
      // This is checking to see if the Geoeode Status is OK before proceeding
      if (status == google.maps.GeocoderStatus.OK) {
        var address = (results[0].formatted_address);
        var address_input = $('#pac-input');
        var location_input = $('#location_input');
        address_input.attr('value',address);
        $('input[name="location"]').attr('value',address);
       
        
        mapInit();
        location_input.append(`<input id="pac-input" class="form-control controls location pac-target-input" type="text" placeholder="Enter a location" onkeydown="return (event.keyCode!=13);" autocomplete="off" style="position: absolute; left: 20px; top: 0px;">
        <input type="hidden"  name="location">
        `
        );

      }
    });
  }
});


