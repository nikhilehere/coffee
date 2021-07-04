<!-- cancel modal -->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog cm-modal-dialog" role="document">
		<div class="modal-content order-shop-slide">
			<div class="modal-header cm-modal-header">
				<h4 class="modal-title cm-modal-title">Cancel Order</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			</div>
			<form method="POST" action="/orders/cancel"> @csrf
				<div class="modal-body cm-modal-body cm-alert-body">
					<input type="hidden" name="order_id" id="cancel_order_id">
					<h5 class="modal-title cm-modal-title">Are you sure?</h5>
					<p class="modal-title cm-modal-title">Are you sure that you want to cancel the current order ? <br>Order : <strong id="cm-modal-cancel-order"></strong></p>
					<p class="modal-title cm-modal-title"><i style="font-size: small;color: #586767;">Note: The cancel procedure will automatically cancel if the order process is initiated. </i></p>
				</div>
				<div class="modal-footer cm-modal-footer"> <a class="btn btn-light col-md-6" data-dismiss="modal">Back</a>
					<button type="submit" class="btn btn-danger col-md-6">Yes, Cancel Order</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- cancel modal end-->