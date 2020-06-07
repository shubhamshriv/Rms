<style type="text/css">
	small{
    font-size: large;
}
</style>
<br><br>
<div class="container" style="
    background: white;">
	
<div class="row">
	<div class="col-sm-4">
     
      <br>
      <img src="<?php echo base_url($child_info->image); ?>" class="rounded-circle" alt="Cinque Terre" width="100" height="100">
    </div>
    <div class="col-sm-4">
     
     
    </div>
    <div class="col-sm-4">
     
    
    </div>
</div>	
<br>
<div class="row">
	<div class="col-sm-4">
     
      <p> <h6>Name <small>: <?php echo $child_info->name; ?></small></h6></p>
    </div>
    <div class="col-sm-4">
     <p> <h6>Sex <small>: <?php echo $child_info->sex; ?></small></h6></p>
     
    </div>
    <div class="col-sm-4">
     <p> <h6>Date Of birth <small>: <?php echo $child_info->dob; ?></small></h6></p>
    
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
     
      <p> <h6>Father's Name <small>: <?php echo $child_info->father_name; ?></small></h6></p>
    </div>
    <div class="col-sm-4">
     
     <p> <h6>Mother's Name <small>: <?php echo $child_info->mother_name; ?></small></h6></p>
    </div>
    <div class="col-sm-4">
     <p> <h6>State <small>: <?php echo $child_info->rms_state_name; ?></small></h6></p>
    
    </div>
</div>
<div class="row">
	<div class="col-sm-4">
     
      <p> <h6>District <small>: <?php echo $child_info->district_name; ?></small></h6></p>
    </div>
    <div class="col-sm-4">
     
    
    </div>
    <div class="col-sm-4">
     
    </div>
</div>
<br><br>
</div>