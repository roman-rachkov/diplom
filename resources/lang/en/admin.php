<?php
return [
    'settings' => [
        'Name' => 'Settings',
        'Description' => 'Settings Change page',
        'updated' => 'Successfully updated',
        'Settings' => 'Settings',
        'Edit' => 'Edit',
        'Contacts' => 'Contacts',
        'Delivery' => 'Delivery',
        'User' => 'User',
        'Title' => 'Title',
        'Value' => 'Value',
        'Action' => 'Action',
        'editing' => 'Editing an options',
        'Update' => 'Update',
        'configuration' => 'Configuration',
        'general' => 'General settings',
    ],
    'import' =>[
        'panel_name' => 'Import',
        'screen_name' => 'Import database',
        'screen_description' => ''
    ],
    'menu' => [
        'elements' => 'Elements',
        'right' => 'All right reserved.',
    ],
    /*
   |--------------------------------------------------------------------------
   | Banner slaider Admin panel Language Lines
   |--------------------------------------------------------------------------
   */

    'banners' => [
        'panel_name' => 'Banners',
        'manage_banners' => 'Manage Banners',
        'add_new_banner' => 'Add new banner',
        'edit_banner' => 'Edit Banner',
        'title' => 'Title',
        'subtitle' => 'Subtitle',
        'button_text' => 'Button text',
        'href' => 'Button URL',
        'is_active' => 'Activate banner',
        'image' => 'Banner image',
        'title_placeholder' => 'Enter title text',
        'subtitle_placeholder' => 'Enter subtitle text',
        'button_text_placeholder' => 'Enter button text',
        'href_placeholder' => 'Enter button URL',
        'is_active_placeholder' => 'If the flag is set, the banner will be displayed',
        'image_help' => 'The image can have a maximum height of 454px and a width of 735px',
        'success_info' => 'You have successfully created an banner.',
        'delete_info' => 'You have successfully deleted the banner.',
        'active' => 'Activity',
    ],

    //permissions
    'permissions' => [
        'customer' => [
            'group_name' => 'Customer',
            'discounts' => 'Access to view discounts on portal'
        ]
    ],

    'category' => [
        'panel_name' => 'Category',
        'name_placeholder' => 'Enter category name',
        'screen_name' => 'Manage category',
        'screen_description' => 'Goods category',
        'add_new' => 'Add new category',
        'edit' => 'Edit/Create category',
        'title' => 'Category',
        'parent' => 'Parent category',
        'edit_category' => 'Редактирование/Создание категории',
        'icon' => 'Иконка категории',
        'icon_help' => 'Select the icon image to be displayed in the menu.',
        'success_info' => 'You have successfully created a category.',
        'delete_info' => 'You have successfully deleted a category.',
        'image_id' => 'Choose image for category.',
        'is_active' => 'Checked if category is active.',
        'slug' => 'Enter the symbol code for the category.',
        'slug_placeholder' => 'The symbolic code must be separated by a dash.',
    ],

    'products' => [
        'panel_name' => 'Products',
        'screen_name' => 'Manage products',
        'screen_description' => 'Products list',
        'add_new' => 'Add product',
        'edit' => 'Edit',
        'name' => 'Name',
        'name_placeholder' => 'Enter the product name',
        'slug' => 'Product symbolic code',
        'slug_placeholder' => 'Enter the symbolic product code',
        'manufacturer' => 'Manufacturer',
        'category' => 'Category',
        'limited_edition' => 'Limited edition',
        'description' => 'Product description',
        'full_description' => 'Product description for tab description',
        'main_tab' => 'Main settings',
        'images_tab' => 'Images settings',
        'seller_prices_tab' => 'Seller and price settings',
        'success_info' => 'Product changes have been successfully committed',
        'price_updated' => 'Price updated',
        'price_deleted' => 'Price deleted',
        'price_created' => 'New price added',
        'delete_info' => 'Product removed',
        'add_new_price_modal_button' => 'Add price',
        'add_new_price_modal_title' => 'Adding a seller and price',
        'main_img_id' => 'Main product image',
        'additional_img' => 'Additional product images',
        'prices' => 'Prices',
        'price' => 'Price',
        'edit_button' => 'Edit',
        'edit_modal_title' => 'Edit price for ',
        'seller' => 'Seller',
        'edit_title' => 'Editing a product',
    ],

    'sellers' => [
        'panel_name' => 'Sellers',
        'screen_name' => 'Manage sellers',
        'screen_description' => 'Sellers list',
        'add_new_seller' => 'Add new seller',
        'edit' => 'Edit seller',
        'add' => 'Create seller',
        'title' => 'Company name',
        'edit_seller' => 'Editing/Creating seller',
        'name_placeholder' => 'Fill the seller-organization name',
        'phone_number' => 'Public seller company phone number',
        'phone_title' => 'Phone number',
        'description' => 'Company description',
        'description_placeholder' => 'About company history, goods and services in details...',
        'address' => 'Company legal address',
        'address_placeholder' => 'Full company name address from Unified Register of Legal Entities and the Unified Register of Individual Entrepreneurs',
        'logo_id' => 'Upload company logo:',
        'success_info' => 'Seller successfully created',
        'delete_info' => 'Seller successfully deleted',
    ],

    'discounts' => [
        'panel_name' => 'Discounts',
        'screen_name' => 'Manage discounts',
        'screen_description' => 'Discounts list'
    ],

    'orders' => [
        'panel_name' => 'Orders',
        'screen_name' => 'Manage orders',
        'screen_description' => 'Orders list',
        'customer_name_title' => 'Customer full name',
        'customer_phone_title' => 'Customer phone',
        'order_delivery_type_title' => 'Delivery type',
        'order_total_title' => ' Total $',
        'delivery_type' => [
            'default' => 'default',
            'express' => 'express'
        ],
        'edit' => 'Edit order',
        'delivery_city' => 'City',
        'delivery_address' => 'Address',
        'delivery_title' => 'Delivery',
        'comment_title' => 'Comment',
        'success_info' => 'Order successfully changed',
    ],

    'reviews' => [
        'panel_name' => 'Reviews',
        'screen_name' => 'Manage reviews',
        'screen_description' => 'Reviews list',
        'edit_review_with' => 'Edit review with ID:',
        'edit' => 'Edit',
        'action' => 'Actions',
        'review' => 'Review',
        'created' => 'Created at',
        'success' => 'Update successfully',
    ],

];
