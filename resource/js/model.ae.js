$(document).ready(function() {
      $('.btnassign').click(function(){
            $('#assignModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                  return $(this).text();
            }).get();
            var id = $(this).attr('id');

            $('#service_ID').val(data[0]);
            $('#date').val(data[1]);
            $('#time').val(data[2]);
            
      });
  });
