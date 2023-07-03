<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet" />
<link href="/vendor/fontawesome-free/css/fontawesome.css" rel="stylesheet" />
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />

<link href="vendor/fontawesome-free/css/fontawesome.min.css" rel="stylesheet" />

<style>
    @import url('https://fonts.googleapis.com/css2?family=Prompt:wght@500&display=swap');

    body {
        font-family: 'Prompt', sans-serif;
    }

    #btn-delete {
        font-size: 14px;
        padding: 10px 15px;
    }

    .badge {
        font-size: 14px;
        padding: 10px 15px;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);
    }


    a#request {
        text-align: right;
    }

    .cursor-pointer {
        cursor: pointer;
    }


    .custom-swal-content {
        font-size: 16px;
    }



    /* CSS สำหรับป้ายกำกับหนังสือ */
    #certificate-salary {
        background-color: #0B409C;
        color: white;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);
    }

    #certificate-work {
        background-color: #F86F03;
        color: white;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);
    }

    #certificate-status {
        background-color: #F35588;
        color: white;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);
    }

    #certificate-other {
        background-color: #71A95A;
        color: white;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 1);
    }

    #respon {
        color: red;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        /* เพิ่มเงาด้วยคุณสมบัติ text-shadow */
    }
    .fade-in-down {
        animation: fadeInDownAnimation 1s ease-in;
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

    .card {
        margin-bottom: 20px;
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


    .card-body {
        padding-bottom: 20px;
    }

    .card-footer {
        margin-top: 20px;
        padding: 10px;
    }
</style>