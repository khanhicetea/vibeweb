<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WebsiteSettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'groups' => WebsiteSetting::groupedForForm(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'settings.site.title' => ['required', 'string', 'max:120'],
            'settings.site.tagline' => ['nullable', 'string', 'max:255'],
            'settings.site.contact_email' => ['nullable', 'email', 'max:255'],
            'settings.seo.meta_title' => ['nullable', 'string', 'max:120'],
            'settings.seo.meta_description' => ['nullable', 'string', 'max:300'],
            'settings.seo.meta_keywords' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (array_keys(WebsiteSetting::DEFINITIONS) as $key) {
            WebsiteSetting::setData($key, data_get($attributes, "settings.{$key}"));
        }

        return redirect()
            ->route('admin.settings.edit')
            ->with('status', 'Website settings saved.');
    }
}
