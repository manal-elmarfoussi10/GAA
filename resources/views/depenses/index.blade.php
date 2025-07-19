@extends('layout')

@section('content')
<div class="p-4 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 p-6 bg-white rounded-xl shadow-sm border border-gray-100">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Gestion des Dépenses</h1>
            <p class="text-gray-600 mt-1">Liste des dépenses enregistrées dans le système</p>
        </div>
        <a href="#" class="flex items-center gap-2 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-4 py-2.5 rounded-lg transition-all shadow-md hover:shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
            </svg>
            Ajouter une dépense
        </a>
    </div>

    <!-- Control Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <!-- Column Visibility -->
            <div class="relative">
                <button onclick="toggleColumnMenu()" class="flex items-center gap-2 border border-gray-200 bg-white px-4 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Colonnes visibles
                </button>
                <div id="columnMenu" class="absolute left-0 mt-2 w-64 bg-white border border-gray-200 rounded-xl shadow-lg z-50 p-4 hidden">
                    <h3 class="font-medium text-gray-800 mb-3">Afficher/Masquer</h3>
                    <ul class="space-y-2">
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-date" checked>
                                <span>Date</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-dossier" checked>
                                <span>Dossier</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-fournisseur" checked>
                                <span>Fournisseur</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-paye" checked>
                                <span>Payé ?</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-ht" checked>
                                <span>Montant HT</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-ttc" checked>
                                <span>Montant TTC</span>
                            </label>
                        </li>
                        <li>
                            <label class="flex items-center gap-2 text-sm cursor-pointer text-gray-700">
                                <input type="checkbox" class="column-toggle rounded text-orange-500" data-column="col-actions" checked>
                                <span>Actions</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Export Buttons -->
            <div class="flex flex-wrap gap-2">
                <a href="#" class="flex items-center gap-2 border border-gray-200 px-4 py-2.5 rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export Excel
                </a>
                <a href="#" class="flex items-center gap-2 border border-gray-200 px-4 py-2.5 rounded-lg text-sm bg-white text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Export PDF
                </a>
            </div>
            
            <!-- Search and Filter -->
            <div class="ml-auto flex flex-wrap gap-2">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="border border-gray-200 bg-white pl-10 pr-4 py-2.5 rounded-lg text-sm text-gray-700 w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-3.5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
                <button class="flex items-center gap-2 border border-gray-200 bg-white px-4 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                    </svg>
                    Filtres
                </button>
            </div>
        </div>
    </div>

    <!-- Dépenses Table -->
    <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full table-auto min-w-[800px]">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-date">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-dossier">Dossier</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-fournisseur">Fournisseur</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-paye">Payé ?</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-ht">HT</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-ttc">TTC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider col-actions">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <!-- Expense 1 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap col-date">
                            <div class="text-sm text-gray-700">09/06/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-dossier">
                            <div class="font-medium">Martin Dubois</div>
                            <div class="text-xs text-gray-500 mt-1">#CL-2025-012</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-fournisseur">
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                                <span class="text-sm font-medium">GG AUTO</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-paye">
                            <span class="inline-flex items-center gap-1 bg-teal-100 px-3 py-1 rounded-full text-xs font-medium text-teal-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                OUI
                            </span>
                            <div class="text-xs text-teal-600 mt-1">Ajout le : 10/05/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-ht">604,63€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 col-ttc">604,63€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm col-actions">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="#" class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Modifier
                                </a>
                                
                                <a href="#" class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Expense 2 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap col-date">
                            <div class="text-sm text-gray-700">07/06/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-dossier">
                            <div class="font-medium">Sophie Lambert</div>
                            <div class="text-xs text-gray-500 mt-1">#CL-2025-008</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-fournisseur">
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                                <span class="text-sm font-medium">Fournitures Pro</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-paye">
                            <span class="inline-flex items-center gap-1 bg-yellow-100 px-3 py-1 rounded-full text-xs font-medium text-yellow-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                En attente
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-ht">1 204,50€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 col-ttc">1 442,90€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm col-actions">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="#" class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Modifier
                                </a>
                                
                                <a href="#" class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Expense 3 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap col-date">
                            <div class="text-sm text-gray-700">02/06/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-dossier">
                            <div class="font-medium">Thomas Moreau</div>
                            <div class="text-xs text-gray-500 mt-1">#CL-2025-015</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-fournisseur">
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                                <span class="text-sm font-medium">Tech Solutions</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-paye">
                            <span class="inline-flex items-center gap-1 bg-teal-100 px-3 py-1 rounded-full text-xs font-medium text-teal-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                OUI
                            </span>
                            <div class="text-xs text-teal-600 mt-1">Ajout le : 28/05/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-ht">890,00€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 col-ttc">1 067,50€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm col-actions">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="#" class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Modifier
                                </a>
                                
                                <a href="#" class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Expense 4 -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap col-date">
                            <div class="text-sm text-gray-700">28/05/2025</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-dossier">
                            <div class="font-medium">Émilie Rousseau</div>
                            <div class="text-xs text-gray-500 mt-1">#CL-2025-009</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-fournisseur">
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-200 border-2 border-dashed rounded-xl w-8 h-8"></div>
                                <span class="text-sm font-medium">Office Plus</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap col-paye">
                            <span class="inline-flex items-center gap-1 bg-red-100 px-3 py-1 rounded-full text-xs font-medium text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                Non
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 col-ht">320,75€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 col-ttc">384,90€</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm col-actions">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <a href="#" class="flex items-center gap-1 text-blue-600 hover:text-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                    Modifier
                                </a>
                                
                                <a href="#" class="flex items-center gap-1 text-red-600 hover:text-red-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="bg-white px-6 py-4 flex flex-col sm:flex-row items-center justify-between border-t border-gray-100">
            <div class="text-sm text-gray-700 mb-4 sm:mb-0">
                Affichage <span class="font-medium">1</span> à <span class="font-medium">4</span> sur <span class="font-medium">12</span> résultats
            </div>
            <div class="flex space-x-1">
                <button class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
                <button class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    1
                </button>
                <button class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-orange-500 border border-orange-500 rounded-md">
                    2
                </button>
                <button class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    3
                </button>
                <button class="relative inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleColumnMenu() {
        const menu = document.getElementById('columnMenu');
        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        const columnMenu = document.getElementById('columnMenu');
        const button = document.querySelector('button[onclick="toggleColumnMenu()"]');
        
        if (!columnMenu.contains(e.target) && !button.contains(e.target)) {
            columnMenu.classList.add('hidden');
        }
    });

    document.querySelectorAll('.column-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const columnClass = this.dataset.column;
            const isVisible = this.checked;
            
            document.querySelectorAll(`.${columnClass}`).forEach(cell => {
                cell.style.display = isVisible ? '' : 'none';
            });
            
            // Store preference in localStorage
            localStorage.setItem(columnClass, isVisible);
        });
    });

    // Load column preferences
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.column-toggle').forEach(toggle => {
            const columnClass = toggle.dataset.column;
            const isVisible = localStorage.getItem(columnClass) !== 'false';
            
            toggle.checked = isVisible;
            document.querySelectorAll(`.${columnClass}`).forEach(cell => {
                cell.style.display = isVisible ? '' : 'none';
            });
        });
    });
</script>
@endsection