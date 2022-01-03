<?php

return [
    'app_name' => 'Audit Monitoring & Management System',
    'loading' => 'লোডিং',
    'choose' => 'বাছাই করুন',
    'select' => 'সিলেক্ট',
    'no_data_found' => 'কোন তথ্য পাওয়া যায়নি',
    'placeholders' => [
        'search' => 'অনুসন্ধান করুন',
    ],
    'buttons' => [
        'submit_to_ocag' => 'ওসিএজিতে প্রেরণ করুন',
        'download' => 'ডাউনলোড',
        'history' => 'লগ',
        'sent_to_rpu' => 'আরপি-তে প্রেরণ',
        'title' => [
            'details' => 'বিস্তারিত দেখুন',
            'edit' => 'হালনাগাদ করুন',
            'history' => 'লগ দেখুন',
            'search' => 'খুঁজুন',
            'reset' => 'রিসেট',
            'refresh' => 'রিফ্রেশ',
            'previous' => 'পূর্ববর্তী',
            'after' => 'পরবর্তী',
            'sent_to_rpu' => 'আরপি-তে প্রেরণ করুন',
        ]
    ],
    'list_views' => [
        'plan' => [
            'audit_plan' => [
                'ministry_or_bivag' => 'মন্ত্রণালয়/বিভাগঃ',
                'entity_or_institute' => 'এনটিটি/প্রতিষ্ঠানঃ',
                'institute_type' => 'প্রতিষ্ঠানের ধরণঃ',
                'subject_matter' => 'সাবজেক্ট ম্যাটারঃ',
            ],
        ],
        'conducting' => [
            'query' => [

            ],
            'memo' => [
                'memo_no' => 'মেমো নং',
                'audit_title' => 'শিরোনাম',
                'memo_type' => 'আপত্তির ধরন',
                'memo_irregularity_type' => 'আপত্তি অনিয়মের ধরন',
                'jorito_ortho' => 'জড়িত অর্থ',
                'onishponno_jorito_ortho' => 'অনিষ্পন্ন জড়িত অর্থ',
            ]
        ]
    ],
    'table_row_headers' => [
        'general' => [
            'serial_no' => 'ক্রমিক নং',
            'memorandum_no' => 'স্মারক নং',
            'memorandum_date' => 'স্মারক তারিখ',
            'subject' => 'বিষয়',
            'comment' => 'মন্তব্য',
            'action' => 'সম্পাদন',
        ],

        'plan' => [
            'annual_plan' => [
                'activity_title' => 'কার্যকলাপ শিরোনাম',
                'milestones' => 'মাইলফলক',
                'target_date' => 'টার্গেট তারিখ',
                'budget' => 'বাজেট',
                'assigned_staff' => 'নিয়োগকৃত স্টাফ',
            ],
            'audit_plan' => [
                'audit_plan' => 'অডিট প্ল্যান',
                'ministry_division' => 'মন্ত্রণালয়/বিভাগ',
                'institute_name' => 'প্রতিষ্ঠানের নাম',
                'institute_type' => 'প্রতিষ্ঠানের ধরণ',
                'institute_total_unit' => 'প্রতিষ্ঠানের মোট ইউনিটের সংখ্যা',
                'auditable_unit_name_and_number' => 'অডিটের জন্য প্রস্তাবিত ইউনিটের নাম ও সংখ্যা',
                'subject_matter' => 'সাবজেক্ট ম্যাটার',
                'controlling_office' => 'নিয়ন্ত্রণকারী অফিস',
                'parent_office' => 'ঊর্ধ্বতন অফিস',
            ],
        ]
    ],
];
