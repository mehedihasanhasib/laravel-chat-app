<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <title>Message</title>
</head>

<body>
    <form id="sendMessage">
        @csrf
        <input type="text" name="message" id="message">
        <button>Send</button>
    </form>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button>Logout</button>
    </form>
</body>

@vite('resources/js/app.js')
<script>
    $(document).ready(function() {
        $('#sendMessage').submit('click', function(e) {
            e.preventDefault()
            data = $('#message');
            $.ajax({
                url: "{{ route('event_fire') }}",
                data: data
            })
        })
    })

    setTimeout(() => {
        window.Echo.join('presence-channel')
            .listen('.App\\Events\\TestPresenceChannel', (e) => {
                console.log(
                    e.user + ": " + e.message
                );
            })
    }, 200);
</script>

</html>
