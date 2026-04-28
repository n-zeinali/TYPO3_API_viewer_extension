<?php
$EM_CONF[$_EXTKEY] = [
    'title'        => 'API Viewer',
    'description'  => 'Fetch any JSON API and show results as a list.',
    'category'     => 'plugin',
    'author'       => 'Nafiseh Zeinali',
    'author_email' => 'n.zeinali@gmail.com',
    'state'        => 'beta',
    'version'      => '1.0.0',
    'constraints'  => [
        'depends' => [
            'typo3' => '14.0.0-14.99.99',
            'php'   => '8.2.0-8.99.99',
        ],
    ],
];