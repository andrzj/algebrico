/*
* Load Subcategories based on selected category passed as parameter
* @param: category => int value
* @param: value => default: null. A int value to be selected after load the content
*/
function loadSubcategories(category, value){
  var ct = category.val();
  if(ct > 0){
    $.get('/api/subcategoryDropdown', { 'option': ct }, 
    function(data) {
        $('#subcategory_id').empty(); 
        $.each(data, function(key, element) {
          $('#subcategory_id').append("<option value='" + key +"'>" + element + "</option>");
        });
        if(typeof value !== 'undefined') {$('#subcategory_id').val(value);};
    });
  };
};

/*
* Check the Type id selected and show or hide parts of layout
* @param: type => input radio
*/
function verifyTransfer(type){
  if(type.val() == 3){
    $('#accountto-dv').show();
    $('#vendor-dv').hide();
    $('.category-dv').hide();
  } else {
    $('#accountto-dv').hide();
    $('#vendor-dv').show();
    $('.category-dv').show();
  }
};

/*
* Check the Type id selected and set proper content to Category dropdown
* @param: type => input radio
*/
function verifyType(type){
  if(type.val() == 2){$('#category_id').val("1").change()};
  if(type.val() == 1){$('#category_id').val("2").change()};
};

/*
* Check the Account id selected and show or hide parts of layout
*/
function verifyAccount(){
  var wlh = window.location.href;
  if(($('#account_id').val() == 2 || $('#account_id').val() == 3) && $('.type_id:checked').val() != 3){
    $('#allotment').show();
    $('#due').show();
    if (wlh.indexOf('edit') < 0 && wlh.indexOf('report') < 0) $('#account_id').parent().removeClass('col-xs-12').addClass('col-xs-9');
  }
  else
  {
    $('#allotment').hide();
    $('#allotment').val('1');
    $('#due').hide();
    if (wlh.indexOf('edit') < 0 && wlh.indexOf('report') < 0) $('#account_id').parent().removeClass('col-xs-9').addClass('col-xs-12');
  }
};

$(document).ready(function($){
  $('#amount-field').maskMoney({/*prefix:'R$ ', sufix:'', */allowNegative: true, allowZero:true, precision:2, thousands:'.', decimal:',', affixesStay: true});
  verifyAccount();

  $('#category_id').change(function(){
    loadSubcategories($(this));
  });

  $('.type_id').change(function(){
    verifyType($(this));
    verifyTransfer($(this));
    verifyAccount();
  });

  $("#date-field").datepicker({
    // changeMonth: true,
    // changeYear: true,
    showAnim: "slideDown",
    dateFormat: "dd/mm/yy"
  });

  $('#account_id').change(function(){
    verifyAccount();
  });
});