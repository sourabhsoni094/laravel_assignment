<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>User Registration</h1>
    <form id="userForm" enctype="multipart/form-data">
    {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description"></textarea>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select class="form-control" name="role_id" id="role_id" required>
                @foreach($roles as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h2 class="mt-5">User List</h2>
    <table class="table table-bordered" id="userTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Description</th>
                <th>Role</th>
                <th>Profile Image</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function () {
        $('#userForm').on('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: '{{url("/users")}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#userTable tbody').append(`
                        <tr>
                            <td>${data.name}</td>
                            <td>${data.email}</td>
                            <td>${data.phone}</td>
                            <td>${data.description}</td>
                            <td>${data.role.name}</td>
                            <td><img src="{{url('')}}/storage/${data.image}" alt="Profile Image" width="50"></td>
                        </tr>
                    `);
                    $('#userForm')[0].reset(); // Reset the form
                },
                error: function (xhr) {
                    // Handle validation errors
                    const errors = xhr.responseJSON;
                    console.log(errors);
                }
            });
        });

        // Load users into the table
        $.get('{{url("/getusers")}}', function (users) {
            users.forEach(user => {
                $('#userTable tbody').append(`
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.phone}</td>
                        <td>${user.description}</td>
                        <td>${user.role.name}</td>
                        <td><img src="{{url('')}}/storage/${user.image}" alt="Profile Image" width="50"></td>
                    </tr>
                `);
            });
        });
    });
</script>

</body>
</html>
