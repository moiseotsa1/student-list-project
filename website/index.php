<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .student-list {
            margin-top: 20px;
        }
        .student-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .student-item:nth-child(even) {
            background-color: #f9f9f9;
        }
        .error {
            color: #dc3545;
            padding: 10px;
            background-color: #f8d7da;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student List Application</h1>
        <button onclick="loadStudents()">List Students</button>
        
        <div id="studentList" class="student-list"></div>
    </div>

    <script>
        function loadStudents() {
            const studentList = document.getElementById('studentList');
            studentList.innerHTML = '<p>Loading...</p>';
            
            // Utiliser le nom du service Docker comme hostname
            const apiUrl = 'http://api:5000/pozos/api/v1.0/get_student_ages';
            
            // Les identifiants sont définis dans les variables d'environnement
            // et seront gérés par le serveur PHP
            fetch('proxy.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    displayStudents(data);
                })
                .catch(error => {
                    studentList.innerHTML = `<div class="error">Error: ${error.message}</div>`;
                    console.error('Error:', error);
                });
        }
        
        function displayStudents(data) {
            const studentList = document.getElementById('studentList');
            
            if (data.students && data.students.length > 0) {
                let html = '<h2>Student List</h2>';
                data.students.forEach(student => {
                    html += `
                        <div class="student-item">
                            <strong>Name:</strong> ${student.name}<br>
                            <strong>Age:</strong> ${student.age}
                        </div>
                    `;
                });
                studentList.innerHTML = html;
            } else {
                studentList.innerHTML = '<p>No students found</p>';
            }
        }
    </script>
</body>
</html>