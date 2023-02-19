<div class="users-table" >
    <table class="table hover">
    <colgroup>
        <col width="5%">
        <col width="10%">
        <col width="10%">
        <col width="15%">
        <col width="10%">
        <col>
        <col width="15%">
    </colgroup>
    <thead>
        <tr>
        <th>번호</th>
        <th>아이디</th>
        <th>이름</th>
        <th>이메일</th>
        <th>연락처</th>
        <th>주소</th>
        <th>등록일</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
        <tr>
            <td>{{ $loop->index + 1 }} {{$member->id}}</td>
            <td>{{ $member->userid }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->email }}</td>
            <td>{{ $member->phone }}</td>
            <td>{{ $member->address }}</td>
            <td>{{ $member->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
</div>

<!-- pagination -->
<div class="row">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info records-total" role="status" aria-live="polite">총 <span id="records_total"></span> 건</div>
    </div>
    <div class="col-sm-12 col-md-7 page-blocks">
        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
            <ul class="pagination" id="pagination">
                <li class="paginate_button page-item first {{ ($paging['page'] <= 1) ? 'disabled' : '' }}" id="dataTable_first">
                    <a href="#" aria-controls="dataTable" data-dt-idx="{{$paging['first']}}" tabindex="0" class="page-link">처음</a>
                </li>
                <li class="paginate_button page-item previous {{ ($paging['page'] <= 1) ? 'disabled' : '' }}" id="dataTable_previous">
                    <a href="#" aria-controls="dataTable" data-dt-idx="{{$paging['prev']}}" tabindex="0" class="page-link">이전</a>
                </li>
                @foreach ($paging['pageBlocks'] as $pageBlock)
                    <li class="paginate_button page-item {{ ($pageBlock === $paging['page']) ? 'active' : '' }}">
                        <a href="#" aria-controls="dataTable" data-dt-idx="{{$pageBlock}}" tabindex="0" class="page-link">{{$pageBlock}}</a>
                    </li>
                @endforeach
                <li class="paginate_button page-item next {{ ($paging['last'] <= $paging['page']) ? 'disabled' : '' }}" id="dataTable_next">
                    <a href="#" aria-controls="dataTable" data-dt-idx="{{$paging['next']}}" tabindex="0" class="page-link">다음</a>
                </li>
                <li class="paginate_button page-item last {{ ($paging['last'] <= $paging['page']) ? 'disabled' : '' }}" id="dataTable_last">
                    <a href="#" aria-controls="dataTable" data-dt-idx="{{$paging['last']}}" tabindex="0" class="page-link">마지막</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- pagination -->

<script>
    // 페이징
    $(function() {
        pageEvent.init();
    })
</script>