$('#viewProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    $.ajax({
      url: '/products/' + id,
      method: 'GET',
      success: function (response) {
        console.log("success", response);
        modal.find('#ViewProductName').text(response.product_name);
        modal.find('#ViewShortProductNo').text(response.product_no);
        modal.find('#ViewProductCost').text(response.product_cost);
        modal.find('#ViewProductQuantity').text(response.quantity + 'ml');
        modal.find('#ViewProductAvailability').text(response.active == 1 ? 'Available' : 'Not Available');
  
      }
    });
  })

  $('#deleteProductModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var productName = button.data('name')
    var modal = $(this)
    modal.find('#delete_product_id').val(id)
    modal.find('#cm-modal-delete-product').text(productName)
  })