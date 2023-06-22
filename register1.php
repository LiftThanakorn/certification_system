<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST">
                                <div class="mb-3">
                                    <label for="idCardNumber" class="form-label">ID Card Number:</label>
                                    <input type="text" class="form-control" id="idCardNumber" name="idCardNumber" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nameTitle" class="form-label">Name Title:</label>
                                    <select class="form-select" id="nameTitle" name="nameTitle" required>
                                        <option value="นาย">นาย</option>
                                        <option value="นางสาว">นางสาว</option>
                                        <option value="นาง">นาง</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fname" class="form-label">First Name:</label>
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lname" class="form-label">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position:</label>
                                    <input type="text" class="form-control" id="position" name="position" required>
                                </div>
                                <div class="mb-3">
                                    <label for="affiliation" class="form-label">Affiliation:</label>
                                    <input type="text" class="form-control" id="affiliation" name="affiliation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="employmentContract" class="form-label">Employment Contract:</label>
                                    <input type="text" class="form-control" id="employmentContract" name="employmentContract" required>
                                </div>
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date:</label>
                                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                                </div>
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary:</label>
                                    <input type="text" class="form-control" id="salary" name="salary" required>
                                </div>
                                <div class="mb-3">
                                    <label for="otherIncome" class="form-label">Other Income:</label>
                                    <input type="text" class="form-control" id="otherIncome" name="otherIncome" required>
                                </div>
                                <div class="mb-3">
                                    <label for="maritalStatus" class="form-label">Marital Status:</label>
                                    <select class="form-select" id="maritalStatus" name="maritalStatus" required>
                                        <option value="โสด">โสด</option>
                                        <option value="สมรส">สมรส</option>
                                        <option value="หม้าย">หม้าย</option>
                                        <option value="หย่า">หย่า</option>
                                        <option value="แยกกันอยู่">แยกกันอยู่</option>
                                    </select>
                                </div>
                    
                                <button type="submit" class="btn btn-primary" name="submit">Register</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>