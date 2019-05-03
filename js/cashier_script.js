function loadOrderGroupByTableInArea(areaId){
  var link=window.window.apiUrl+"order.php";
  if(parseInt(areaId)>0){
    link+="?areaId="+areaId;
  }
  $.getJSON(link, function(response){
    if(response.status === true){
      var $tableBody= $('#order_body');
      $tableBody.empty();
      //title
      $.each(response.orders, function(i, order){
        console.log(order);
        var $row = $('<tr onclick="onOrderTableItemClick('+order.number_id+',event)"></tr>');
        $row.append('<td class="text-align--left width--full"><strong class="color--blue">['+order.number_id+']'+order.table_name+'</strong></td>')
            .append('<td class="text-align--center"><span class="rounded background-color--green padding">'+order.count_sum+'</span></td>')
            .append('<td class="white-space--nowrap text-align--right"><span class="rounded background-color--yellow padding">'+formatCurrency(order.price_sum)+'</span></td>')
            .append('<td onclick="editOrder(event,'+order.number_id+');return false;"><img width="24px" height="24px" src="./images/ic_edit.png" alt="Them"></td>')
            .append('<td onclick="deleteOrder(event,'+order.number_id+');return false;"><img width="24px" height="24px" src="./images/ic_close.png" alt="Xoa"></td>');
        $tableBody.append($row);
      });
      //if ok set pressed on menu
      $(".scroll-menu > *").each(function(){
        $this=$(this);
        if($this.data('id') == areaId) $this.addClass('active');
        else $this.removeClass('active');
      });
    }else{
      if(response.code == 306) location.href=window.loginUrl+'?from='+location.href;
      else showAlertDialog('That bai',response.message,false,false);
    }
  });
}
function editOrder(event,numberId){
  $(location).attr('href','index.php?pageId=editOrder&numberId='+numberId);
  event.stopPropagation();
}
function deleteOrder(event,numberId){
  var $modalDialog=$(".modal-dialog");
  console.log(JSON.stringify({number_id:numberId,data:[]}));
  $modalDialog.find('.modal-dialog__ok').on('click',function(){
    $modalDialog.find('.modal-dialog__ok').off('click');
    closeAlertDialog();
    $.ajax({
         url: window.apiUrl+"order.php",
         type : "POST",
         contentType : 'application/json',
         data : JSON.stringify({number_id:numberId,data:[]}),
         success : function(result) {
           var response=JSON.parse(result);
           console.log(result);
           if(response.status === true && parseInt(response.message) === 0){
             $(event.target).parent().parent().remove();
           }else{
             if(response.code == 306) location.href=window.loginUrl+'?from='+location.href;
             else showAlertDialog('That bai',response.message,false,false);
           }
         },
         error: function(xhr, resp, text){
           showAlertDialog('That bai',(xhr+resp+text),false,false);
         }
     });
  });
  showAlertDialog('Xac nhan thuc hien','Ban co muon xoa khong, lich su se duoc luu lai tren may chu',true,true);
  event.stopPropagation();
}

function onSoftKeyboardNumber(value){
  if($numberIdInput.val().length === 0 && value === 0) return;
  $numberIdInput.val($numberIdInput.val()+value);
}

function onOrderTableItemClick(value,event){
  var div = document.getElementById("numberIdInput");
  div.value=value;
}
//page run setting
//not allow 0 in the first input
$numberIdInput=$("#numberIdInput");
$numberIdInput.on('input',function(){
  console.log($numberIdInput.val());
  if($numberIdInput.val() === '0') $numberIdInput.val('');
});
