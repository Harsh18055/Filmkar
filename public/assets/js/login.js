document.getElementById("forgot_telent").onclick = function(){
    $("#employer").removeClass("in show active");
    $("#telent-forgot").addClass("in show active");
    $("#organize-forgot").removeClass("in show active");

  }

  // document.getElementById("telentforgot").onclick = function(){
  //   // alert(document.getElementById("email").value)
  //   var email = document.getElementById("email").value;

  //   $.get("forgotpassword/?user_type=telent&email="+email, function(data){
  //     if(data == true){
  //       $("#msg_telent_forgot").html('Mail Sent!, Please check your inbox.');
  //     }else{
  //       $("#msg_telent_forgot").html('This email address not found!');
  //     }
  //   });

  //   return false;
  // }
  document.getElementById("forgot_organize").onclick = function(){
    $("#telent-forgot").removeClass("in show active");
    $("#candidate").removeClass("in show active");
    $("#organize-forgot").addClass("in show active");

  }
  // document.getElementById("organizeforgot").onclick = function(){
  //   // alert(document.getElementById("email2").value)
  //   var email = document.getElementById("email2").value;

  //   $.get("forgotpassword/?user_type=organize&email="+email, function(data){
  //     if(data == true){
  //       $("#msg_organize_forgot").html('Mail Sent!, Please check your inbox.');
  //     }else{
  //       $("#msg_organize_forgot").html('This email address not found!');
  //     }
  //   });

  //   return false;
  // }

//   document.getElementById("login_telent").onclick = function(){
//     // alert(document.getElementById("email2").value)
//     document.getElementById("login_telent").value = 'Loading...';
//     var email = document.getElementById("email").value;
//     var password = document.getElementById("password").value;

//     var baseUrl = location.protocol + '//' + location.host;
//     // var baseUrl = document.baseURI;
//     $.get(baseUrl+"/checklogin/?user_type=1&email="+email+"&password="+password, function(data){
//       if(data.status === '0'){
//         $("#msg_telent").html(data.message);
//         document.getElementById("login_telent").value = 'Login';
//       }else{
//         $("#msg_telent").html(data.message);
//         document.getElementById("login_telent").value = 'Login';
//         window.setTimeout(function() {
//             window.location.href = '/';
//         }, 1000);
//       }
//     });

//     return false;
//   }

//   document.getElementById("login_organize").onclick = function(){
//     // alert(document.getElementById("email2").value)
//     document.getElementById("login_organize").value = 'Loading...';
//     var email = document.getElementById("email2").value;
//     var password = document.getElementById("password2").value;
//     var baseUrl = location.protocol + '//' + location.host;

//     $.get(baseUrl+"/checklogin/?user_type=2&email="+email+"&password="+password, function(data){
//       // alert(data)
//       if(data.status === '0'){
//         $("#msg_organize").html(data.message);
//         document.getElementById("login_organize").value = 'Login';
//       }else{
//         $("#msg_organize").html(data.message);
//         document.getElementById("login_organize").value = 'Login';
//         window.setTimeout(function() {
//             window.location.href = '/';
//         }, 1000);
//       }
//     });

//     return false;
//   }


$('#login_telent').submit(function(event) {
  event.preventDefault();
  let timerInterval
  Swal.fire({
  title: 'Wait...',
  // html: 'I will close in <b></b> milliseconds.',
  //   timer: 2000,
  timerProgressBar: true,
  didOpen: () => {
      Swal.showLoading()
      const b = Swal.getHtmlContainer().querySelector('b')
      timerInterval = setInterval(() => {
      b.textContent = Swal.getTimerLeft()
      },)
  },
  })
  $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      async: true,
      data: $(this).serialize(),
      success: function(response) {
          if (response.success) {
            $("#msg_telent").html(response.msg);
            willClose: () => {
              clearInterval(timerInterval)
          }
          
          Swal.fire(
                'Welcome to Filmkar!',
                'Login successful.',
                'success',

              ).then(function() {
                location.reload();
                  });
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: response.msg,
            })
            // $("#msg_telent").html(response.msg);
          }
      }
  });
});

$('#form_login_organize').submit(function(event) {
  event.preventDefault();
  let timerInterval;
  Swal.fire({
      title: 'Wait...',
      timerProgressBar: true,
      didOpen: () => {
          Swal.showLoading();
          const b = Swal.getHtmlContainer().querySelector('b');
          timerInterval = setInterval(() => {
              b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
          }, 1000);
      },
  });
  $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      async: true,
      data: $(this).serialize(),
      success: function(response) {
          clearInterval(timerInterval);
          if (response.success) {
              Swal.fire(
                  'Welcome to Filmkar!',
                  response.msg,
                  'success'
              ).then(function() {
                  location.reload();
              });
          } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: response.msg,
              });
          }
      },
  });
});

$('#telent_forgot_form').submit(function(event) {
  event.preventDefault();
  let timerInterval;
  Swal.fire({
      title: 'Wait...',
      timerProgressBar: true,
      didOpen: () => {
          Swal.showLoading();
          const b = Swal.getHtmlContainer().querySelector('b');
          timerInterval = setInterval(() => {
              b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
          }, 1000);
      },
  });
  $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      async: true,
      data: $(this).serialize(),
      success: function(response) {
          clearInterval(timerInterval);
          if (response.success) {
              Swal.fire(
                  'Password reset link sent!',
                  'Please check your email.',
                  'success'
              ).then(function() {
                  location.reload();
              });
          } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: response.msg,
              });
          }
      },
  });
});

$('#organize_forgot_form').submit(function(event) {
  event.preventDefault();
  let timerInterval;
  Swal.fire({
      title: 'Wait...',
      timerProgressBar: true,
      didOpen: () => {
          Swal.showLoading();
          const b = Swal.getHtmlContainer().querySelector('b');
          timerInterval = setInterval(() => {
              b.textContent = Math.ceil(Swal.getTimerLeft() / 1000);
          }, 1000);
      },
  });
  $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      async: true,
      data: $(this).serialize(),
      success: function(response) {
          clearInterval(timerInterval);
          if (response.success) {
              Swal.fire(
                  'Password reset link sent!',
                  'Please check your email.',
                  'success'
              ).then(function() {
                  location.reload();
              });
          } else {
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: response.msg,
              });
          }
      },
  });
});

