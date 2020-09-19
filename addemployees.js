$(document).ready(function($){
    $("#bt_add").click(function(){
               $.ajax({
                    url: 'addemployee.php',
                    type: "POST",
                    datatype: "text",
                    data: { "firstname":$("#fname").val(),
                             "lastname":$("#lname").val(),
                             "username":$("#username").val(),
                             "email":$("#mail").val(),
                             "password":$("#pass10").val(),
                             "passwordconfirmed":$("#pass11").val(),
                             "number":$("#phone").val(),
                             "address":$("#address").val(),
                            },
                    async:false,

                    success: function(data){
                               if(data.indexOf("successfully added")>-1)
                                {
                                    window.location.assign('businessowner.html') ;
                                }
                                else
                                {
                                    $(".modal-body").html(data);
							        $("#modalbutton").click();
                                }
                        },
                        error: function(data) {
                            console.log("error " + data);
                        },
                        done: function(data) {
                            console.log(data + " success");
                        }
                 });
    });
});