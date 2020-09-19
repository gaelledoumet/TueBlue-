$(document).ready(function($)
      {
          $("#add_price").click(function()
            { 
                    $.ajax({ url: 'changebackend.php',
                    type: 'POST',
                    data:{
						  "newprice":$("#new_price").val(),
						  "pcode":$(this).parent().parent().children().eq(1).children().eq(0).children().eq(0).html(),
                    },
                    dataType: 'text',
                          success: function(txt) {
                            $(".modal-body").html(txt);
                            $("#modalbutton").click();	
                              if(txt.indexOf("updated successfully")>-1)
                                {
                                  setTimeout(function(){ window.location.assign("seller.php"); }, 2000);
                                } 
                          },
                    
                      });
        });
      });