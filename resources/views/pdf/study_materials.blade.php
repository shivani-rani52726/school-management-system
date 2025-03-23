<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Study Materials PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        img { max-width: 100px; max-height: 100px; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Study Materials Report</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Class</th>
                <th>Subject</th>
                <th>Due Date</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materials as $material)
                <tr>
                    <td>{{ $material->title }}</td>
                    <td>{{ $material->material_type }}</td>
                    <td>{{ $material->class_name }}</td>
                    <td>{{ $material->subject_name }}</td>
                    <td>{{ $material->due_date ?? 'N/A' }}</td>
                    <td>
                        @php
                            $ext = pathinfo($material->file_path, PATHINFO_EXTENSION);
                        @endphp
                    
                        @if(in_array($ext, ['png', 'jpg', 'pdf', 'jpeg']))
                            <img src="{{ Storage::url($material->file_path) }}" alt="Uploaded Image">
                        @else
                            <a href="{{ Storage::url($material->file_path) }}" target="_blank">View File</a>
                        @endif
                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
