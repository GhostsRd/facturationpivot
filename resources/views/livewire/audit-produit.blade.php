<div class="container">
    <button class="btn" onclick="window.print()">Print</button>
     <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Mail</th>
                <th scope="col">Action</th>
                <th scope="col">IP</th>
                <th scope="col">User Agent</th>
                <th scope="col">Referer</th>
                <th scope="col">Timezone</th>
                <th scope="col">Created At</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($audits as $audit)
                <tr>
                    <th scope="row">{{ $audit->id }}</th>
                    <td>{{ $audit->user_name }}</td>
                    <td>{{ $audit->user_mail }}</td>
                    <td>{{ $audit->action_type }}</td>
                    <td>{{ $audit->ip }}</td>
                    <td>{{ $audit->user_agent }}</td>
                    <td>{{ $audit->referer }}</td>
                    <td>{{ $audit->tz }}</td>
                    <td>{{ $audit->created_at }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

