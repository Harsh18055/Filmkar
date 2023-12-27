  $('#subscribe').submit(function(event) {
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
            willClose: () => {
              clearInterval(timerInterval)
          }
          
          Swal.fire(
                'Welcome to Filmkar!',
                response.msg,
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
