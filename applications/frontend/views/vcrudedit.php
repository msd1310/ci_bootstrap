<?php echo form_open('ccrud/update', 'role="form"'); ?>
  <div class="form-group">
    <label for="fn">First Name</label>
    <input type="text" class="form-control" id="fn" name="fn" value="<?php echo $fn ?>">
  </div>
  <div class="form-group">
    <label for="fn">Last Name</label>
    <input type="text" class="form-control" id="ln" name="ln" value="<?php echo $ln ?>">
  </div>
  <div class="form-group">
    <label for="ag">Age</label>
    <input type="text" class="form-control" id="ag" name="ag" value="<?php echo $ag ?>">
  </div>
  <div class="form-group">
    <label for="ad">Address</label>
    <input type="text" class="form-control" id="ad" name="ad" value="<?php echo $ad ?>">
  </div>
  <input type="hidden" name="id" value="<?php echo $id ?>" />
  <input type="submit" name="mit" class="btn btn-primary" value="Update">
  <button type="button" onclick="location.href='<?php echo site_url('ccrud') ?>'" class="btn btn-success">Back</button>
</form>
<?php echo form_close(); ?>
