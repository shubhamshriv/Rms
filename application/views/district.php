<style type="text/css">
  .rectangles .rectangle {
    border-radius: 10px;
    display: inline-block;
    margin-bottom: 31px;
    margin-right: 20px;
    width: 343px;
    height: 183px;
    border: 2px solid #5ab471;
    background-color: white;
    padding: 42px 10px 10px 100px;
    position: relative;
}
</style>
<br><br>
<div class="container">
    <div class="alert-danger">
        <?php echo validation_errors(); ?>
      </div>
      <?php if(!empty($error_message)) { ?>
      <div class="alert alert-danger">
        <?php echo $error_message; ?>
      </div>
    <?php } ?>
    <?php if(!empty($succeess_msg)) { ?>
      <div class="alert alert-success">
        <?php echo $succeess_msg; ?>
      </div>
    <?php } ?>
<div class="rectangles">
    <div class="rectangle">
      
     <?php echo form_open(base_url()."District"); ?>
      <select class="state" name="rms_state_id" id="sel1">

        <option>Select State Name</option>
        <?php foreach ($all_states as $data) {  ?>
        <option value="<?php echo $data->id; ?>"><?php echo $data->state_name; ?></option>
        <?php }  ?>
      </select>
    
        <div class="circle_dotted"> <p class="text-center font-weight-bold" style="color: green;font-size: x-large;">+<p></div>
            
            
        <input type="text" class="input_button" id="rms_district_id" placeholder="Enter District Name" name="rms_district_n" autocomplete="off">

        

      <button type="submit" class="btn btn-success">Add District</button>
      <br><br>
      <?php echo form_close(); ?> 
    </div>
<?php foreach ($all_district as $data) {  ?>
                 <div class="rectangle">
        <div class="circle"> <p class="text-center font-weight-bold" style="color: green">122<p></div>
        <p class="ceo"><?php echo $data->state_name; ?></p>
        <p class="ceo"><?php echo $data->district_name; ?></p>
         <br> <br>
       
    </div>
                
<?php }  ?>
 

    
</div>

</div>