<label>Project</label><br>

<select name="project_id">
    @foreach($projects as $project)
        <option
            value="{{ $project->id }}"
            @selected(old('project_id', $issue->project_id ?? '') == $project->id)
        >
            {{ $project->name }}
        </option>
    @endforeach
</select>

<br><br>

<label>Title</label><br>
<input
    type="text"
    name="title"
    value="{{ old('title', $issue->title ?? '') }}"
>

<br><br>

<label>Description</label><br>
<textarea name="description">{{ old('description', $issue->description ?? '') }}</textarea>

<br><br>

<label>Status</label><br>

<select name="status">
    <option value="open">Open</option>
    <option value="in_progress">In Progress</option>
    <option value="closed">Closed</option>
</select>

<br><br>

<label>Priority</label><br>

<select name="priority">
    <option value="low">Low</option>
    <option value="medium">Medium</option>
    <option value="high">High</option>
</select>

<br><br>

<label>Due Date</label><br>
<input
    type="date"
    name="due_date"
    value="{{ old('due_date', $issue->due_date ?? '') }}"
>

<br><br>