<?php
App::uses('AppModel', 'Model');
/**
 * Config Model
 *
 */
class Config extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'config';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

}
