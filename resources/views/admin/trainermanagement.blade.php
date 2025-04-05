@extends('admin.layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        /* Dashboard Layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 20px;
            background: #f9f9f9;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(135deg, #2c1d56, #4a2a7a);
            padding: 15px 20px;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .user-info span {
            font-size: 16px;
            font-weight: 600;
        }

        /* Table Styling */
        .table-responsive {
            overflow-x: auto;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table thead tr {
            background: linear-gradient(135deg, #2c1d56, #4a2a7a);
            color: #fff;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
        }

        .table tbody tr {
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #f9f9f9;
        }

        .table tbody tr:last-of-type {
            border-bottom: 2px solid #2c1d56;
        }

        .table tbody tr:hover {
            background-color: #ff9800;
            color: #fff;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            font-size: 0.9em;
            border: none;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .btn-edit {
            background-color: #FFA500;
        }

        .btn-delete {
            background-color: #DC3545;
        }

        .btn:hover {
            opacity: 0.8;
        }

        /* Card Styling */
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #2c1d56, #4a2a7a);
            color: #fff;
            padding: 15px 20px;
            border-bottom: 2px solid #ff9800;
        }

        .card-header h4 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- Main Content -->
        <main class="content">
            <header class="header">
                <h2>Welcome To Admin Dashboard</h2>
                <div class="user-info">
                    <span>Joo Muri</span>
                    <img src="https://i.pravatar.cc/41" alt="User">
                </div>
            </header>

            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Trainer List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="studentsTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Registered At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($students as $index => $student)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->phone ?? 'N/A' }}</td>
                                                <td>{{ date('d M Y', strtotime($student->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.student.edit', $student->id) }}" class="btn btn-edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <form action="{{ route('admin.student.delete', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-delete">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="6" class="text-center">No students found.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable({
                "paging": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "responsive": true,
                "autoWidth": false,
                "dom": '<"top"f>rt<"bottom"lip><"clear">'
            });

            // Row hover effect
            $('tbody tr').hover(function() {
                $(this).css('background', '#ff9800').css('color', '#fff');
            }, function() {
                $(this).css('background', '').css('color', '');
            });
        });
    </script>
</body>
</html>