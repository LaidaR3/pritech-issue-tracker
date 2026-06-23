<label>Project</label><br>

<select name="project_id">
    @foreach($projects as $project)
        <option value="{{ $project->id }}" @selected(old('project_id', $issue->project_id ?? '') == $project->id)>
            {{ $project->name }}
        </option>
    @endforeach
</select>

<br><br>

<label>Title</label><br>
<input type="text" name="title" value="{{ old('title', $issue->title ?? '') }}">

@error('title')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>

<label>Description</label><br>
<textarea name="description">{{ old('description', $issue->description ?? '') }}</textarea>

@error('description')
    <p style="color:red">{{ $message }}</p>
@enderror
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

<label>Tags</label><br>

@foreach($tags as $tag)
    <label>
        <input
            type="checkbox"
            name="tags[]"
            value="{{ $tag->id }}"
            @checked(in_array(
                $tag->id,
                old('tags', isset($issue) ? $issue->tags->pluck('id')->toArray() : [])
            ))
        >
        {{ $tag->name }}
    </label>
    <br>
@endforeach

<br>

<label>Due Date</label><br>
<input type="date" name="due_date" value="{{ old('due_date', $issue->due_date ?? '') }}">

@error('due_date')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>