<label>Name</label><br>
<input type="text" name="name" value="{{ old('name', $project->name ?? '') }}">
@error('name') <p>{{ $message }}</p> @enderror

<br><br>

<label>Description</label><br>
<textarea name="description">{{ old('description', $project->description ?? '') }}</textarea>
@error('description') <p>{{ $message }}</p> @enderror

<br><br>

<label>Start Date</label><br>
<input type="date" name="start_date" value="{{ old('start_date', $project->start_date ?? '') }}">

<br><br>

<label>Deadline</label><br>
<input type="date" name="deadline" value="{{ old('deadline', $project->deadline ?? '') }}">
@error('deadline') <p>{{ $message }}</p> @enderror

<br><br>