<?php namespace Douyasi\Http\Controllers\Admin;

use Douyasi\Http\Requests\ArticleRequest;  //请求层
use Douyasi\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Douyasi\Repositories\ContentRepository;  //模型仓库层


/*
#Laravel 5 推荐使用Request （facade），但Input仍然可以使用，这里我们使用服务容器自动注入
use Input;
*/

/**
 * 内容文章资源控制器
 * 
 * @author raoyc <raoyc2009@gmail.com>
 */
class AdminArticleController extends BackController {


	/**
	 * The ContentRepository instance.
	 *
	 * @var Douyasi\Repositories\ContentRepository
	 */
	protected $content;


	public function __construct(
		ContentRepository $content)
	{
		parent::__construct();
		$this->content = $content;
		
		if(! user('object')->can('manage_contents') ){
			$this->middleware('deny403');
		}
		
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//处理get参数
		$s_title = $request->input('s_title');
		$data = ['s_title'=>$s_title];

		//使用仓库方法获取文章列表
		$articles = $this->content->index('article', $data);

		//传入自定义的分页Presenter
		$links = page_links($articles, $data);

		return view('back.article.index', compact('articles','links'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//需传递分类信息进去
		$categories = $this->content->meta();
		return view('back.article.create', compact('categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ArticleRequest $request)
	{
		
		//鉴权，这里需要手动对存储行为进行鉴权，如不需要可直接移除
		if( ($response = $request->make()) !== true){
			return $response;
			die();
		}
		if ($request->is_ajax())  //判断是否ajax提交
		{
			$validator = $request->validate('store');  //获取Validator对象
			$data = $request->data('store');  //获取请求过来的数据
			$json = $request->response();
			$json = array_replace($json, ['operation' => '添加文章']);

			if($validator->passes()){

				$content = $this->content->store('article', $data, user('id'));  //使用仓库方法存储
				if($content->id){  //添加成功
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
		$categories = $this->content->meta();
		$article = $this->content->edit('article', $id);
		is_null($article) AND abort(404);
		return view('back.article.edit', ['data' => $article, 'categories' => $categories]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Douyasi\Http\Requests\ArticleRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ArticleRequest $request, $id)
	{
		//
		if ( $request->is_ajax() && $request->is_method('put') )
		{
			$validator = $request->validate('update');
			$data = $request->data('update');
			$json = $request->response();
			$json = array_replace($json, ['operation' => '修改文章']);

			if($validator->passes()){
				$this->content->update('article', $data , $id);
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
	public function destroy(ArticleRequest $request, $id)
	{
		//
		if($request->is_ajax() && $request->is_method('delete'))
		{
			$this->content->destroy('article', $id);
			$json = [
				'status' => 1, 
				'info' => '成功', 
				'operation' => '删除文章', 
				'url' => route('admin.article.index'), 
			];
			return response()->json($json);
		}
		else{
			return view('back.exceptions.jump', ['exception' => '非法请求，不予处理！']);
		}
	}


}
