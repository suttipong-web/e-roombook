@inject('getService', 'App\class\HelperService')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>คู่มือการใช้ระบบ จองห้องประชุมคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</title>
    @includeIf('partials.headtag')
</head>

<body>
    @includeIf('partials.header')
    <main class="main">
        <section id="search" class="about section" style="padding: 70px 0px 100px 0px">
            <div class="container ">
                <div class="section-title text-center mt-5 mb-4">
                    <h2>คู่มือการใช้ระบบ จองห้องประชุมคณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่</h2>
                    <p>สามารถดาวน์โหลดคู่มือการใช้งานได้ที่นี่</p>
                </div>
                <div class="text-center mb-4">
                    <a href="{{ Storage::url('manual.pdf') }}" target="_blank"
                        class="btn btn-primary">ดาวน์โหลดคู่มือ</a>
                    <br />                   
                    <iframe src="{{ Storage::url('manual.pdf') }}" width="100%" height="600px" style="border: none;"></iframe>             

                </div>
            </div>
        </section>
    </main>
    @includeIf('partials.footer')
    @includeIf('partials.incJS')
    <script>
        $(function () { });
    </script>
</body>

</html>