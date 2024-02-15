<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@1.9.6/dist/tailwind.min.css" rel="stylesheet">
    <title>Chat</title>
</head>

<body>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button>Logout</button>
    </form>
</body>
@vite('resources/js/app.js')
<script>
    setTimeout(() => {
        window.Echo.private('newMessage').listen('.App\\Events\\NewMessage', (e) => {
            console.log(e.newChat);
        })
    }, 200);
</script>

</html>
