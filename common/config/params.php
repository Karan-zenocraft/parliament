<?php
return [
    'adminEmail' => 'admin@b4p.et',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'site_url' => stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'],
    'root_url' => stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ? 'https://' . $_SERVER['HTTP_HOST'] : 'http://' . $_SERVER['HTTP_HOST'] . "/parliament/",
    'login_url' => '/parliament/admin/login',
    'frontend_login_url' => '/parliament/login',
    'user.passwordResetTokenExpire' => 3600,
    'userroles' => [
        'admin' => '1',
        'MP' => '2',
        'user_agent' => '3',
    ],
    'user_status' => array('1' => 'Active', '0' => 'In-Active'),
    'user_status_value' => array('active' => '1', 'in_active' => '0'),
    'gender' => [
        '1' => 'Female',
        '2' => 'Male',
    ],
    'bsVersion' => '4.x',
    'bsDependencyEnabled' => false,
];
