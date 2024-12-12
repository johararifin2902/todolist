<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">To-Do List</h1>
        
        <!-- Add Task Form -->
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="task_name">Nama Tugas</label>
                <input type="text" name="task_name" id="task_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="duration">Durasi (menit)</label>
                <input type="number" name="duration" id="duration" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deadline">Deadline</label>
                <input type="datetime-local" name="deadline" id="deadline" class="form-control">
            </div>
            <div class="form-group">
                <label for="priority">Prioras</label>
                <select name="priority" id="priority" class="form-control">
                    <option value="1">High</option>
                    <option value="2">Medium</option>
                    <option value="3">Low</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan Tugas</button>
        </form>

        <h2 class="mt-5">Daftar Tugas</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">Nama Tugas</th>
                    <th scope="col">Durasi (menit)</th>
                    <th scope="col">Prioritas</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->task_name }}</td>
                    <td>{{ $task->duration }} minutes</td>
                    <td>
                        @if($task->priority == 1) 
                            High
                        @elseif($task->priority == 2) 
                            Medium
                        @else 
                            Low
                        @endif
                    </td>
                    <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d H:i') : 'No deadline' }}</td>
                    <td>{{ ucfirst($task->status) }}</td>
                    <td>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JavaScript and Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
