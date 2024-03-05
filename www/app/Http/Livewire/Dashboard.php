<?php

namespace App\Http\Livewire;


use App\Models\BankRates;
use App\Models\Banks;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Livewire\Component;

class Dashboard extends Component
{
    public $banks;
    public  Banks $showBank;

    public function mount()
    {
        $this->showBank = new Banks();
        $this->banks = Banks::all();
    }

    public function render()
    {
        $todayBanksRates = BankRates::latest()->where('code','USD')->get()->unique('bankId');
        $columnChartModel = new ColumnChartModel();
        $columnChartModel->setTitle('USD');
            foreach ($todayBanksRates as $rate){
                $columnChartModel->addColumn(Banks::getById($rate->bankId)->first()->title, $rate->bid, '#f6ad55');
            }
        return view('livewire.dashboard', [
            'columnChartModel' => $columnChartModel
        ]);
    }

    public function showBankModal($id)
    {
        $this->showBank = Banks::with('branches')->getById($id)->first();
        $this->dispatchBrowserEvent('show-bank-modal');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('close-modal');
        $this->showBank = new Banks();
    }
}
