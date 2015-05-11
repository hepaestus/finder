
$( document ).ready(function() {

  $("a.mark_read").click('a',function(event) {
    event.preventDefault();
    $.ajax(this.href, { 
      success: function(data) {
        console.log("Marked Item Read");
        $(event.target).closest('a').hide();
        $(event.target).closest('td.actions').find('a.mark_unread').show();
        $(event.target).closest('td.actions').find('a.mark_unread').removeClass('hide');
        $(event.target).closest('tr').removeClass('unread');
        $(event.target).closest('tr').addClass('read');
        $(event.target).closest('tr').find('.unread').addClass('read');
        $(event.target).closest('tr').find('.unread').removeClass('unread');
      },
      error: function() {
        alert("Error: Failed to mark item read.");
      },
    });
  });

  $("a.mark_unread").click('a',function(event) {
    event.preventDefault();
    $.ajax(this.href, { 
      success: function(data) {
        console.log("Marked Item Un-Read");
        $(event.target).closest('a').hide();
        $(event.target).closest('td.actions').find('a.mark_read').show();
        $(event.target).closest('td.actions').find('a.mark_read').removeClass('hide');
        $(event.target).closest('tr').removeClass('read');
        $(event.target).closest('tr').addClass('unread');
        $(event.target).closest('tr').find('.read').addClass('unread');
        $(event.target).closest('tr').find('.read').removeClass('read');
      },
      error: function() {
        alert("Error: Failed to mark item unread.");
      },
    });
  });
  
  $("a.delete").click("a", function(event) {
    event.preventDefault();

    var answer = confirm("Are you sure you want to delete that?");

    if ( answer ) {
      $.ajax(this.href, { 
        success: function(data) {
          $(event.target).closest('tr').hide();
          console.log("Deleted Item");
        },
        error: function() {
          alert("Error: Failed to delete item.");
        },
      });
    }
  });

});
