<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\CategoryRequest;
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Douyasi\Repositories\MetaRepository;

/**
 * 分类资源控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminCategoryController extends BackController {
	
	/**
	 * The MetaRepository instance.
	 *
	 * @var Douyasi\Repositories\MetaRepository
	 */
	protected $meta;


	public function __construct(
		MetaRepository $meta)
	{
		parent::__construct();
		$this->meta = $meta;
		
		if(! user('object')->can('manage_contents') ){
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
		$categories = $this->meta->index();
		return view('back.category.index', compact('categories'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('back.category.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CategoryRequest $request)
	{
		//
		if ($request->is_ajax())
		{
			$validator = $request->validate('store');
			$data = $request->data('store');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '添加分类']);

			if($validator->passes()){

				$meta = $this->meta->store('category', $data);
				if($meta->id){
					$json = array_replace($json, ['status' => 1, 'info' => '成功']);
				}
				else{  //添加失败
					$info = '失败原因为：<span class="text_error">数据库操作返回异常</span>';
					$json = array_replace($json, ['info' => $info]);
				}

			} else {
				// 验证失败
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}
		
		else{
			//非ajax请求抛出异常
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
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
		$category = $this->meta->edit('category', $id);
		is_null($category) AND abort(404);
		return view('back.category.edit', ['data' => $category]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CategoryRequest $request, $id)
	{
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改分类']);

			if($validator->passes()){
				$this->meta->update('category', $data , $id);
				$json = array_replace($json, ['status' => 1, 'info' => '成功']);
			} else {
				$json = format_json_message($validator->messages(), $json);
			}
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(CategoryRequest $request, $id)
	{
		//
		if( $request->is_ajax() && $request->is_method('delete') )
		{
			$json = $request->response();
			$json = array_replace($json, ['operation' => '删除分类']);
			if($id == 1){
				$json = array_replace($json, ['info' => '失败原因为：<span class="text_error">ID为1的默认分类不能被删除！</span>']);
			}
			else{
				if($this->meta->hasContent('category', $id)){
					$json = array_replace($json, ['info' => '失败原因为：<span class="text_error">该分类下还存在文章，不能被删除！</span>']);
				}
				else{
					$this->meta->destroy('category', $id);
					$json = array_replace($json, ['status'=>1, 'info' => '成功']);
				}
			}
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


}
