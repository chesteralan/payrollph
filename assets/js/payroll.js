(function($){

var current_uri = '';

 var init_sortable = function() {
    $( ".sortable" ).sortable();
    $( ".sortable" ).disableSelection();
 };

var init_datepicker = function() {
  $('.datepicker').datepicker();
  $('select').selectpicker({
    liveSearch : true,
  });
};


var confirmButton = function() {
  $('.confirm').click(function(){
  	if(confirm('Are you sure?')) {
  		return true;
  	} else {
  		return false;
  	}
  });
};

var confirmRemove = function() {
  $('.confirm_remove').each(function(){
      var href = $(this).prop('href');
      var data_url = $(this).attr('data-url');
      var data_morph = $(this).attr('data-morph');
      var target = $(this).attr('data-target');
      if( data_morph != 'confirmRemove') {
        $(this).attr('data-url', href);
        $(this).prop('href', 'javascript:void(0);');
        $(this).attr('data-morph', 'confirmRemove');
        $(this).click(function(){
           var divBody = $('#bodyWrapper');
            var loadingDiv = $('<div class="loading-wait"></div>');
            loadingDiv.css('height', ( divBody.parent().height() - 43 ) );
            var loadingImg = $('<img src="/assets/images/loader4.gif"/>');
            loadingImg.css('margin-top', Math.ceil( divBody.parent().height() / 2 ));
            loadingDiv.html( loadingImg );
            divBody.prepend( loadingDiv );
            var ajax_url = $(this).attr('data-url');
          if(confirm('Are you sure?')) {
              $.ajax({
                url: ajax_url,
                method: 'GET',
                success: function( data ) {
                      $(target).remove();
                }
              }); // $.ajax()
          }
          loadingDiv.remove();
        });
      }
  });
};

var addDeposits = function() {
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
};

var hoverPop = function() {
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
};

var select_account_titles = function() {
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
};

var autocomplete_navbarsearch = function() {
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
};

var init_member_change = function() {
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
          //window.location.href=ui.item.redirect;
              var divBody = $('#bodyWrapper');
              var loadingDiv = $('<div class="loading-wait"></div>');
              loadingDiv.css('height', ( divBody.parent().height() - 43 ) );
              var loadingImg = $('<img src="/assets/images/loader4.gif"/>');
              loadingImg.css('margin-top', Math.ceil( divBody.parent().height() / 2 ));
              loadingDiv.html( loadingImg );
              divBody.prepend( loadingDiv );
              $.ajax({
                url: ui.item.redirect,
                method: 'POST',
                data: {
                  output: 'body_wrapper',
                },
                success: function( data ) {
                    divBody.slideUp( function(){
                      $(this).html( data );
                      $(this).slideDown(function(){
                        loadingDiv.remove();
                        window.history.replaceState('Object', $(document).prop('title'), ui.item.redirect);
                        $('.autocomplete-member_change').val('');
                        init_coop();
                      });
                    });
                }
              }); // $.ajax()
          
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

};

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
  var edit_invoices_func = function() {

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

  };

  var autosum = function(input, output){
    var total = 0;
    $(input).each(function(){
      total += parseFloat( $(this).val().replace(',','') );
    });
    $(output).text( (Math.round(total * 100) / 100) );
  };

  var init_payment_buttons = function() {
 
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

};

var total_deposits = function(){
      var total_selected_deposits = 0;
      $('.deposit_item').each(function(){
        var rId = $(this).val();
        var amount = parseFloat( $(this).attr('data-amount') );
        
        if( $(this).prop('checked') ) {
          total_selected_deposits += amount;
        }
        
        $('.total_selected_deposits').text( numeral( total_selected_deposits ).format('0,0.00')  );

        if( total_selected_deposits > 0) {
          $('.deposits_receipts_selected').show();
        } else {
          $('.deposits_receipts_selected').hide();
        }
      });
};

var checkSelectedReceipts = function() {
   $('#deposits_select_all').click(function(){
      if($(this).prop('checked')) {
        $('input.deposit_item').prop('checked',true);
        $('.select_sales_receipt').addClass('success');
      } else {
        $('input.deposit_item').prop('checked',false);
        $('.select_sales_receipt').removeClass('success');
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
};

var loadLib = function() {

    init_sortable();

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
  var href = $(this).prop('href');
  $(this).attr('data-url', href);
  $(this).prop('href', 'javascript:void(0);');
  $(this).click(function(){
    ajaxModalUrl = $(this).attr('data-url');
    $('#ajaxModal form').prop( 'action', ajaxModalUrl );
    $('#ajaxModal .modal-title').text( $(this).attr('data-title') );
    $('#ajaxModal .loader').slideDown('slow');
    var hide_footer = $(this).attr('data-hide_footer');
    $('#ajaxModal .output').slideUp('slow').html( '' );
      $.ajax({
        url : ajaxModalUrl,
        method : 'GET',
        dataType : 'html'
      }).success(function(html){
        if( hide_footer ) {
          $('#ajaxModal .modal-footer').hide();
        } else {
          $('#ajaxModal .modal-footer').show();
        }
        $('#ajaxModal .loader').slideUp('slow');
        $('#ajaxModal .output').css('display', 'none').html( html ).slideDown('slow');
         loadLib();
      });
  });
});

  }; // loadLib
  
var ajaxModalUrl = null;
var setupAjaxModal = function(){
    $('.ajax-modal').click(function(){
    $('#ajaxModal .modal-title').text( $(this).attr('data-title') );
    var button_title = $(this).attr('data-button_title');
    if( button_title !== undefined ) {
      $('#ajaxModal .modal-footer button[type="submit"]').text( button_title );
    }
    ajaxModalUrl = $(this).attr('data-url');
    var hide_footer = $(this).attr('data-hide_footer');
     if( hide_footer ) {
        $('#ajaxModal .modal-footer').hide();
      } else {
        $('#ajaxModal .modal-footer').show();
      }
  });
};

var loadAjaxModal = function() {
  setupAjaxModal();
  $('#ajaxModal').on('shown.bs.modal', function () {
    $('#ajaxModal form').prop( 'action', ajaxModalUrl );
      $.ajax({
        url : ajaxModalUrl,
        method : 'GET',
        dataType : 'html'
      }).success(function(html){
        $('#ajaxModal .loader').slideUp('slow');
        $('#ajaxModal .output').css('display', 'none').html( html ).slideDown('slow');

    loadLib();
  });

  }).on('hidden.bs.modal', function (e) {
      $('#ajaxModal .loader').show();
      $('#ajaxModal .modal-footer').hide();
      $('#ajaxModal .output').html( '' );
  });

  $('.ajax-dialog').click(function(){
     ajaxModalUrl = $(this).attr('data-url');
    $('#ajaxDialog form').prop( 'action', ajaxModalUrl );
    $('#ajaxDialog .loader').slideDown('slow');
    $('#ajaxDialog .output').slideUp('slow').html( '' );
      $.ajax({
        url : ajaxModalUrl,
        method : 'GET',
        dataType : 'html'
      }).success(function(html){
        $('#ajaxDialog .loader').slideUp('slow');
        $('#ajaxDialog .output').css('display', 'none').html( html ).slideDown('slow');
      });
    $('#ajaxDialog').dialog({
      resizable: false,
      height: "auto",
      width: '80%',
      modal: true,
      title : $(this).attr('data-title'),
    }).css('overflow', 'inherit');
  });

};

loadAjaxModal();

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

  var journalLine = function() {
    $('.unlockJournalLine').click(unlockJournalLine);
    $('.insertJournalLine').click(insertJournalLine);
    $('.removeJournalLine').click(removeJournalLine);
  };

var lending_schedule_details = function() {
  $('.lending-schedule-details').click(function(){
    $('.lending-schedule-details').removeClass('btn-success').addClass('btn-default');
    $(this).addClass('btn-success');
    var type = $(this).attr('data-type');
    if( type == 'minimal' ) {
      $('.detailed-schedule').hide();
    } else if( type == 'detailed') {
      $('.detailed-schedule').show();
    }
  });
};

  var panelHeight = function() {
    var innerPage = $('#ajaxBodyInnerPage');
    var panel = innerPage.parent();
    var inner_height = innerPage.height() + 73;
    var panel_height =  panel.height();
    var current_height = parseInt(panel.css('height'));
    if( (current_height > panel_height) && (current_height > inner_height) ) {
      panel.css( 'height', current_height);
    } else {
      if( panel_height > inner_height ) {
        panel.css( 'height', panel_height);
      } else {
        panel.css( 'height', inner_height);
      }
    }
  } 
  
  var ajaxPagination = function() {

    $('.ajaxPage').each(function(){
      var href = $(this).prop('href');
      var data_url = $(this).attr('data-url');
      var data_morph = $(this).attr('data-morph');
      if( data_morph != 'ajaxPage') {
        $(this).attr('data-url', href);
        $(this).prop('href', 'javascript:void(0);');
        $(this).attr('data-morph', 'ajaxPage');
        $(this).click(function(){
              var divBody = $('#ajaxBodyInnerPage');
              var loadingDiv = $('<div class="loading-wait"></div>');
              loadingDiv.css('height', ( divBody.parent().height() - 43 ) );
              var loadingImg = $('<img src="/assets/images/loader4.gif"/>');
              loadingImg.css('margin-top', Math.ceil( divBody.parent().height() / 2 ));
              loadingDiv.html( loadingImg );
              divBody.prepend( loadingDiv );

              var ajax_url = $(this).attr('data-url');

              $.ajax({
                url: ajax_url,
                method: 'POST',
                data: {
                  output: 'inner_page',
                },
                success: function( data ) {
                    divBody.slideUp( function(){
                      $(this).html( data );
                      panelHeight();
                      $(this).slideDown(function(){
                        loadingDiv.remove();
                        window.history.replaceState('Object', $(document).prop('title'), ajax_url);
                        $('.autocomplete-member_change').attr('data-current_sub_uri', ajax_url);
                        init_coop();
                      });
                    });
                }
              }); // $.ajax()
            }); // $(this).click()
        }
    });
  };

  var bodyWrapper = function() {
   $('.body_wrapper').each(function(){
      var href = $(this).prop('href');
      var data_url = $(this).attr('data-url');
      var data_morph = $(this).attr('data-morph');
      if( data_morph != 'bodyWrapper') {
        $(this).attr('data-url', href);
        $(this).prop('href', 'javascript:void(0);');
        $(this).attr('data-morph', 'bodyWrapper');
        $(this).click(function() {
              var divBody = $('#bodyWrapper');
              var loadingDiv = $('<div class="loading-wait"></div>');
              loadingDiv.css('height', ( divBody.parent().height() - 43 ) );
              var loadingImg = $('<img src="/assets/images/loader4.gif"/>');
              loadingImg.css('margin-top', Math.ceil( divBody.parent().height() / 2 ));
              loadingDiv.html( loadingImg );
              divBody.prepend( loadingDiv );

              var ajax_url = $(this).attr('data-url');

              $.ajax({
                url: ajax_url,
                method: 'POST',
                data: {
                  output: 'body_wrapper',
                },
                success: function( data ) {
                    divBody.slideUp( function(){
                      $(this).html( data );
                      $(this).slideDown(function(){
                        loadingDiv.remove();
                        window.history.replaceState('Object', $(document).prop('title'), ajax_url);
                        $('.autocomplete-member_change').attr('data-current_sub_uri', ajax_url);
                        init_coop();
                      });
                    });
                }
              }); // $.ajax()
        }); // $(this).click()
      }
   });
 }; // bodyWrapper

 var init_coop = function() {
      bodyWrapper();
      ajaxPagination();
      setupAjaxModal();
      lending_schedule_details();
      edit_invoices_func();
      journalLine();
      confirmButton();
      confirmRemove();
      init_datepicker();
      init_payment_buttons();
      panelHeight();
      init_member_change();
      addDeposits();
      //autocomplete_navbarsearch();
      //select_account_titles();
      //hoverPop();
      checkSelectedReceipts();
      init_sortable();
 }
 init_coop();
})(jQuery);
