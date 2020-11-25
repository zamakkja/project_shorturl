@extends('layouts.app')

@section('content')

<link href="css/addons/datatables.min.css" rel="stylesheet">
<script type="text/javascript" src="js/addons/datatables.min.js" defer></script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">All URL Created</div>

                <div class="card-body">
                    <table id="dtBasicExample" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10%;padding:10px;">#</th>
                                <th style="width:30%;padding:10px;">Short URL</th>
                                <th style="width:40%;padding:10px;">Full URL</th>
                                <th style="width:20%;padding:10px;">Opened</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($data as $item)
                            @php
                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"."/".$item->short_link;
                            @endphp
                            <tr>
                                <td style="padding:10px;">{{$index}}</td>
                                <td style="padding:10px;"> <a href="#" onclick="ClickShowDetail('{{$item->short_link}}')"> {{$actual_link}} </a></td>
                                <td class="box-full-link" style="padding:10px;"> <a id="full_link" href="{{$item->full_link}}"> {{$item->full_link}} </a> </td>
                                <td style="padding:10px;">{{$item->count_open}}</td>
                            </tr>

                            @php
                                $index ++;
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="padding:10px;">#</th>
                                <th style="padding:10px;">Short URL</th>
                                <th style="padding:10px;">Full URL</th>
                                <th style="padding:10px;">Opened</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">SHORT URL DETAIL</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">SHORT LINK :</span>
                </div>
                <input type="text" class="form-control" id="short_link" readonly >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">FULL LINK :</span>
                </div>
                <textarea class="form-control" cols="30" rows="5" id="txt_full_link" readonly ></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">OPEN LINK :</span>
                </div>
                <input type="text" class="form-control" id="open_link" readonly >
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">CREATE DATE :</span>
                </div>
                <input type="text" class="form-control" id="date_link" readonly >
            </div>
        </div>
        <div class="modal-footer">
            <a href="" id="link_go" class="btn btn-primary">GO TO LINK</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<style>
    .box-full-link{
    max-width: 300px ;
    text-overflow: ellipsis;
    overflow: hidden;
    }
    a#full_link {
        width: 100%;
        word-break: break-all;
        white-space: nowrap;
    }
</style>

<script>

    function ClickShowDetail(code){
        $.ajax({
            url:"/getDetail/"+code,
            type:"GET",
            success: (res) => {
                let date = new Date(res.created_at);
                document.getElementById("link_go").href = window.location.origin+"/"+res.short_link ;
                document.getElementById("short_link").value = window.location.origin+"/"+res.short_link ;
                document.getElementById("txt_full_link").value = res.full_link;
                document.getElementById("open_link").value = res.count_open;
                document.getElementById("date_link").value = date.getDate() + "/" + date.getMonth() + "/" +date.getFullYear();
                $('#myModal').modal('toggle')
            }
        })
    }

// $.noConflict();
$(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});



</script>
@endsection
