<?php namespace Douyasi\Http\Controllers\Api;

use Douyasi\Http\Requests;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;
use Crypt;
/*
 * php artisan make:controller Api/PhotoController
 */
class PhotoController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('home');
/*		$result = DB::table('contents')->get();
		print_r($result);*/
		$decrypted = Crypt::encrypt('admin');
		//$decrypted = Crypt::decrypt('$2y$10$J7LHukU1OvdKS0HjHyP67OckaKXwci9vV6iqOCpN65x8X7MDgMNlu');
		echo $decrypted;

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
