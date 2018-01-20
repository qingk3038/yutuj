<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Facades\Agent;

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
        $travels = auth()->user()->travels()->withCount('likes')->where('status', '!=', 'draft')->orderByDesc('updated_at')->paginate();

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
            'description' => 'required|string|between:10, 350',
            'body' => 'required|string|min:20',
            'status' => 'required|string|in:draft,audit',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
        ]);
        $data['thumb'] = $request->file('thumb')->store('images');
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

        $prevId = Travel::where('user_id', auth()->id())->where('status', $travel->status)->where('id', '<', $travel->id)->max('id');
        $nextId = Travel::where('user_id', auth()->id())->where('status', $travel->status)->where('id', '>', $travel->id)->min('id');

        return view('www.home.travels', compact('travel', 'prevId', 'nextId'));
    }

    /**
     * 游记更新
     * @param Travel $travel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Travel $travel)
    {
        $this->authorize('update', $travel);
        return view('www.home.release_edit', compact('travel'));
    }

    /**
     * 游记更新
     * @param Travel $travel
     * @param Request $request
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Travel $travel, Request $request)
    {
        $this->authorize('update', $travel);

        $data = $this->validate($request, [
            'title' => ['required', 'string', 'between:3,100', Rule::unique('travels')->ignore($travel->id)],
            'thumb' => 'image',
            'description' => 'required|string|between:10, 350',
            'body' => 'required|string|min:20',
            'status' => 'required|string|in:draft,audit',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
        ]);
        if ($request->hasFile('thumb')) {
            Storage::delete($travel->thumb);
            $data['thumb'] = $request->file('thumb')->store('images');
        }

        $travel->update($data);

        return $request->status === 'draft' ? ['message' => '已保存至草稿箱中。'] : ['message' => '发布成功，请等待官方人员审核。'];
    }

    /**
     * 更新缩略图
     * @param Travel $travel
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function updateThumb(Travel $travel, Request $request)
    {
        $this->authorize('update', $travel);
        $this->validate($request, [
            'thumb' => 'required|image'
        ]);
        Storage::delete($travel->thumb);
        $thumb = $request->file('thumb')->store('images');
        $travel->thumb = $thumb;
        $travel->save();

        $path = Agent::isMobile() ? imageCut(414, 220, $thumb) : imageCut(870, 290, $thumb);
        return ['message' => '封面设置成功。', 'path' => $path];
    }

    /**
     * 游记删除
     * @param Travel $travel
     * @return array
     * @throws \Exception
     */
    public function destroy(Travel $travel)
    {
        $this->authorize('delete', $travel);

        Storage::delete($travel->thumb);
        $travel->delete();
        return ['message' => '成功删除。'];
    }

}
