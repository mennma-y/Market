@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">
            <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
            <div class="">
                <div class="d-flex flex-row flex-wrap">
                    @foreach($stocks as $stock)
                        <div class="col-xs-6 col-sm-4 col-md-4">
                            <div class="mycart-box" style="text-align:center; border:1px solid #eef; margin:5px;">
                                {{$stock['name']}}<br>
                                {{$stock['fee']}}円<br>
                                <img src="/image/{{$stock->imgpath}}" alt="" class="incart" >
                                <br>
                                {{$stock['detail']}}<br>
                                @auth
                                    <form action="/mycart" method="post">
                                        @csrf
                                        <input type="hidden" name="stock_id" value="{{$stock['id']}}">
                                        <input type="submit" value="カートに入れる">
                                    </form>
                                @endauth
                            </div>

                            <a href="/" class="text-center">商品一覧へ</a>
                        </div>
                    @endforeach
                </div>
                <div class="transition">
                    {{$stocks->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection