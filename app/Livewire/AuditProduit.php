<?php

namespace App\Livewire;

use App\Models\AuditProduit as Audit;
use Livewire\Component;


class AuditProduit extends Component
{
    public function render()
    {
        $audits = Audit::orderBy('created_at', 'desc')->get();
        return view('livewire.audit-produit', compact('audits'));
    }
}
