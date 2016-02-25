<?php
namespace CentraleLille\SearchBundle\Extra;

class Elastic
{
	private $host;

	function __construct($container = null) {
		if ($container && $container->get( 'kernel' )->getEnvironment() == 'dev') {
			$host = 'http://localhost:9200/';
		} else {
			$host = '';
		}
		$this->host = $host;
	}

	public function simpleSearch($string)
	{

		$must = array(
			array(
				'match' => array(
					'title' => $string
				)
			)
		);

		$query = array(
			'bool' => array(
				'must' => $must
			),
		);

		//option de tri
		//$sort = array();
		//option champs spécifique
		//$fields = array();

		$data = $this->search('library', 'book', $query, 500, 0);
		//	$data = $this->search($index, $type, $query, $size, $from, $fields, $sort);
		return $data;
	}

	public function search($index, $type, $query, $size, $from, $fields = null, $sort = null)
	{

		$body = array(
			'query' => $query,
			'size' => $size,
			'from' => $from
		);
		if ($fields) $body['fields'] = $fields;
		if ($sort) $body['sort'] = $sort;
		return $this->curl($this->host.$index.'/'.$type.'/_search', 'GET', $body);
	}

	public function curl($url, $method, $body)
	{
		$ci = curl_init();
		curl_setopt($ci, CURLOPT_URL, $url);
		curl_setopt($ci, CURLOPT_PORT, 9200);
		curl_setopt($ci, CURLOPT_TIMEOUT, 200);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ci, CURLOPT_FORBID_REUSE, 0);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ci, CURLOPT_POSTFIELDS, json_encode($body));
		$data = curl_exec($ci);
		return json_decode($data, true);
	}
}
