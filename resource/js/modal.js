$(document).ready(function() {
      $('.editbtn').click(function(){
            $('#loginModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                  return $(this).text();
            }).get();
            var id = $(this).attr('id');

            $('#available_Datee').val(data[0]);
            $('#available_fromm').val(data[1]);
            $('#available_too').val(data[2]);
            $('#dateId').val(id);
      });
  });
