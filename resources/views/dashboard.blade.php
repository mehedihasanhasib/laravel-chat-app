<x-app-layout>

    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="mb-2">
                            <div class="d-flex nav-item dropdown">
                                <img src="{{ asset('profile_picture/' . Auth::user()->profile_picture) }}" alt="avater"
                                    height="41" width="47" id="navbarDropdown" class="rounded-circle d-inline">

                                <p class="navbar-brand mx-2" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">{{ Auth::user()->name }}</p>

                                <form action="{{ route('logout') }}" method="POST"
                                    class="form-inline my-2 my-lg-0 dropdown-menu" aria-labelledby="navbarDropdown">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @foreach ($users as $user)
                                <li id="{{ $user->id }}" class="clearfix user-list">
                                    <img src="{{ asset('profile_picture/' . $user->profile_picture) }}" alt="avatar"
                                        height="47" width="47">
                                    <div class="about">
                                        <div class="name">{{ $user->name }}</div>
                                        <div class="status" id="status">
                                            <i id="{{ $user->id }}" class="fa fa-circle offline"></i>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="chat">

                        {{-- with whom chatting --}}
                        <div class="chat-header clearfix">
                            <div class="row">

                                {{-- profile picture of the receiver --}}
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img id="receiver_image" src="" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 id="receiver_name" class="m-b-0"></h6>
                                        {{-- <small>Last seen: 2 hours ago</small> --}}
                                    </div>
                                </div>

                                <div class="col-lg-6 hidden-sm text-right">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary"><i
                                            class="fa fa-camera"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-primary"><i
                                            class="fa fa-image"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-info"><i
                                            class="fa fa-cogs"></i></a>
                                    <a href="javascript:void(0);" class="btn btn-outline-warning"><i
                                            class="fa fa-question"></i></a>
                                </div>
                            </div>
                        </div>
                        {{-- with whom chatting ends --}}

                        {{-- ----------------------------------------------------------------------- --}}

                        {{-- show messages --}}
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="" alt="avatar">
                                    </div>
                                    <div class="message other-message float-right"> Hi Aiden, how are you? How is the
                                        project coming along? </div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:12 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Are we meeting today?</div>
                                </li>
                                <li class="clearfix">
                                    <div class="message-data">
                                        <span class="message-data-time">10:15 AM, Today</span>
                                    </div>
                                    <div class="message my-message">Project has been already finished and I have
                                        results
                                        to show you.</div>
                                </li>
                            </ul>
                        </div>
                        {{-- show messages ends --}}

                        <form class="chat-message clearfix" action="" method="POST">
                            @csrf
                            <div class="input-group mb-0">
                                <input type="text" class="form-control" placeholder="Enter text here...">
                                <div class="input-group-prepend">
                                    <button type="submit" class="m-0 p-0">
                                        <span class="input-group-text"><i class="fa fa-send"></i></span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/app.js')
<script>
    setTimeout(() => {
        window.Echo.join('status_update_channel')
            .here((users) => {
                for (let i = 0; i < users.length; i++) {
                    if (users[i].id != sender_id) {
                        $('#' + users[i].id).removeClass('offline');
                        $('#' + users[i].id).addClass('online');
                    }
                }
            })
            .joining((users) => {
                $('#' + users.id).removeClass('offline');
                $('#' + users.id).addClass('online');
            })
            .leaving((users) => {
                $('#' + users.id).removeClass('online');
                $('#' + users.id).addClass('offline');
            })
            .listen('.App\\Events\\UserStatusEvemt', (e) => {
                console.log(
                    e.user + ": " + e.message
                );
            })
    }, 500);

    $(document).ready(function() {
        $('.user-list').click(function() {
            receiver_id = $(this).attr('id');
            $.ajax({
                url: `{{ url('get-receiver-info') }}/${receiver_id}`,
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#receiver_name').text(data.name);
                    $('#receiver_image').attr('src',
                        `{{ asset('profile_picture/${data.profile_picture}') }}`);
                }
            });
        });
    });
</script>
