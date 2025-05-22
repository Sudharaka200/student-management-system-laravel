<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #F5F5F5">
    <div class="container mt-5">
            <h1>Student Managemenet System</h1>
        </div>
    <div class="mt-5">
        <div class="container" style="background-color: #FFFF; padding: 60px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
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


        <div class="">
            <h3 class="">Add New Student</h3>
        </div>
        <form action="{{ route('student.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                    placeholder="Enter name">
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                    placeholder="Enter email">
            </div>

            <div class="form-group mb-4">
                <label for="course">Course</label>
                <select name="course" class="form-control" id="course">
                    <option value="">Select Course </option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Science">Science</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>

    {{-- Table --}}
    <div>
        <div class="container mt-5" style="background-color: #FFFF; padding: 60px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        <div class="mt-5">
            <h3 class="mt-5">Student Details</h3>
        </div>
        <div>
            <div class="row mb-5">
                <div class="col">
                </div>
                <div class="col">
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <form action="{{ route('students.index') }}" method="GET" class="d-flex w-100">
                            <input type="text" name="search" class="form-control rounded"
                                placeholder="Search by ID, name or email" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-primary ms-2">Search</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Course</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <th scope="row">{{ $student->id }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('students.edit', $student->id) }}">Edit</a>

                            <form action="{{ route('students.delete', $student->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

</body>

</html>