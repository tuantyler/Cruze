@extends('layouts.layout1', ['breadcrumb' => "Xem danh sách đăng ký"])

@section('content')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Biển số xe</th>
            <th scope="col">Hành động</th>
        </tr>
    </thead>
    <tbody>
        @isset($registered)
        @foreach ($registered as $ticket_id => $item)
        <tr>
            <th scope="row">{{$loop->index + 1}}</th>
            <td>{{$item["fullname"]}}</td>
            <td>{{$item["phone"]}}</td>
            <td>{{$item["gender"]}}</td>
            <td>{{$item["plate"]}}</td>
            <td>
                <button class="btn btn-info" onclick="showDetail({{$loop->index}} , this)" style="width: 150px;">Xem chi tiết</button>
                <a href="{{ route('deleteVerifiedTicket', ['ticket'=>$ticket_id]) }}"><button class="btn btn-danger">X</button></a>
            </td>
        </tr>
        <tr >
            <td colspan="6" style="padding: 0%;">
                <div id="detail{{$loop->index}}" style="background: turquoise; color: white; display: none; padding: 10px">
                    <strong>Tên facebook:</strong> {{$item["fb_name"]}}
                    <br>
                    <strong>Địa chỉ:</strong> {{$item["address"]}}
                    <br>
                    <strong>Tem số:</strong> {{$item["stamp"]}}
                </div>
    
            </td>
        </tr> 
        @endforeach
        @endisset
       
    </tbody>
</table>
@endsection

@section('scripts')
<script>
    function showDetail(index , evt){
        $("#detail"+index).slideToggle();
        $current = $(evt).html();
        if ($current == "Xem chi tiết") {
            $(evt).html("Ẩn chi tiết")
        }
        else {
            $(evt).html("Xem chi tiết")
        }
    }
</script>

@endsection