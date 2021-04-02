<?php

/**
 * Routes are now defined outside main router file.
 * Now its possible to add params in the current layout
 * index, such as:
 *  'route-name' => [
 *      'params' => ['param1', 'param2'],
 *      'body'   => $l = new Endpoint(),
 *                  $l->page('domain/page')
 *                    ->permission('auth')
 *  ],
 * 
 * Params index MUST BE before body properties, otherwise, it will be lost.
 */

use MMWS\Factory\EndpointFactory;

return [
	'wine' => [
		'params' => ['codigo'],
		'body' => EndpointFactory::create()
			->post('wine/manage', 'create')
			->get('wine/manage', 'get')
			->put('wine/manage', 'update')
			->delete('wine/manage', 'delete')
			->cache(),
		// Add children routes calling the http methods from endpoint
		'another-children-route' => [
			'body' => EndpointFactory::create()
				->get('wine/manage', 'exampleMethod'),
		]
	],
];
