<?php
$xpdo_meta_map['forcedPasswdChange']= array (
  'package' => 'forcedpasswdchange',
  'table' => 'forcedpasswdchange',
  'fields' => 
  array (
    'user' => NULL,
    'changed' => 0,
  ),
  'fieldMeta' => 
  array (
    'user' => 
    array (
      'dbtype' => 'int',
      'precision' => '11',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'index',
    ),
    'changed' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
  ),
);
