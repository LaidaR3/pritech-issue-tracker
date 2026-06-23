<label>Name</label><br>
<input type="text" name="name" value="{{ old('name', $project->name ?? '') }}">
@error('name')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>

<label>Description</label><br>
<textarea name="description">{{ old('description', $project->description ?? '') }}</textarea>
@error('description')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>

<label>Start Date</label><br>
<input type="date" name="start_date" value="{{ old('start_date', $project->start_date ?? '') }}">
@error('start_date')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>

<label>Deadline</label><br>
<input type="date" name="deadline" value="{{ old('deadline', $project->deadline ?? '') }}">
@error('deadline')
    <p style="color:red">{{ $message }}</p>
@enderror

<br><br>