<table>
    <tr>
        <th>Title</th>
        <th>Project</th>
        <th>Status</th>
        <th>Assigned Users</th>
        <th>Priority</th>
        <th>Due Date</th>
        <th>Actions</th>
    </tr>

    @forelse($issues as $issue)
        <tr>
            <td>{{ $issue->title }}</td>
            <td>{{ $issue->project->name }}</td>
            <td>{{ ucfirst(str_replace('_', ' ', $issue->status)) }}</td>

            <td>
                @forelse($issue->users as $user)
                    <span>{{ $user->name }}</span>@if(!$loop->last), @endif
                @empty
                    <span style="color:#6b7280;">No users</span>
                @endforelse
            </td>

            <td>{{ ucfirst($issue->priority) }}</td>
            <td>{{ $issue->due_date }}</td>

            <td>
                <div class="actions">
                    <a href="{{ route('issues.show', $issue) }}" class="btn-light action-btn">View</a>
                    <a href="{{ route('issues.edit', $issue) }}" class="btn-light action-btn">Edit</a>

                    <form action="{{ route('issues.destroy', $issue) }}" method="POST"
                          onsubmit="return confirm('Delete this issue?')">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-danger action-btn">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" style="text-align:center;padding:20px;">
                No issues found.
            </td>
        </tr>
    @endforelse
</table>