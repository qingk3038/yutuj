<?php

namespace App\Http\Controllers;

use App\Models\Customized;
use App\Rules\Mobile;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class CustomizedController extends Controller
{
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required|between:2,30',
            'mobile' => ['required', new Mobile],
        ]);

        if ($dz = Customized::where(['title' => $data['title'], 'mobile' => $data['mobile'], 'read' => 0])->count()) {
            return response(['title' => '你的需求提交失败！', 'message' => '你已经提交过了，请等待我们处理。']);
        }

        if ($user = $request->user()) {
            $data['user_id'] = $user->id;
        }

        $data['type'] = Agent::isMobile() ? 'Mobile' : 'PC';
        Customized::create($data);

        return response(['title' => '你的需求提交成功！', 'message' => '旅游顾问会尽快跟您联系。']);
    }
}
