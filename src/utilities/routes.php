<?php

$routes = [
    'website' => [
        'routes' => [
            ['(index|home)?', 'index.view.php'],
            ['(about|about-us)', 'about-us.view.php'],
            ['(wall-form-block|wall-form-blocks|precast)', 'wall-form-blocks.view.php'],
            ['(user-guide|guide)', 'user-guide.view.php'],
            ['(project|projects)', 'projects.view.php'],
            ['(contact-us|contacts|contact)', 'contact-us.view.php'],
            ['(login)', 'login.view.php'],
            ['(signup)', 'signup.view.php'],
            ['(forgot-password)', 'forgot-password.view.php'],
            ['(change-password)', 'change-password.view.php'],
        ]
    ],
    'backend' => [
        'routes' => [
            ['', 'getUser', []],
            ['(signup)', 'signup', ['validateSignUp']],
            ['(login)', 'login', ['validateLogin']],
            ['(change-password)', 'changePassword', ['validateChangePassword']],
            ['(logout)', 'logout', ['isAuthorized']],
            ['(get-products)', 'getWallFormBlocks', ['isAuthorized']],
            ['(add-to-cart)', 'addToCart', ['isAuthorized']],
            ['(remove-to-cart)', 'removeToCart', ['isAuthorized']],
            ['(get-cart)', 'getCart', ['isAuthorized']],
            ['(add-to-order)', 'addToOrder', ['isAuthorized']],
            ['(get-orders)', 'getOrders', ['isAuthorized']],
            ['(send-message)', 'addMessage', ['isAuthorized']],
            ['(get-message)', 'getMessages', ['isAuthorized']],
            ['(get-new-message)', 'getNewMessages', ['isAuthorized']],
            ['(get-new-billing)', 'getNewBillings', ['isAuthorized']],
            ['(get-quotation)', 'getQuotation', ['isAuthorized']],
            ['(set-quotation)', 'setQuotation', ['isAuthorized']],
            ['(remove-quotation)', 'removeQuotation', ['isAuthorized']],
            ['(get-payment)', 'getPayment', ['isAuthorized']],
            ['(submit-payment)', 'submitPayment', ['validateSubmitPayment', 'isAuthorized']],
            ['(set-payment-status)', 'setPaymentStatus', ['isAuthorized']],
        ]
    ]
];
