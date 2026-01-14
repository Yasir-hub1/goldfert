<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:255',
                'message' => 'required|string|max:5000',
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser texto.',
                'name.max' => 'El nombre no puede exceder 255 caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser válido.',
                'email.max' => 'El correo electrónico no puede exceder 255 caracteres.',
                'phone.string' => 'El teléfono debe ser texto.',
                'phone.max' => 'El teléfono no puede exceder 255 caracteres.',
                'message.required' => 'El mensaje es obligatorio.',
                'message.string' => 'El mensaje debe ser texto.',
                'message.max' => 'El mensaje no puede exceder 5000 caracteres.',
            ]);

            $contact = Contact::create($validated);

            return response()->json([
                'message' => 'Mensaje enviado exitosamente. Nos pondremos en contacto contigo pronto.',
                'contact' => $contact
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error al guardar contacto: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al enviar el mensaje. Por favor, intenta de nuevo.'
            ], 500);
        }
    }

    public function index()
    {
        try {
            $contacts = Contact::orderBy('created_at', 'desc')->get();
            return response()->json($contacts);
        } catch (\Exception $e) {
            \Log::error('Error al obtener contactos: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al cargar los contactos.'
            ], 500);
        }
    }

    public function markAsRead($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->update(['read' => true]);
            return response()->json([
                'message' => 'Contacto marcado como leído.',
                'contact' => $contact
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al marcar contacto como leído: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error al actualizar el contacto.'
            ], 500);
        }
    }

    public function unreadCount()
    {
        try {
            $count = Contact::where('read', false)->count();
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['count' => 0]);
        }
    }
}
