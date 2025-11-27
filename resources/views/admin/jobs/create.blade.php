<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Job</title>
</head>
<body>
<h1>Tambah Job</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.jobs.store') }}">
    @csrf

    <div>
        <label>Title</label><br>
        <input type="text" name="title" value="{{ old('title') }}" required>
    </div>

    <div>
        <label>Company</label><br>
        <input type="text" name="company" value="{{ old('company') }}">
    </div>

    <div>
        <label>Location</label><br>
        <input type="text" name="location" value="{{ old('location') }}">
    </div>

    <div>
        <label>Job Type</label><br>
        <select name="job_type" required>
            <option value="full_time"   @selected(old('job_type') === 'full_time')>Full Time</option>
            <option value="part_time"   @selected(old('job_type') === 'part_time')>Part Time</option>
            <option value="internship"  @selected(old('job_type') === 'internship' || old('job_type') === null)>Internship</option>
            <option value="freelance"   @selected(old('job_type') === 'freelance')>Freelance</option>
        </select>
    </div>

    <div>
        <label>Level</label><br>
        <select name="level" required>
            <option value="junior" @selected(old('level') === 'junior' || old('level') === null)>Junior</option>
            <option value="mid"    @selected(old('level') === 'mid')>Mid</option>
            <option value="senior" @selected(old('level') === 'senior')>Senior</option>
        </select>
    </div>

    <div>
        <label>Description</label><br>
        <textarea name="description" rows="4" required>{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Requirements</label><br>
        <textarea name="requirements" rows="4">{{ old('requirements') }}</textarea>
    </div>

    <div>
        <label>Salary Min</label><br>
        <input type="number" name="salary_min" value="{{ old('salary_min') }}">
    </div>

    <div>
        <label>Salary Max</label><br>
        <input type="number" name="salary_max" value="{{ old('salary_max') }}">
    </div>

    <div>
        <label>Deadline</label><br>
        <input type="date" name="deadline" value="{{ old('deadline') }}">
    </div>

    <div>
        <label>Status</label><br>
        <select name="status" required>
            <option value="active" @selected(old('status') === 'active' || old('status') === null)>Active</option>
            <option value="closed" @selected(old('status') === 'closed')>Closed</option>
        </select>
    </div>

    <button type="submit">Simpan</button>
</form>

<p><a href="{{ route('admin.jobs.index') }}">Kembali</a></p>
</body>
</html>
