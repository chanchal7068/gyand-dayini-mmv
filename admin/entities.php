<?php
/* Configuration schema for admin entities — powers all admin CRUD management screens */

$ENTITIES = [

'pages' => [
    'label' => 'Pages',
    'icon'  => '📄',
    'table' => 'pages',
    'order' => 'title ASC',
    'list'  => ['title', 'slug', 'is_active'],
    'fields' => [
        'title'     => ['label' => 'Page Title', 'type' => 'text', 'req' => 1],
        'slug'      => ['label' => 'URL Slug (page/<slug>)', 'type' => 'text', 'req' => 1, 'hint' => 'English letters, numbers and hyphens only, e.g. about-college'],
        'subtitle'  => ['label' => 'Subtitle', 'type' => 'text'],
        'banner'    => ['label' => 'Banner Image', 'type' => 'image', 'folder' => 'pages'],
        'content'   => ['label' => 'Content (HTML supported)', 'type' => 'html'],
        'meta_desc' => ['label' => 'Meta Description (SEO)', 'type' => 'text'],
        'sort_order'=> ['label' => 'Sort Order', 'type' => 'number'],
        'is_active' => ['label' => 'Published', 'type' => 'check', 'default' => 1],
    ],
],

'menus' => [
    'label' => 'Menus',
    'icon'  => '☰',
    'table' => 'menus',
    'order' => 'parent_id ASC, sort_order ASC',
    'list'  => ['title', 'url', 'parent_id', 'is_active'],
    'fields' => [
        'title'     => ['label' => 'Menu Item Title', 'type' => 'text', 'req' => 1],
        'url'       => ['label' => 'Link URL', 'type' => 'text', 'hint' => 'e.g.: page/about-college, courses.php, or full https:// URL. Use # for dropdown header'],
        'parent_id' => ['label' => 'Parent Menu', 'type' => 'parent'],
        'sort_order'=> ['label' => 'Sort Order', 'type' => 'number'],
        'open_new'  => ['label' => 'Open in New Tab', 'type' => 'check'],
        'is_active' => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'notices' => [
    'label' => 'Notices & Circulars',
    'icon'  => '🔔',
    'table' => 'notices',
    'order' => 'notice_date DESC',
    'list'  => ['title', 'notice_date', 'is_new', 'is_active'],
    'fields' => [
        'title'      => ['label' => 'Notice Title', 'type' => 'text', 'req' => 1],
        'notice_date'=> ['label' => 'Notice Date', 'type' => 'date'],
        'file_path'  => ['label' => 'PDF / Attachment File', 'type' => 'image', 'folder' => 'notices'],
        'link_url'   => ['label' => 'External Link', 'type' => 'text'],
        'is_new'     => ['label' => 'Show "NEW" Tag', 'type' => 'check', 'default' => 1],
        'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'  => ['label' => 'Published', 'type' => 'check', 'default' => 1],
    ],
],

'sliders' => [
    'label' => 'Home Sliders',
    'icon'  => '🖼️',
    'table' => 'sliders',
    'list'  => ['caption', 'image', 'is_active'],
    'fields' => [
        'image'      => ['label' => 'Image (1600×900 recommended)', 'type' => 'image', 'folder' => 'slider', 'req' => 1],
        'caption'    => ['label' => 'Heading Caption', 'type' => 'text'],
        'sub_caption'=> ['label' => 'Subcaption', 'type' => 'text'],
        'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'  => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'courses' => [
    'label' => 'Courses & Programs',
    'icon'  => '🎓',
    'table' => 'courses',
    'list'  => ['name', 'short_name', 'duration', 'is_active'],
    'fields' => [
        'name'        => ['label' => 'Program Name', 'type' => 'text', 'req' => 1],
        'short_name'  => ['label' => 'Short Name (e.g. B.A., B.Com.)', 'type' => 'text'],
        'duration'    => ['label' => 'Duration', 'type' => 'text'],
        'eligibility' => ['label' => 'Eligibility Criteria', 'type' => 'text'],
        'subjects'    => ['label' => 'Subjects / Combinations', 'type' => 'textarea'],
        'seats'       => ['label' => 'Available Seats', 'type' => 'text'],
        'description' => ['label' => 'Course Description', 'type' => 'textarea'],
        'sort_order'  => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'   => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'faculty' => [
    'label' => 'Faculty & Staff',
    'icon'  => '👩‍🏫',
    'table' => 'faculty',
    'list'  => ['name', 'designation', 'department', 'is_active'],
    'fields' => [
        'name'         => ['label' => 'Full Name', 'type' => 'text', 'req' => 1],
        'designation'  => ['label' => 'Designation', 'type' => 'text'],
        'department'   => ['label' => 'Department', 'type' => 'text'],
        'qualification'=> ['label' => 'Qualification', 'type' => 'text'],
        'photo'        => ['label' => 'Photo', 'type' => 'image', 'folder' => 'faculty'],
        'email'        => ['label' => 'Email Address', 'type' => 'text'],
        'sort_order'   => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'    => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'leaders' => [
    'label' => 'Founders & Leadership',
    'icon'  => '🪔',
    'table' => 'leaders',
    'list'  => ['name', 'designation', 'is_active'],
    'fields' => [
        'name'       => ['label' => 'Full Name', 'type' => 'text', 'req' => 1],
        'designation'=> ['label' => 'Role / Designation', 'type' => 'text'],
        'photo'      => ['label' => 'Photo', 'type' => 'image', 'folder' => 'faculty'],
        'link_url'   => ['label' => 'Link URL', 'type' => 'text'],
        'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'  => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'gallery' => [
    'label' => 'Photo Gallery',
    'icon'  => '📷',
    'table' => 'gallery',
    'list'  => ['title', 'category', 'image', 'is_active'],
    'fields' => [
        'image'     => ['label' => 'Image', 'type' => 'image', 'folder' => 'gallery', 'req' => 1],
        'title'     => ['label' => 'Image Title', 'type' => 'text'],
        'category'  => ['label' => 'Category', 'type' => 'select', 'options' => ['Photos', 'Video', 'News', 'Campus', 'Events']],
        'sort_order'=> ['label' => 'Sort Order', 'type' => 'number'],
        'is_active' => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

'events' => [
    'label' => 'Events & Activities',
    'icon'  => '📅',
    'table' => 'events',
    'order' => 'event_date DESC',
    'list'  => ['title', 'event_date', 'is_active'],
    'fields' => [
        'title'      => ['label' => 'Event Title', 'type' => 'text', 'req' => 1],
        'event_date' => ['label' => 'Event Date', 'type' => 'date'],
        'image'      => ['label' => 'Event Image', 'type' => 'image', 'folder' => 'gallery'],
        'description'=> ['label' => 'Event Description', 'type' => 'textarea'],
        'sort_order' => ['label' => 'Sort Order', 'type' => 'number'],
        'is_active'  => ['label' => 'Published', 'type' => 'check', 'default' => 1],
    ],
],

'quicklinks' => [
    'label' => 'Quick Links',
    'icon'  => '🔗',
    'table' => 'quicklinks',
    'list'  => ['title', 'url', 'icon', 'is_active'],
    'fields' => [
        'title'     => ['label' => 'Title', 'type' => 'text', 'req' => 1],
        'url'       => ['label' => 'Link URL', 'type' => 'text'],
        'icon'      => ['label' => 'Icon Name', 'type' => 'select', 'options' => ['edit','coin','university','result','book','file','shield','phone','link']],
        'sort_order'=> ['label' => 'Sort Order', 'type' => 'number'],
        'is_active' => ['label' => 'Active', 'type' => 'check', 'default' => 1],
    ],
],

];

