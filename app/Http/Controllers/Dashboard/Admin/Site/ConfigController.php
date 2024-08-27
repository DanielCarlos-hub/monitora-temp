<?php

namespace App\Http\Controllers\Dashboard\Admin\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ConfigRequest;
use App\Models\Site\Config;
use App\Services\ProcessImage;

class ConfigController extends Controller
{

    public function siteConfig()
    {
        $config = Config::first();

        return view('dashboard.admin.site.config', compact('config'));
    }

    public function updateSiteConfig(ConfigRequest $request, $id)
    {

        try {
            $config = Config::findOrFail($id);

            $site_config = $request->site;

            $request->file('logo')->move(storage_path().'\app\public\site\logo', $request->file('logo')->getClientOriginalName())->getRealPath();

            $site_config['logo'] = $request->file('logo')->getClientOriginalName();

            $imageResize = new ProcessImage();
            $site_config['favicon'] = $imageResize->convertImage($request->file('favicon'), 32, 32, 'favicon', $config->favicon);

            $config->update($site_config);

            $notification = array(
                'message' => 'As configurações do site foram atualizadas',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        } catch (\Exception $e) {
            dd($e);
            $notification = array(
                'message' => 'Não foi possível atualizar as configurações do Site',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
