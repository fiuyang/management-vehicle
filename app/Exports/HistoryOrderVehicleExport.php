<?php

namespace App\Exports;

use App\Models\VehicleUsage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class HistoryOrderVehicleExport implements FromCollection,  WithHeadings, WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return VehicleUsage::select('vehicle_usages.id', 'vehicle_usages.created_at as created_date', 'vehicle_usages.order_destination', 'employees.name as employee_name', 'officers.name as officer_name', 'vehicles.name as vehicle_name', 'vehicles.status')
            ->join('vehicles', 'vehicles.id', 'vehicle_usages.vehicle_id')
            ->join('employees', 'employees.id', 'vehicle_usages.employee_id')
            ->leftjoin('officers', 'officers.id', 'vehicle_usages.approval_id')
            ->get();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->created_date,
            $row->vehicle_name,
            $row->employee_name,
            $row->order_destination,
            $row->status,
            $row->officer_name,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Created Date',
            'Vehicle Name',
            'Employee Name',
            'Order Destination',
            'Status',
            'Officer Name'
        ];
    }
}
