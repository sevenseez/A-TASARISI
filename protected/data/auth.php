<?php
return array (
  'reader' => 
  array (
    'type' => 2,
    'description' => 'Can only read a post',
    'bizRule' => '',
    'data' => '',
  ),
  'commentor' => 
  array (
    'type' => 2,
    'description' => 'Can post a comment',
    'bizRule' => '',
    'data' => '',
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => 'Can read a post and post a comment',
    'bizRule' => '',
    'data' => '',
    'children' => 
    array (
      0 => 'reader',
      1 => 'commentor',
    ),
    'assignments' => 
    array (
      4 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      2 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      3 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
      5 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
);
