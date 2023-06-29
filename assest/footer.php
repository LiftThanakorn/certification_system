<style>
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .content {
    flex: 1;
  }

  .sticky-footer {
    width: 100%;
    padding: 1rem;
    background-color: white;
    position: sticky;
    bottom: 0;
  }
</style>

<body>
  <div class="content">
    <!-- เนื้อหาหลักของหน้าเว็บไซต์ -->
  </div>

  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; PersonnelRERU <?php echo date("Y"); ?></span>
      </div>
    </div>
  </footer>
</body>


<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">แน่ใจว่าจะออกจากระบบ ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        คลิกที่ปุ่ม "Logout" เพื่อออกจากระบบ
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">
          Cancel
        </button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
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

<!-- Page level plugins -->
<link href="vendor/datatables/datatables.min.css" rel="stylesheet" />
<script src="vendor/datatables/datatables.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<!-- SweetAlert2 -->
<script src="vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="vendor/sweetalert2/dist/sweetalert2.min.css">
<script src="vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script>

window.onload = function() {
  var pages = document.getElementsByClassName('fade-in-down');
  for (var i = 0; i < pages.length; i++) {
    pages[i].classList.add('active');
  }
};

function toggleClicked() {
  var icon = document.getElementById('eye-icon');
  var isClicked = icon.dataset.clicked;

  if (isClicked === 'true') {
    icon.dataset.clicked = 'false';
    icon.className = 'fas fa-eye-slash';
  } else {
    icon.dataset.clicked = 'true';
    icon.className = 'fas fa-eye';
  }
}


</script>