@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h1 class="title_text" >SHORT URL Project</h1></div>
                <div class="card-body">
                    <form onsubmit="SubmitLink(event);" id="form_link">
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
    <div class="row justify-content-center" id="show_short_url">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <h1 class="title_text" >Your shortened URL</h1></div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" id="input_link" class="form-control" name="link" placeholder="กรอก URL ที่ต้องการ" >
                        <div class="input-group-append">
                            <button class="btn btn-primary" onclick="ClickCopyShortLink('input_link');" >คัดลอง</button>
                        </div>
                    </div>
                    <h3>ลิงค์เต็ม</h3>
                    <div class="box-full-link">
                        <a id="full_link" href=""></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
.box-full-link{
    width: 100%;
    text-overflow: ellipsis;
    overflow: hidden;
}
a#full_link {
    width: 100%;
    word-break: break-all;
    white-space: nowrap;
}
.title_text{
    background: -webkit-linear-gradient(#7895ff, #000b58);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
}
#show_short_url{
    transition: .4s ease all;
    opacity: 0;
}
</style>

<script>
    function ClickCopyShortLink(id){
        let range = document.createRange();
        let copydata = document.getElementById(id);
        range.selectNode(copydata); //changed here
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        // alert("คัดลอกข้อมูลสำเร็จ");
        Swal.fire("","คัดลอกลิงค์สำเร็จ","success")
    }
    function SubmitLink(e){
        e.preventDefault();
        let form = document.getElementById("form_link");
        let formdata = new FormData(form);
        let token = formdata.get("_token");
        let link = formdata.get("link");
        $.ajax({
            url:"/add_short",
            type:"POST",
            headers: {
                    'X-CSRF-TOKEN':token
                },
            processData:false,
            contentType:false,
            data:formdata,
            success: (res) => {
                let data = JSON.parse(res);
                if(data.status == "success"){
                    document.getElementById("show_short_url").style.opacity = "1";
                    document.getElementById("input_link").value = data.message;
                    document.getElementById("full_link").href = link;
                    document.getElementById("full_link").innerText = link;
                }else{
                    Swal.fire("",data.message,data.status)
                }
            }
        })
    }
</script>

@endsection


