<?php

namespace App\Http\Controllers;

use App\Http\Requests\WaStoreRequest;
use App\Models\WhatsApp;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class WhatsAppController extends Controller
{
    public function index()
    {
        $settings = WhatsApp::all();
        return view('admin.whatsapp.index', compact('settings'));

    }

    public function wastore(WaStoreRequest $request)
    {
        $wa = WhatsApp::create([
            'api_key' => $request->api_key,
            'sender' => $request->sender,
        ]);

        return redirect()->back()->with('success', 'Api Key Berhasil');
    }

    public function deletewa($id)
    {
        $wa = WhatsApp::findorfail($id);
        $wa->delete();
        return redirect()->back()->with('success', 'Api Key Berhasil dihapus');

    }

    public function waupdate(Request $request, $id)
    {
        $wa = WhatsApp::findorfail($id);
        $wa->update([
            'api_key' => $request->api_key,
            'sender' => $request->sender,
        ]);
        return redirect()->back()->with('success', 'Api Key Berhasil di Update');

    }
}
