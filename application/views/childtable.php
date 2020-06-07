<br><br>
<div class="container" style="
    background-color: white;">
   
<br>
    <a href="<?php echo base_url('Child'); ?>" style="
    background-color: #2b8e51;" class="btn btn-info float-right btn-sm " data-toggle="tooltip" title="ADD CHILD"> ADD Child<i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        <table id="child_list" class="table">
            <thead>
                <tr class="">
                    <th>#</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Date Of Birth</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>State</th>
                     <th>District</th>
                      <th>Action</th>
                   
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
  


</div>

<script type="text/javascript">

  document.addEventListener("DOMContentLoaded", function () {
        makeDataTable('child_list', 'Child/ajaxChildtList');
    });
  
  function makeDataTable(id, url) {

    $('#' + id).DataTable({
        "serverSide": true,
        "processing": true,
        ordering: false,
        searching: true,
        "bLengthChange": true,
        "ajax": {
            url: "http://localhost/Rms/Child/ajaxChildtList", // json datasource
            type: "post", // method  , by default get
            dataType: "json",
            error: function (data, res, test) {  // error handling
                console.log(res);
               
            },
            complete: function (data, res, test) {
             
                tooltip();
                // hideLoader();
            },
            beforeSend: function (data, res, test) {
                // showLoader();
            }
        }
    });

    // $('#' + id).DataTable({});
}

function tooltip() {
    $('[data-toggle="tooltip"]').tooltip();
}

</script>