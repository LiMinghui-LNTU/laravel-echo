<?php

namespace App\Http\Controllers\Admin;

use App\Model\Knowledge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    private $sViewPath = 'admin.';
    private $sidebar = 'admin.layout.sidebar2';
    protected $oUser;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->oUser = Auth::user();
            if ($this->oUser->role_id == 2) {
                return $next($request);
            } else {
                abort(404);
            }
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sTitle = '养护文章列表';
        $sidebar = $this->sidebar;
        $content = 'admin.article.index';
        //拿到所有文章
        $oArticles = Knowledge::getAllArticles();
        return view($this->sViewPath. 'index', compact('sTitle', 'sidebar', 'content', 'oArticles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sTitle = '新增文章';
        $sidebar = $this->sidebar;
        $content = 'admin.article.create';
        return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'title'=>trim($request->input('title')),
            'thumb'=>$request->input('thumb'),
            'description'=>trim($request->input('description')),
            'content'=>trim($request->input('content')),
            'coins'=>trim($request->input('coins'))
        );
        $validator = Knowledge::knowledgeValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //数据入库
            $bRes = Knowledge::saveArticle($data);
            if ($bRes) {
                return redirect('/admin/article');
            } else {
                Session::flash('warning', '保存失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sTitle = '文章编辑';
        $sidebar = $this->sidebar;
        $content = 'admin.article.edit';
        //获取这篇文章
        $oArticle = Knowledge::getArticleById($id);
        if (is_null($oArticle)) {
            Session::flash('warning', '该文章不存在或已删除');
            return redirect()->back();
        } else {
            return view($this->sViewPath . 'index', compact('sTitle', 'sidebar', 'content', 'oArticle'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array(
            'title'=>trim($request->input('title')),
            'thumb'=>$request->input('thumb'),
            'description'=>trim($request->input('description')),
            'content'=>trim($request->input('content')),
            'coins'=>trim($request->input('coins'))
        );
        //验证
        $validator = Knowledge::knowledgeValid($data);
        if ($validator->fails()) {
            Session::flash('warning', $validator->messages()->first());
            return redirect()->back()->withInput();
        } else {
            //更新数据
            $iRes = Knowledge::updateArticle($id, $data);
            if ($iRes) {
                return redirect('/admin/article');
            } else {
                Session::flash('warning', '更新失败');
                return redirect()->back()->withInput();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $iId = $request->input('id');
        $oArticle = Knowledge::getArticleById($iId);
        if (is_null($oArticle) || $iId != $id) {
            return json_encode(['code' => 1004, 'msg' => '此文章不存在或已删除']);
        } else {
            Knowledge::destroy($iId);
            return json_encode(['code' => 1001, 'msg' => '删除成功']);
        }
    }
}
