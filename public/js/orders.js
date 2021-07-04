$('#viewOrderModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    $.ajax({
      url: '/orders/' + id,
      method: 'GET',
      success: function (response) {
        console.log("success", response);
        modal.find('#ViewOrderNo').text(response.order_no);
        modal.find('#ViewOrderProduct').text(response.product);
        modal.find('#ViewOrderQty').text(response.Qty);
        modal.find('#ViewCustomerName').text(response.customer );
        modal.find('#ViewCustomerAddress').text(response.address);
        modal.find('#ViewPayMode').text(response.payMode);
        modal.find('#ViewOrderStatus').text(response.orderStatus);
        modal.find('#ViewOrderTime').text(response.orderTime);
      }
    });
  })

$('#custViewOrderModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    $.ajax({
      url: '/orders/' + id,
      method: 'GET',
      success: function (response) {
        console.log("success", response);
        modal.find('#ViewOrderNo').text(response.order_no);
        modal.find('#ViewOrderProduct').text(response.product);
        modal.find('#ViewOrderQty').text(response.Qty);
        modal.find('#ViewCustomerName').text(response.customer );
        modal.find('#ViewCustomerAddress').text(response.address);
        modal.find('#ViewPayMode').text(response.payMode);
        modal.find('#ViewOrderStatus').text(response.orderStatus);
        modal.find('#ViewOrderTime').text(response.orderTime);
      }
    });
  })

  $('#deleteOrderModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var orderNo = button.data('name')
    var modal = $(this)
    modal.find('#delete_order_id').val(id)
    modal.find('#cm-modal-delete-order').text(orderNo)
  })

  $('#cancelOrderModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var orderNo = button.data('name')
    var modal = $(this)
    modal.find('#cancel_order_id').val(id)
    modal.find('#cm-modal-cancel-order').text(orderNo)
  })