<?php
require_once 'dbconnect.php';
require_once __DIR__ . '/vendor/autoload.php';

$defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf',
        ]
    ],
    'default_font' => 'sarabun',
    'default_font_size' => '16',
    'format' => 'A4',
    'margin_left' => 30, // 3 cm หรือ 30 mm
    'margin_right' => 20, // 2 cm หรือ 20 mm
    'margin_top' => 25, // 4 cm หรือ 40 mm (เพิ่มระยะห่าง)
    'margin_bottom' => 20 // 2 cm หรือ 20 mm
]);

// รับข้อมูลที่ถูกส่งมาผ่าน AJAX
$nameTitle = $_POST['nameTitle'] ?? '';
$mhesinumber = $_POST['mhesinumber'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$position = $_POST['position'] ?? '';
$positionlevel_name = ($_POST['positionlevel_name'] ?? '') !== 'ไม่มีรหัสวิทยฐานะ' ? $_POST['positionlevel_name'] ?? '' : '';
$affiliation_name = $_POST['affiliation_name'] ?? '';
$subaffiliation_name = $_POST['subaffiliation_name'] ?? '';
$employmentContract = $_POST['employmentContract'] ?? '';
$otherIncome = $_POST['otherIncome'] ?? '';
$startDate_buddhist = $_POST['startDate_buddhist'] ?? '';
$years = $_POST['years'] ?? '';
$months = $_POST['months'] ?? '';
$day = $_POST['day'] ?? '';

$salary = isset($_POST['salary']) ? number_format((float) $_POST['salary'], 0, '.', ',') : '';

// ฟังก์ชันแปลงเลขอาราบิกเป็นตัวเลขไทย
function numberToThai($number)
{
    $arr_number = array(
        '0' => '๐',
        '1' => '๑',
        '2' => '๒',
        '3' => '๓',
        '4' => '๔',
        '5' => '๕',
        '6' => '๖',
        '7' => '๗',
        '8' => '๘',
        '9' => '๙',
    );
    $str_number = (string) $number;
    $result = '';
    for ($i = 0; $i < strlen($str_number); $i++) {
        $result .= isset($arr_number[$str_number[$i]]) ? $arr_number[$str_number[$i]] : $str_number[$i];
    }
    return $result;
}

// ฟังก์ชันแปลงเดือนเป็นภาษาไทย
function convertToThaiMonth($date)
{
    $months_thai = array(
        '01' => 'มกราคม',
        '02' => 'กุมภาพันธ์',
        '03' => 'มีนาคม',
        '04' => 'เมษายน',
        '05' => 'พฤษภาคม',
        '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม',
        '08' => 'สิงหาคม',
        '09' => 'กันยายน',
        '10' => 'ตุลาคม',
        '11' => 'พฤศจิกายน',
        '12' => 'ธันวาคม',
    );
    return strtr($date, $months_thai);
}

// ฟังก์ชันแปลงปีคริสต์ศักราชเป็นพุทธศักราช (พ.ศ.)
function convertToBuddhistEra($date)
{
    $year = intval(date('Y', strtotime($date))) + 543;
    return numberToThai($year);
}

$currentDate = numberToThai(date('d')) . ' ' . convertToThaiMonth(date('m')) . ' ' . convertToBuddhistEra(date('Y-m-d')); // แสดงผลในรูปแบบ "วันที่ รหัสเดือน พ.ศ. ปี"

$pastContent = '<p class="custom-indent">หนังสือฉบับนี้ให้ไว้เพื่อรับรองว่า ' . $nameTitle . '' . $fname . ' ' . $lname . 'เป็น ' . $employmentContract . ' ตำแหน่ง' . $position . ' ' . $positionlevel_name . ' อัตราเงินเดือน ' . numberToThai($salary) . ' บาท สังกัดมหาวิทยาลัยราชภัฏร้อยเอ็ด กระทรวงการอุดมศึกษา วิทยาศาสตร์ วิจัยและนวัตกรรม เริ่มปฏิบัติงานในมหาวิทยาลัยราชภัฏร้อยเอ็ด ตั้งแต่วันที่ ' . numberToThai($startDate_buddhist) . ' จนถึงปัจจุบัน นับเป็นเวลา ' . numberToThai($years) . ' ปี ' . numberToThai($months) . ' เดือน ' .  '</p>';


$content = '
<style>
body {
    /* font-size: 16pt; */
    line-height: 1.1;
}
.center {
    text-align: center;
}
.custom-image {
    width: 3cm;
}
.custom-table {
    margin-top: -40px;
}
.custom-space td {
    height: 20pt;
}
.custom-space2 td {
    height: 90px;
}
.custom-space3 td {
    height: 180px;
}
.custom-indent {
    text-indent: 5em;
    text-align: justify;
    
}
</style>
<div class="center">
    <img src="images/krut-3-cm.png" alt="krut" class="custom-image">
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="5" class="custom-table">
    <tr>
        <td>ที่ อว ๐๖๔๗.๐๑(๒)/' . numberToThai($mhesinumber) . '</td>
        <td width="28%" style="padding: 0px;">มหาวิทยาลัยราชภัฏร้อยเอ็ด</td>
    </tr>
    <tr>
        <td></td>
        <td width="28%" style="padding: 0px;">ตำบลเกาะแก้ว อำเภอเสลภูมิ</td>
    </tr>
    <tr>
        <td></td>
        <td width="28%" style="padding: 0px;">จังหวัดร้อยเอ็ด ๔๕๑๒๐</td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="custom-space">
    <tr>
        <td></td>
    </tr>
</table>

' . $pastContent . '

<p class="custom-indent">ให้ไว้ ณ วันที่  ' . $currentDate . '</p>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="custom-space2">
    <tr>
        <td></td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td></td>
        <td width="72%" style="text-align:center;">
            <p>
                (ผู้ช่วยศาสตราจารย์ ดร.เกรียงศักดิ์ ศรีสมบัติ)<br/>
                รองอธิการบดีฝ่ายทรัพยากรบุคคลและพัฒนาคุณภาพองค์กร<br /> 
                ปฏิบัติราชการแทน รักษาราชการแทนอธิการบดีมหาวิทยาลัยราชภัฏร้อยเอ็ด
            </p>
        </td>
    </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="5" class="custom-space3">
    <tr>
        <td></td>
    </tr>
</table>

<b>หมายเหตุ : หนังสือฉบับนี้มีอายุ ๙๐ วัน นับตั้งแต่วันที่ออกหนังสือ</b>

<p>สำนักงานอธิการบดี : ฝ่ายการเจ้าหน้าที่<br />
โทร. ๐ ๔๓๕๕ ๖๐๐๖<br />
โทรสาร ๐ ๔๓๕๕ ๖๐๐๙ <br />
</p>';

$mpdf->SetTitle('หนังสือรับรองเงินเดือน');
$mpdf->WriteHTML($content);

$mpdf->Output();
