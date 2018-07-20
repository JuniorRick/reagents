<?php
namespace App\Exports;
class ReagentExport implements \Maatwebsite\Excel\Concerns\FromCollection,
\Maatwebsite\Excel\Concerns\ShouldAutoSize,
\Maatwebsite\Excel\Concerns\WithHeadings {
  public function collection() {
    $reports = \App\Report::all();


    $data = [];

    foreach ($reports as $report) {
      $order = \App\Order::find($report->order_id);
      $row = new \stdClass();
      @$row->reagent_code = $order->reagentCode($order->reagent_id);
      @$row->producer = $order->producer($order->reagent_id);
      @$row->reagent_name = $order->reagentTitle($order->reagent_id);
      @$row->reagent_ref = $order->reagentRef($order->reagent_id);
      @$row->reagent_lot = $order->reagentLot($order->reagent_id);
      @$row->reagent_lot = $order->reagentLot($order->reagent_id);
      @$row->reagent_expire_date = $order->reagentExpireDate($order->reagent_id);
      @$row->reagent_handed_date = $order->handed_date;
      @$row->reagent_quantity = $order->reagentQty($order->reagent_id);
      @$row->order_extracted = $report->taken_quantity;
      @$row->person = $report->person($report->person_id);
      @$row->start_date = $report->start_date;
      @$row->end_date = $report->end_date;

      array_push($data, new \Illuminate\Database\Eloquent\Collection($row));
    }
    return collect($data);
  }

  public function headings(): array {
    return [
        "Cod", "Producator", "Denumire regent", "Ref", "Lot",
        "Data Expirarii", "Data eliberarii", "Cantitate cutie",
        "Cantitate extrasa", "Persoana", "Data installarii",
        "Data finalizarii",
    ];
  }
}
