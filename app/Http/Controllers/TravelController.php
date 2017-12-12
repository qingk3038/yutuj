<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TravelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 游记列表
     */
    public function index()
    {
        $travels = auth()->user()->travels()->withCount('likes')->where('status', '!=', 'draft')->orderByDesc('updated_at')->paginate(2);

        return view('www.home.index', compact('travels'));
    }

    /**
     * 游记发布界面
     */
    public function create()
    {
        return view('www.home.release');
    }

    /**
     * 发布游记
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|string|between:3,100|unique:travels',
            'thumb' => 'required|file',
            'body' => 'required|string|min:20',
            'status' => 'required|string|in:draft,audit',
            'province' => 'required|string',
            'city' => 'required|string',
        ]);
        $data['thumb'] = $request->file('thumb')->store('images');
        $data['description'] = str_limit(strip_tags($request->body), 350);
        $request->user()->travels()->create($data);

        return $request->status === 'draft' ? ['message' => '已保存至草稿箱中。'] : ['message' => '发布成功，请等待官方人员审核。'];
    }

    /**
     * 游记详情
     * @param Travel $travel
     * @return Travel
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Travel $travel)
    {
        $this->authorize('view', $travel);
        $prevId = Travel::where('id', '<', $travel->id)->max('id');
        $nextId = Travel::where('id', '>', $travel->id)->min('id');

        return view('www.home.travels', compact('travel', 'prevId', 'nextId'));
    }

    /**
     * 游记更新
     * @param Travel $travel
     * @return Travel
     */
    public function edit(Travel $travel)
    {
        return view('www.home.release_edit', compact('travel'));
    }

    /**
     * 游记更新
     * @param Request $request
     * @param Travel $travel
     * @return array
     */
    public function update(Travel $travel, Request $request)
    {
        $data = $this->validate($request, [
            'title' => ['required', 'string', 'between:3,100', Rule::unique('travels')->ignore($travel->id)],
            'thumb' => 'file',
            'body' => 'required|string|min:20',
            'status' => 'required|string|in:draft,audit',
            'province' => 'required|string',
            'city' => 'required|string',
        ]);
        if ($request->hasFile('thumb')) {
            Storage::delete($travel->thumb);
            $data['thumb'] = $request->file('thumb')->store('images');
        }

        $data['description'] = str_limit(strip_tags($request->body), 350);
        $travel->update($data);

        return $request->status === 'draft' ? ['message' => '已保存至草稿箱中。'] : ['message' => '发布成功，请等待官方人员审核。'];
    }

    /**
     * 游记删除
     * @param Travel $travel
     * @return array
     * @throws \Exception
     */
    public function destroy(Travel $travel)
    {
        Storage::delete($travel->thumb);
        $travel->delete();
        return ['message' => '成功删除。'];
    }

}
