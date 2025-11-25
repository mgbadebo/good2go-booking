<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.content.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => 'text',
                    'group' => $this->getGroupForKey($key),
                ]
            );
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    private function getGroupForKey($key)
    {
        if (str_contains($key, 'about')) {
            return 'about';
        }
        if (str_contains($key, 'contact') || str_contains($key, 'phone') || str_contains($key, 'email')) {
            return 'contact';
        }
        if (str_contains($key, 'bank') || str_contains($key, 'account')) {
            return 'payment';
        }
        return 'general';
    }
}
