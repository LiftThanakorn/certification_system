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
            <form id="registrationForm" enctype="multipart/form-data">
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
                    <option value="">โปรดเลือก</option>
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
                  <label for="affiliation" class="form-label">สังกัด:</label>
                  <select class="form-select" id="affiliation" name="affiliation" required>
                    <option value="">โปรดเลือก</option>
                    <optgroup label="กองกลาง">
                      <option value="ฝ่ายธุรการ">ฝ่ายธุรการ</option>
                      <option value="ฝ่ายการเจ้าหน้าที่">ฝ่ายการเจ้าหน้าที่</option>
                      <option value="ฝ่ายนิติการ">ฝ่ายนิติการ</option>
                      <option value="ฝ่ายเลขานุการ">ฝ่ายเลขานุการ</option>
                      <option value="ฝ่ายการเงิน">ฝ่ายการเงิน</option>
                      <option value="ฝ่ายประกันคุณภาพ">ฝ่ายประกันคุณภาพ</option>
                      <option value="ฝ่ายกิจการพิเศษ">ฝ่ายกิจการพิเศษ</option>
                      <option value="ฝ่ายประชาสัมพันธ์">ฝ่ายประชาสัมพันธ์</option>
                      <option value="ฝ่ายวิเทศสัมพันธ์และการศึกษานานาชาติ">ฝ่ายวิเทศสัมพันธ์และการศึกษานานาชาติ</option>
                      <option value="ศูนย์นวัตกรรมและสื่อ">ศูนย์นวัตกรรมและสื่อ</option>
                      <option value="ศูนย์วิทยบริการ">ศูนย์วิทยบริการ</option>
                      <option value="ศูนย์คอมพิวเตอร์">ศูนย์คอมพิวเตอร์</option>
                      <option value="สำนักงานเลขานุการสภามหาวิทยาลัย">สำนักงานเลขานุการสภามหาวิทยาลัย</option>
                    </optgroup>
                    <optgroup label="กองนโยบายและแผน">
                      <option value="ฝ่ายแผนงานและนโยบาย">ฝ่ายแผนงานและนโยบาย</option>
                      <option value="ฝ่ายพัสดุ">ฝ่ายพัสดุ</option>
                      <option value="ฝ่ายสวัสดิการ">ฝ่ายสวัสดิการ</option>
                      <option value="ฝ่ายยานพาหนะ">ฝ่ายยานพาหนะ</option>
                      <option value="ฝ่ายอาคารและสถานที่">ฝ่ายอาคารและสถานที่</option>
                      <option value="ฝ่ายก่อสร้างและภูมิทัศน์">ฝ่ายก่อสร้างและภูมิทัศน์</option>
                      <option value="ฝ่ายสาธารณูปโภค">ฝ่ายสาธารณูปโภค</option>
                    </optgroup>
                    <optgroup label="คณะ">
                      <option value="คณะศิลปศาสตร์และวิทยาศาสตร์">คณะศิลปศาสตร์และวิทยาศาสตร์</option>
                      <option value="คณะครุศาสตร์">คณะครุศาสตร์</option>
                      <option value="คณะบริหารธุรกิจและการบัญชี">คณะบริหารธุรกิจและการบัญชี</option>
                      <option value="คณะนิติรัฐศาสตร์">คณะนิติรัฐศาสตร์</option>
                      <option value="คณะเทคโนโลยีสารสนเทศ">คณะเทคโนโลยีสารสนเทศ</option>
                      <option value="คณะพยาบาลศาสตร์">คณะพยาบาลศาสตร์</option>
                    </optgroup>
                    <optgroup label="หน่วยงานอื่นๆ">
                      <option value="โครงการจัดตั้งคณะแพทยศาสตร์">โครงการจัดตั้งคณะแพทยศาสตร์</option>
                      <option value="บัณฑิตวิทยาลัย">บัณฑิตวิทยาลัย</option>
                      <option value="สำนักวิชาการและประมวลผล">สำนักวิชาการและประมวลผล</option>
                      <option value="สำนักกิจการนักศึกษา">สำนักกิจการนักศึกษา</option>
                      <option value="สถาบันวิจัยและพัฒนา">สถาบันวิจัยและพัฒนา</option>
                      <option value="หน่วยตรวจสอบภายใน">หน่วยตรวจสอบภายใน</option>
                    </optgroup>
                  </select>
                </div>
                <div class="col">
                  <label for="employmentContract" class="form-label">ประเภทสัญญาจ้าง</label>
                  <select class="form-select" id="employmentContract" required>
                    <option value="">โปรดเลือก</option>
                    <option value="พนักงานมหาวิทยาลัย">พนักงานมหาวิทยาลัย</option>
                    <option value="จ้างประจำ">จ้างประจำ</option>
                    <option value="จ้างชั่วคราว">จ้างชั่วคราว</option>
                    <option value="ข้าราชการ">ข้าราชการ</option>
                    <option value="พนักงานราชการ">พนักงานราชการ</option>
                    <option value="พนักงานรัฐวิสาหกิจ">พนักงานรัฐวิสาหกิจ</option>
                  </select>
                </div>
                <div class="col">
                  <label for="staffType" class="form-label">ระดับประเภทตำแหน่ง</label>
                  <select class="form-select" id="staffType" required>
                    <option value="">โปรดเลือก</option>
                    <option value="สายวิชาการ">สายวิชาการ</option>
                    <option value="สายสนับสนุน">สายสนับสนุน</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="startDate" class="form-label">วันเริ่มงาน</label>
                  <input type="text" class="form-control" id="startDate" pattern="\d{2}-\d{2}-\d{4}" required>
                  <small>รูปแบบ: 00-00-0000</small>
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
                    <option value="">โปรดเลือก</option>
                    <option value="โสด">โสด</option>
                    <option value="สมรส">สมรส</option>
                    <option value="หม้าย">หม้าย</option>
                    <option value="หย่า">หย่า</option>
                    <option value="แยกกันอยู่">แยกกันอยู่</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col">
                  <label for="profileImage" class="form-label">รูปภาพโปรไฟล์</label>
                  <input type="file" class="form-control" id="profileImage" accept="image/*" required>
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
      var staffType = $('#staffType').val(); // เพิ่มการรับค่า staffType
      var profileImage = $('#profileImage')[0].files[0]; // เพิ่มการรับค่ารูปภาพ

      // สร้าง FormData เพื่อส่งข้อมูลผ่าน AJAX
      var formData = new FormData();
      formData.append('idCardNumber', idCardNumber);
      formData.append('password', password);
      formData.append('nameTitle', nameTitle);
      formData.append('fname', fname);
      formData.append('lname', lname);
      formData.append('position', position);
      formData.append('affiliation', affiliation);
      formData.append('employmentContract', employmentContract);
      formData.append('startDate', startDate);
      formData.append('salary', salary);
      formData.append('otherIncome', otherIncome);
      formData.append('maritalStatus', maritalStatus);
      formData.append('staffType', staffType);
      formData.append('profileImage', profileImage); // เพิ่มข้อมูลรูปภาพใน FormData

      // ส่งข้อมูลไปยังไฟล์ process_register.php โดยใช้ AJAX
      $.ajax({
        url: 'process_register.php',
        method: 'POST',
        data: formData, // ใช้ FormData เป็นข้อมูลที่จะส่ง
        dataType: 'json',
        contentType: false, // ไม่ตั้งค่า contentType เป็นค่าเริ่มต้น
        processData: false, // ไม่ต้องประมวลผลข้อมูลที่ส่ง
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

<script>
  var startDateInput = document.getElementById("startDate");

  startDateInput.addEventListener("input", function() {
    var inputValue = startDateInput.value;
    var isValidFormat = /^\d{2}-\d{2}-\d{4}$/.test(inputValue);

    if (!isValidFormat) {
      startDateInput.setCustomValidity("กรุณาใส่รูปแบบวันที่ให้ถูกต้อง (รูปแบบ: 00-00-0000)");
    } else {
      startDateInput.setCustomValidity("");
    }
  });
</script>