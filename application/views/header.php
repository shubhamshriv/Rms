<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   <!-- DataTables -->
<!-- DataTables -->
   <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

 <script>
            var base_url = "<?php echo base_url(''); ?>"
        </script>

  <style> 
      .circle {
    border-style: solid;
    border-width: 2px;
    border-color: #4cae65;
    border-radius: 100%;
    height: 110px;
    width: 110px;
    /* position: absolute; */
    /* top: 20px; */
    /* left: 20px; */
    /* margin-top: 25px; */
    margin: 88px auto;
}
.logo{
      padding-top: 34px;
}
.spacing{
  letter-spacing: 4px;
}
.form-control {
  outline: 0;
  border-width: 0 0 0;
  
}
.form-div{
  
      margin-top: 35px;
    width: 417px;

}
.navbar-nav { 
            margin-left: auto; 
        } 

       .navbar-expand-sm .navbar-nav .nav-link {
    padding-right: .5rem;
    padding-left: 5.5rem;
}
p {
    margin-top: 12px;
    margin-bottom: 1rem;
}
a {
    color: #1d2124;
    text-decoration: none;
    background-color: transparent;
}

.rectangles .rectangle {
    border-radius: 10px;
    display: inline-block;
    margin-bottom: 31px;
    margin-right: 20px;
    width: 343px;
    height: 150px;
    border: 2px solid #5ab471;
  
    background-color: white;
    padding: 42px 10px 10px 100px;
    position: relative;
}

.rectangles .rectangle .circle {
 
  border-style: solid;
  border-width: 2px;
border-color:#5ab471;
  border-radius: 100%;
  height: 65px;
  width: 65px;
  position: absolute;
  top: 20px;
  left: 20px;
      margin-top: 25px;
}
.circle_dotted{
  border-style: dotted;
  border-width: 2px;
border-color:#5ab471;
  border-radius: 100%;
  height: 65px;
  width: 65px;
  position: absolute;
  top: 20px;
  left: 20px;
      margin-top: 25px;
}
.input_button {
    border: 0;
    outline: 0;
    border-bottom: 1px solid #707c85;
    margin-bottom: 19px;
}
.state {
    border: 0;
    outline: 0;
    border-bottom: 1px solid #707c85;
    margin-bottom: 1px;
}
.addchildform {
    background-color: white;
    /* padding: 55px; */
    padding-left: 20px;
}
.input_button2 {
    /* padding-right: 25px; */
    border: 0;
    outline: 0;
    border-bottom: 1px solid #707c85;
    margin-bottom: 2px;
    /* margin-left: -2px; */
    /* padding-left: 0px; */
    width: 233px;
}

.form_button {
    color: white;
    background-color: #2b8e51;
    width: 243px;
}

    </style> 
</head>