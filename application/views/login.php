
<body class="bg-white">

  <div class="container">
    
    <div class="circle">
     <h3 class="text-center font-weight-bold logo" style="color: #4cae65">LOGO</h3>
    </div>

    <div><h3 class="text-center spacing" style="color: ##43425d">Login</h3></div>

  </div>

  <div class="container form-div">
    <?php if(validation_errors()) { ?>
      <div class="alert alert-danger">
        <?php echo validation_errors(); ?>
      </div>
    <?php } ?>

    <?php if(!empty($error_message)) { ?>
      <div class="alert alert-danger">
        <?php echo $error_message; ?>
      </div>
    <?php } ?>

  <?php echo form_open(base_url()."Login"); ?>
    <div class="form-group input-group-sm">
    
      <input type="text" class="form-control shadow-sm" id="rms_user_id" placeholder="Username" name="rms_user_n" autocomplete="off">
    </div>
    <div class="form-group input-group-sm">
    
      <input type="password" class="form-control shadow-sm" id="rms_password_id" placeholder="password" name="rms_password_n" autocomplete="off">
    </div>
   
    <button type="submit" class="btn btn-primary form-div" style="background-color: #0d7e39;width: -webkit-fill-available;">Login</button>
<?php echo form_close(); ?> 
</div>


</body>

