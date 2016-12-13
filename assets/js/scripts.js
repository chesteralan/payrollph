(function($){

  $('.datepicker').datepicker();
  $('select').selectpicker({
    liveSearch : true,
  });

  $('.confirm').click(function(){
  	if(confirm('Are you sure?')) {
  		return true;
  	} else {
  		return false;
  	}
  });

  $('.add_deposits').click(function(){
  	$('#addDepositModal-title').text($(this).attr('data-title'));
  	$('#addDepositModal-bankid').val($(this).attr('data-bankid'));	
  	$('#addDepositModal-amount').val($(this).text().replace(/,/g,'').trim());	
  });
  $('.add_disbursement').click(function(){
  	$('#addDisbursementModal-title').text($(this).attr('data-title'));
  	$('#addDisbursementModal-bankid').val($(this).attr('data-bankid'));
  	$('#addDisbursementModal-amount').val($(this).text().replace(/,/g,'').trim());	
  });
  $('#addDepositModal').on('shown.bs.modal', function () {
    $('#addDepositModal-amount').focus().select();
  });
  $('#addDisbursementModal').on('shown.bs.modal', function () {
    $('#addDisbursementModal-amount').focus().select();
  });

  $('.hoverPopBottom').popover({
    trigger : 'hover',
    placement : 'bottom',
    html : true,
  });
   $('.hoverPopRight').popover({
    trigger : 'hover',
    placement : 'right',
    html : true,
  });

  $('select.select_account_titles').click(function(){
    var at = JSON.parse(account_titles);
    var html = '<option value="">- - Account Title - -</option>';
    var set_options = function(at,p) {
       for(a in at) {
        html += '<option value="'+at[a].id+'">'+p+" "+at[a].title+'</option>';
        if( at[a].children.length > 0) {
          set_options(at[a].children, p + " - -");
        }
       }
    };
    set_options(at,'');
    //$(this).html(html);
  });

  $('.autocomplete-navbarsearch').autocomplete({
      source: function( request, response ) {
        var ths = $(this);
        var source = ths[0]['element'][0]['dataset'].source;
        $.ajax({
          url: source,
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        var redirect = event['target']['dataset'].redirect;
        if( redirect == '1') {
          window.location.href=ui.item.redirect;
        }
      }
    });

  $('.autocomplete-member_change').autocomplete({
      source: function( request, response ) {
        var ths = $(this);
        var source = ths[0]['element'][0]['dataset'].source;
        var current_sub_uri = ths[0]['element'][0]['dataset'].current_sub_uri;
        $.ajax({
          url: source,
          dataType: "json",
          data: {
            term: request.term,
            sub_uri : current_sub_uri
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
          window.location.href=ui.item.redirect;
      }
    });

  var autocomplete_name_select_change_name = function(){
    var name_id = $(this).attr('data-name_id');
    var timestamp = $(this).attr('data-timestamp');
    $('#'+name_id).val('');
    $('.autocomplete-name_select-name-display-'+ timestamp).remove();
    $('.autocomplete-name_select-name-input-'+ timestamp).val('').show().focus().removeClass( 'autocomplete-name_select-name-input-'+ timestamp );
  };

  $('#changeName').click(autocomplete_name_select_change_name);

  $('.changeName').click(autocomplete_name_select_change_name);

  var autocomplete_name_select_options = {
      source: function( request, response ) {
        var ths = $(this);
        var source = ths[0]['element'][0]['dataset'].source;
        $.ajax({
          url: source,
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        var name_id = event['target']['dataset'].name_id;
        var full_name = event['target']['dataset'].full_name;
        var target = $(event['target']);
        var name = $('<div/>').addClass('form-control');
        var link = $('<a/>').addClass('badge');
        var timestamp = $.now();

        target.addClass('autocomplete-name_select-name-input-' + timestamp );
        
        name.html( link.text( ui.item.label ) );
        name.addClass('autocomplete-name_select-name-display-' + timestamp );
        name.insertAfter( target );

        link.prop('href', '#changeName');
        link.attr('data-id', ui.item.id );
        link.attr('data-name_id', name_id );
        link.attr('data-timestamp', timestamp );

          link.click(function(){
            var name_id = $(this).attr('data-name_id');
            var timestamp = $(this).attr('data-timestamp');
            $('#'+name_id).val('');
            $('.autocomplete-name_select-name-display-'+ timestamp).remove();
            $('.autocomplete-name_select-name-input-'+ timestamp).val('').show().focus().removeClass( 'autocomplete-name_select-name-input-'+ timestamp );
          });
        name.prepend( link );

        target.hide();
        $('#'+name_id).val(ui.item.id);
        $('#'+full_name).val(ui.item.label);
      }
    };

  $('.autocomplete-name_select').autocomplete( autocomplete_name_select_options );

  $('#split_bank_entry').click(function(){ 
    var timestamp = $.now();
    var id = $(this).attr('data-id');
    var link = $('<a/>').addClass('pull-right');
        link.prop('href', '#removeThisSplit');
        link.attr('data-timestamp', timestamp );
        link.html('<span class="glyphicon glyphicon-remove"></span>');
        link.click(function(){
          var timestamp = $(this).attr('data-timestamp');
          $('.duplicate_bank_entry_'+timestamp).remove();
        });
    $('#'+id).after( "<tr class='duplicate_bank_entry_"+timestamp+"'>" + $('#'+id).html() + "</tr>" );
    $('.duplicate_bank_entry_'+timestamp+' .split_bank_entry').after( link );
    $('.duplicate_bank_entry_'+timestamp+' .split_bank_entry').remove();
    $('.duplicate_bank_entry_'+timestamp+' td.class_names').html( "<select type=\"text\" class=\"form-control class_names\" name=\"class_name[]\" title=\"Select a Class...\">" + $('#bank_entry td.class_names select.class_names').html() + "</select>" );
    $('.duplicate_bank_entry_'+timestamp+' td.class_names select.class_names').selectpicker({
      liveSearch : true,
    });

  });

  var edit_invoices = false;
  $('.edit_invoices').click(function(){
    if( edit_invoices ) {
      $('.edit_invoices_item').hide();
      $(this).text('Edit Invoices');
      edit_invoices = false;
    } else {
      $('.edit_invoices_item').show();
      $(this).text('Cancel Edit Invoices');
      edit_invoices = true;
    }
  });
  $('.edit_invoices_select_all').click(function(){
    if($(this).prop('checked')) {
      $('input.edit_invoices_delete_item').prop('checked',true);
    } else {
      $('input.edit_invoices_delete_item').prop('checked',false);
    }
  });

  var autosum = function(input, output){
    var total = 0;
    $(input).each(function(){
      total += parseFloat( $(this).val().replace(',','') );
    });
    $(output).text( (Math.round(total * 100) / 100) );
  };
  $('.payment_autoapply').click(function(){
    var max_amount = parseFloat($(this).attr('data-max_amount'));
    var input = $(this).attr('data-input');
    $('.'+input).each(function(){
      var limit = parseFloat( $(this).attr('data-limit') );
      var amount = (max_amount > limit) ? limit : max_amount;
      $(this).val( (amount > 0) ? (Math.round(amount * 100) / 100) : 0 );
       max_amount -= parseFloat( limit );
    });
    autosum('.'+input, '#autosum-output');
  });
  $('.payment_unapply').click(function(){
      var input = $(this).attr('data-input');
      $('.'+input).each(function(){
        $(this).val( '0.00' );
      });
      autosum('.'+input, '#autosum-output');
  });

    var total_deposits = function(){
      var total_selected_deposits = 0;
      $('.deposit_item:checked').each(function(){
        var rId = $(this).val();
        var amount = parseFloat( $(this).attr('data-amount') );
        
        total_selected_deposits += amount;
        
        $('.total_selected_deposits').text( numeral( total_selected_deposits ).format('0,0.00')  );

        if( total_selected_deposits > 0) {
          $('.deposits_receipts_selected').show();
        } else {
          $('.deposits_receipts_selected').hide();
        }
      });
    };
   $('#deposits_select_all').click(function(){
      if($(this).prop('checked')) {
        $('input.deposit_item').prop('checked',true);
      } else {
        $('input.deposit_item').prop('checked',false);
      }
      total_deposits();
    });
   $('input.deposit_item').click(function(){
      var rId = $(this).val();
      if($(this).prop('checked')) {
          $('#sales-receipt-' + rId).addClass('success');
      } else {
          $('#sales-receipt-' + rId).removeClass('success');
      }
      total_deposits();
   });

   $('.select_sales_receipt td.clickable').click(function(){
       var rId = $(this).parent().attr('data-id');
       $('#deposit_item-' + rId).trigger('click');
   });


  var ajaxModalUrl = null;
  $('.ajax-modal').click(function(){
    var hide_footer = $(this).attr('data-hide_footer');
    $('#ajaxModal .modal-title').text( $(this).attr('data-title') );
    ajaxModalUrl = $(this).attr('data-url');
     if( hide_footer ) {
        $('#ajaxModal .modal-footer').hide();
      } else {
        $('#ajaxModal .modal-footer').show();
      }
  });
  $('#ajaxModal').on('shown.bs.modal', function () {
    $('#ajaxModal form').prop( 'action', ajaxModalUrl );
      $.ajax({
        url : ajaxModalUrl,
        method : 'GET',
        dataType : 'html'
      }).success(function(html){
        $('#ajaxModal .loader').slideUp('slow');
        $('#ajaxModal .output').css('display', 'none').html( html ).slideDown('slow');
        var loadLib = function() {

$('#ajaxModal .datepicker').datepicker();
        $('#ajaxModal select').selectpicker({
          liveSearch : true,
        });
        $('#ajaxModal .confirm').click(function(){
          if(confirm('Are you sure?')) {
            return true;
          } else {
            return false;
          }
        });
    $('#ajaxModal .autocomplete-name_select').autocomplete({
      source: function( request, response ) {
        var ths = $(this);
        var source = ths[0]['element'][0]['dataset'].source;
        $.ajax({
          url: source,
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        var name_id = event['target']['dataset'].name_id;
        var full_name = event['target']['dataset'].full_name;
        var target = $(event['target']);
        var name = $('<div/>').addClass('form-control');
        var link = $('<a/>').addClass('badge');
        var timestamp = $.now();

        target.addClass('autocomplete-name_select-name-input-' + timestamp );
        
        name.html( link.text( ui.item.label ) );
        name.addClass('autocomplete-name_select-name-display-' + timestamp );
        name.insertAfter( target );

        link.prop('href', '#changeName');
        link.attr('data-id', ui.item.id );
        link.attr('data-name_id', name_id );
        link.attr('data-timestamp', timestamp );

          link.click(function(){
            var name_id = $(this).attr('data-name_id');
            var timestamp = $(this).attr('data-timestamp');
            $('#'+name_id).val('');
            $('.autocomplete-name_select-name-display-'+ timestamp).remove();
            $('.autocomplete-name_select-name-input-'+ timestamp).val('').show().focus().removeClass( 'autocomplete-name_select-name-input-'+ timestamp );
          });
        name.prepend( link );

        target.hide();
        $('#'+name_id).val(ui.item.id);
        $('#'+full_name).val(ui.item.label);
      }
    });
        $('#ajaxModal #changeName').click(function(){
          var name_id = $(this).attr('data-name_id');
          var timestamp = $(this).attr('data-timestamp');
          $('#'+name_id).val('');
          $('.autocomplete-name_select-name-display-'+ timestamp).remove();
          $('.autocomplete-name_select-name-input-'+ timestamp).val('').show().focus().removeClass( 'autocomplete-name_select-name-input-'+ timestamp );
        });


$('.ajax-modal-inner').each(function(){
  var href=$(this).prop('href');
  $(this).attr('data-url', href);
  $(this).prop('href', '#ajax-modal-inner');
});

$('.ajax-modal-inner').click(function(){
    ajaxModalUrl = $(this).attr('data-url');
    $('#ajaxModal form').prop( 'action', ajaxModalUrl );
    $('#ajaxModal .loader').slideDown('slow');
    $('#ajaxModal .modal-footer').hide();
     $('#ajaxModal .output').slideUp('slow').html( '' );
      $.ajax({
        url : ajaxModalUrl,
        method : 'GET',
        dataType : 'html'
      }).success(function(html){
        $('#ajaxModal .modal-footer').show();
        $('#ajaxModal .loader').slideUp('slow');
        $('#ajaxModal .output').css('display', 'none').html( html ).slideDown('slow');
         loadLib();
      });
  });

/*
  $('#ajaxModalForm').submit(function(e){
        $('#ajaxModal .modal-footer').slideUp();
        $('#ajaxModal .output').slideUp('slow', function(){
          $('#ajaxModal .loader').slideDown('slow');
        });
        console.log( $(this).serialize() );
        $.ajax({
           type: $(this).prop('method'),
           url: $(this).prop('action'),
           data: $(this).serialize(), // serializes the form's elements.
           success: function(data)
           {
                $('#ajaxModal').modal('hide');
           }
         });

      e.preventDefault(); // avoid to execute the actual submit of the form.
  });
*/

  }; // loadLib

  loadLib();

});
  }).on('hidden.bs.modal', function (e) {
      $('#ajaxModal .loader').show();
      $('#ajaxModal .modal-footer').hide();
      $('#ajaxModal .output').html( '' );
  });

  $('#recon input.recon_item').click(function(){ 

    var trn_id = $(this).val();
   if( $(this).prop('checked') ) {
      $('#list-group-item-'+trn_id).addClass('highlight');
   } else {
      $('#list-group-item-'+trn_id).removeClass('highlight');
   }

    var recon_balance = {
      'deposit' : 0,
      'disburse' : 0,
    };

    $('#recon input.recon_item:checked').each(function(){
        var type = $(this).attr('data-type');
        var amount = $(this).attr('data-amount');
          recon_balance[type] = parseFloat( recon_balance[type] ) + parseFloat( amount );
    });

    var balance_beg = parseFloat( $('#recon_balance_beg').text().replace(',', '') );
    var balance_end = parseFloat( $('#recon_balance_end').text().replace(',', '') );
    var balance_cleared = 0;
    
    balance_cleared = (balance_beg + recon_balance.deposit) - recon_balance.disburse; 
    balance_difference = ((balance_end - balance_beg) + recon_balance.disburse) - recon_balance.deposit; 
   
    $('#recon_output_disburse').text( numeral( recon_balance['disburse'] ).format('0,0.00') );
    $('#recon_output_deposit').text( numeral( recon_balance['deposit'] ).format('0,0.00') );
    $('#recon_output_cleared').text( numeral( balance_cleared ).format('0,0.00') );
    $('#recon_output_difference').text( numeral( balance_difference ).format('0,0.00') );

    if( numeral( balance_difference ).format('0') == 0) {
      $('#reconcile_button').removeClass('hidden');
    } else {
      $('#reconcile_button').addClass('hidden');
    }

  });
  
  var debit_credit_equal = function(debit,credit){
    if(debit==credit) {
      $('#saveEntriesButton').show();
    } else {
      $('#saveEntriesButton').hide();
    }
  };

  var debit_total = function(){
    var debit_total = 0;
    $('.debit_amount').each(function(){ 
      var amount = parseFloat(numeral( $(this).val() ).format('0'));
      debit_total = debit_total + amount;
    });
    $('#debit_total').text( numeral( debit_total ).format('0,0.00') );
    return debit_total;
  };
  var credit_total = function(){
    var credit_total = 0;
    $('.credit_amount').each(function(){ 
      var amount = parseFloat(numeral( $(this).val() ).format('0'));
      credit_total = credit_total + amount;
    });
    $('#credit_total').text( numeral( credit_total ).format('0,0.00') );
    return credit_total;
  };
  debit_total();
  credit_total();
  $('.debit_amount').keyup(function(){
    debit_total();
    debit_credit_equal(debit_total(), credit_total());
  });
  $('.credit_amount').keyup(function(){
    credit_total();
    debit_credit_equal(debit_total(), credit_total());
  });
  var removeJournalLine = function(){
    $(this).parent().parent().remove();
    debit_credit_equal(debit_total(), credit_total());
  };
  var insertJournalLine = function(){
    var timestamp = $.now();
    var line = $(this).parent().parent();
    var clone = $(this).parent().parent().clone();
    clone.find('a.insertJournalLine').click( insertJournalLine );
    clone.find('a.removeJournalLine').click( removeJournalLine );
    clone.find('input').val('');
    clone.find('div.autocomplete-name_select').remove();
    var name_select = clone.find('input.autocomplete-name_select')
    name_select.show();
    name_select.autocomplete( autocomplete_name_select_options );
    var name_id = name_select.attr('data-name_id');
    var new_name_id = 'journal_name_id_' + timestamp;
    name_select.attr('data-name_id', new_name_id);
    clone.find('input[type="hidden"]#' + name_id).prop('id', new_name_id);
    clone.insertBefore( line );
      var select_clone = clone.find($('select'));
      select_clone.each(function(){
        $(this).find('option:selected').prop('selected', false);
        var parent = $(this).parent();
        $(this).insertBefore(parent);
        parent.remove();
        $(this).selectpicker({
          liveSearch : true,
        });
      });

    $('.debit_amount').keyup(function(){
      debit_total();
      debit_credit_equal(debit_total(), credit_total());
    });
    $('.credit_amount').keyup(function(){
      credit_total();
      debit_credit_equal(debit_total(), credit_total());
    });
  };
  var unlockJournalLine = function() {
    var line_number = $(this).attr('data-line_number');
    $('.je_input-'+line_number).prop('disabled', false);
    $('.je_input-'+line_number).selectpicker('refresh');
  };
  $('.unlockJournalLine').click(unlockJournalLine);
  $('.insertJournalLine').click(insertJournalLine);
  $('.removeJournalLine').click(removeJournalLine);

})(jQuery);