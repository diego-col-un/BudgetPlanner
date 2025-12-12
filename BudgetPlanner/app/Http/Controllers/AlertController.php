<?php
namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Auth::user()->alerts()->paginate(10);
        return view('alerts.index', compact('alerts'));
    }

    public function show(Alert $alert)
    {
        $this->authorize('view', $alert); // opcional, crea policy o quita
        if (!$alert->read) {
            $alert->update(['read' => true]);
        }
        return view('alerts.show', compact('alert'));
    }

    // marcar todas como leídas (opcional)
    public function markAllRead()
    {
        Auth::user()->alerts()->where('read', false)->update(['read' => true]);
        return back()->with('success','Alertas marcadas como leídas.');
    }
}
