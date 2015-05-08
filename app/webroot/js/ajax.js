
$( document ).ready(function() {

  $("a.mark_read").click('a',function(event) {
    event.preventDefault();
    $.ajax(this.href, { 
      success: function(data) {
        console.log("Marked Item Read");
        $(event.target).closest('a').hide();
      },
      error: function() {
        alert("Error: Failed to mark item read.");
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
