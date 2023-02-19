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
                <form name="search_form" action="" method="">
                    <table class="search">
                        <tr>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">등록일</li>
                                        <li class="item"><input class="form-input datepicker max" type="text" name="created_start"></li>
                                        <span>~</span>
                                        <li class="item"><input class="form-input datepicker max" type="text" name="created_end"></li>
                                    </ul>
                                </label>
                            </td>
                            <td>
                                <div class="btn-group" id="period_group">
                                    <button data-id="all">전체</button>
                                    <button data-id="lastweek">저번주</button>
                                    <button data-id="two_days_ago">이틀 전</button>
                                    <button data-id="yesterday">어제</button>
                                    <button data-id="today">오늘</button>
                                    <button data-id="thisweek">이번주</button>
                                </div>
                            </td>
                        </tr>
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
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">이메일</li>
                                        <li class="item"><input class="form-input" type="email" name="email" ></li>
                                    </ul>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">휴대폰번호</li>
                                        <li class="item"><input class="form-input" type="text" name="phone"></li>
                                    </ul>
                                </label>
                            </td>
                            <td class="form-label">
                                <label>
                                    <ul class="area">
                                        <li class="title">주소</li>
                                        <li class="item"><input class="form-input" type="text" name="address"></li>
                                    </ul>
                                </label>
                            </td>
                        </tr>
                    </table>
                </form>
                <div class="search-right">
                    <button class="reset button btn-light">초기화</button>
                    <button class="search button btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        검색
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- search -->
    <!-- table -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="text-primary">회원관리 리스트</h6>
        </div>
        <div class="card-body responsive table-wrapper dataTables_wrapper">
            <div id="member_list"></div>
        </div>
        
    </div>
     <!-- table -->




<!-- Modal -->

<div class="wrap"> <a href="#" id="modal_click" class="btn btn-big">Modal!</a></div>

@stop
<!-- 푸터에는 layouts/footer.blade.php의 내용을 가져온다. -->
@section('footer')
    @include('layouts.footer') 
@stop
<!-- 페이지에 사용되는 js를 임폴트 한다. -->
@section('import_js') 
<script>

    $("#modal_click").on("click", function() {
        let popup = new modalPop({width: 250}, {'등록':'register'});
        popup.open('제목목', '/member/register', `{{ csrf_token() }}`);
    });

    let form = {
        init : function () {
            let _self = this;
            _self.list();
            _self.settingPeriod();
            $("button.search").on("click", function() {
                _self.list();
            });
        },
        settingPeriod : function () {
            // 기본 세팅된 기간 값
            let defaultPeriod = setDate.defaultDate();
            $("input[name=created_start]").val(defaultPeriod[0]);
            $("input[name=created_end]").val(defaultPeriod[1]);
            // 기간 선택
            $("#period_group button").on("click", function(e) {
                e.preventDefault();
                let period  = setDate.period(e);
                $("input[name=created_start]").val(period[0]);
                $("input[name=created_end]").val(period[1]);
            });
        },
        list : function () {
            $.ajax({
                headers     : { 'X-CSRF-TOKEN': `{{ csrf_token() }}` },
                url         : '/member/list',
                type        : 'POST',
                data        : commonForm.thisForm.serialize(),
                contentType : 'application/x-www-form-urlencoded; charset=UTF-8',
                dataType    : 'html',
                success     : function(html) {
                   $("#member_list").html(html);
                },
                error       : function(request, status, error) {
                    console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
                }
            })
        } // search end
    } // form end

    $(function() {
        form.init();
    })
</script>
@stop
