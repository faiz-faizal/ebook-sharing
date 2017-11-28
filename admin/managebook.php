<?php include './template/header.php'; ?>

<div id="manageBook"></div>


<div id="listAllBook"></div>


<div id="resultadd"></div>

<button id="deletebutManageBook" class="floatDelBut" title="Delete Data"><i class="fa fa-fw fa-trash"></i></button>


<!-- Update Data Modal -->
<div class="modal fade" id="upDataModal">
  <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" id="closeModal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-fw fa-close"></i></span></button>
    <h4 class="modal-title">Update Data</h4>
    </div>
    <div class="modal-body">
    
    <div id="dispUpdateDataModal"></div>
    
    </div>
    <div class="modal-footer">
    <button type="button" id="updatedat" class="btn btn-success pull-right">Update</button>
    </div>
  </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>

<?php include './template/footer.php'; ?>