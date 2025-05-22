<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #F5F5F5">
    <div class="container mt-5" style="background-color: #FFFF; padding: 60px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div>
                <h3 class="mt-5 mb-5">Update Student Details</h3>
            </div>
        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Spoofs PUT request for update --}}

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name', $student->name) }}" placeholder="Enter name">
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email"
                    value="{{ old('email', $student->email) }}" placeholder="Enter email">
            </div>

            <div class="form-group mb-4">
                <label for="course">Course</label>
                <select name="course" class="form-control" id="course">
                    <option value="">Select Course</option>
                    <option value="Mathematics" {{ old('course', $student->course) == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                    <option value="Information Technology" {{ old('course', $student->course) == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                    <option value="Science" {{ old('course', $student->course) == 'Science' ? 'selected' : '' }}>Science</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
