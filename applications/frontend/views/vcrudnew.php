<?php echo form_open('ccrud/save', 'role="form"'); ?>
  <div class="form-group">
    <label for="fn">First Name</label>
    <input type="text" class="form-control" id="fn" name="fn">
  </div>
  <div class="form-group">
    <label for="fn">Last Name</label>
    <input type="text" class="form-control" id="ln" name="ln">
  </div>
  <div class="form-group">
    <label for="ag">Age</label>
    <input type="text" class="form-control" id="ag" name="ag">
  </div>
  <div class="form-group">
    <label for="ad">Address</label>
    <input type="text" class="form-control" id="ad" name="ad">
  </div>
  <input type="submit" name="mit" class="btn btn-primary" value="Submit">
  <button type="button" onclick="location.href='<?php echo site_url('ccrud') ?>'" class="btn btn-success">Back</button>
</form>
<?php echo form_close(); ?> 
