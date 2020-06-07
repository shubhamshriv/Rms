<br><br>
<div class="">



<div class="row">
<div class="col-sm-5"></div>
<div class="col-sm-3">

<?php echo form_open_multipart(base_url().'Child','class="form-horizontal addchildform"'); ?>

<!--  <form class="form-horizontal addchildform" action="/action_page.php"> -->
<br>
<h2 style="color: #2b8e51;text-align: center;">ADD CHILD</h2><br>
<div class="alert-danger" style="margin-right: 27px;">
<?php echo validation_errors(); ?>
</div>
<?php if(!empty($error_message)) { ?>
<div class="alert alert-danger" style="margin-right: 27px;">
<?php echo $error_message; ?>
</div>
<?php } ?>
<?php if(!empty($succeess_msg)) { ?>
<div class="alert alert-success" style="margin-right: 27px;">
<?php echo $succeess_msg; ?>
</div>
<?php } ?>
<div class="form-group">
<div class="col-sm-10">
<input type="text" class="input_button2" id="child_name_i" placeholder="NAME" name="child_name_n">
</div>
</div>
<div class="form-group">

<div class="col-sm-10">
<select class="input_button2" name="child_sex_n" id="child_sex_i">

<option value="">SEX</option>

<option value="Male">Male</option>
<option value="Female">Female</option>

</select>
</div>
</div>
<div class="form-group">
<div class="col-sm-5">
<input type="date" class="input_button2" id="child_dob_i" placeholder="DATE OF BIRTH" name="child_dob_n">
</div>
</div>
<div class="form-group">
<div class="col-sm-5">
<input type="text" class="input_button2" id="child_father_name_i" placeholder="FATHER'S NAME" name="child_father_name_n">
</div>
</div>
<div class="form-group">
<div class="col-sm-5">
<input type="text" class="input_button2" id="child_mother_name_i" placeholder="MOTHER'S NAME" name="child_mother_name_n">
</div>
</div>

<div class="form-group">
<div class="col-sm-5">
<select class="input_button2" id="child_state_i" name="child_state_n" >

<option value="">State       </option>
<?php foreach ($all_states as $data) {  ?>
<option value="<?php echo $data->id; ?>"><?php echo $data->state_name; ?></option>
<?php }  ?>
</select>
</div>
</div>

<div class="form-group">
<div class="col-sm-5">
<select class="input_button2" name="child_district_id" id="child_distrct_n">

<option value="">District</option>

</select>
</div>
</div>


<div class="form-group">        
<div class="col-sm-offset-2 col-sm-10">
<div class="checkbox">
<Input type="file" class="btn form_button" name="child_image_n">
</div>
</div>
</div>
<div class="form-group">        
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn form_button">SUBMIT</button>
</div>
</div>
<?php echo form_close(); ?>

</div>
<div class="col-sm-3"></div>

</div>

</div>

<script>
$(document).ready(function(){
$('#child_state_i').change(function(){
var rms_state_id = $('#child_state_i').val();
if(rms_state_id != '')
{
$.ajax({
url:"<?php echo base_url(); ?>District/fetch_district",
method:"POST",
data:{rms_state_id:rms_state_id},
success:function(data)
{
$('#child_distrct_n').html(data);
/* $('#city').html('<option value="">Select City</option>');*/
}
});
}
else
{
/* $('#state').html('<option value="">Select State</option>');
$('#city').html('<option value="">Select City</option>');*/
}
});



});
</script>