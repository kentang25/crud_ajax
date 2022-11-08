<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>

<!-- Student Add Modal -->
<div class="modal fade" id="studentsAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Students</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    <form id="saveStudents">
      <div class="modal-body">

        <div class="alert alert-warning d-none"></div>

       <div class="mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama" class="form-control">
       </div>

       <div class="mb-3">
        <label for="">Alamat</label>
        <input type="text" name="alamat" class="form-control">
       </div>

       <div class="mb-3">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control">
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Save Students</button>
      </div>
    </form>

    </div>
  </div>
</div>

<!-- Student Edit Modal -->
<div class="modal fade" id="studentsEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Students</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

    <form id="updateStudents">
      <div class="modal-body">

        <div class="alert alert-warning d-none"></div>
        <input type="text" name="students_id" id="students_id">

       <div class="mb-3">
        <label for="">Nama</label>
        <input type="text" name="nama"  id="nama"  class="form-control">
       </div>

       <div class="mb-3">
        <label for="">Alamat</label>
        <input type="text" name="alamat"id="alamat" class="form-control">
       </div>

       <div class="mb-3">
        <label for="">Email</label>
        <input type="email" name="email" id="email" class="form-control">
       </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Update Students</button>
      </div>
    </form>

    </div>
  </div>
</div>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>PHP Ajax CRUD without page reload using Bootstrap Modal
                <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#studentsAddModal">
                Add Student
              </button>
              </h4>
            </div>
            <div class="card-body">

              <table id="myTable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php require_once "pelajar.php"; ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="jquery.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
        $(document).ready(function(){
            $('#saveStudents').on('submit', function (e) {
              e.preventDefault();
              var formData = new FormData(this);
              // console.log(formData)
              $.ajax({
                  type: "POST",
                  url: "code.php",
                  data: formData,
                  processData: false,
                  contentType: false,
                  dataType:'json',
                  success: function (response) {
                      
                      var res = response;
                      if(res.status == 422) {
                          $('#errorMessage').removeClass('d-none');
                          $('#errorMessage').text(res.message);

                      }else if(res.status == 200){
                          Swal.fire('Berhasil Input')

                          $('#errorMessage').addClass('d-none');
                          $('#studentsAddModal').modal('hide');
                          $('#saveStudents')[0].reset();

                          $("#myTable").load(location.href + " #myTable")
                    }
                  }
              });
          });
            $('.editStudentsbtn').on('click', function(){
              var students_id = $(this).val();
              // alert(students_id);

              $.ajax({
                type:"GET",
                url:"code.php?students_id=" + students_id,
                success: function(response){

                  var res = response;
                      if(res.status == 422) {
                         alert(res.message);

                      }else if(res.status == 200){
                          Swal.fire('Berhasil Input')

                          $('#students_id').val(res.data.id);
                          $('#nama').val(res.data.nama);
                          $('#alamat').val(res.data.alamat);
                          $('#email').val(res.data.email);

                          $('#studentsEditModal').modal('show');
                          
                    }
                  }

                

              });
            });
        })
      </script>
  </body>
</html>