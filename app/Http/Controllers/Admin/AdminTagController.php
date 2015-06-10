<?php

namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\TagRequest;
use Douyasi\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 标签资源控制器
 * TODO 暂未完善
 *
 * @author raoyc<raoyc2009@gmail.com>
 */
class AdminTagController extends BackController
{

    public function __construct()
    {
        parent::__construct();
        if (! user('object')->can('manage_contents')) {
            $this->middleware('deny403');
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view('back.tag.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
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
