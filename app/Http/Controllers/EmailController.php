<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use App\Models\Reply;

class EmailController extends Controller
{
    public function inbox()
    {
        $emails = Email::where('folder', 'inbox')
            ->where('is_deleted', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('emails.inbox', compact('emails'));
    }

    public function sent()
    {
        $emails = Email::where('folder', 'sent')->latest()->get();
        return view('emails.sent', compact('emails'));
    }

    public function important()
    {
        $emails = Email::where('tag', 'important')->get();
        return view('emails.important', compact('emails'));
    }

    public function bin()
    {
        $emails = Email::where('is_deleted', true)->get();
        return view('emails.bin', compact('emails'));
    }

    public function create()
    {
        return view('emails.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender' => 'required|string',
            'receiver' => 'nullable|string',
            'subject' => 'required|string',
            'content' => 'required|string',
            'tag' => 'nullable|string',
        ]);

        Email::create([
            'sender' => $request->sender,
            'receiver' => $request->receiver,
            'subject' => $request->subject,
            'content' => $request->content,
            'tag' => $request->tag,
            'folder' => 'sent',
        ]);

        return redirect()->route('emails.sent')->with('success', 'Email sent successfully.');
    }

    public function show($id)
    {
        $email = Email::findOrFail($id);
        return view('emails.show', compact('email'));
    }

    public function destroy(Email $email)
    {
        $email->delete(); // or forceDelete() if using SoftDeletes
        return redirect()->back()->with('success', 'Email supprimé définitivement.');
    }

    public function restore($id)
    {
        $email = Email::findOrFail($id);
        $email->is_deleted = false;
        $email->tag = null;
        $email->label_color = null;
        $email->save();
    
        return redirect()->route('emails.bin')->with('success', 'Email restored.');
    }

    public function toggleStar($id)
    {
        $email = Email::findOrFail($id);
        $email->update(['starred' => !$email->starred]);

        return back();
    }

    public function permanentDelete($id)
    {
        $email = Email::findOrFail($id);
        $email->delete();

        return back()->with('success', 'Email permanently deleted.');
    }

    public function markImportant($id)
{
    $email = Email::findOrFail($id);
    $email->tag = 'important';
    $email->tag_color = '#facc15'; // yellow
    $email->save();

    return redirect()->back()->with('success', 'Email marqué comme important.');
}
public function toggleImportant($id)
{
    $email = Email::findOrFail($id);

    if ($email->tag === 'important') {
        $email->tag = null;
        $email->tag_color = null;
    } else {
        $email->tag = 'important';
        $email->tag_color = '#facc15'; // Yellow
    }

    $email->save();

    return redirect()->back()->with('success', 'Email mis à jour.');
}

public function moveToTrash($id)
{
    $email = Email::findOrFail($id);
    $email->is_deleted = true;
    $email->tag = 'bin';
    $email->label_color = '#ef4444'; // red
    $email->save();

    return redirect()->back()->with('success', 'Email moved to trash.');
}

public function reply(Request $request, $id)
{
    $email = Email::findOrFail($id);

    $request->validate([
        'content' => 'required|string',
        'file' => 'nullable|file|max:2048',
    ]);

    $reply = new Reply([
        'email_id' => $email->id,
        'content' => $request->content,
        'file_path' => null,
        'file_name' => null,
    ]);

    // Handle file upload if present
    if ($request->hasFile('file')) {
        $path = $request->file('file')->store('attachments', 'public');
        $reply->file_path = $path;
        $reply->file_name = $request->file('file')->getClientOriginalName();
    }

    $reply->save();

    return redirect()->route('emails.show', $email->id)->with('success', 'Réponse envoyée.');
}

public function notifications()
{
    $emails = Email::where('folder', 'inbox')
                   ->where('is_read', false) // ← only unread ones
                   ->latest()
                   ->get();

    return view('emails.notifications', compact('emails'));
}
public function markAllRead()
{
    Email::where('folder', 'inbox')->update(['is_read' => true]);

    return redirect()->back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
}

}