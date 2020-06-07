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

        <div class="circle_dotted"> <p class="text-center font-weight-bold" style="color: green;font-size: x-large;">+<p></div>
            
            <?php echo form_open(base_url()."State"); ?>
        <input type="text" class="input_button" id="rms_state_id" placeholder="Enter State Name" name="rms_state_n" autocomplete="off">

        <br>

      <button type="submit" class="btn btn-success">Success</button>
      <?php echo form_close(); ?> 
    </div>
<?php foreach ($all_states as $data) {  ?>
                 <div class="rectangle">
        <div class="circle"> <p class="text-center font-weight-bold" style="color: green">122<p></div>
        <p class="ceo"><?php echo $data->state_name; ?></p>
         <p class="ceo"> <br>  </p>
       
    </div>
                
<?php }  ?>
 

    
</div>

</div>