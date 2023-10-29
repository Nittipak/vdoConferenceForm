<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FormStatus;
use App\Http\Controllers\Controller;
use App\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        return Form::query()
            ->with('users:id,name')
            ->when(request('status'), function ($query) {
                return $query->where('status', FormStatus::from(request('status')));
            })
            ->latest()
            ->paginate()
            ->through(fn ($form) => [
                'id' => $form->id,
                'contact_name' => $form->contact_name,
                'meeting_topic' => $form->meeting_topic,
                'meeting_room_name' => $form->meeting_room_name,
                'meeting_date' => $form->meeting_date,
                'meeting_time' => $form->meeting_time,
                'status' => [
                    'name' => $form->status->name,
                    'color' => $form->status->color(),
                ],
                'users' => $form->user,
            ]);
    }

    public function store()
    {
        $validated = request()->validate([
            'users_id' => 'required',
            'meeting_date' => 'required',
            'meeting_time' => 'required',
            'meeting_topic' => 'required',
            'meeting_room_name' => 'required',
            'notebook' => 'required',
            'speaker' => 'required',
            'contact_email' => 'required',
            'contact_name' => 'required',
            'contct_number' => 'required|max:10',
            'institution' => 'required',
            'เลขที่หนังสือ' => 'sometimes|max:8',
        ], [
            'users_id.required' => 'The user name field is required.',
        ]);

        Form::create([
            'users_id' => $validated['users_id'],
            'meeting_topic' => $validated['meeting_topic'],
            'meeting_room_name' => $validated['meeting_room_name'],
            'meeting_time' => $validated['meeting_time'],
            'meeting_date' => $validated['meeting_date'],
            'notebook' => $validated['notebook'],
            'speaker' => $validated['speaker'],
            'contact_email' => $validated['contact_email'],
            'contact_name' => $validated['contact_name'],
            'contct_number' => $validated['contct_number'],
            'institution' => $validated['institution'],
            'เลขที่หนังสือ' => $validated['เลขที่หนังสือ'],
            'status' => FormStatus::INPROCESS,
        ]);

        return response()->json(['message' => 'success']);
    }

    public function edit(Form $form)
    {
        return $form;
    }

    public function update(Form $form)
    {
        $validated = request()->validate([
            'users_id' => 'required',
            'meeting_date' => 'required',
            'meeting_time' => 'required',
            'meeting_topic' => 'required',
            'meeting_room_name' => 'required',
            'notebook' => 'required',
            'speaker' => 'required',
            'contact_email' => 'required',
            'contact_name' => 'required',
            'contct_number' => 'required',
            'institution' => 'required',
            'เลขที่หนังสือ' => 'sometimes|max:8',
        ], [
            'users_id.required' => 'The user name field is required.',
        ]);

        $form->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return response()->json(['success' => true], 200);
    }
}
