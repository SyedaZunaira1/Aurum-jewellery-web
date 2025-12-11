<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Aurum Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-gold: #d4af37;
            --deep-navy: #1a1a2e;
        }

        body {
            background-color: #f4f6f9;
            font-family: 'Poppins', sans-serif;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            max-width: 600px;
            margin: 50px auto;
        }

        .card-header {
            background: var(--deep-navy);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .card-header h3 {
            font-family: 'Playfair Display', serif;
            margin: 0;
            color: var(--primary-gold);
        }

        .card-body {
            padding: 30px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-update {
            background: linear-gradient(135deg, var(--deep-navy), #16213e);
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            margin-top: 10px;
        }

        .btn-update:hover {
            opacity: 0.9;
            color: white;
        }

        .btn-back {
            color: #666;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn-back:hover {
            color: var(--deep-navy);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.dashboard') }}" class="btn-back mt-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
                </a>

                <div class="profile-card">
                    <div class="card-header">
                        <h3><i class="fas fa-user-edit me-2"></i>Manage Profile</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $admin->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $admin->email) }}" required>
                            </div>

                            <hr class="my-4">
                            <p class="text-muted small mb-3">Leave password fields empty if you don't want to change it.
                            </p>

                            <div class="mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-update">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>