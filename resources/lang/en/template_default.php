<?php

return [

    'main' => [
        'home' => 'Home',
        'about_us' => 'About',
        'store' => 'Store',
        'contact' => 'Contact',
        'offers' => 'Offers',
        'blog' => 'Blog',
    ],
    'connect' => [
        'login' => 'Login',
        'register' => 'Register'
    ],
    'g' => [
        'search_placeholder' => 'Search',
        'lang_en' => 'English',
        'lang_es' => 'Español',
        'month' => [
            'january' => 'January',
            'february' => 'February',
            'march' => 'March',
            'april' => 'April',
            'may' => 'May',
            'june' => 'June',
            'july' => 'July',
            'august' => 'August',
            'september' => 'September',
            'october' => 'October',
            'november' => 'November',
            'december' => 'December'
        ]
    ],
    'login' => [
        'title' => 'Enter your credentials',
        'email' => 'Email',
        'password' => 'Password',
        'login' => 'Login',
        'register' => 'Register',
        'recover' => 'Recover my password',
        'messages' => [
            'title' => 'An error has occurred',
            'email_required' => 'Email is required.',
            'email_email' => 'Invalid email format.',
            'password_required' => 'You must enter your password.',
            'password_min' => 'Password must be at least 8 characters long.',
            'error' => 'Incorrect email or password.'
        ]
    ],
    'register' => [
        'title' => 'Create your account',
        'name' => 'Name',
        'lastname' => 'Lastname',
        'email' => 'Email',
        'password' => 'Password',
        'cpassword' => 'Confirm password',
        'register' => 'Register',
        'to_login' => 'Already have an account? Login',
        'recover' => 'Recover my password',
        'messages' => [
            'name_required' => 'Name is required.',
            'lastname_required' => 'Lastname is required.',
            'email_required' => 'Email is required.',
            'email_email' => 'Invalid email format.',
            'email_unique' => 'There is already a user with this email. Please use another email.',
            'password_required' => 'Please enter a password.',
            'password_min' => 'Password must be at least 8 characters long.',
            'cpassword_equired' => 'Please confirm the password.',
            'cpassword_min' => 'Password must be at least 8 characters long.',
            'cpassword_same' => 'Password confirmation does not match.',
            'error' => 'An error has occurred. Please try again.',
            'success' => 'Your account has been created successfully. You can now login.'
        ]
    ],
    'messages' => [
        'suspended_account' => 'Suspended account',
        'error' => 'An error has occurred',

    ],
    'recover' => [
        'title' => 'Recover your password',
        'email' => 'Enter your email',
        'recover' => 'Recover',
        'login' => 'Log in to My Account',
        'cod_sent' => 'Enter the code we sent to your email',
        'cod_recover' => 'Code recover',
        'email_not_exist' => 'Email entered does not exist',
        'register' => 'I am new, please to go Register',
        'success' => 'Password changed. New password sent to your email.',
        'error' => 'The email and recovery code are incorrect.',
        'title_btn' => 'Recover password',
        'messages' => [
            'email_required' => 'Email is required.',
            'email_email' => 'Invalid email format.',
            'error' => 'An error has occurred. Please try again.'
        ]
    ],
    'users' => [
        'postAccountAvatar' => [
            'avatar_required' => 'You must add an image.'
        ],
        'postAccountPassword' => [
            'apassword_required' => 'Enter your current password.',
            'apassword_min' => 'Current password must be at least 8 characters long.',
            'password_required' => 'Enter the new password.',
            'password_min' => 'New password must be at least 8 characters long.',
            'cpassword_required' => 'Confirm the new password.',
            'cpassword_min' => 'New password must be at least 8 characters long.',
            'cpassword_same' => 'Passwords do not match.'
        ],
        'postAccountInfo' => [
            'name_required' => 'Your name is required.',
            'lastname_required' => 'Your last name is required.',
            'phone_required' => 'Your phone number is required.',
            'password_min' => 'New password must be at least 8 characters long.',
            'year_required' => 'Your year of birth is required.',
            'day_requerido' => 'Your year of birth is required.'
        ],
        'postAccountAddress' => [
            'name_required' => 'You must assign a name.',
            'state_id_required' => 'You must select a state.',
            'city_id_required' => 'Select a city.',
            'add1_required' => 'Your neighborhood name is required.',
            'add2_required' => 'Enter the name of the street where you live.',
            'add3_requerid' => 'Enter the number.'
        ],
        'alerts' => [
            'success_message' => 'Your account has been updated successfully.',
            'password_incorrect_message' => 'Your current password is incorrect.',
            'password_success_message' => 'Your password has been changed successfully.',
            'error_message' => 'An error has occurred',
            'address_save_success_message' => 'Your shipping information was successfully saved.',
            'address_edit_error_message' => 'You cannot edit this delivery address.',
            'address_update_success_message' => 'Your address has been updated. Its main address is now ',
            'address_delete_default_error_message' => 'Delivery address removed successfully.',
            'address_delete_success_message' => 'Cannot delete a delivery address.',
            'address_delete_error_message' => 'You cannot delete this address.',
            'info_update_success_message' => 'Your personal information has been updated.',
        ]
    ],
    'api_js_alerts' => [
        'error_message' => 'An error has occurred',
        'success_message' => 'He saved his favorite'
    ],
    'cart' => [
        'postCartAdd' => [
            'not_available' => 'You must select an available option.',
            'not_available_selected' =>  'The selected option is not available.',
            'cannot_be_added_to_cart' => 'Cannot add this product to cart.',
            'enter_amount' => 'You must enter the amount.',
            'not_available_quantity' => 'That quantity is not available in inventory.',
            'selected_sub_option' => 'Select at least one of the available sub-options.',
            'invalid_selection' => 'Invalid selection or does not exist for this offer',
            'add_product_cart' => 'Product added to shopping cart',
            'exist_product_cart' => 'This product is already in your cart.',
            'not_updated_product' => 'The quantity of this product cannot be updated.',
            'not_product_availale' => 'The quantity entered exceeds the quantity of available inventory.',
            'success_quantity_update' => 'Successfully updated quantity',
            'delete_item_success' => 'Item successfully deleted'
        ]
    ],

    'settings' => [
        'dashboard' => [
            'dashboard' => 'Can view the Dashboard',
            'dashboard_small_stats' => 'Can view the quick statistics',
            'dashboard_sell_today' => 'Can view daily sales',
        ],

        'products' => [
            'products' => 'Can list products',
            'product_add'  => 'Can add products',
            'product_edit'  => 'Can edit products',
            'product_search'  => 'Can search products',
            'product_delete'  => 'Can delete product',
            'product_gallery_add'  => 'Can add images to the Gallery',
            'product_gallery_delete'  => 'Can delete images from the Gallery',
            'product_inventory'  => 'Can manage product inventory',
        ],
        'categories' => [
            'categories' => 'Can view categories',
            'category_add' => 'Can add categories',
            'category_edit' => 'Can edit categories',
            'category_delete' => 'Can delete categories',
        ],
        'users' => [
            'user_list' => 'Can list users',
            'user_view' => 'Can view users',
            'user_edit' => 'Can edit users',
            'user_banned' => 'Can ban users',
            'user_permissions' => 'Can manage user permissions',
        ],

        'settings' => [
            'settings' => 'Can modify settings',
        ],

        'sliders' => [
            'sliders_list'  => 'Can list sliders',
            'slider_add'    => 'Can add sliders',
            'slider_edit'   => 'Can edit sliders',
            'slider_delete' => 'Can delete sliders',
        ],

        'orders' => [
            'orders_list' => 'Can view the list of orders',
            'order_view' => 'Can view the details of an order',
            'order_change_status' => 'Can change the status of an order',
        ],
        'coverage' => [
            'coverage_list' => 'Can view the list of shipments',
            'coverage_add' => 'Can add shipping coverage',
            'coverage_edit' => 'Can edit shipping coverage',
            'coverage_delete' => 'Can delete shipping coverage',
        ],
        'shipping_method' => [
            'free_shipping' => 'Free Shipping'
        ],
        'status' => [
            'free_shipping' => 'Free Shipping',
            'fixed_price' => 'Fixed Price',
            'variable_price_by_location' => 'Variable Price by Location',
            'free_shipping_minimum_amount' => 'Free Shipping / Minimum Amount'

        ],
        'list' => [
            'in_process' => 'In Process',
            'pending_payment_confirmation' => 'Pending Payment Confirmation',
            'payment_received' => 'Payment Received',
            'processing_order' => 'Processing Order',
            'order_shipped' => 'Order Shipped',
            'ready_for_pickup' => 'Ready for Pickup',
            'order_delivered' => 'Order Delivered',
            'order_rejected' => 'Order Rejected'
        ],

        'list_method_payment' => [
            'cash' => 'Cash',
            'bank_transfer' => 'Bank Transfer',
            'paypal' => 'Paypal',
            'credit_card' => 'Credit Card'
        ],
        'order_type' => [
            'home_delivery' => 'Home Delivery',
            'to_go' => 'To Go'
        ],
        'orders' => [
            'getCoverageStatus' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
            'getEnableOrNotEnable' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
        ]
    ]
];
