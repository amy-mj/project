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
            <h6 class="text-primary">회원관리 검색</h6>
        </div>
        <div class="card-body">
            <div class="responsive">
                <form class="" action="" method="">
                    <table class="search">
                        <tr>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">아이디</li>
                                        <li class="item"><input class="form-input" type="text" name="userid"></li>
                                    </ul>
                                </label>
                            </td>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">이름</li>
                                        <li class="item"><input class="form-input" type="text" name="name"></li>
                                    </ul>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">이메일</li>
                                        <li class="item"><input class="form-input" type="email" name="email"></li>
                                    </ul>
                                </label>
                            </td>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">휴대폰번호</li>
                                        <li class="item"><input class="form-input" type="text" name="phone"></li>
                                    </ul>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="area">
                                    <li class="title">주소</li>
                                    <li class="item"><input class="form-input" type="text" name="address"></li>
                                </ul>
                            </td>
                            <td>
                                <div class="search-right">
                                    <button class="primary-default-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                        검색
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
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