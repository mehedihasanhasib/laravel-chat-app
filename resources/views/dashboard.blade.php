<x-app-layout>
    <div class="container">

        <div class="row clearfix">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto"></ul>

                    <img src="{{ asset('profile_picture/' . Auth::user()->profile_picture) }}" alt="avater"
                        height="45" width="45" class="rounded-circle mx-3">
                    <a class="navbar-brand mx-2" href="#">{{ Auth::user()->name }}</a>
                    <form action="{{ route('logout') }}" method="POST" class="form-inline my-2 my-lg-0">
                        @csrf
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                    </form>
                </div>
            </nav>
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="list-unstyled chat-list mt-2 mb-0">
                            @foreach ($users as $user)
                                <li class="clearfix">
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
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                    </a>
                                    <div class="chat-about">
                                        <h6 class="m-b-0">Aiden Chavez</h6>
                                        <small>Last seen: 2 hours ago</small>
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
                        <div class="chat-history">
                            <ul class="m-b-0">
                                <li class="clearfix">
                                    <div class="message-data text-right">
                                        <span class="message-data-time">10:10 AM, Today</span>
                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
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
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">

                                <input type="text" class="form-control" placeholder="Enter text here...">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                            </div>
                        </div>
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
</script>
