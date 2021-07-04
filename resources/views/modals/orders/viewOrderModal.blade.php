<!-- Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" role="dialog" aria-hidden="true"
  aria-labelledby="">
  <div class="modal-dialog cm-modal-dialog" role="document">
    <div class="modal-content cm-modal-content">
      <div class="modal-header cm-modal-header">
        <h5 class="modal-title cm-modal-title">Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
            aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body cm-modal-body">
        <!-- ----------------------- contents ---------------- -->
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Order No</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewOrderNo"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Product</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewOrderProduct"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Quantity</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewOrderQty"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Customer Name</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewCustomerName"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Customer Address</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewCustomerAddress"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Pay Mode</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewPayMode"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Status</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewOrderStatus"></label>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Date and Time</label>
          <label class="col-sm-1 col-form-label">:</label>
          <label class="col-sm-8 col-form-label" id="ViewOrderTime"></label>
        </div>
        <!-- ------------------------end -------------------- -->
      </div>
      <div class="modal-footer cm-modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
