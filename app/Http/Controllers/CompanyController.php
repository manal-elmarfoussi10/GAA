<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function show()
    {
        // Assuming only one company record
        $company = Company::first();

        return view('company.profile', compact('company'));
    }

    public function create()
{
    return view('company.create');
}

public function store(Request $request)
{
    $company = new Company($request->all());
    $company->save();

    return redirect()->route('company.profile')->with('success', 'Informations enregistrées.');
}

    public function edit()
    {
        $company = Company::first();

        return view('company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $company = Company::first();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'commercial_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'siret' => 'nullable|string|max:50',
            'tva' => 'nullable|string|max:50',
            'iban' => 'nullable|string|max:50',
            'bic' => 'nullable|string|max:50',
            'ape' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'known_by' => 'nullable|string|max:255',
            'contact_permission' => 'nullable|string|max:255',
            'garage_type' => 'nullable|string|max:100',

            // File fields (optional, validate type/size if needed)
            'logo' => 'nullable|file',
            'rib' => 'nullable|file',
            'kbis' => 'nullable|file',
            'id_photo_recto' => 'nullable|file',
            'id_photo_verso' => 'nullable|file',
            'tva_exemption_doc' => 'nullable|file',
            'invoice_terms_doc' => 'nullable|file',
        ]);

        // Handle file uploads
        foreach (['logo', 'rib', 'kbis', 'id_photo_recto', 'id_photo_verso', 'tva_exemption_doc', 'invoice_terms_doc'] as $field) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store('company_files', 'public');
            }
        }

        $company->update($data);

        return redirect()->route('company.profile')->with('success', 'Informations mises à jour avec succès.');
    }
}