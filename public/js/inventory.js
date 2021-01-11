$('.add').on('click',function(){
    var quant=$('.quantity').val();
  //  var sku=$('#sku').val();
  // add();
   
   console.log(quant)
    return false;
});

function add(){
    $.ajax({
        url:'/index/add',
        type:'POST',
        data:{'sku':sku, 'quantity':quant},
        success : function(data){
            if(data==='OK'){
                document.getElementById("msg").innerHTML ="Added to inventory";
            }else{
                alert(data);
            }
            
        }
    });
}