<?php
// تنظیمات اصلی فرم تماس
$subject = 'پیام جدید از وب‌سایت پاپا استور';
$emailadd = 'pari.1993@ymail.com';
$url = 'send.html'; // صفحه‌ای که بعد از ارسال موفق نمایش داده می‌شود
$req = '0'; // 0 یعنی اجباری نبودن فیلدها، 1 یعنی اجباری

$text = "اطلاعات فرم ارسال شده از وب‌سایت:\n\n";
$line = "\r\n";
$space = ' ';

foreach ($_POST as $key => $value) {
    // پاکسازی ورودی‌ها برای امنیت
    $key = htmlspecialchars(trim($key), ENT_QUOTES, 'UTF-8');
    $value = htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');

    if ($req == '1' && $value == '') {
        echo "فیلد $key خالی است.";
        die;
    }
    
    $j = strlen($key);
    if ($j >= 30) {
        echo "نام فیلد $key نمی‌تواند بیشتر از 30 کاراکتر باشد";
        die;
    }
    
    $text .= "{$key}: {$value}{$line}";
}

// تنظیم هدرهای ایمیل برای پشتیبانی کامل از زبان فارسی (UTF-8)
$headers  = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8" . "\r\n";
$headers .= "From: webmaster@yourdomain.com" . "\r\n"; // بهتر است ایمیل هاست باشد یا خود ایمیل سایت
$headers .= "Reply-To: " . $emailadd . "\r\n";

// ارسال ایمیل
@mail($emailadd, $subject, $text, $headers);

// انتقال کاربر به صفحه تایید ارسال
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . $url . '">';
exit;
?>
