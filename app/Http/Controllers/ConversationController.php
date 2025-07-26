<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Email;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ConversationController extends Controller
{
    /**
     * Start a new conversation
     */
    public function store(Request $request, Client $client)
{
    try {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $conversation = Email::create([
            'client_id' => $client->id,
            'sender' => Auth::user()->email,
            'receiver' => $client->email,
            'subject' => $request->subject,
            'content' => $request->content,
            'folder' => 'sent',
            'company_id' => Auth::user()->company_id,
        ]);

        // No changes needed here since we're using email_id
        $reply = new Reply([
            'email_id' => $conversation->id,
            'sender_id' => Auth::id(),
            'content' => $request->content,
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('conversations');
            $reply->file_path = $path;
            $reply->file_name = $request->file('file')->getClientOriginalName();
        }

        $reply->save();

        return back()->with('success', 'Conversation started!');
    } catch (\Exception $e) {
        return back()->with('error', 'Error: '.$e->getMessage());
    }
}

    /**
     * Reply to an existing conversation
     */
    public function reply(Request $request, Email $conversation)
    {
        try {
            // Validate input
            $request->validate([
                'content' => 'required|string',
                'file' => 'nullable|file|max:2048',
            ]);

            // Create reply
            $reply = new Reply([
                'email_id' => $conversation->id,
                'sender_id' => Auth::id(),
                'content' => $request->content,
            ]);

            // Handle file upload
            if ($request->hasFile('file')) {
                $path = $request->file('file')->store('conversations');
                $reply->file_path = $path;
                $reply->file_name = $request->file('file')->getClientOriginalName();
            }

            $reply->save();

            return back()->with('success', 'Reply sent!');
        } catch (\Exception $e) {
            Log::error('Reply error: '.$e->getMessage());
            return back()->with('error', 'Error: '.$e->getMessage());
        }
    }

    /**
     * Download a conversation attachment
     */
    public function download(Reply $reply)
    {
        try {
            // Verify file exists
            if (!Storage::exists($reply->file_path)) {
                abort(404);
            }

            return Storage::download($reply->file_path, $reply->file_name);
        } catch (\Exception $e) {
            Log::error('Download error: '.$e->getMessage());
            return back()->with('error', 'File not found');
        }
    }

    public function showThread(Client $client)
    {
        // Get or create thread for this client
        $thread = ConversationThread::firstOrCreate(
            ['client_id' => $client->id],
            [
                'subject' => 'Conversation with ' . $client->prenom,
                'company_id' => Auth::user()->company_id
            ]
        );
        
        $messages = Email::with('senderUser')
            ->where('thread_id', $thread->id)
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('clients.conversation', compact('client', 'thread', 'messages'));
    }

    public function sendMessage(Request $request, Client $client)
    {
        $request->validate([
            'content' => 'required|string',
        ]);
        
        $thread = ConversationThread::firstOrCreate(
            ['client_id' => $client->id],
            [
                'subject' => 'Conversation with ' . $client->prenom,
                'company_id' => Auth::user()->company_id
            ]
        );
        
        $message = new Email([
            'thread_id' => $thread->id,
            'sender_id' => Auth::id(),
            'sender' => Auth::user()->email,
            'receiver' => $client->email,
            'content' => $request->content,
            'folder' => 'sent',
            'company_id' => Auth::user()->company_id,
        ]);
        
        $message->save();
        
        return back()->with('success', 'Message sent!');
    }
}