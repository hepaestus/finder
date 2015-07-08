    <!-- Start of first page: #one -->
    <div data-role="page" data-url="<?php echo $data_url; ?>" id="one">
    <script>
      console.log("Load View Page!");
    </script>

        <div data-role="panel" data-position="right" data-display="overlay" id="search">
            <script>
               $(document).on('keyup', "#search", function(event) {
                 event.preventDefault();
                 var value = $(this).val();
                 var code = event.keyCode || event.which;
                 console.log("Changed! " + value.length + " Val:" + value );
                 if ( code == 13 ) {
                   runSearchQuery(value);
                 } else {
                   updateSuggestions(value);
                 } 
               });
                
                  
               function runSearchQuery(searchString) {
                 console.log("Search");
                 if( searchString.length > 2 ) {
                   $.ajax({
                     type: "GET",
                     url: "/finder/searches/search/" + searchString,
                     data: searchString,
                     success: function(data) {
                       data = data.replace("\\n","");
                       updateSearchResults(JSON.parse(data));
                     },
                     error: function() {
                       console.log("Error Performing Search");
                       alert("Error Performing Search");
                     }
                   });
                 }
               };

               function updateSuggestions(searchString) {
                  console.log("Update");
                  runSearchQuery(searchString);
               };


               function updateSearchResults(data) {
                 var data_obj = JSON.parse(data);
                 var docs = data_obj.response.docs;
                 $("#search_results").empty();
                 var results_list = document.createElement('ul');
                 for(var i = 0; i < docs.length; i++) {
                   $(results_list).addClass('search_content');
                   $(results_list).attr("id", "search_list");
                   $(results_list).data("user-id", docs[i].user_id);
                   $(results_list).append("<li>" +
                       "<a href='/finder/users/view/" + docs[i].id  + "'><img src='/finder/img/" + docs[i].image_url + "' class='profile_image' alt='" + docs[i].name + " profile image' style=''/>" +
                       "<strong class='user' data-user-id='" + docs[i].id + "'>" + docs[i].name + "</strong></a></li>");
                   $("#search_results").append(results_list);
                 }
               };
            </script>
            <form data-url="<?php echo $data_url; ?>">
                <label for="search">Search</label>
                <input id="search" name="search" type="text">
            </form>
            <div id="search_results">
            
            </div>
            <a href="#close" data-icon="back" data-rel="close" class="ui-btn-right">Close</a>
            <!-- panel content goes here -->
        </div><!-- /panel -->

        <div data-role="navbar" data-grid="c">
            <ul>
                <li><a href="#one">Home</a></li>
                <li><a href="#seven">Profile</a></li>
                <li><a href="/contracts/">Contracts</a></li>
                <li><a href="#three">Notes</a></li>
            </ul>
        </div>
        <div data-role="header">
            <h1><?php echo $title_for_layout; ?> : <?php echo $welcome_user; ?></h1>
            <div class="flash"><?php echo $this->Session->flash(); ?></div>
            <a href="/finder/users/logout" data-icon="user" class="ui-btn-left">Logout</a>
            <a href="#search" data-icon="search" class="ui-btn-right">Search</a>
        </div><!-- /header -->
    


        <div role="main" class="ui-content"
            <ul data-role="listview" data-inset="true">
            <?php
            $matches_array = json_decode($matches, true);
            //pr($matches_array); 
            ?>
            <li><a href="#two"><span class="ui-li-count"><?php echo $matches_array['response']['numFound']; ?></span>
                    <h2 class="circle_icon "><span class="text_icon">M!</span></h2>
                    <h3>Matches</h3></a>
                </li>
                <li><a href="#three"><span class="ui-li-count"><?php echo count($notesIncoming); ?></span>
                    <h2 class="circle_icon"><span class="text_icon">N!</span></h2>
                    <h3>Notes</h3></a>
                </li>
                <li><a href="#four"><span class="ui-li-count">6</span>
                    <h2 class="circle_icon"><span class="text_icon">A!</span></h2>
                    <h3>Activities</h3></a>
                </li>
                <li><a href="#five"><span class="ui-li-count">3</span>
                    <h2 class="circle_icon"><span class="text_icon">C!</span></h2>
                    <h3>Connections</h3></a>
                </li>
                <li><a href="#six"><span class="ui-li-count">1</span>
                    <h2 class="circle_icon"><span class="text_icon">R!</span></h2>
                    <h3>Reputation</h3></a>
                </li>
            </ul> 
        </div><!-- /content -->
    
        <div data-role="footer" data-theme="a">
            <h4>Home : Dashboard - Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="#three">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page one -->
    


    <!-- Start of second page: #two -->
    <div data-role="page" id="two" data-theme="a">
        <div data-role="navbar" data-grid="c">
            <ul>
                <li><a href="#one">Home</a></li>
                <li><a href="#seven">Profile</a></li>
                <li><a href="/contracts/">Contracts</a></li>
                <li><a href="/notes/">Notes</a></li>
            </ul>
        </div>
        <div data-role="header">
            <h1>Matches</h1>
        </div><!-- /header -->

        <script>
          $(document).ready( function() { 

            var user_id = null;
            var username = null;
            $(".match_user_profile").on('click', function() {
                user_id = $(this).closest("li").data("user-id"); 
                console.log("User Id: " + user_id);
                username = $(this).closest(".match_user_profile").find(".user").text();
                var affinity = $(this).closest(".match_user_profile").find(".affinity").text();
                var location = $(this).closest(".match_user_profile").find(".location").text();
                var distance = $(this).closest(".match_user_profile").find(".distance").text();
                var image_url = $(this).closest(".match_user_profile").find("img").attr("src");
                $("#popup_match_content").empty();
                var match_div = document.createElement('div');
                $(match_div).addClass('_content');
                $(match_div).attr("Id", "match_div");
                $(match_div).data("user-id", user_id);
                $(match_div).append("<img src='" + image_url + "' class='profile_image' alt='" + username + " profile image' style='float:left;'/>");
                $(match_div).append("<h1 class='user' data-user-id='" + user_id + "'>" + username + "</h1>");
                $(match_div).append("<p>Affinity: <span class='affinity'>" + affinity + "</span></p>");
                $(match_div).append("<p>Location: <span class='location'>" + location + "</span></p>");
                $(match_div).append("<p>Distance: <span class='distance'>" + distance + "</span></p>");
                $(match_div).append("<div id='send_message_to_user'></div>");
                console.log(match_div);
                $("#popup_match_content").append(match_div);
            });

            var match_reply = 0;
            $(".note_match").on('click', function() {                 
                var user_id = $("#popup_match_content").find(".user").data("user-id"); 
                console.log("User Id: " + user_id);
                if ( match_reply != user_id ) {
                    var user = $("#popup_match_content").find(".user").text(); 
                    var reply_div = document.createElement('div');
                    $(reply_div).attr("Id", "reply_div");
                    $(reply_div).append("<p>To: <strong>" + user + "</strong></p>");
                    $(reply_div).append("<form action='/notes/add' id='Note' method='PUT'>");
                    $(reply_div).append("<input type='hidden' id='note_username' name=\"Note['username']\" value='" + username + "'/>");
                    $(reply_div).append("<p>Subject: <input type='text' id='note_subject' name=\"Note['subject']\"/></p>");
                    $(reply_div).append("<p>Body:<br/><textarea id='note_message' name=\"Note['message']\" cols='40' rows='5'></textarea><br/>");
                    $(reply_div).append("<button name='submit' id='submit_note_button'>Submit Note</button>");
                    $(reply_div).append("</p></form>");
                    $("#popup_match_content").append(reply_div);
                    match_reply = user_id;
                }
            });

            $(document).on('click', '#submit_note_button', function(event) {
              var Note = {'Note': {"username":$("#note_username").val(), 'subject':$("#note_subject").val(), 'message':$("#note_message").val()}};
              console.log("Submit Note: " + Note);
              $.ajax({
                type: "POST",
                url: "/finder/notes/add",
                data: Note,
                success: function(data) {
                  $("#reply_div").hide();
                  console.log("Note Sent: " + data);
                },
                error: function() {
                  console.log("Error Sending Note");
                  alert("Error Sending Note");
                }
              });
            });

            $(".create_connection").on('click', function() {
              var user_id = $("#popup_match_content").find(".user").data("user-id");
              var username = $("#popup_match_content").find(".user").text();
              var Connection = {'Connection':{'username':username, }};
              console.log("User Id: " + user_id);              
              console.log("Username: " + username);              
              $.ajax({
                type: 'POST',
                url: '/finder/connections/add',
                data: Connection,
                success: function(data) {
                  $("a.create_connection").hide();
                  console.log("Connection Created");
                },
                error: function() {
                  console.log("Connection Creation Failed");
                  alert("Error Creating Connection");
                }
              });
            });

          });
        </script>

        <?php
        $matches_array = json_decode($matches,1);        
        if (!empty( $matches_array['response'])) {
            echo $this->element('matches_list');
        } else {
            echo "<h4>You Currently have no matches. Try creating your profile and adding some interests.</h4>";
        }
        ?>
        <div data-role="popup" id="user" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width=340px; padding-bottom:2em;">
            <h3>User Info</h3>
            <div id="popup_match_content"></div>
            <a href="#create_connection" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check ui-btn-icon-left ui-btn-inline ui-mini create_connection">Create a connection</a>
            <a href="#send_note"         data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-mail  ui-btn-icon-left ui-btn-inline ui-mini note_match">Send Note</a>
            <a href="#cancel"            data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-a ui-icon-back  ui-btn-icon-left ui-btn-inline ui-mini cancel">Close</a>
        </div>

    
        <div data-role="footer">
            <h4>Matches - Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page two -->



    <!-- Start of third page: #three -->
    <div data-role="page" id="three" data-theme="a">
        <script>
          $(document).ready( function() {
              var note_id = null;
              $(".note_contents").on('click', function() {
                note_id = $(this).data("note-id"); 
                console.log("Note Contents Id: " + note_id);
                var user_id = $(this).closest("li.note").find(".user").data("user-id");
                var user = $(this).closest(".note_contents").find(".user").text();
                var subject = $(this).closest(".note_contents").find(".subject").text();
                var content = $(this).closest(".note_contents").find(".content").text();
                $("#popup_note_content").empty();
                var note_div = document.createElement('div');
                $(note_div).addClass('note_content');
                $(note_div).attr("id", "note_div");
                $(note_div).data("note-id", note_id);
                console.log("NOTE DIV DATA: " + $(note_div).data("note-id"));
                $(note_div).append("<p class='user' data-user-id='" + user_id + "'>From: <strong class='user_content'>" + user + "</strong></p>");
                $(note_div).append("<p class='subject'>Subject: <strong class='subject_content'>" + subject + "</strong></p>");
                $(note_div).append("<p class='body'>Body:<br/><blockquote class='body_content'>" + content + "</blockquote></p><br/>");
                $("#popup_note_content").append(note_div);
              });

              $("a#mark_read").on('click', function() {
                console.log("Mark Read : " + note_id );
                $.ajax('/finder/notes/mark_read/' + note_id, {
                  success: function(data) {
                    $('#note-' + note_id).addClass('read');
                    console.log("Marked Read : " + data);
                  },
                  error: function() {
                    alert("Error: Could not mark note as read. Sorry.");
                  }
                });
              });

              $("a#delete_note").on('click', function() {
                console.log("Delete Note : " + note_id );
                $.ajax('/finder/notes/delete/' + note_id, {
                  success: function(data) {
                    $('#note-' + note_id).addClass('hidden');
                    console.log("Deleted Note : " + data);
                  },
                  error: function() {
                    alert("Error: Could not delete your note. Sorry.");
                  }
                });
              });

              var reply_is_open = 0;
              $(".note_reply").on('click', function() {
                    var ajax_data_div = $(this).parent("div").find("#note_div"); 
                    var note_id = $(ajax_data_div).data("note-id"); 
                    console.log("Reply Note Id: " + note_id);
                if ( reply_is_open != note_id ) { 
                    var user_id = $(ajax_data_div).find(".user").data("user-id")
                    console.log("Reply User Id: " + note_id);
                    var user_id = $(ajax_data_div).find(".user").data("user-id");
                    var user    = $(ajax_data_div).find(".user_content").text();
                    var subject = $(ajax_data_div).find(".subject_content").text();
                    var content = $(ajax_data_div).find(".body_content").text();
                    ajax_data_div.empty();
                    ajax_data_div.append("<p>From: <strong>" + user + "</strong></p>");
                    ajax_data_div.append("<p>Subject: <strong>" + subject + "</strong></p>");
                    ajax_data_div.append("<p>Body:<br/>" +
                        "<form action='/finder/notes/reply' method='post'>" +
                        "<textarea cols='40' rows='6'>" + content + "</textarea><br/>" +
                        "<input type='submit' />" +
                        "</form>" +
                        "</p><br/>");
                    reply_is_open = note_id;
                }
              });
          });
        </script> 
        <div data-role="header">
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="#three">Notes</a></li>
                </ul>
            </div>
            <h1>Notes</h1>
        </div><!-- /header -->
    
        <div role="main" class="ui-content">
            <ul data-role="listview" data-inset="true">
                <!-- li data-role="list-divider">Monday, December 8, 2014 <span class="ui-li-count">2</span></li -->
                <li data-role="list-divider">Inbox<span class="ui-li-count"><?php echo count($notesIncoming); ?></span></li>
                <?php foreach( $notesIncoming as $note): ?>
                <li id="note-<?php echo $note['Note']['id']; ?>" data-note-id="<?php echo $note['Note']['id']; ?>" class="note <?php if ($note['Note']['read']) { echo 'read'; } ?>">
                        <a href="#note" data-note-id="<?php echo $note['Note']['id']; ?>" class="note_contents" data-rel="popup">
                            <?php if ( $note['User']['ExtendedProfile']['image'] ) { 
                                echo $this->Html->image($note['User']['ExtendedProfile']['image'], array('alt' => 'Profile Image', 'class' => 'profile_image')); 
                                } else {
                                echo $this->Html->image("/img/profile_75.jpeg", array('alt' => 'Generic Profile Image', 'class' => 'profile_image'));
                                }
                            ?>
                            <h2 class="user" data-user-id="<?php echo $note['User']['id']; ?>"><?php echo $note['User']['username']; ?></h2>
                            <p class="subject"><strong><?php echo $note['Note']['subject']; ?></strong></p>
                            <p class="content"><?php echo $note['Note']['message']; ?></p>
                            <p class="ui-li-aside"><strong><?php echo date("D M d, Y, h:i a", strtotime($note['Note']['created'])); ?></strong></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul data-role="listview" data-inset="true">
                <li data-role="list-divider">Sent<span class="ui-li-count"><?php echo count($notesOutgoing); ?></span></li>
                <?php foreach( $notesOutgoing as $note): ?>
                    <li id="note-<?php echo $note['Note']['id']; ?>" data-note-id="<?php echo $note['Note']['id']; ?>" class="note <?php if ($note['Note']['read']) { echo 'read'; } ?>">
                        <a href="#note" data-note-id="<?php echo $note['Note']['id']; ?>" class="note_contents" data-rel="popup">
                            <?php if ( $note['User']['ExtendedProfile']['image'] ) { 
                                echo $this->Html->image($note['User']['ExtendedProfile']['image'], array('alt' => 'Profile Image', 'class' => 'profile_image')); 
                                } else {
                                echo $this->Html->image("/img/profile_75.jpeg", array('alt' => 'Generic Profile Image', 'class' => 'profile_image'));
                                }
                            ?>
                            <h2 class="user" data-user-id="<?php echo $note['User']['id']; ?>"><?php echo $note['User']['username']; ?></h2>
                            <p class="subject"><strong><?php echo $note['Note']['subject']; ?></strong></p>
                            <p class="content"><?php echo $note['Note']['message']; ?></p>
                            <p class="ui-li-aside"><strong><?php echo date("D M d, Y, h:i a", strtotime($note['Note']['created'])); ?></strong></p>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div data-role="popup" id="note" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width=340px; padding-bottom:2em;">
                <h3>View Note Details</h3>
                <div id="popup_note_content" class="ajax_data"></div>
                <a href="#reply"             id="reply"       data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-edit      ui-btn-icon-left ui-btn-inline ui-mini note_reply">Reply</a>
                <a href="#mark_read"         id="mark_read"   data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check     ui-btn-icon-left ui-btn-inline ui-mini">Mark Read</a>
                <a href="#mark_unread"       id="mark_unread" data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check     ui-btn-icon-left ui-btn-inline ui-mini">Mark Un-Read</a>
                <a href="#delete_note"       id="delete_note"      data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-delete    ui-btn-icon-left ui-btn-inline ui-mini">Delete</a>
                <a href="#create_connection" data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-check     ui-btn-icon-left ui-btn-inline ui-mini">Create a connection</a>
                <a href="#block_user"        data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-forbidden ui-btn-icon-left ui-btn-inline ui-mini">BLOCK USER</a>
                <a href="#cancel"            data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-a ui-icon-back      ui-btn-icon-left ui-btn-inline ui-mini">Cancel</a>
            </div><!-- /popup -->

        </div><!-- /content -->
    
        <div data-role="footer">
            <h4>Notes : Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page three -->
    


    <!-- Start of fourth page: #four -->
    <div data-role="page" id="four" data-theme="a">
    
        <div data-role="header">
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div>
            <h1>Activities</h1>
        </div><!-- /header -->
    
        <div role="main" class="ui-content">
            <!-- h2>Activities</h2 -->
            <ul data-role="listview" data-inset="true">

            <?php 
                if (!empty($user['Interest'])){
                    foreach ($user['Interest'] as $interest) {
                        echo "               <li data-activity-id='" . $interest['activity_id'] . "' data-category-id='" . $interest['Activity']['activity_category_id'] . "'>";
                        echo "                    <a href='/activities/view/" . $interest['activity_id'] . "'><strong>" . $interest['Activity']['name'] . "</strong> ";
                        echo "<span class='activities_metadata'>(importance: " . $interest['importance'] . ", exerience: " . $interest['experience'] . ")</span></a>\n";
                        echo "                    <a href='#configure'   data-rel='popup' data-position-to='window' data-icon='edit' data-transition='pop'>Configure</a>\n";
                        echo "                </li>\n";
                    }
                }
                ?>
                <!-- TEMPLATE
                <li data-activity-id="1234" data-category-id="099"><a href="activities/view/1234"><strong>Cuddling</strong> <span class="activities_metadata">(importance: 5, exerience: 9)</span></a>
                    <a href="#configure"   data-rel="popup" data-position-to="window" data-icon="edit" data-transition="pop">Configure</a>
                </li>
                -->
            </ul>
            <div data-role="popup" id="configure" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width=340px; padding-bottom:2em;">
                <h3>Edit Activity</h3>
                <div id="edit_activity_content"></div>
                <p>Ajax $jquery to populate this information and a form.</p>
                <p>Form itself should be the output of a view</p>
                <a href="#edit_post"   data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-edit   ui-btn-icon-left ui-btn-inline ui-mini">Save Changes</a>
                <a href="#delete_post" data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-delete ui-btn-icon-left ui-btn-inline ui-mini">Delete</a>
                <a href="#cancel"      data-rel="back" class="ui-shadow ui-btn ui-corner-all ui-btn-a ui-icon-back   ui-btn-icon-left ui-btn-inline ui-mini">Cancel</a>
            </div><!-- /popup -->

        </div><!-- /content -->
    
        <div data-role="footer">
            <h4>Activities - Footer</h4>
            <div data-role="navbar" data-grid="c" >
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page four -->
    
    

    <!-- Start of fifth page: #five-->
    <div data-role="page" id="five" data-theme="a">
        <script>
          $(document).ready( function() {
              $(".connection_user_profile").on('click', function() {
                var connection_id = $(this).closest("li").data("connection-id"); 
                var user_id = $(this).closest(".connection_contents").find(".user").data("user-id");
                var user    = $(this).closest(".connection_contents").find(".user").text();
                var type    = $(this).closest(".connection_contents").find(".connection_type").text();
                var message = $(this).closest(".connection_contents").find(".connection_message").text();
                var image_src = $(this).closest(".connection_contents").find("img").attr("src");
                console.log("Connection Id: " + connection_id);
                $("#popup_reply_content").empty();
                var conn_div = document.createElement('div');
                $(conn_div).addClass('connection_content');
                $(conn_div).attr("Id", "conn_div");
                $(conn_div).data("connection-id", connection_id);
                console.log("CONNECTION DIV DATA: " + $(conn_div).data("connection-id"));
                $(conn_div).append("<img class='user_image' class='profile_image' alt='profile image' src='" + image_src + "'>");
                $(conn_div).append("<p class='user' data-user-id='" + user_id + "'>From: <strong class='user_content'>" + user + "</strong></p>");
                $(conn_div).append("<p class='message'><strong class='message_content'>" + message + "</strong></p>");
                $(conn_div).append("<p class='message'><strong class='connection_type'>" + type + "</strong></p>");
                $("#popup_reply_content").append(conn_div);
              });

          });
        </script> 
        <div data-role="header">
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div>
            <h1>Connections</h1>
        </div><!-- /header -->
        <div role="main" class="ui-content">
            <!-- h2>Connections</h2 -->
            <div data-role="collapsibleset" data-inset="true">
                <div data-role="collapsible" data-inset="true" data-collapsed="false">
                    <h3>New Incoming Connection Requests</h3>
                    <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">

                    <?php
                        //pr($connectionsIncoming);
                        foreach($connectionsIncoming as $connection) {
                            pr($connection);
                            echo "<li class='connection_contents' data-user-id='" . $connection['MyUser']['id'] . "' data-connection-id='" . $connection['Connection']['id'] . "'>";
                            echo "<a href='#connection' data-user-id='" . $connection['MyUser']['id'] . "' class='connection_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>";
                            if ( array_key_exists('image', $connection['MyUser']['ExtendedProfile']) && $connection['MyUser']['ExtendedProfile']['image'] != NULL ) {
                                echo $this->Html->image($connection['MyUser']['ExtendedProfile']['image'], array( 'alt' => $connection['MyUser']['username'] . "'s Profile Image", 'class' => 'profile_image'));
                            } else {
                                echo $this->Html->image('/img/profile_75.jpeg', array( 'alt' => "Generic Profile Image", 'class' => 'profile_image'));
                            }
                            echo "<h2 class='user' data-user-id='" . $connection['MyUser']['id'] . "'>" . $connection['MyUser']['username'] . "</h2>";
                            echo "<p class='connection_type'>Connection Type: " . $connection['Connection']['connection_type'] . "</p>";
                            echo "<p class='connection_message'>" . $connection['Connection']['message'] . "</p>";
                            echo "</a>";
                            echo "</li>";
                        }
                    ?>
                        <!-- TEMPLATE
                        <li class="connection_contents" data-user-id="1234" data-connection-id="3456">
                            <a href="#connection" data-user-id="1234" class="connection_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 class="user" data-user-id="1234">Jamey Douglas</h2>
                                <p class="connection_type">Connection Type: Unknown</p>
                                <p class="connection_message">Hi, How have you been?</p>
                            </a>
                        </li>
                        -->

                    </ul>
                </div>
                <div data-role="collapsible" data-inset="true">
                    <h3>Existing Connections</h3>
                    <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">

                    <?php 
                        //pr($connectionsOutgoing);
                        if (!empty($connectionsOutgoing)) {
                            foreach ($connectionsOutgoing as $connection) {
                                echo "<li class='connection_contents' data-user-id='" . $connection['MyConnection']['id'] . "' data-connection-id='" . $connection['Connection']['id'] . "'>\n";
                                echo "<a href='#connection' data-user-id='" . $connection['MyConnection']['id'] . "' class='connection_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>\n";
                                echo $this->Html->image($connection['MyConnection']['ExtendedProfile']['image'], array( 'alt' => $connection['MyConnection']['username'] . "'s Profile Image", 'class' => 'profile_image'));
                                echo "<p class='connection_type'>Connection Type: " . $connection['Connection']['connection_type'] . "</p>";
                                echo "<p class='connection_message'>" . $connection['Connection']['message'] . "</p>";
                                echo "</a>";
                                echo "</li>";
                            }
                        }
                    ?>
                        <!-- TEMPLATE
                        <li class="connection_contents" data-user-id="1244" data-connection-id="6456">
                            <a href="#connection" data-user-id="1244" class="connection_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 class="user" data-user-id="1244">Mitt Schmit</h2>
                                <p class="connection_type">Connection Type: Unknown</p>
                                <p class="connection_message">Hi, How have you been?</p>
                            </a>
                        </li>
                        <li class="connection_contents" data-user-id="2234" data-connection-id="7456">
                            <a href="#connection" data-user-id="2234" class="connection_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 class="user" data-user-id="2234">Seamus McDougal</h2>
                                <p class="connection_type">Connection Type: Aquaintances</p>
                                <p class="connection_message">Hi, How have you been?</p>
                            </a>
                        </li>
                        -->
                    </ul>
                </div>          
                <div data-role="collapsible" data-inset="true">
                    <h3>Blocked Connections</h3>
                    <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">

                    <?php 
                        //pr($connectionsBlocked);
                        if (!empty($connectionsBlocked)) {
                            foreach ($connectionsBlocked as $connection) {
                                echo "<li class='connection_contents' data-user-id='" . $connection['MyConnection']['id'] . "' data-connection-id='" . $connection['Connection']['id'] . "'>\n";
                                echo "<a href='#connection' data-user-id='" . $connection['MyConnection']['id'] . "' class='connection_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>\n";
                                echo $this->Html->image($connection['MyConnection']['ExtendedProfile']['image'], array( 'alt' => $connection['MyConnection']['username'] . "'s Profile Image", 'class' => 'profile_image'));
                                echo "<p class='connection_type'>Connection Type: " . $connection['Connection']['connection_type'] . "</p>";
                                echo "<p class='connection_message'>" . $connection['Connection']['message'] . "</p>";
                                echo "</a>";
                                echo "</li>";
                            }
                        }
                    ?>
                        <!-- TEMPLATE
                        <li class="connection_contents" data-user-id="3234" data-connection-id="6456" data-theme="b">
                            <a href="#connection" data-user-id="3234" class="connection_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 class="user" data-user-id="3234">Frank Curns</h2>
                                <p class="connection_type">Connection Type: Blocked</p>
                                <p class="connection_message">Hi, How have you been?</p>
                            </a>
                        </li>
                        -->

                    </ul>
                </div>
            </div>

            <div data-role="popup" id="connection" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width=340px; padding-bottom:2em;">
                <h3>Connection Details</h3>
                <div id="popup_reply_content"></div>
                <a href="#verify_edit" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-edit ui-btn-icon-left ui-btn-inline ui-mini">Verify/Edit</a>
                <a href="#send_note"   data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-mail ui-btn-icon-left ui-btn-inline ui-mini">Send Note</a>
                <a href="#cancel"      data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-a ui-icon-back ui-btn-icon-left ui-btn-inline ui-mini">Cancel</a>
            </div><!-- /popup -->

        </div><!-- /content -->

        <div data-role="footer">
            <h4>Connections - Footer</h4>
            <div data-role="navbar" data-grid="c" >
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page five -->



    <!-- Start of sixth page: #six -->
    <div data-role="page" id="six" data-theme="a">
        <script>
          $(document).ready( function() {
              $(".review_user_profile").on('click', function() {
                var review_id   = $(this).closest("li").data("review-id"); 
                var reviewer_id = $(this).closest("li").data("reviewer-id"); 
                var user_id     = $(this).closest(".review_contents").find(".user").data("user-id");
                var user    = $(this).closest(".review_contents").find(".user").text();
                var rating  = $(this).closest(".review_contents").find(".rating").text();
                var message = $(this).closest(".review_contents").find(".review_message").text();
                var image_src = $(this).closest(".review_contents").find("img").attr("src");
                console.log("Review Id: " + review_id);
                $("#review_popup_reply_content").empty();
                var review_div = document.createElement('div');
                if ( reviewer_id != this_user_id ) {
                    console.log("I can't edit these reviews");
                    $("a.edit_review").css('display', 'none');
                    $("a.delete_review").css('display', 'none');
                } else {
                    console.log("I CAN edit these reviews");
                    $("a.edit_review").css('display', 'inline');
                    $("a.delete_review").css('display', 'inline');
                }
                $(review_div).addClass('review_content');
                $(review_div).attr("Id", "review_div");
                $(review_div).data("review-id", review_id);
                $(review_div).data("reviewer-id", reviewer_id);
                console.log("REVIEW DIV DATA: " + $(review_div).data("review-id"));
                $(review_div).append("<img class='user_image' class='profile_image' alt='profile image' src='" + image_src + "'>");
                $(review_div).append("<p class='user' data-user-id='" + user_id + "'>From: <strong class='user_content'>" + user + "</strong></p>");
                $(review_div).append("<p class='message'>Messsage: <strong class='message_content'>" + message + "</strong></p>");
                $(review_div).append("<p class='message'>Rating: <strong class='rating'>" + rating + "</strong></p>");
                $("#review_popup_reply_content").append(review_div);
              });

              var review_reply_is_open = 0;
              $(".note_review").on('click', function() {
                    var ajax_data_div = $(this).parent("div").find("#review_popup_reply_content"); 
                    var review_id = $(ajax_data_div).data("review-id"); 
                    var reviewer_id = $(ajax_data_div).data("reviewer-id"); 
                    console.log("Reply Review Id: " + review_id);
                if ( review_reply_is_open != review_id ) { 
                    var user_id = $(ajax_data_div).find(".user").data("user-id")
                    console.log("Review Reply User Id: " + user_id);
                    var user_id = $(ajax_data_div).find(".user").data("user-id");
                    var user    = $(ajax_data_div).find(".user_content").text();
                    var subject = $(ajax_data_div).find(".message_content").text();
                    var content = $(ajax_data_div).find(".body_content").text();
                    ajax_data_div.empty();
                    ajax_data_div.append("<p>From: <strong>" + user + "</strong></p>");
                    ajax_data_div.append("<p>Subject: <strong>" + subject + "</strong></p>");
                    ajax_data_div.append("<p>Body:<br/>" +
                        "<form action='/notes/send' method='post'>" +
                        "<textarea cols='40' rows='6'>" + content + "</textarea><br/>" +
                        "<input type='submit' />" +
                        "</form>" +
                        "</p><br/>");
                    reply_is_open = note_id;
                }
              });

              var review_edit_is_open = 0;
              $(".edit_review").on('click', function() {
                    var ajax_data_div = $(this).parent("div").find("#review_popup_reply_content"); 
                    var review_id = $(ajax_data_div).data("review-id"); 
                    var reviewer_id = $(ajax_data_div).data("reviewer-id"); 
                    console.log("Verify/Edit Id: " + review_id);
                if ( review_edit_is_open != review_id ) { 
                    var user_id = $(ajax_data_div).find(".user").data("user-id")
                    console.log("Reviewer User Id: " + reviewer_id);
                    var user_id = $(ajax_data_div).find(".user").data("user-id");
                    var user    = $(ajax_data_div).find(".user_content").text();
                    var message = $(ajax_data_div).find(".message_content").text();
                    var rating = $(ajax_data_div).find(".rating").text();
                    ajax_data_div.empty();
                    ajax_data_div.append("<p>From: <strong>" + user + "</strong></p>");
                    ajax_data_div.append("<p>Message: <strong>" + message + "</strong></p>");
                    ajax_data_div.append("<p>" +
                        "<form action='/notes/send' method='post'>" +
                        "Rating: <select name='Review[rating]'>" + 
                        "    <option value='" + rating + "' selected='selected'>" + rating + "</option>" +
                        "    <option value='3'>3 - Awesome</option>" +
                        "    <option value='2'>2 - Great</option>" +
                        "    <option value='1'>1 - Good</option>" +
                        "    <option value='0'>0 - None</option>" +
                        "    <option value='-1'>-1 - Needs Improvement</option>" +
                        "    <option value='-2'>-2 - Bad</option>" +
                        "    <option value='-3'>-3 - Terrible</option>" +
                        "</select><br/>" +
                        "<input type='submit' />" +
                        "</form>" +
                        "</p><br/>");
                    review_edit_is_open = review_id;
                }
              });
          });
        </script> 
        <div data-role="header">
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div>
            <h1>Reputation</h1>
        </div><!-- /header -->
    
        <div role="main" class="ui-content">
            <!-- h2>Reputation</h2 -->
            <ul>
                <li>You have been reviewed <span class="times_rated">2</span> times and your average score is  <span class="your_rating">2.5</span> <strong><span class="rating_flavor">That's Pretty Good!</span></strong> </li>
            </ul>
            <div data-role="collapsibleset" data-inset="true">
                <div data-role="collapsible" data-inset="true">
                    <h3>Reviews Of You</h3>
                        <ul data-role='listview' data-split-icon='gear' data-split-theme='a' data-inset='true'>
                    <?php 
                        if (!empty($reputationsIncoming)) {
                            foreach ($reputationsIncoming as $reputation) {
                                echo "<li data-user-id='" . $reputation['User']['id'] . "' data-reviewer-id='" . $reputation['Reviewer']['id'] . "' data-review-id='" . $reputation['Reputation']['id'] . "' class='review_contents'>";
                                echo "    <a href='#review_user' data-user-id='" . $reputation['User']['id'] . "' class='review_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>";
                                echo "        <img src='" . $reputation['Reviewer']['image'] . "' class='profile_image' alt='profile image'>";
                                echo "        <h2 data-user-id='" . $reputation['Reviewer']['id'] . "' class='user'>" . $reputation['Reviewer']['username'] . "</h2>";
                                echo "        <p class='review_message'>" . $reputation['Reputation']['comment'] . "</p>";
                                echo "        <p>Rating:<span class='rating'>" . $reputation['Reputation']['rating']  . "</span></p>";
                                echo "    </a>";
                                echo "</li>";
                            }
                        }
                    ?>
                    <!-- TEMPLATE 
                        <li data-user-id="1244" data-reviewer-id="1234" data-review-id="8764" class="review_contents">
                            <a href="#review_user" data-user-id="1244" class="review_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 data-user-id="1244" class="user">Mike Sullivan</h2>
                                <p class="review_message">You are very sweet.</p>
                                <p>Rating:<span class="rating">2</span></p>
                            </a>
                        </li>
                        <li data-user-id="2234" data-reviewer-id="1344" data-review-id="8765" class="review_contents">
                            <a href="#review_user" data-user-id="2234" class="review_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 data-user-id="2234" class="user">Shamus McDougal</h2>
                                <p class="review_message">Super Sweet! You Are The Best :)</p>
                                <p>Rating:<span class="rating">3</span></p>
                            </a>
                        </li>
                    END TEMPLATE -->
                    </ul>
                </div>
                <div data-role="collapsible" data-inset="true">
                    <h3>Reviews By You</h3>
                    <ul data-role="listview" data-split-icon="gear" data-split-theme="a" data-inset="true">
                    <?php 
                        if (!empty($reputationsOutgoing)) {
                            foreach ($reputationsOutgoing as $reputation) {
                                echo "<li data-user-id='" . $reputation['User']['id'] . "' data-reviewer-id='" . $reputation['Reviewer']['id'] . "' data-review-id='" . $reputation['Reputation']['id'] . "' class='review_contents'>";
                                echo "    <a href='#review_user' data-user-id='" . $reputation['User']['id'] . "' class='review_user_profile' data-rel='popup' data-position-to='window' data-transition='pop'>";
                                echo "        <img src='" . $reputation['Reviewer']['image'] . "' class='profile_image' alt='profile image'>";
                                echo "        <h2 data-user-id='" . $reputation['Reviewer']['id'] . "' class='user'>" . $reputation['Reviewer']['username'] . "</h2>";
                                echo "        <p class='review_message'>" . $reputation['Reputation']['comment'] . "</p>";
                                echo "        <p>Rating:<span class='rating'>" . $reputation['Reputation']['rating']  . "</span></p>";
                                echo "    </a>";
                                echo "</li>";
                            }
                        }
                    ?>
                    <!-- TEMPLATE 
                        <li data-user-id="2234" data-reviewer-id="1111" data-review-id="8766" class="review_contents">
                            <a href="#review_user" data-user-id="2234" class="review_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 data-user-id="2234" class="user">Shamus McDougal</h2>
                                <p class="review_message">Shamus is so nice. He is the nicest ever.</p>
                                <p>Rating<span class="rating">3</span></p>
                            </a>
                        </li>
                        <li data-user-id="3234" data-reviewer-id="1111" data-review-id="8767" data-theme="b" class="review_contents">
                            <a href="#review_user" data-user-id="3234" class="review_user_profile" data-rel="popup" data-position-to="window" data-transition="pop">
                                <img src="profile_75.jpeg" class="profile_image" alt="profile image">
                                <h2 data-user-id="3234" class="user">Frank Curns</h2>
                                <p class="review_message">Total Jerk. BLOCK!</p>
                                <p>Rating:<span class="rating">-3<span></p>
                            </a>
                        </li>
                    -->
                    </ul>
                </div>
            </div>
        
            <div data-role="popup" id="review_user" data-theme="a" data-overlay-theme="b" class="ui-content" style="max-width=340px; padding-bottom:2em;">
                <h3>Review Details</h3>
                <div id="review_popup_reply_content"></div>
                <a href="#edit_review" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-edit ui-btn-icon-left ui-btn-inline ui-mini edit_review">Edit</a>
                <a href="#delete_review" data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-delete ui-btn-icon-left ui-btn-inline ui-mini delete_review">Delete</a>
                <a href="#send_note"   data-rel="popup" class="ui-shadow ui-btn ui-corner-all ui-btn-b ui-icon-mail ui-btn-icon-left ui-btn-inline ui-mini note_review">Send Note</a>
                <a href="#cancel"      data-rel="back"  class="ui-shadow ui-btn ui-corner-all ui-btn-a ui-icon-back ui-btn-icon-left ui-btn-inline ui-mini cancel">Cancel</a>
            </div><!-- /popup -->

        </div><!-- /content -->
    
        <div data-role="footer">
            <h4>Reputations - Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page five -->



    <!-- Start of first page: #seven -->
    <div data-role="page" id="seven" data-theme="a">
       <div data-role="navbar" data-grid="c">
           <ul>
               <li><a href="#one">Home</a></li>
               <li><a href="#seven">Profile</a></li>
               <li><a href="/contracts/">Contracts</a></li>
               <li><a href="/notes/">Notes</a></li>
           </ul>
       </div><!-- /navbar -->
        <div data-role="header">
            <h1>Profile</h1>
            <a href="#" data-icon="edit" class="ui-btn-right">Edit Profile</a>
        </div><!-- /header -->
    
        <div role="main" class="ui-content">
            <dl>
                <dt> <?php echo __('Image'); ?></dt>
                <dd> <?php if ( $user['ExtendedProfile']['image'] ) {
                        echo $this->Html->image($user['ExtendedProfile']['image'], array('alt' => 'Profile Image'));
                    } else {
                        echo "none";
                    }
                    ?>&nbsp;
                <dt> <?php echo __('First Name'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['first_name']; ?> &nbsp;</dd>
                <dt> <?php echo __('Last Name'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['last_name']; ?> &nbsp;</dd>
                <dt> <?php echo __('Username'); ?></dt>
                <dd> <?php echo h($user['User']['username']); ?> &nbsp; </dd>
                <dt> <?php echo __('Role'); ?></dt>
                <dd> <?php echo h($user['User']['role']); ?> &nbsp; </dd>
                <dt> <?php echo __('Email'); ?></dt>
                <dd> <?php echo h($user['User']['email']); ?> &nbsp; </dd>
            
                <dt> <?php echo __('Scene Name'); ?></dt>
                <dd> <?php echo $user['Profile']['scene_name']; ?> &nbsp;</dd>
                <dt> <?php echo __('Birth Date'); ?></dt>
                <dd> <?php echo $user['Profile']['birth_date']; ?> &nbsp;</dd>
                <dt> <?php echo __('About'); ?></dt>
                <dd> <?php echo $user['Profile']['about']; ?> &nbsp;</dd>

                <dt> <?php echo __('Postal Code'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['postal_code']; ?> &nbsp;</dd>
                <dt> <?php echo __('Gender Identity'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['gender_identity']; ?> &nbsp;</dd>
                <dt> <?php echo __('Relationship Status'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['relationship_status']; ?> &nbsp;</dd>
                </dd>
                <dt><?php echo __('External Links'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['external_links']; ?> &nbsp;</dd>
                <dt><?php echo __('Location'); ?></dt>
                <dd> <?php echo $user['ExtendedProfile']['latitude'] . "," . $user['ExtendedProfile']['longitude']; ?> &nbsp;</dd>
            </dl>
        </div><!-- /content -->
    
        <div data-role="footer" data-theme="a">
            <h4>Profile - Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#seven">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page seven -->



    <!-- Start of first page: #NEW -->
    <div data-role="page" id="NEW" data-theme="a">
       <div data-role="navbar" data-grid="c">
           <ul>
               <li><a href="#one">Home</a></li>
               <li><a href="#six">Profile</a></li>
               <li><a href="/contracts/">Contracts</a></li>
               <li><a href="/notes/">Notes</a></li>
           </ul>
       </div><!-- /navbar -->
        <div data-role="header">
            <h1>Page NEW Header</h1>
            <a href="#" data-icon="search" class="ui-btn-right">Search</a>
        </div><!-- /header -->
    
        <div role="main" class="ui-content">
            <h2>NEW</h2>
            <p>NEW CONTENT</p>
        </div><!-- /content -->
    
        <div data-role="footer" data-theme="a">
            <h4>Page NEW Footer</h4>
            <div data-role="navbar" data-grid="c">
                <ul>
                    <li><a href="#one">Home</a></li>
                    <li><a href="#six">Profile</a></li>
                    <li><a href="/contracts/">Contracts</a></li>
                    <li><a href="/notes/">Notes</a></li>
                </ul>
            </div><!-- /navbar -->
        </div><!-- /footer -->
    </div><!-- /page NEW -->

