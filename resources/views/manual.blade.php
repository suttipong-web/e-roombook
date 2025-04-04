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
                  
                </div>
                <p class="text-center"> หากคู่มือไม่แสดง สามารถดาวน์โหลดคู่มือการใช้งานได้ที่นี่   <a href="{{ Storage::url('manual.pdf') }}" target="_blank"
                    class="btn btn-primary"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-download-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z"/>
                      </svg> ดาวน์โหลดคู่มือ  </a> </p>
                <div class="text-center mb-4  mt-3">
                
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