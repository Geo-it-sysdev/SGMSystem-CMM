 <!-- GLightbox CSS -->
 <link rel="stylesheet" href="<?= base_url('assets/libs/glightbox/css/glightbox.min.css'); ?>" />

 <!-- Layout config JS -->
 <script src="<?= base_url('assets/js/layout.js'); ?>"></script>

 <!-- Bootstrap CSS -->
 <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />

 <!-- Icons CSS -->
 <link href="<?= base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />

 <!-- App CSS -->
 <link href="<?= base_url('assets/css/app.min.css'); ?>" rel="stylesheet" type="text/css" />

 <!-- Custom CSS -->
 <link href="<?= base_url('assets/css/custom.min.css'); ?>" rel="stylesheet" type="text/css" />

 <style>
.chat-list {
    list-style: none;
    padding: 0;
    margin: 0;
    max-width: 400px;
}

.chat-item {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    border-bottom: 1px solid #eee;
}

.flex-shrink-0.chat-user-img {
    position: relative;
    width: 40px;
    height: 40px;
    margin-right: 12px;
}

.flex-shrink-0.chat-user-img img.avatar-xs {
    width: 40px;
    height: 40px;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

.user-status {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid white;
    background-color: gray;
    /* default offline */
    box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);
}

.chat-user-img.online .user-status {
    background-color: #4CAF50;
    /* green dot */
}

.chat-user-img.offline .user-status {
    background-color: #4CAF50;
    /* gray dot for offline */
}

/* .chat-user-img.offline .user-status {
  background-color: gray;
} */

.chat-item .user-name {
    font-weight: 600;
    font-size: 14px;
    color: #333;
}
 </style>
 <!-- ============================================================== -->
 <!-- Start right Content here -->
 <!-- ============================================================== -->
 <div class="main-content">

     <div class="page-content">
         <div class="container-fluid">
             <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
                 <div class="chat-leftsidebar">
                     <div class="px-4 pt-4 mb-3">
                         <div class="d-flex align-items-start">
                             <div class="flex-grow-1">
                                 <h5 class="mb-4">Chats </h5>
                             </div>
                             <div class="flex-shrink-0">
                                 <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom"
                                     title="Add Group">

                                     <!-- Button trigger modal -->
                                     <button type="button" class="btn btn-soft-success btn-sm">
                                         <i class="ri-add-line align-bottom"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>
                         <div class="search-box mb-3">
                             <input type="text" id="userSearch" class="form-control bg-light border-light"
                                 placeholder="Search here..." />
                             <i class="ri-search-2-line search-icon"></i>
                         </div>

                     </div> <!-- .p-4 -->

                     <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified" role="tablist">
                         <li class="nav-item">
                             <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab">
                                 Chats
                             </a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab">
                                 Group Chat
                             </a>
                         </li>
                     </ul>

                     <div class="tab-content text-muted">
                         <div class="tab-pane active" id="chats" role="tabpanel">
                             <div class="chat-room-list pt-3" data-simplebar="">
                                 <div class="d-flex align-items-center px-4 mb-2">
                                     <div class="flex-grow-1">
                                         <p class="mb-4 fs-11 text-muted text-uppercase">User Chat</p>
                                         <ul class="chat-list">
                                             <?php if(!empty($users)): ?>
                                             <?php foreach($users as $user): 
                                                        $photo_url = !empty($user->photo) ? 
                                                            'http://172.16.161.34:8080/hrms/images/users/' . basename($user->photo) : 
                                                            base_url('assets/img/user-dummy-img.jpg');

                                                        // Calculate online status (last activity within 5 mins)
                                                        $last_activity = new DateTime($user->last_activity ?? '2000-01-01 00:00:00');
                                                        $now = new DateTime();
                                                        $threshold = (clone $now)->sub(new DateInterval('PT5M'));
                                                        $is_online = $last_activity > $threshold;
                                                    ?>
                                             <li class="chat-item" style="cursor:pointer;"
                                                 data-userid="<?= $user->id; ?>"
                                                 data-username="<?= htmlspecialchars($user->full_name); ?>"
                                                 data-photo="<?= $photo_url; ?>">

                                                 <div class="flex-shrink-0 chat-user-img <?= $is_online ? 'online' : 'offline'; ?> user-own-img align-self-center me-3 ms-0"
                                                     style="position: relative;">
                                                     <img src="<?= htmlspecialchars($photo_url); ?>"
                                                         class="rounded-circle avatar-xs" alt="User Photo" />
                                                     <span class="user-status"></span>
                                                 </div>

                                                 <div class="position-relative d-inline-block">
                                                     <span
                                                         class="user-name"><?= htmlspecialchars($user->full_name); ?></span>

                                                     <?php if (!empty($user->unread_count) && $user->unread_count > 0): ?>
                                                     <span
                                                         class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                                         style="margin-left: 6px; font-size: 0.65rem; padding: 0.25em 0.4em; line-height: 1;">
                                                         <?= $user->unread_count > 99 ? '+99' : $user->unread_count ?>
                                                         <span class="visually-hidden">unread messages</span>
                                                     </span>
                                                     <?php endif; ?>
                                                 </div>
                                             </li>
                                             <?php endforeach; ?>
                                             <?php else: ?>
                                             <li>No users found.</li>
                                             <?php endif; ?>
                                         </ul>
                                     </div>

                                     <!-- <div class="flex-shrink-0">
                                                 <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="New Message">
        
                                                     <button type="button" class="btn btn-soft-success btn-sm shadow-none">
                                                         <i class="ri-add-line align-bottom"></i>
                                                     </button>
                                                 </div>
                                             </div> -->
                                 </div>



                                 <div class="chat-message-list">

                                     <ul class="list-unstyled chat-list chat-user-list" id="userList">

                                     </ul>
                                 </div>

                                 <!-- <div class="d-flex align-items-center px-4 mt-4 pt-2 mb-2">
                                             <div class="flex-grow-1">
                                                 <h4 class="mb-0 fs-11 text-muted text-uppercase">Channels </h4>
                                             </div>
                                             <div class="flex-shrink-0">
                                                 <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="bottom" title="Create group">
                                                     <button type="button" class="btn btn-soft-success btn-sm">
                                                         <i class="ri-add-line align-bottom"></i>
                                                     </button>
                                                 </div>
                                             </div>
                                         </div> -->

                                 <div class="chat-message-list">

                                     <ul class="list-unstyled chat-list chat-user-list mb-0" id="channelList">
                                     </ul>
                                 </div>
                                 <!-- End chat-message-list -->
                             </div>
                         </div>
                         <div class="tab-pane" id="contacts" role="tabpanel">
                             <div class="chat-room-list pt-3" data-simplebar="">
                                 <div class="sort-contact" style="margin-left: 30px;">
                                     <p>No Group Chat Available. </p>
                                 </div>
                             </div>
                         </div>

                     </div>
                     <!-- end tab contact -->
                 </div>
                 <!-- end chat leftsidebar -->
                 <!-- Start User chat -->
                 <div class="user-chat w-100 overflow-hidden">

                     <div class="chat-content d-lg-flex">
                         <!-- start chat conversation section -->
                         <div class="w-100 overflow-hidden position-relative">
                             <!-- conversation user -->
                             <div class="position-relative">


                                 <div class="position-relative" id="users-chat">
                                     <div class="p-3 user-chat-topbar">
                                         <div class="row align-items-center">
                                             <div class="col-sm-4 col-8">
                                                 <div class="d-flex align-items-center">
                                                     <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                         <a href="javascript: void(0);"
                                                             class="user-chat-remove fs-18 p-1"><i
                                                                 class="ri-arrow-left-s-line align-bottom"></i></a>
                                                     </div>
                                                     <div id="chat-panel" style="display:none;">
                                                         <div class="flex-grow-1 overflow-hidden">
                                                             <div class="d-flex align-items-center">
                                                                 <div
                                                                     class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                     <img id="chat-user-photo" src=""
                                                                         class="rounded-circle avatar-xs"
                                                                         alt="User Photo" />
                                                                     <span class="user-status"></span>
                                                                 </div>
                                                                 <div class="flex-grow-1 overflow-hidden">
                                                                     <h5 class="text-truncate mb-0 fs-16"><a href="#"
                                                                             class="text-reset username"
                                                                             id="chat-username">Username</a></h5>
                                                                     <p
                                                                         class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                         <small id="chat-user-status">Online</small></p>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-sm-8 col-4">
                                                 <ul class="list-inline user-chat-nav text-end mb-0">
                                                     <li class="list-inline-item m-0">
                                                         <div class="dropdown">
                                                             <button class="btn btn-ghost-secondary btn-icon"
                                                                 type="button" data-bs-toggle="dropdown"
                                                                 aria-haspopup="true" aria-expanded="false">
                                                                 <i data-feather="search" class="icon-sm"></i>
                                                             </button>
                                                             <div
                                                                 class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                 <div class="p-2">
                                                                     <div class="search-box">
                                                                         <input type="text"
                                                                             class="form-control bg-light border-light"
                                                                             placeholder="Search here..."
                                                                             onkeyup="searchMessages()"
                                                                             id="searchMessage" />
                                                                         <i class="ri-search-2-line search-icon"></i>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </li>

                                                     <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                         <button type="button" class="btn btn-ghost-secondary btn-icon"
                                                             data-bs-toggle="offcanvas"
                                                             data-bs-target="#userProfileCanvasExample"
                                                             aria-controls="userProfileCanvasExample">
                                                             <i data-feather="info" class="icon-sm"></i>
                                                         </button>
                                                     </li>

                                                     <li class="list-inline-item m-0">
                                                         <div class="dropdown">
                                                             <button class="btn btn-ghost-secondary btn-icon"
                                                                 type="button" data-bs-toggle="dropdown"
                                                                 aria-haspopup="true" aria-expanded="false">
                                                                 <i data-feather="more-vertical" class="icon-sm"></i>
                                                             </button>
                                                             <div class="dropdown-menu dropdown-menu-end">
                                                                 <a class="dropdown-item d-block d-lg-none user-profile-show"
                                                                     href="#"><i
                                                                         class="ri-user-2-fill align-bottom text-muted me-2"></i>
                                                                     View Profile </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                                     Archive </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                                     Muted </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                                     Delete </a>
                                                             </div>
                                                         </div>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div>

                                     </div>


                                     <!--   <div class="chat-conversation p-3 p-lg-4 " id="chat-messages" data-simplebar="">
                                                 <div id="elmLoader">
                                               <h4>HELLO! WELCOME PHARMA MONITORING MANAGEMENT SYSTEM <br>
                                               <span style="margin-left: 60px;">  <br>
                                               FEEL FREE TO ASK AND CHAT ABOUT YOUR CONCERNS. </span></h4>
                                                 </div>
                                                 <ul class="list-unstyled chat-conversation-list" id="users-conversation">
                                                    
                                                 </ul>
                                             </div>

                                             <div id="chat-messages" style="height:300px; overflow-y:auto; border:1px solid #ddd; padding:10px; margin-top:15px; background:#f9f9f9;">
                                            </div> -->



                                     <div id="chat-messages"
                                         style="height: 300px; overflow-y: auto; margin-top: 15px; border: 1px solid #ddd; padding: 10px;">
                                         <!-- messages loaded here -->
                                     </div>

                                     <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show "
                                         id="copyClipBoard" role="alert">
                                         Message ______
                                     </div>
                                 </div>

                                 <div class="position-relative" id="channel-chat">
                                     <div class="p-3 user-chat-topbar">
                                         <div class="row align-items-center">
                                             <div class="col-sm-4 col-8">
                                                 <div class="d-flex align-items-center">
                                                     <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                         <a href="javascript: void(0);"
                                                             class="user-chat-remove fs-18 p-1"><i
                                                                 class="ri-arrow-left-s-line align-bottom"></i></a>
                                                     </div>
                                                     <div class="flex-grow-1 overflow-hidden">
                                                         <div class="d-flex align-items-center">
                                                             <div
                                                                 class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                                                 <img src="assets/images/users/avatar-2.jpg"
                                                                     class="rounded-circle avatar-xs" alt="" />
                                                             </div>
                                                             <div class="flex-grow-1 overflow-hidden">
                                                                 <h5 class="text-truncate mb-0 fs-16"><a
                                                                         class="text-reset username"
                                                                         data-bs-toggle="offcanvas"
                                                                         href="#userProfileCanvasExample"
                                                                         aria-controls="userProfileCanvasExample">Lisa
                                                                         Parker </a></h5>
                                                                 <p
                                                                     class="text-truncate text-muted fs-14 mb-0 userStatus">
                                                                     <small>24 Members </small></p>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-sm-8 col-4">
                                                 <ul class="list-inline user-chat-nav text-end mb-0">
                                                     <li class="list-inline-item m-0">
                                                         <div class="dropdown">
                                                             <button class="btn btn-ghost-secondary btn-icon"
                                                                 type="button" data-bs-toggle="dropdown"
                                                                 aria-haspopup="true" aria-expanded="false">
                                                                 <i data-feather="search" class="icon-sm"></i>
                                                             </button>
                                                             <div
                                                                 class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg">
                                                                 <div class="p-2">
                                                                     <div class="search-box">
                                                                         <input type="text"
                                                                             class="form-control bg-light border-light"
                                                                             placeholder="Search here..."
                                                                             onkeyup="searchMessages()"
                                                                             id="searchMessage" />
                                                                         <i class="ri-search-2-line search-icon"></i>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </li>

                                                     <li class="list-inline-item d-none d-lg-inline-block m-0">
                                                         <button type="button" class="btn btn-ghost-secondary btn-icon"
                                                             data-bs-toggle="offcanvas"
                                                             data-bs-target="#userProfileCanvasExample"
                                                             aria-controls="userProfileCanvasExample">
                                                             <i data-feather="info" class="icon-sm"></i>
                                                         </button>
                                                     </li>

                                                     <li class="list-inline-item m-0">
                                                         <div class="dropdown">
                                                             <button class="btn btn-ghost-secondary btn-icon"
                                                                 type="button" data-bs-toggle="dropdown"
                                                                 aria-haspopup="true" aria-expanded="false">
                                                                 <i data-feather="more-vertical" class="icon-sm"></i>
                                                             </button>
                                                             <div class="dropdown-menu dropdown-menu-end">
                                                                 <a class="dropdown-item d-block d-lg-none user-profile-show"
                                                                     href="#"><i
                                                                         class="ri-user-2-fill align-bottom text-muted me-2"></i>
                                                                     View Profile </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-inbox-archive-line align-bottom text-muted me-2"></i>
                                                                     Archive </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-mic-off-line align-bottom text-muted me-2"></i>
                                                                     Muted </a>
                                                                 <a class="dropdown-item" href="#"><i
                                                                         class="ri-delete-bin-5-line align-bottom text-muted me-2"></i>
                                                                     Delete </a>
                                                             </div>
                                                         </div>
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div>

                                     </div>
                                     <!-- end chat user head -->
                                     <div class="chat-conversation p-3 p-lg-4" id="chat-conversation" data-simplebar="">
                                         <ul class="list-unstyled chat-conversation-list" id="channel-conversation">
                                         </ul>
                                         <!-- end chat-conversation-list -->

                                     </div>
                                     <div class="alert alert-warning alert-dismissible copyclipboard-alert px-4 fade show "
                                         id="copyClipBoardChannel" role="alert">
                                         Message ______
                                     </div>
                                 </div>

                                 <!-- end chat-conversation -->

                                 <div class="chat-input-section p-3 p-lg-4">

                                     <form id="chatinput-form" style="margin-top:15px;">
                                         <input type="hidden" id="chat-receiver-id" value="" />
                                         <div class="row g-0 align-items-center">
                                             <div class="col-auto">
                                                 <button type="button"
                                                     class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                                                     <i class="bx bx-smile align-middle"></i>
                                                 </button>
                                             </div>
                                             <div class="col">
                                                 <input type="text"
                                                     class="form-control chat-input bg-light border-light"
                                                     id="chat-input" placeholder="Type your message..."
                                                     autocomplete="off" />
                                                 <div class="chat-input-feedback text-danger small mt-1"
                                                     style="display:none;">Please enter a message</div>
                                             </div>
                                             <div class="col-auto">
                                                 <button type="submit"
                                                     class="btn btn-success chat-send waves-effect waves-light">
                                                     <i class="ri-send-plane-2-fill align-bottom"></i>
                                                 </button>
                                             </div>
                                         </div>
                                     </form>
                                 </div>

                                 <div class="replyCard">
                                     <div class="card mb-0">
                                         <div class="card-body py-3">
                                             <div class="replymessage-block mb-0 d-flex align-items-start">
                                                 <div class="flex-grow-1">
                                                     <h5 class="conversation-name"></h5>
                                                     <p class="mb-0" />
                                                 </div>
                                                 <div class="flex-shrink-0">
                                                     <button type="button" id="close_toggle"
                                                         class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                         <i class="bx bx-x align-middle"></i>
                                                     </button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- end chat-wrapper -->

         </div>
         <!-- container-fluid -->
     </div>
     <!-- End Page-content -->

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <script>
     $(document).ready(function() {

         function scrollMessagesToBottom() {
             var chatMessages = $('#chat-messages');
             chatMessages.scrollTop(chatMessages[0].scrollHeight);
         }

         // ===================== On user click, load user info and chat messages =================\\
         $('.chat-list').on('click', '.chat-item', function() {
             var userId = $(this).data('userid');
             var username = $(this).data('username');
             var photo = $(this).data('photo');

             //======================= Update chat panel user info =================\\
             $('#chat-user-photo').attr('src', photo);
             $('#chat-username').text(username);
             $('#chat-receiver-id').val(userId);

             $('#chat-panel').show();

             // ======================= Fetch messages via AJAX ====================\\
             $.ajax({
                 url: '<?= base_url("AdminController/fetch_messages/") ?>' + userId,
                 method: 'GET',
                 dataType: 'json',
                 success: function(data) {
                     var html = '';
                     if (data.length === 0) {
                         html =
                             '<p class="text-muted">No messages yet. Start the conversation!</p>';
                     } else {
                         data.forEach(function(msg) {
                             var isSender = (msg.sender_id ==
                                 <?= $this->session->userdata("po_user"); ?>);
                             html += '<div style="margin-bottom:10px; text-align:' +
                                 (isSender ? 'right' : 'left') + ';">' +
                                 '<span style="display:inline-block; background:' +
                                 (isSender ? '#d1e7dd' : '#f8d7da') +
                                 '; padding:8px 12px; border-radius:15px; max-width:70%;">' +
                                 $('<div>').text(msg.message).html() +
                                 '</span><br>' +
                                 '<small class="text-muted">' + msg.timestamp +
                                 '</small>' +
                                 '</div>';
                         });
                     }
                     $('#chat-messages').html(html);
                     scrollMessagesToBottom();
                 },
                 error: function() {
                     $('#chat-messages').html(
                         '<p class="text-danger">Failed to load messages</p>');
                 }
             });
         });

         //========================= #Submit chat message ===========================\\
         $('#chatinput-form').submit(function(e) {
             e.preventDefault();
             var receiverId = $('#chat-receiver-id').val();
             var message = $('#chat-input').val().trim();

             if (message === '') {
                 $('.chat-input-feedback').show();
                 return;
             } else {
                 $('.chat-input-feedback').hide();
             }

             $.ajax({
                 url: '<?= base_url("AdminController/send_message") ?>',
                 method: 'POST',
                 dataType: 'json',
                 data: {
                     receiver_id: receiverId,
                     message: message
                 },
                 success: function(response) {
                     if (response.status === 'success') {
                         $('#chat-input').val('');
                         $('.chat-item[data-userid="' + receiverId + '"]').click();
                     } else {
                         alert('Failed to send message: ' + response.message);
                     }
                 },
                 error: function() {
                     alert('Failed to send message');
                 }
             });
         });

     });
     </script>

     <script>
     document.addEventListener("DOMContentLoaded", function() {
         const searchInput = document.getElementById("userSearch");
         const chatItems = document.querySelectorAll(".chat-item");

         searchInput.addEventListener("keyup", function() {
             const searchTerm = searchInput.value.toLowerCase();

             chatItems.forEach(function(item) {
                 const userName = item.querySelector(".user-name").textContent.toLowerCase();
                 if (userName.includes(searchTerm)) {
                     item.style.display = "";
                 } else {
                     item.style.display = "none";
                 }
             });
         });
     });
     </script>


     <!-- JAVASCRIPT -->
     <script src="<?= base_url('assets/libs/simplebar/simplebar.min.js'); ?>"></script>
     <script src="<?= base_url('assets/libs/node-waves/waves.min.js'); ?>"></script>
     <script src="<?= base_url('assets/libs/feather-icons/feather.min.js'); ?>"></script>
     <script src="<?= base_url('assets/js/pages/plugins/lord-icon-2.1.0.js'); ?>"></script>
     <script src="<?= base_url('assets/js/plugins.js'); ?>"></script>
     <!-- glightbox js -->
     <script src="<?= base_url('assets/libs/glightbox/js/glightbox.min.js'); ?>"></script>
     <!-- fgEmojiPicker js -->
     <script src="<?= base_url('assets/libs/fg-emoji-picker/fgEmojiPicker.js'); ?>"></script>
     <!-- chat init js -->
     <script src="<?= base_url('assets/js/pages/chat.init.js'); ?>"></script>
     <!-- App js -->
     <script src="<?= base_url('assets/js/app.js'); ?>"></script>