<?php include './template/header.php'; ?>

<div id="membershipadminpage"></div>
<div class="box box-success" id="UM">
<div class="box-header with-border">
  <h3 class="box-title">Choose Membership</h3>
</div><!-- /.box-header -->
	<form action="membership.php" method="get" id="searchMem">
		  <div class="box-body">
		  <label class="col-sm-1 control-label">Search Member</label>
		  <div class="col-sm-8">
		  <div class="form-group">
				<select name='searchMember' id='searchMemberSelect' class='selectpicker' data-live-search='true' title="Please choose member's name...">
				</select>
		  </div>
		  </div>
		  </div><!-- /.box-body -->
		  <div class="box-footer">
                <button class = "btn btn-success" id="showBox">Search</button>
          </div>
	</form>
</div>

<div id="dis"></div>




<?php include './template/footer.php'; ?>