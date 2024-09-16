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

            <div class="container pt-5">
                    <div class="text-center p-2 mt-5">
                        <div class="alert alert-danger" role="alert">
                            <div>
                                <h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                                    </svg>
                                </h1>
                            </div>
                            <div>
                                ท่านไม่สามารถเข้าสู่ระบบได้ กรุณาติดต่อผู้ดูแลระบบ <br /> เพื่อตรวจสอบสิทธิ์การเข้าใช้งานระบบ

                                <br />
                            โทรศัพท์: 0-539-44120  , อีเมล: webmaster@eng.cmu.ac.th
                            </div>
                            <div class="p-3">
                                <a href="/">
                                    << กลับหน้าหลัก </a>
                            </div>

                        </div>
                    </div>
                </div>


    </main>
    @includeIf('partials.footer')
    @includeIf('partials.incJS')
    <script>
        $(function() {});
    </script>
</body>

</html>
