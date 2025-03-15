<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    {{-- <link rel="stylesheet"  href="{{asset('css/app.css')}}"> --}}

    <link rel="stylesheet" href="/vendors/feather/feather.css">

    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    {{-- <script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script> --}}

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <script src=""></script> --}}
    @vite('resources/css/app.css')

    <script>
        var sender_id = @json(auth()->user()->id);
        var receiver_id;
    </script>
</head>


<body>

    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('user.includes.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>

            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('user.includes.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if (isset($users) && count($users) > 0)

                                <div class="col-3 p-0 m-0">
                                    <ul>
                                        @foreach ($users as $user)
                                            <div class="p-2 col-12 user-chat" data-id="{{ $user->id }}"
                                                style="display:flex; justify-content:center;align-item:center;background-color:rgb(220, 224, 224)">
                                                @if ($user->picture)
                                                    <img src="{{ url('storage/' . $user->picture) }}"
                                                        alt="Profile Picture" class=""
                                                        style="width: 40px; height: 40px;border-radius:50%">
                                                @else
                                                    <img src="{{ asset('images/user.jpg') }}" alt="Profile Picture"
                                                        class=""
                                                        style="width: 40px; height: 40px;border-radius:50%">
                                                @endif


                                                <li class="ml-2"
                                                    style="list-style: none;font-weight:bold;margin:auto">
                                                    {{ $user->name ?? '-' }}</li>
                                                <span id="{{ $user->id }}-status"
                                                    class="offline-status mt-2 text-danger">Offline</span>
                                            </div>
                                        @endforeach
                                    </ul>


                                </div>
                                <div class=" col-9 w-100 chat-section"
                                    style="display:flex; justify-content:center;align-items:center;background-color: rgb(230, 250, 250); height:100vh">
                                    <h6>Your Chat is end-to-end Encrypted</h6>
                                </div>
                                <div class="col-9 d-none chat-container "
                                    style="background-color: rgb(230, 250, 250);height:100vh;overflow-y:scroll">

                                    {{-- <div class="current-user-class">
                                        <h4>hy how are you</h4>
                                    </div>
                                    <div class="distance-user-class">
                                        <h4>Fine You</h4>
                                    </div> --}}

                                    <form action="" style="bottom:0;position:fixed;" class="col-7" id="chat-form">
                                        <div class="d-flex pb-42" style="width: 100%">
                                            <input type="text" style="width:100%;border-radies:25px" name="message"
                                                id="message" placeholder="Enter Message">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>

                                </div>

                            @endif

                        </div>
                    </div>

                </div>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->


        {{-- modal --}}
        <!-- Button trigger modal -->
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
  </button> --}}

        <!-- Modal -->
        <div class="modal fade" id="deleteChat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="" id="delete-chat-form">

                        {{-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> --}}
                        <div class="modal-body">
                            <input type="hidden" name="id" id="delete-chat-id" value="">
                            <p>ARE you sure to delte this chat </p>
                            <p class="delete-chat"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- modal --}}

        @vite('resources/js/app.js')

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


        <!-- plugins:js -->
        <script src="/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="/vendors/chart.js/Chart.min.js"></script>
        <script src="/vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="/js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="/js/off-canvas.js"></script>
        <script src="/js/hoverable-collapse.js"></script>
        <script src="/js/template.js"></script>
        <script src="/js/settings.js"></script>
        <script src="/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="/js/dashboard.js"></script>

        <script src="/js/Chart.roundedBarCharts.js"></script>
        <!-- End custom js for this page-->



        <script>
            $(document).ready(function() {
                // var sender_id = @json(auth()->user()->id);
                // var receiver_id;
                $('.user-chat').on('click', function() {
                    receiver_id = $(this).attr('data-id');
                    $('.chat-section').addClass('d-none');
                    $('.chat-container').removeClass('d-none');

                    $.ajax({
                        url: 'load-chats',
                        type: 'POST',
                        data: {
                            sender_id: sender_id,
                            receiver_id: receiver_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                                var html = '';
                                for (let i = 0; i < response.data.length; i++) {
                                    let addClass;
                                    if (response.data[i].sender_id == sender_id) {
                                        addClass = 'current-user-class';
                                    } else {
                                        addClass = 'distance-user-class';
                                    }
                                    html += `<div class="${addClass}" id="${response.data[i].id}-chat"> <h4>`;

                                    html += `<span>` + response.data[i].message + `</span>`;
                                    if (sender_id == response.data[i].sender_id) {
                                        html +=
                                            `<i class="fa fa-solid fa-trash" data-toggle="modal" data-target="#deleteChat" data-id='` +
                                            response
                                            .data[
                                                i].id + `'></i>`;
                                    }

                                    html += `</h4></div>`;
                                }

                                $('.chat-container').append('');
                                $('.chat-container').append(html);
                                scrollChat();


                            } else {
                                alert(response.message)
                            }
                        },
                        error: function(response) {
                            alert(response.message)
                        }
                    })
                });

                $('#chat-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: 'save-chat',
                        type: 'POST',
                        data: {
                            sender_id: sender_id,
                            receiver_id: receiver_id,
                            message: $('#message').val()

                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',

                        },
                        success: function(response) {
                            if (response.success) {
                                $('#message').val('');
                                var html = `<div class='current-user-class' id='` + response.data
                                    .id + '-chat'
                                `'>
                                        <h4> <span>` + response.data.message +
                                    `<i class="fa fa-solid fa-trash" data-toggle="modal" data-target="#deleteChat" data-id='` +
                                    response.data.id + `'></i></span></h4>
                                    </div>`;

                                $('.chat-container').append(html);
                                scrollChat();

                            } else {
                                alert(response.message)
                            }
                        },
                        error: function(response) {
                            alert(response.message)
                        }
                    })
                })

                function scrollChat() {
                    $('.chat-container').animate({
                        scrollTop: $('.chat-container').offset().top + $('.chat-container')[0].scrollHeight
                    }, 0)
                }



                $(document).on('click', '.fa-trash', function() {
                    $('#delete-chat-id').val($(this).attr('data-id'));
                    $('.delete-chat').text($(this).parent().text());
                })


                $('#delete-chat-form').on('submit', function(e) {
                    e.preventDefault();
                    var id = $('#delete-chat-id').val();
                    $.ajax({
                        url: 'delete-chat',
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            if (response.success) {
                               $('#' + id +'-chat' ).remove();
                               $('#deleteChat' ).modal('hide');
                            } else {
                                alert(response.message)
                            }
                        },
                        error: function(response) {
                            alert(response.message)
                        }
                    })
                })


            })
        </script>

</body>

</html>
