$(document).ready(function(){
     $("#get_row_col").validate({
        rules: {
            "number_of_row": {
                required:true,
                digits: true,
                min: 2,
                max:8
               
            },
            "number_of_column": {
                required:true,
                digits: true,
                min: 2,
                max:5
               
            }
        },
        messages: {
            "number_of_row": {
                required: "Please  Enter NO. of Rows",
                min: 'Enter Minimum 2 rows',
                max:'Enter Maximum 8 rows'
            },
            "number_of_column": {
                required: "Please  Enter NO. of Column",
                min: ' Enter Minimum 2  coulmn',
                maxlength:'Please Maximum 5 coulmn'
            },
        },
        errorPlacement: function(error, element) { 
            error.insertBefore( element ); 
        } ,
        submitHandler: function (form) { // for demo
             var url = $('#url').val();
             var row = $("#number_of_row").val()
             var coulmn = $("#number_of_column").val()
             $.ajax({
                    url: url, // Url to which the request is send
                    type: "POST",             // Type of request to be send, called as method
                    data: {'number_of_row':row,'number_of_column':coulmn}, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    success: function(response)   // A function to be called if request succeeds
                    {
                        //  console.log(response);
                        var data = $.parseJSON(response);
                        if (data.status) {
                            $('#get_row').css('display','none');
                            $('#add_data').html(data.table);
                        }
                        //alert(data.status);
                    }                            
                });
            }
    }); 
    $(document).on('submit',"#dynamic_form", function (e) {
            e.preventDefault();
            var url = $('#url_save').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: $("#dynamic_form").serialize()
            }).always(function (response){
                var data = $.parseJSON(response);
             
                if(data.status == 1){
                   
                    $("#get_row_col").trigger("reset");
                    swal(data.message);
                    location.reload();
                }
                else{
                   swal(data.message);
                }
            });
        });

    $(document).on('click',"#back", function (e) {
            e.preventDefault();
            $('#get_row').css('display','block');
            $('#add_data').html(data.table);
        });
});
