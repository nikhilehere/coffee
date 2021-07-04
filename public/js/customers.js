$('#viewCustomerModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var modal = $(this)
    $.ajax({
      url: '/customers/' + id,
      method: 'GET',
      success: function (response) {
        console.log("success", response);
        modal.find('#ViewCustomerName').text(response.name);
        modal.find('#ViewCustomerAge').text(response.age);
        modal.find('#ViewCustomerGender').text(response.gender);
        modal.find('#ViewCustomerMobile').text(response.mobile );
        modal.find('#ViewCustomerEmail').text(response.email);
        modal.find('#ViewCustomerAddress').text(response.address);
        modal.find('#ViewCustomerWallet').text(response.wallet);
      }
    });
  })

  $('#deleteCustomerModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var customerName = button.data('name')
    var modal = $(this)
    modal.find('#delete_customer_id').val(id)
    modal.find('#cm-modal-delete-customer').text(customerName)
  })