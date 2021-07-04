<!-- delete modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog cm-modal-dialog" role="document">
		<div class="modal-content cm-modal-content">
			<div class="modal-header cm-modal-header">
				<h4 class="modal-title cm-modal-title">Delete Order</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form method="POST" action="/orders/remove"> @csrf
				<div class="modal-body cm-modal-body">
					<input type="hidden" name="order_id" id="delete_order_id">
					<h5 class="modal-title cm-modal-title">Are you sure?</h5>
					<p class="modal-title cm-modal-title">Are you sure that you want to permanently delete the selected order <strong id="cm-modal-delete-order"></strong>?</p>
				</div>
				<div class="modal-footer cm-modal-footer"> <a class="btn btn-light col-md-6" data-dismiss="modal">Cancel</a>
					<button type="submit" class="btn btn-danger col-md-6">Delete</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- delete modal end-->