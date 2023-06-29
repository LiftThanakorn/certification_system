<?php
header("Cache-Control: private, no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap');
  </style>
  <style>
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url("images/bgregister.jpg");
      background-position: center;
      font-family: 'Prompt', sans-serif;
    }

    .card {
      margin: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
    }

    .card-header {
      display: flex;
      justify-content: center;
      /* เพิ่ม CSS นี้เพื่อจัดให้โลโก้และข้อความตรงกลาง */
      align-items: center;
      background-color: #f8f9fa;
      border-bottom: none;
      padding: 10px;
    }

    .card-logo {
      width: 50px;
      /* ปรับขนาดโลโก้ตามต้องการ */
      height: 50px;
      /* ปรับขนาดโลโก้ตามต้องการ */
      margin-right: 10px;
    }

    .card-title {
      margin-bottom: 0;
    }

    .fade-in-down {
        animation: fadeInDownAnimation 0.8s ease-in;
        animation-fill-mode: forwards;
        opacity: 0;
        transform: translateY(-50px);
    }

    @keyframes fadeInDownAnimation {
        0% {
            opacity: 0;
            transform: translateY(-50px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }


  </style>
  <title>ระบบขอใบรับรอง CertificateSystemRERU</title>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-12">
        <div class="card fade-in-down">
          <div class="card-header">
            <img src="images/stamp.png" alt="Logo" class="card-logo">
            <h4 class="card-title">ลงทะเบียนเข้าใช้งานระบบขอใบรับรอง CertificateSystemRERU</h4>
          </div>
          <div class="card-body">
            <form id="registrationForm">
              <div class="row mb-3">
                <div class="col">
                  <label for="idCardNumber" class="form-label">เลขบัตรประชาชน</label>
                  <input type="text" class="form-control" id="idCardNumber" required>
                </div>
                <div class="col">
                  <label for="password" class="form-label">รหัสผ่าน</label>
                  <input type="password" class="form-control" id="password" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="nameTitle" class="form-label">คำนำหน้าชื่อ</label>
                  <select class="form-select name-title-select" id="nameTitle" required>
                    <option value="นาย">นาย</option>
                    <option value="นางสาว">นางสาว</option>
                    <option value="นาง">นาง</option>
                  </select>
                </div>
                <div class="col">
                  <label for="fname" class="form-label">ชื่อ</label>
                  <input type="text" class="form-control" id="fname" required>
                </div>
                <div class="col">
                  <label for="lname" class="form-label">นามสกุล</label>
                  <input type="text" class="form-control" id="lname" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <label for="position" class="form-label">ตำแหน่ง</label>
                  <input type="text" class="form-control" id="position" required>
                </div>
                <div class="col">
                  <label for="affiliation" class="form-label">สังกัด</label>
                  <input type="text" class="form-control" id="affiliation" required>
                </div>
                <div class="col">
                  <label for="employmentContract" class="form-label">สัญญาจ้าง</label>
                  <input type="text" class="form-control" id="employmentContract" required>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="startDate" class="form-label">วันเริ่มงาน(ค.ศ.)</label>
                  <input type="date" class="form-control" id="startDate" required>
                </div>
                <div class="col">
                  <label for="salary" class="form-label">เงินเดือน</label>
                  <input type="text" class="form-control" id="salary" required>
                </div>
                <div class="col">
                  <label for="otherIncome" class="form-label">เงินรายได้อื่น</label>
                  <input type="text" class="form-control" id="otherIncome" required>
                </div>
                <div class="col">
                  <label for="maritalStatus" class="form-label">สถานะภาพ</label>
                  <select class="form-select" id="maritalStatus" required>
                    <option value="โสด">โสด</option>
                    <option value="สมรส">สมรส</option>
                    <option value="หม้าย">หม้าย</option>
                    <option value="หย่า">หย่า</option>
                    <option value="แยกกันอยู่">แยกกันอยู่</option>
                  </select>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" id="submitButton">ลงทะเบียนเข้าใช้งาน</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.min.js"></script>
<!-- สคริปต์ JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // รองรับการคลิกปุ่ม Submit
    $('#registrationForm').on('submit', function(event) {
      event.preventDefault(); // ป้องกันการรีเฟรชหน้าหลังจากกด Submit

      // รับข้อมูลจากฟอร์มลงทะเบียน
      var idCardNumber = $('#idCardNumber').val();
      var password = $('#password').val();
      var nameTitle = $('#nameTitle').val();
      var fname = $('#fname').val();
      var lname = $('#lname').val();
      var position = $('#position').val();
      var affiliation = $('#affiliation').val();
      var employmentContract = $('#employmentContract').val();
      var startDate = $('#startDate').val();
      var salary = $('#salary').val();
      var otherIncome = $('#otherIncome').val();
      var maritalStatus = $('#maritalStatus').val();

      // ส่งข้อมูลไปยังไฟล์ process_register.php โดยใช้ AJAX
      $.ajax({
        url: 'process_register.php',
        method: 'POST',
        data: {
          idCardNumber: idCardNumber,
          password: password,
          nameTitle: nameTitle,
          fname: fname,
          lname: lname,
          position: position,
          affiliation: affiliation,
          employmentContract: employmentContract,
          startDate: startDate,
          salary: salary,
          otherIncome: otherIncome,
          maritalStatus: maritalStatus
        },
        dataType: 'json',
        success: function(response) {
          if (response.redirect) {
            // แสดงข้อความลงทะเบียนสำเร็จและเปลี่ยนเส้นทางไปยังหน้า login.php
            Swal.fire({
              title: response.title,
              text: response.message,
              icon: response.icon
            }).then(function() {
              window.location.href = response.redirect;
            });
          } else {
            // แสดงข้อความผิดพลาดในกรณีที่รหัสบัตรประชาชนซ้ำกัน
            Swal.fire({
              title: response.title,
              text: response.message,
              icon: response.icon
            });
          }
        },
        error: function() {
          // แสดงข้อความเมื่อเกิดข้อผิดพลาดในการส่งข้อมูล
          Swal.fire({
            title: 'เกิดข้อผิดพลาด',
            text: 'ไม่สามารถส่งข้อมูลได้',
            icon: 'error'
          });
        }
      });
    });
  });
</script>
