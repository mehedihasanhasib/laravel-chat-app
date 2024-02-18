<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>
</head>

<body>
    <form action="{{ route('event_fire') }}">
        <input type="text" name="" id="">
        <button>Send</button>
    </form>
    <br>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
</body>

@vite('resources/js/app.js')
<script>
    setTimeout(() => {
        window.Echo.join('presence-channel')
            .listen('.App\\Events\\TestPresenceChannel', (e) => {
                console.log(e);
            })
    }, 100);
</script>

</html>
