<?php include './template/header.php'; ?>

<div id="UpcomingBookPage"></div>

<div class="box box-success">
<div class="box-header with-border">
  <h3 class="box-title">Add New Upcoming Book</h3>
</div><!-- /.box-header -->
<!-- form start -->
<form id="insertUpcomingBkForm">
  <div class="box-body">
  <label class="col-sm-1 control-label">Book Title &amp; Author:</label>
  <div class="col-sm-8">
  <div class="input-group">
    <input type="text" class="form-control" id="upbtitle" name="upbtitle" required="required" placeholder="Insert book title...">
    <span class="input-group-btn">
      <button class="btn btn-success btn-flat" type="button" id="addUpcomingBkBut">Add</button>
    </span>
  </div>
  </div>
  </div><!-- /.box-body -->
</form>
</div>

<div id="listUpcomingBk"></div>


<div id="resultadd"></div>

<button id="deletebut" class="floatDelBut" title="Delete Data"><i class="fa fa-fw fa-trash"></i></button>

<?php include './template/footer.php'; ?>