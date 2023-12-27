function jobapplied(job_posts_id){
    Swal.fire({
    title: 'Are you sure?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, Apply!'
  }).then((result) => {
    if (result.isConfirmed) {
  
      var user_id = {{ Session::get('USER_ID') }};
  
      $.get("job/apply/"+user_id+'/'+job_posts_id, function(data){
          if(data == true){
            Swal.fire(
              'Applied!',
              'Your application has been applied.',
              'success'
            );
          }else{
            Swal.fire('You Are Alredy applied!');
          }
      });
      
    }
  })
  }