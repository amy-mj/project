<div class="responsive users-table table-wrapper">
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
            <td>{{ $loop->index + 1 }}</td>
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