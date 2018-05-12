

$('.confirm').on("click",function(e){
    e.preventDefault();
    var url = $(this).attr('href');
        bootbox.confirm("Are you sure?", function(result) {
           if(result==true){
    			if(url){
    				location.href = url;
    			}
    	   }
        });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showAddItemModal(menu_id){
    $("#menu_id").val(menu_id);

    $.ajax({
      type:"POST",
      url: base_url + "/menus/getAddItemModal",
      data: {menu_id: menu_id},
      success: function(result){
        $("#addItemModal").html(result);
        $("#addItemModal").modal('show');
      }
    });

  }


  $(document).on("submit", "#addItemForm1", function(event){
    event.preventDefault();

    var form = $(this);
    $.ajax({
      type: "POST",
      url:form.attr('action'),
      data: form.serializeArray(),
      success: function(response){

        var result = JSON.parse(response);

        if(result['success']){
          swal({
            title: "",
            text: "Menu item successfully added",
            type: "success",

            closeOnConfirm: true,

          }, function(){
            $("#addItemModal").modal('hide');
          });
        }
        else{
          var errors_li = "";
          $.each(result['message'], function(key, value){
            errors_li += value;

          });

          $(".validation-errors").html('<ul class="alert alert-danger">'+ errors_li +'</ul>');
          swal({
            title: "",
            text: "Something went wrong, please try again.",
            type: "warning",
            closeOnConfirm: true,
          });
        }

      }
    });

  });

  $(document).on('click','.delete_confirm', function (e) {
        var id = $(this).data('id');
        var delete_url = $(this).attr('href');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this info again",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",

        },
        function(isConfirm) {

            if (isConfirm) {
                $.ajax({
                    url: delete_url,
                    type: "DELETE",
                    data: {id: id},
                    success: function(result){
                        $("[row_id='"+id+"']").remove();
                    }
                })

            }
        });

    });

  $('.nav-pills, .nav-tabs').tabdrop();

  /* method for update alias field automatically when user fill up title field*/
  function update_alias(value, lang){
    var alias = value.replace(/[\s]|[,]/g,"-");
    $('input[name="alias['+lang+']"]').val(alias);
  }
