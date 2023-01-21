@extends('layouts.master') <!--  layouts/master.blade.php 파일의 레이아웃을 상속받는다. -->
<!--  @yield('title')에는 '테스트페이지' 라는 값이 입력된다. -->
@section('title') 
    amy-do 회원관리
@stop
<!--  @yield('header_css_js')에 페이지에 사용될 js와 css를 임폴트 한다. -->
@section('header_css_js') 

@stop
<!--  헤더에는 layouts/header.blade.php의 내용을 가져온다. -->
@section('header')
    @include('layouts.header') 
@stop

@section('container')
    <h1 class="page-title">회원관리</h1>
    <!-- search -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="text-primary">회원관리 리스트</h6>
        </div>
        <div class="card-body">
            <div class="responsive">
                <table class="table" cellspacing="0">
                    <tbody>
                        <tr>
                            <th>아이디</th>
                            <td><input type="text" name="userid"></td>
                            <th>이름</th>
                            <td><input type="text" name="name"></td>
                            <th>이메일</th>
                            <td><input type="text" name="email"></td>
                        </tr>
                        <tr>
                            <th>연락처</th>
                            <td><input type="text" name="phone"></td>
                            <th>주소</th>
                            <td><input type="text" name="address"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- search -->
    <!-- table -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="text-primary">회원관리 리스트</h6>
        </div>
        <div class="card-body">
            <div class="responsive">
                <table class="table hover" cellspacing="0">
                    <colgroup>
                        <col width="60px">
                        <col width="150px">
                        <col width="150px">
                        <col width="200px">
                        <col width="200px">
                        <col>
                        <col width="250px">
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="cols">번호</th>
                        <th scope="cols">아이디</th>
                        <th scope="cols">이름</th>
                        <th scope="cols">이메일</th>
                        <th scope="cols">연락처</th>
                        <th scope="cols">주소</th>
                        <th scope="cols">등록일</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($members as $member)
                    <tr>
                        <td>{{ $loop->index + 1 }}</th>
                        <td>{{ $member->userid }}</th>
                        <td>{{ $member->name }}</th>
                        <td>{{ $member->email }}</th>
                        <td>{{ $member->phone }}</th>
                        <td>{{ $member->address }}</th>
                        <td>{{ $member->created_at }}</th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <!-- table -->
@stop
<!-- 푸터에는 layouts/footer.blade.php의 내용을 가져온다. -->
@section('footer')
    @include('layouts.footer') 
@stop
<!-- 페이지에 사용되는 js를 임폴트 한다. -->
@section('import_js') 
    <!--script src="/js/common_menu.js"></script-->
@stop