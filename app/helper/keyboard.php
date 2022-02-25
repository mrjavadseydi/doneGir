<?php

use Telegram\Bot\Keyboard\Keyboard;

function mainMenu($isVip)
{

    $home = [
        [
            '📮 دریافت بنر 📮'
        ],
        [
            '✔️ ثبت دان ✔️',
            '🖼 ارسال شات 🖼'
        ],

        ['📨 پشتیبانی 📨',
            '💰 کیف پول💰']
        ,

        ['🤔 راهنما 🤔',
            "🔱VIP🔱",
            '💲قیمت امروز💲'
        ]

    ];
    $vip_home = [
        [
            '📮 دریافت بنر 📮'
        ],

        [    '🔱 ثبت دان 🔱',
            '🔱 ارسال شات 🔱'
        ],
        [    '📨 پشتیبانی 📨',
            '💰 کیف پول💰'
        ],
        [    '📃 راهنما 📃',
            '💲قیمت امروز💲'
        ]
    ];
    if($isVip){
        return Keyboard::make($vip_home);
    }else{
        return Keyboard::make($home);
    }
}

if (!function_exists('menuButton')) {
    function menuButton()
    {

        $btn = Keyboard::button(
            [
                ['💰 فروش به ما', '💳 خرید از ما'],
                ['💸 خرید/فروش های من', '📄 نرخ ارزها'],
                ['⁉️ سوالات متداول', '💡 راهنما'],
                ['📞 تماس با ما', '👮 قوانین و مقررات'],
                ['👤 پروفایل کاربری']
            ]
        );
        return Keyboard::make(['keyboard' => $btn, 'resize_keyboard' => true, 'one_time_keyboard' => true]);
    }
}
if (!function_exists('activateUser')) {
    function activateUser($id, $chat_id)
    {
        return keyboard::make([
            'inline_keyboard' => [
                [
                    [
                        'text' => "تایید",
                        'callback_data' => "activate-$id-$chat_id"
                    ],
                    [
                        'text' => "رد",
                        'callback_data' => "deactive-$id-$chat_id"
                    ],
                    [
                        'text' => "بلاک",
                        'callback_data' => "block-$id-$chat_id"
                    ],

                ]
            ],
        ]);
    }
}
