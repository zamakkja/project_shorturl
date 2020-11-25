
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
    <title>PROJECT SHORT URL</title>
</head>
<body>

    <div class="container">
        <div class="box-card" >
            <h1 class="text-primary text-center mb-5"> SHORT URL Project </h1>
            <div class="card bg-custom">
                <div class="card-header">
                    <h2 class="title-color text-center">ใส่ URL ที่คุณต้องการทำให้สั้นลง</h2>
                </div>
                <div class="card-body">
                    <form onsubmit="SubmitLink(event);">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="link" placeholder="กรอก URL ที่ต้องการ" >
                            <div class="input-group-append">
                                <button class="btn btn-primary">ย่อลิงค์</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


</body>
</html>
