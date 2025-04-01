<?php

namespace Modules\KnowledgeBaseApiModule\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:admin');
    }
    
    /**
     * Show the settings page.
     *
     * @return Response
     */
    public function index()
    {
        $api_token = Option::get('knowledgebase_api_token');
        $custom_url_template = Option::get('knowledgebase_api_custom_url');
        $client_url_template = Option::get('knowledgebase_api_client_url');
        
        return view('knowledgebase-api-module::settings', [
            'api_token' => $api_token,
            'custom_url_template' => $custom_url_template,
            'client_url_template' => $client_url_template,
        ]);
    }
    
    /**
     * Save settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function save(Request $request)
    {
        $validated = $request->validate([
            'api_token' => 'required|string|min:16|max:64',
            'custom_url_template' => 'nullable|string|max:255',
            'client_url_template' => 'nullable|string|max:255',
        ]);
        
        Option::set('knowledgebase_api_token', $request->api_token);
        Option::set('knowledgebase_api_custom_url', $request->custom_url_template);
        Option::set('knowledgebase_api_client_url', $request->client_url_template);
        
        \Session::flash('flash_success_floating', __('Settings saved'));
        
        return redirect()->route('knowledgebase-api-module.settings');
    }
} 