@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จองห้องประชุมคณะวิศวกรรมศาสตร์</title>
    @includeIf('partials.headtag')
</head>

<body>
    @includeIf('partials.header')
    <main class="main">
    </main>
    @includeIf('partials.incJS')
    <script>
        $(function() {});
    </script>
</body>

</html>
