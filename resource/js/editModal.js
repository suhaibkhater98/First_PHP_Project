$(document).ready(function() {
      $('.editbtnn').click(function(){
            $('#loginModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function(){
                  return $(this).text();
            }).get();
            var id = $(this).attr('id');

			$('#serviceId').val(id);
      });
  });
